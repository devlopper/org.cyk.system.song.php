<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

require_once('\database\seeds\AbstractSeeder.php');

abstract class AbstractIdentifiableTest extends TestCase {

    use DatabaseMigrations;

    public function testList(){
      $this->visit('/song/list')
             ->see('Laravel 5')
             ->dontSee('Rails');
    }
    public function ftestCreate(){
      $song = (new SongBusiness())->instanciateOne();
      $song->getGlobalIdentifierInstance()->code = "s001";
      $song->getGlobalIdentifierInstance()->name = "Yes! You are";
      $song->lyrics="Oh Jesus! You are my lord.";

      $globalIdentifierCount = (new App\Service\Business\GlobalIdentifierBusiness())->countAll();
      $songCount = (new SongBusiness())->countAll();

      (new SongBusiness())->create($song);

      $this->assertEquals($globalIdentifierCount+1, (new App\Service\Business\GlobalIdentifierBusiness())->countAll());
      $this->assertEquals($songCount+1, (new SongBusiness())->countAll());

      $this->seeInDatabase('globalidentifier', ['identifier' => $song->getGlobalIdentifierInstance()->identifier,'code' => 's001','name' => 'Yes! You are']);
      $this->seeInDatabase('song', ['lyrics' => 'Oh Jesus! You are my lord.','globalidentifier' => $song->getGlobalIdentifierInstance()->identifier]);

      $song = (new SongBusiness())->findByCode("s001");
      $this->assertSong("s001","Yes! You are","Oh Jesus! You are my lord.",$song);
    }

    public function ftestRead(){
      $song = new Song();
      $song->getGlobalIdentifierInstance()->code = "s001ToRead";
      $song->getGlobalIdentifierInstance()->name = "My song";
      $song->lyrics="The lines of the lyrics";
      (new SongBusiness())->create($song);
      $song = (new SongBusiness())->findByCode("s001ToRead");
      $this->assertSong("s001ToRead","My song","The lines of the lyrics",$song);
    }

    public function ftestUpdate(){
      $song = new Song();
      $song->getGlobalIdentifierInstance()->code = "s001ToUpdate";
      $song->getGlobalIdentifierInstance()->name = "My song";
      $song->lyrics="The lines of the lyrics";
      //$this->echoSong($song,"Before create");
      (new SongBusiness())->create($song);
      $song = ((new SongBusiness())->findByCode("s001ToUpdate"));
      //$this->echoSong($song,"After find by code");
      $this->assertSong("s001ToUpdate","My song","The lines of the lyrics",$song);
      //$song->setGlobalIdentifierInstance($song->getGlobalIdentifier);
      $song->getGlobalIdentifierInstance()->name = "Newtitle";
      //$song->name="NewTitle";
      $song->lyrics="The lines of the lyrics.More lines";
      //$this->echoSong($song,"Before update");
      (new SongBusiness())->update($song);
      $song = (new SongBusiness())->findByCode("s001ToUpdate");
      //$this->echoSong($song,"After find by code after update");
      $this->assertSong("s001ToUpdate","Newtitle","The lines of the lyrics.More lines",$song);

    }

    public function ftestDelete(){
      $song = new Song();
      $song->getGlobalIdentifierInstance()->code = "s001ToDelete";
      $song->getGlobalIdentifierInstance()->name = "My song";
      $song->lyrics="The lines of the lyrics";

      $globalIdentifierCount = (new App\Service\Business\GlobalIdentifierBusiness())->countAll();
      $songCount = (new SongBusiness())->countAll();
      (new SongBusiness())->create($song);
      $this->assertEquals($globalIdentifierCount+1, (new App\Service\Business\GlobalIdentifierBusiness())->countAll());
      $this->assertEquals($songCount+1, (new SongBusiness())->countAll());

      $song = (new SongBusiness())->findByCode("s001ToDelete");

      $globalIdentifierCount = (new App\Service\Business\GlobalIdentifierBusiness())->countAll();
      $songCount = (new SongBusiness())->countAll();
      (new SongBusiness())->delete($song);
      $this->assertEquals($globalIdentifierCount-1, (new App\Service\Business\GlobalIdentifierBusiness())->countAll());
      $this->assertEquals($songCount-1, (new SongBusiness())->countAll());

      $this->assertEquals(null, (new App\Service\Business\GlobalIdentifierBusiness())->findByCode("s001ToDelete"));
      $this->assertEquals(null, (new SongBusiness())->findByCode("s001ToDelete"));
    }

    public function ftestPagination(){
      $songBusiness = new SongBusiness();
      for($i = 0 ; $i < 10 ; $i++){
        $song = new Song();
        $song->getGlobalIdentifierInstance()->code = "s".$i;
        $song->getGlobalIdentifierInstance()->name = "My song";
        $song->lyrics="The lines of the lyrics";
        $songBusiness->create($song);
      }

      $paginator = new \App\Model\Utils\Pagination(0,3);
      $songs = $songBusiness->findAllUsingPagination($paginator);
      $this->assertSongPagination(['s0','s1','s2'],$paginator,$songs);

      $paginator = new \App\Model\Utils\Pagination(3,3);
      $songs = $songBusiness->findAllUsingPagination($paginator);
      $this->assertSongPagination(['s3','s4','s5'],$paginator,$songs);

    }

    /**/

    protected function create($count){
      for($i = 0 ; $i < $count ; $i++){
        $song = new Song();
        $song->getGlobalIdentifierInstance()->code = "s".$i;
        $song->getGlobalIdentifierInstance()->name = "My song";
        $song->lyrics="The lines of the lyrics";
        $songBusiness->create($song);
      }
    }

    /**/

    private function assertSong($code,$name,$lyrics,$song){
      $this->assertNotEquals(null, $song);
      $this->assertNotEquals(null, $song->getGlobalIdentifierInstance());
      $this->assertEquals($song->globalidentifier, $song->getGlobalIdentifierInstance()->identifier);
      $this->assertEquals($code, $song->getGlobalIdentifierInstance()->code);
      $this->assertEquals($name, $song->getGlobalIdentifierInstance()->name);
      $this->assertEquals($lyrics, $song->lyrics);
    }

    private function echoSong($song,$message){
      echo "\r\n".$message."\r\nIDENTIFIER : ".$song->identifier."\r\n";
      echo "GLOBAL IDENTIFIER : ".$song->globalidentifier."\r\n";
      echo "CODE : ".$song->getGlobalIdentifierInstance()->code."\r\n";
      echo "NAME : ".$song->getGlobalIdentifierInstance()->name."\r\n";
      echo "LYRICS : ".$song->lyrics."\r\n";
      var_dump($song->getAttributes());
    }

    private function assertSongPagination($codes,$paginator,$songs){
      for($i = 0 ; $i < count($songs) ; $i++){
        $this->assertEquals($codes[$i], $songs[$i]->getGlobalIdentifier->code);
      }
    }

    /**/

    protected abstract function getIdentifiableClassName();

    protected function getBusinessClass(){
      return \App\Utils::getIdentifiableBusinessClassName($this->getIdentifiableClassName());
    }

    protected function getBusinessInstance(){
      $businessClass = $this->getBusinessClass();
      $business = new $businessClass;
      return $business;
    }
}

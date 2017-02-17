<?php

class SongBusinessTest extends AbstractIdentifiableTest {

  protected function getIdentifiableClassName(){
    return "\App\Model\Identifiable\Song\Song";
  }

  protected function getDirectFieldNames(){
    return ['lyrics'];
  }

}

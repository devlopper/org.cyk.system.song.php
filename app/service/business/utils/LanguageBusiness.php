<?php

namespace App\Service\Business\Utils;

class LanguageBusiness extends \App\Service\Business\AbstractBusiness {

    public function find($identifier,$arguments){
      return trans($identifier,$arguments);
    }

    public function findVerb($identifier){
      return $this->find('verb.'.$identifier,[]);
    }

    public function findField($identifier){
      return $this->find('field.'.$identifier,[]);
    }

    public function findAction($actionIdentifier,$classInfos,$noun){
      $arguments = array();
      $arguments['action'] = trans('noun.'.$actionIdentifier);
      $arguments['of'] = 'de';
      $arguments['noun'] = $classInfos->label;
      return $this->find('message.action.'.($noun?'noun':'verb'),$arguments);
    }
}

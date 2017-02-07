<?php

namespace App;

class Utils {

  public static function getIdentifiableLayerClassName($identifiableClassName,$layerNamespacePrefix,$layerClassNameSuffix){
    if($layerClassNameSuffix == null)
      $layerClassNameSuffix = substr($layerNamespacePrefix, strpos($layerNamespacePrefix, "\\") + 1);
    return str_replace("Model\Identifiable",$layerNamespacePrefix, $identifiableClassName).$layerClassNameSuffix;
  }

  public static function getIdentifiableServiceClassName($identifiableClassName,$serviceName){
    return Utils::getIdentifiableLayerClassName($identifiableClassName,"Service\\".$serviceName,null);
  }

  public static function getIdentifiablePersistenceClassName($identifiableClassName){
    return Utils::getIdentifiableServiceClassName($identifiableClassName,"Persistence");
  }

  public static function getIdentifiableBusinessClassName($identifiableClassName){
    return Utils::getIdentifiableServiceClassName($identifiableClassName,"Business");
  }

  public static function getIdentifiableDtoClassName($identifiableClassName){
    return $identifiableClassName."Dto";
  }

  public static function getIdentifiableFormClassName($identifiableClassName){
    return $identifiableClassName."Form";
  }

  public static function getIdentifiableControllerClassName($identifiableClassName){
    return Utils::getIdentifiableLayerClassName($identifiableClassName,"Http\Controllers","Controller");
  }

  public static function getIdentifiableClassIdentifier($identifiableClassName){
    return Utils::getIdentifiableLayerClassName($identifiableClassName,"Http\Controllers","Controller");
  }
}

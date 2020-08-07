<?php

namespace Epiqworx\Views;
/**
*
*/
abstract class Resource
{
  /**
   * USR (Universal System Resources)
   * Used to load node modules
   */
  static function usr($file)
  {
    $temp = unserialize(PATHS);
    return $temp['USR'] . $file;
  }

  /**
   * RSC (Resources)
   * Used to load public files
   */
  static function rsc($file)
  {
    $temp = unserialize(PATHS);
    return $temp['RSC'] . $file;
  }

  /**
   * RSC (Resources)
   * Used to load public files
   */
  static function section($file)
  {
    $temp = unserialize(PATHS);
    $template = $temp['VIEW'] . str_replace('.', DIRECTORY_SEPARATOR, $file) . '.php';
    if (!is_file($template) || !is_readable($template)) {
      throw new \InvalidArgumentException(
          "The template '$template' is invalid.");
    } 
    include_once $template;
    return; 
  }

  /**
   * RSC (Resources)
   * Used to load public files
   */
  static function content($file, $fields = array(), $required = true)
  {
    if($fields) {
      extract($fields);
      ob_start();
      //ob_get_clean();
    }
    if($required) {
      require_once $file;
      return;
    }
		include_once $file; 
    return;
  }
}

?>

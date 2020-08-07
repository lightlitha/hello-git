<?php

namespace Epiqworx\Views;
/**
*
*/
class Resource
{
  /**
   * USR (Universal System Resources)
   * Used to load node modules
   */
  public function usr($file)
  {
    $temp = unserialize(PATHS);
    return $temp['USR'] . $file;
  }

  /**
   * RSC (Resources)
   * Used to load public files
   */
  public function rsc($file)
  {
    $temp = unserialize(PATHS);
    return $temp['RSC'] . $file;
  }

  /**
   * RSC (Resources)
   * Used to load public files
   */
  public function error($file, $hold)
  {
    $temp = unserialize(PATHS);
    $template = $temp['ERROR'] . str_replace('.', DIRECTORY_SEPARATOR, $file) . '.php';
    if (!is_file($template) || !is_readable($template)) {
      throw new \InvalidArgumentException(
          "The error template '$template' is invalid.");
    } 
    $this->content($template, $hold);
    return;
  }

  /**
   * RSC (Resources)
   * Used to load public files
   */
  public function section($file)
  {
    $temp = unserialize(PATHS);
    $template = $temp['VIEW'] . str_replace('.', DIRECTORY_SEPARATOR, $file) . '.php';
    if (!is_file($template) || !is_readable($template)) {
      throw new \InvalidArgumentException(
          "The template '$template' is invalid.");
    } 
    $hold = [];
    foreach (unserialize(ROUTE) as $key => $value) {
      $hold[$key] = "?r=" . $value;
    }
    $this->content($template, $hold);
    return; 
  }

  /**
   * RSC (Resources)
   * Used to load public files
   */
  public function content($file, $fields = array(), $required = true)
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

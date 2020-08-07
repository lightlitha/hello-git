<?php
  
  /**
   * Immutables
   */
  require_once __DIR__ . '/../bin/immutable.php';

  /**
   * Web Routes
   */
  require_once __DIR__ . '/../www/web.php';

  /**
   * Autoload
   */
  require_once __DIR__ . '/../vendor/autoload.php';

  /**
   * 
   */
  set_error_handler("Epiqworx\Glitch\Flaw::dev_errors");

  /**
   * 
   */
  error_reporting(E_ALL);

  /**
   * 
   */
  ini_set("display_errors", 1);

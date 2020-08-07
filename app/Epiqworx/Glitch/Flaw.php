<?php

namespace Epiqworx\Glitch;
use Epiqworx\Views\Resource;

abstract class Flaw {
  /**
   * @param $errno        : Required. Specifies the error report level for the user-defined error. Must be a value number.
   * @param $errstr       : Required. Specifies the error message for the user-defined error.
   * @param $errfile      : Optional. Specifies the filename in which the error occurred.
   * @param $errline      : Optional. Specifies the line number in which the error occurred.
   * @param $context      : Optional. Specifies an array containing every variable, and their values, in use when the error occurred
   */
  public static function dev_errors($errno, $errstr, $errfile, $errline)
  {
    $rsc = new Resource();
    $rsc->error("dev_error", ["errno" => $errno, "errstr" => $errstr, "errfile" => $errfile, "errline" => $errline]);
    return true;
  }
}

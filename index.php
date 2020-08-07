<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once 'app/init.php';

// use Epiqworx\Model\User as User;

new Epiqworx\Route\Router();

// $filter = new User();

// echo $filter->Display();
// echo filter_input(INPUT_SERVER, 'PHP_SELF');
// $phpSelf = explode(DIRECTORY_SEPARATOR, filter_input(INPUT_SERVER, 'PHP_SELF'));
// if (empty($level)){$level=1;}   // website hierachy
// $temp = "";
// for($k=1;$k<count($phpSelf)-$level;$k++){
//     $temp .= DIRECTORY_SEPARATOR.$phpSelf[$k];
// }

// echo $temp;
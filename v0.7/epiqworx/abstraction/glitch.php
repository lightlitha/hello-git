<?php

namespace Epiqworx\Abstraction;

abstract class Glitch {
    public static function e404($page = '') {
        require_once 'epiqworx/error/404.php';
    }
}

?>

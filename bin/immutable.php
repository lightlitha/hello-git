<?php

define("APPNAME","Epiqworx");
define("APPVERSION","v0.5");

define("PATHS",
    serialize(
        array(
            "CONTROLLER" => "",
            "MODEL" => "",
            "VIEW" => "resource/views/",
            "USR" => "public/",
            "RSC" => "resource/",
            "NODE_RSC" => "node_modules",
            "MAIN_VIEW" => "layouts/main.php"
        )
    )
);

define("DEFAULTS",
    serialize(
        array(
            "CLASS" => "WWW\Http\Offline\Welcome",
            "METHOD" => "landing",
        )
    )
);

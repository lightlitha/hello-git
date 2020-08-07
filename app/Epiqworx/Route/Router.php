<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Epiqworx\Route;

use Epiqworx\Glitch\Flaw;

/**
 * Description of Router
 *
 * @author math
 */
class Router {
  /**
     * Controller Class
     * e.g https://epiquadruple.org/#/classname/
     * @var string
     * @access private
     */
    private $controller = '';
    /**
     * Method in class
     * e.g https://epiquadruple.org/#/classname/methodname
     * @var string
     * @access private
     */
    private $method = '';
    /**
     * Method Parameters
     * e.g https://epiquadruple.org/#/classname/methodname/param1/param2/ etc.
     * @var array
     * @access private
     */
    private $params = [];

    private $class_method;

    function __construct() {
        try {
            $this->class_method = unserialize(DEFAULTS);
            $url = $this->uri();
            if (count($url) == 0) {
                $this->controller = $this->class_method['CLASS'];
                $this->method = $this->class_method['METHOD'];
                $this->controller = new $this->controller();
            } else {
                $this->setClass($url[0]);
                $this->controller = new $this->controller();
                $this->setMethod($this->controller, $url[1]);
                unset($url[0]);
                unset($url[1]);
                $this->params = $url ? array_values($url) : [];
            }
            call_user_func_array([$this->controller, $this->method], $this->params);
        } catch (\Throwable $th) {
            trigger_error($th->getMessage());
        }
  }

  /**
     * Takes URL request, splits to array, removes web parent directories
     * @return array : Class, Method, Method Params
     */
    private function uri() {
        try {
            $uri = explode("/", $this->getRequest());
            if ($uri[0] === NULL | $uri[0] === "" | $uri[0] === "/") {
                unset($uri[0]);
            }
            $uri = array_values($uri);
            return array_values($uri);
        } catch (\Throwable $th) {
            trigger_error("Error in the uri function " . $th->getMessage());
        }
  }

  /**
     * Looks for file and requires it.
     * @param type $classObj
     */
    private function setClass($classObj) {
        $path = unserialize(PATHS);
        foreach ($path['CONTROLLER'] as $key => $value) {
            if (is_readable($value . ($classObj) . '.php')) {
                $this->controller = str_replace("/","\\",$value).$classObj;
            }
        }
        if(empty($this->controller)) {
            $msg = "Could not find the file for class " . ($classObj);
            trigger_error($msg);
        }
  }

  /**
     * Set Method Call for Class
     * Display Error Message If Method Not Found
     * And No Page Content Rendered
     * @param type $classObj : Class
     * @param type $method : Method
     */
    private function setMethod($classObj, $method) {
        if (!is_null($method)) {
            if (method_exists($classObj, $method)) {
                $this->method = $method;
            } else {
              trigger_error("Method : " . $method . " Does Not Exist <br>");
            }
        } else {
          trigger_error("Method : " . $method . " Is Not Set <br>");
        }
  }
  
  /**
     * Removes Get Parameter Values From URL
     * @param server-request $url
     * @return string
     */
    private function getRequest() {
        $url = filter_input(INPUT_GET, 'r');
        if(empty($url)) { return ''; }
        else { return $url; }
  }

}
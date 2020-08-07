<?php

namespace Epiqworx\Controllers;
use Epiqworx\Views\Resource;
/**
*
*/
class Controller implements IController
{
		protected $view;
		protected $template;
		protected $fields = array();

		function __construct($tempate = null, array $fields = array())
		{
			$temp = unserialize(PATHS);
			$this->view = $temp['VIEW'];
			if($tempate !== null) {
				$this->view($tempate);
			}
			if(!empty($fields)) {
				foreach ($fields as $name => $value) {
					$this->$name = $value;
				}
			}
		}

    public function view($template) {
        $template = $this->view . $template . ".php";
        if (!is_file($template) || !is_readable($template)) {
            throw new \InvalidArgumentException(
                "The template '$template' is invalid.");
        }
        $this->template = $template;
    }

		public function get_view() {
			return $this->template;
		}

		public function frame($name, $value) {
        $this->fields[$name] = $value;
    }

    public function get_frame($name) {
        return $this->fields;
    }

    public function render($file, $fields = [], $required = true) {
				$this->view($file);
				if(count($fields) > 0) {
					foreach ($fields as $key => $value) {
						$this->frame($key, $value);
					}
				}
        $temp = unserialize(PATHS);
				
				if($required) {require_once $temp['VIEW'] . $temp['MAIN_VIEW'];}
				else {include_once $temp['VIEW'] . $temp['MAIN_VIEW'];}
    }
}

?>

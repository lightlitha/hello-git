<?php

namespace Epiqworx\Controllers;
use Epiqworx\Views\Resource as Resource;
/**
*
*/
class Controller implements IController
{
		protected $view;
		protected $template;
		protected $fields = array();

		/**
		 * 
		 */
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

		
		/** 
		 * Load pre-set variables
		 * Set routes and Resource object global to all views
		*/
		private function init()
		{
			$this->frame("Resource",  new Resource());
			foreach (unserialize(ROUTE) as $key => $value) {
				$this->frame($key, "?r=" . $value);
			}
		}

		/**
		 * find view file
		 */
    public function view($template) {
        $template = $this->view . $template . ".php";
        if (!is_file($template) || !is_readable($template)) {
            throw new \InvalidArgumentException(
                "The template '$template' is not found. :)");
        }
        $this->template = $template;
    }

		/**
		 * return view file
		 */
		public function get_view() {
			return $this->template;
		}

		/**
		 * set variables
		 */
		public function frame($name, $value) {
        $this->fields[$name] = $value;
    }

		/**
		 * get variables
		 */
    public function get_frame($name) {
        return $this->fields;
    }

		/**
		 * render view.
		 * extract fields and pass as variable
		 * load view template
		 */
    public function render($file, $fields = [], $required = true) {
				$this->view($file);
				if(count($fields) > 0) {
					foreach ($fields as $key => $value) {
						$this->frame($key, $value);
					}
				}
				$this->init();
				if($this->fields) {
					extract($this->fields);
					ob_start();
					//ob_get_clean();
				}

				$temp = unserialize(PATHS);
				
				if($required) {require_once $temp['VIEW'] . $temp['MAIN_VIEW'];}
				else {include_once $temp['VIEW'] . $temp['MAIN_VIEW'];}
    }
}

?>

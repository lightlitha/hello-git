<?php

/**
*
*/
class Home extends \Epiqworx\Concrete\Controller
{
	function index() {
		$this->setBlueprint('home');
		$this->setFields("var1", "Hello");
		$this->setFields("var2", "World");
		$this->render();
	}
}
?>

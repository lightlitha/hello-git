<?php

/**
*
*/
class Welcome extends \Epiqworx\Concrete\Controller
{
	function home() {
		$this->setBlueprint('welcome');
		$this->setFields("varNik", "Hello Nikitha");
		$this->setFields("var2", "World");
		$this->render();
	}
}
?>

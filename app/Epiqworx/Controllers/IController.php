<?php
namespace Epiqworx\Controllers;

interface IController {

	public function view($template);
	public function get_view();
	public function frame($field, $value);
	public function get_frame($field);
	public function render($file);
}

?>

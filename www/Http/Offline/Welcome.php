<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace WWW\Http\Offline;
/**
 * Description of Welcome
 *
 * @author math
 */

use Epiqworx\Controllers\Controller as Controller;
use Epiqworx\Views\Resource as Resource;

class Welcome extends Controller {

  public function landing()
  {
		$this->render('offline/home', ['var2' => "World", 'var1' => "World"]);
  }

}
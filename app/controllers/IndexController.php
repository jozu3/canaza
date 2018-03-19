<?php
namespace App\Controllers;

use App\Controllers\BaseController;

class IndexController extends BaseController {
	
	public function getIndex(){
		return $this->render('index.twig');
	}
}

<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Usuario;

class IndexController extends BaseController {
	
	public function getIndex(){
		if (isset($_SESSION['us_codigo'])) {
			$usId = $_SESSION['us_codigo'];
			$usuario = Usuario::find($usId);

			if ($usuario) {
				return $this->render('admin/index.twig', [
					'usuario' => $usuario
				]);
			}
		}else{
			header('Location: '.BASE_URL.'auth/login');
		}		
	}
}
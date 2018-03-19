<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use Sirius\Validation\Validator;
use App\Models\Usuario;

class AuthController extends BaseController {
	
	public function getLogin(){
		return $this->render('login.twig');
	}
	public function postLogin(){
		$errors = [];

		$validator = new Validator();
		$validator->add('us_usuario', 'required');
		$validator->add('us_password', 'required');

		if ($validator->validate($_POST)) {
			$usuario = Usuario::where('us_usuario',$_POST['us_usuario'])->first();
			if ($usuario) {
				if (password_verify($_POST['us_password'],$usuario->us_password )) {
					$_SESSION['us_codigo'] = $usuario->id;
					header('Location:'.BASE_URL.'admin');
					return null;
				}
			}

			$validator->addMessage('us_usuario', 'Usuario o password no coinciden.');
		}

		$errors = $validator->getMessages();

		return $this->render('login.twig', [
			'errors' => $errors
		]);	
	}
	public function getLogout(){
		unset($_SESSION['us_codigo']);
		header('Location: '.BASE_URL.'auth/login');
	}
}

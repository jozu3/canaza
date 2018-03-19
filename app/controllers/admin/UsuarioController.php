<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Usuario;
use Sirius\Validation\Validator;

class UsuarioController extends BaseController
{
	public function getIndex(){

		if (isset($_SESSION['us_codigo'])) {
			$usId = $_SESSION['us_codigo'];
			$usuarios = Usuario::all();	
			$usuario = Usuario::find($usId);
			if ($usuario) {
				return $this->render('admin/usuarios.twig', [
					'usuarios' => $usuarios,
					'usuario' => $usuario
				]);

			}
		}else{
			header('Location: '.BASE_URL.'auth/login');
		}	
	}		

	public function getCreate(){
		return $this->render('admin/registrarUsuario.twig');
	}

	public function postCreate(){
		$errors = [];
		$result = false;

		$validator = new Validator();
		$validator->add('us_nombre', 'required');
		$validator->add('us_apellido', 'required');
		$validator->add('us_dni', 'required');
		$validator->add('us_telefono', 'required');
		$validator->add('us_email', 'required');
		$validator->add('us_email', 'email');
		$validator->add('us_cargo', 'required');
		$validator->add('us_usuario', 'required');
		$validator->add('us_password', 'required');

		if ($validator->validate($_POST)) {
			$usuario = new Usuario();
			$usuario->us_nombre = $_POST['us_nombre'];
			$usuario->us_apellido = $_POST['us_apellido'];
			$usuario->us_dni = $_POST['us_dni'];
			$usuario->us_telefono = $_POST['us_telefono'];
			$usuario->us_email = $_POST['us_email'];
			$usuario->cargo = $_POST['us_cargo'];
			$usuario->us_usuario = $_POST['us_usuario'];
			$usuario->us_password = password_hash($_POST['us_password'], PASSWORD_DEFAULT);

			$usuario->save();
			$result = true;
		} else {
			$errors = $validator->getMessages();
		}

		return $this->render('admin/registrarUsuario.twig',[
			'result' => $result,
			'errors' => $errors
			]);	
	}
}
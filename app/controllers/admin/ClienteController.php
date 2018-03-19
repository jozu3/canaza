<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Cliente;
use Sirius\Validation\Validator;

class ClienteController extends BaseController
{
	public function getIndex(){
		$clientes = Cliente::all();
		return $this->render('admin/clientes.twig', [
			'clientes' => $clientes
		]);
	}

	public function getCreate(){
		return $this->render('admin/registrarCliente.twig');
	}

	public function postCreate(){
		$errors =[];
		$result= false;

		$validator = new Validator();

		if ($validator->validate($_POST)) {
			$cliente = new Cliente();
			$cliente->nombre =  $_POST['cl_nombre'];
			$cliente->doc_identidad = $_POST['cl_docid'];
			$cliente->direccion = $_POST['cl_direcc'];
			$cliente->telefono = $_POST['cl_telef'];

			$cliente->save();
			$result = true;
		} else {
			$errors = $validator->getMessages();
		}

		return $this->render('admin/registrarCliente.twig',[
			'result' => $result,
			'errors' => $errors
		]);

	}
}
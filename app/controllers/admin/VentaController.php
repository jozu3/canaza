<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Venta;
use App\Models\Cliente;
use App\Models\Producto;
use Sirius\Validation\Validator;

class VentaController extends BaseController
{
	public function getIndex(){
		$ventas = Venta::all();
		$clientes = Cliente::all();
		return $this->render('admin/ventas.twig', [
			'ventas' => $ventas,
			'clientes' => $clientes
		]);
	}

	public function getCreate(){
		$clientes = Cliente::all();
		return $this->render('admin/registrarVenta.twig',[
			'clientes' => $clientes
		]);
	}

	public function postCreate(){
	}
}
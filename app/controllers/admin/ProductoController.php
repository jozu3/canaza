<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Producto;
use App\Models\Categoria;
use Sirius\Validation\Validator;

class ProductoController extends BaseController
{
	public function getIndex(){
		$productos = Producto::all();
		return $this->render('admin/productos.twig', [
			'productos' => $productos
		]);
	}
	public function postIndex(){
		$productos = Producto::all();
		$errors = [];
		$result = false;

		$validator = new Validator();
		$validator->add('pr-stac', 'required');
		$validator->add('pr-stac', 'number');
		$validator->add('idprod', 'required');

		if ($validator->validate($_POST)) {

			$pr_stockactual = $_POST['pr-stac'];
			$idprod = $_POST['idprod'];

			$producto = Producto::where('id',$idprod)->update([
				'pr_stockactual' => $pr_stockactual
			]);

			$result = true;
			
		}else{
			$errors = $validator->getMessages();
		}
		return $this->render('admin/productos.twig', [
			'productos' => $productos,
			'errors' => $errors,
			'result' => $result
		]);
	}

	public function getCreate(){
		$categorias = Categoria::all();
		return $this->render('admin/registrarProducto.twig',[
			'categorias' => $categorias
		]);
	}

	public function postCreate(){
		$errors = [];
		$result = false;
		
		$validator = new Validator();
		$validator->add('pr_nombre', 'required');
		$validator->add('pr_categoria', 'required');
		$validator->add('pr_pcosto', 'required');
		$validator->add('pr_punit', 'required');
		$validator->add('pr_pdocena', 'required');
		$validator->add('pr_pcaja', 'required');
		$validator->add('pr_cantidading', 'required');

		if ($validator->validate($_POST)) {
			$producto = new Producto();
			$producto->pr_nombre = $_POST['pr_nombre'];
			$producto->categoria = $_POST['pr_categoria'];
			$producto->pr_p_costo = $_POST['pr_pcosto'];
			$producto->pr_p_unidad = $_POST['pr_punit'];
			$producto->pr_p_docena = $_POST['pr_pdocena'];
			$producto->pr_p_caja = $_POST['pr_pcaja'];
			$producto->pr_stockactual = $_POST['pr_cantidading'];

			$producto->save();
			$result = true;
		} else {
			$errors = $validator->getMessages();
		}

		return $this->render('admin/registrarProducto.twig',[
			'result' => $result,
			'errors' => $errors
			]);	
	}
}
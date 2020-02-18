<?php 
/* *******************************
 *
 * Developer by FelipheGomez
 *
 * ******************************/

class Router extends ModeloBase {
	# vars
	
	public function __construct($adapter){
        $table = "routes";
        parent::__construct($table, $adapter);
	}
	
	public function __sleep(){
		return [
			'id', 
			'is_actived', 
			'is_hidden', 
			'is_searchable', 
			'permission_access', 
			'title', 
			'parent', 
			'request_uri', 
			'menu_order', 
			'type', 
			'view', 
			'layaout', 
			'mime_type', 
			'created', 
			'created_by', 
			'updated', 
			'updated_by', 
		];
	}
	
	public function getById($id){
		$id = (isset($id) && $id > 0) ? $id : 0;
		$items = parent::getById($id);
		if(isset($items[0])){
			foreach($items[0] as $k=>$v){
				if($k == 'permission_access' && $v !== null){
					$permission_accessModel = new PermissionItem($this->adapter);
					$permission_accessModel->getById($v);
					$this->{$k} = $permission_accessModel;
				} else {
					$this->{$k} = $v;
				}
			}
		}
		return $items;
	}
	
	public function getBySlug($slug){
		$id = (isset($id) && is_string($slug)) ? $slug : '/';
		$items = parent::getBy('request_uri', $slug);
		if(isset($items[0])){
			foreach($items[0] as $k=>$v){
				if($k == 'permission_access' && $v !== null){
					$permission_accessModel = new PermissionItem($this->adapter);
					$permission_accessModel->getById($v);
					$this->{$k} = $permission_accessModel;
				} else {
					$this->{$k} = $v;
				}
			}
		}
		return $items;
	}
	
	public function isValid(){
		return (isset($this->id) && $this->id > 0 && $this->is_actived == 1 && $this->is_hidden == 0) ? true : false;
	}
	/*
    public function rules($dataAccess = "complete"){
		if($dataAccess == "complete"){
			return parent::rules();
		} 
		else if($dataAccess == "basic") {
			// Información Básica
			return [
				["identification_number" => new PHPStrap\Form\Text([
						"name" => "identification_number", 
						"placeholder" => "# Documento de identificación",
						"value" => $this->identification_number
					], [
				])]
				, ["identification_type" => new PHPStrap\Form\Select(Types::OptionsForm($this->adapter, "identifications_types", [
						"key" => "id"
					]), [$this->identification_type], [
						"name" => "identification_type", 
						"placeholder" => "Tipo de documento de identificación"
					], [
					new PHPStrap\Form\Validation\RequiredValidation('Requerido.')
				])]
				, ["names" => new PHPStrap\Form\Text([
						"name" => "names", 
						"placeholder" => "Nombre(s)",
						"value" => $this->names
					], [])]
				, ["surname" => new PHPStrap\Form\Text([
						"name" => "surname", 
						"placeholder" => "Apellido(s)",
						"value" => $this->surname
					], [])]
				, ["phone" => new PHPStrap\Form\Text([
						"name" => "phone", 
						"placeholder" => "Teléfono Fijo",
						"value" => $this->phone
					], [])]
				, ["mobile" => new PHPStrap\Form\Text([
						"name" => "mobile", 
						"placeholder" => "Teléfono Móvil",
						"value" => $this->mobile
					], [])]
				, ["address" => new PHPStrap\Form\Textarea($this->address, [
						"name" => "address", 
						"placeholder" => "Dirección"
					], [])]
				, ["department" => new PHPStrap\Form\Select(Types::OptionsForm($this->adapter, "geo_departments", [
						"key" => "id",
						"label" => "name"
					]), [$this->department], [
						"name" => "department", 
						"placeholder" => "Departamento"
					], [
						new PHPStrap\Form\Validation\RequiredValidation('Requerido.')
					])]
				, ["city" => new PHPStrap\Form\Select(Types::OptionsForm($this->adapter, "geo_citys", [
						"key" => "id"
					]), [$this->city], [
						"name" => "city", 
						"placeholder" => "Ciudad"
					], [
						new PHPStrap\Form\Validation\RequiredValidation('Requerido.')
					])]
				, ["bulletin" => new PHPStrap\Form\Select(["1"=>"SI", "0"=>"NO"], $this->bulletin, [
					"name" => "bulletin", 
					"placeholder" => "Boletín"
				])]
				, ["marketing" => new PHPStrap\Form\Select(["1"=>"SI", "0"=>"NO"], $this->marketing, [
					"name" => "marketing", 
					"placeholder" => "Campañas de Marketing"
				])]
				, ["analytic" => new PHPStrap\Form\Select(["1"=>"SI", "0"=>"NO"], $this->analytic, [
					"name" => "analytic", 
					"placeholder" => "Campañas de Mejoramiento"
				])]
			];
		} 
		else if($dataAccess == "access") {
			return [
				// Datos de acceso
				new PHPStrap\Form\Text([
						"name" => "username", 
						"placeholder" => "Usuario",
						"value" => $this->username,
					], [
						new PHPStrap\Form\Validation\RequiredValidation('Ingresa tu usuario.')
						, new PHPStrap\Form\Validation\LengthValidation(32)
						, new PHPStrap\Form\Validation\LambdaValidation("El usuario ya existe", function($value){
							if($value == $this->username) return true;
							$model = new Usuario($this->adapter);
							$exist = $model->getBy('username', $value);
							return (isset($exist[0]) && isset($exist[0]->id) && $exist[0]->id > 0) ? false : true;
						})
					])
				, new PHPStrap\Form\Text([
						"name" => "email", 
						"placeholder" => "Correo Electronico",
						"value" => $this->email,
					], [
						new PHPStrap\Form\Validation\EmailValidation('Ingrese un email.')
						, new PHPStrap\Form\Validation\LambdaValidation("El correo ya existe", function($value){
							if($value == $this->email) return true;
							$model = new Usuario($this->adapter);
							$exist = $model->getBy('email', $value);
							return (isset($exist[0]) && isset($exist[0]->id) && $exist[0]->id > 0) ? false : true;
						})
					])
			];
		}
    }*/
}
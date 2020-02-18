<?php 
/* *******************************
 *
 * Developer by FelipheGomez
 *
 * ******************************/

class Me extends Usuario{
	public $form_update_info;
	public $form_update_access;

	public function __construct($adapter){
		parent::__construct($adapter);
		// $this->formulario_acesso = $this->toFormHtml("", "POST", 1, "Datos recibidos en form_update_access");

		//$this->form_update_access = $this->formAccess();
		//$this->form_update_info = $this->formInfoBasic();
	}

	public function formAccess(){
		$rules = $this->rules("access");
		$labels = $this->attributeLabels();
		$formulario = new PHPStrap\Form\Form("", "POST", 1);
		foreach($rules as $rul){
			$formulario->group($rul);
		}
		$formulario->addSubmitButton('Cambiar mis datos ', [
			"name" => "btn-submit", 
		]);
		if($formulario->isValid()){
			foreach($_REQUEST as $k => $v){
				if(isset($this->{$k})){
					$this->{$k} = $v;
					$labelsSave[] = $k;
				}
			}
			$success = $this->save($labelsSave);
			if($success === true){
				echo "<meta http-equiv=\"refresh\" content=\"0\">";
			}
		}
		return $formulario;
	}

	public function formInfoBasic(){
		$rules = $this->rules("basic");
		$labels = $this->attributeLabels();
		$labelsSave = [];

		$formulario = new PHPStrap\Form\Form("", "POST", 0, "Error en el formulario.", "Tus datos se guardaron con éxito.");
		foreach($rules as $rule){
			if(is_array($rule)){
				foreach($rule as $label => $rul){
					$label = (isset($labels[$label])) ? $labels[$label] : $label;
					$formulario->group($rul, $label);
				};
			} else {
				$formulario->group($rule);
			}
		}
		$formulario->addSubmitButton('Modificar mi Perfil', [
			"name" => "btn-submit", 
		]);
		if($formulario->isValid()){
			foreach($_REQUEST as $k => $v){
				if(isset($labels{$k})){
					$this->{$k} = $v;
					$labelsSave[] = $k;
				}
			}
			$success = $this->save($labelsSave);
			if($success === true){
				echo "<meta http-equiv=\"refresh\" content=\"0\">";
			}
		}
		return $formulario;
	}
	
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
    }
}
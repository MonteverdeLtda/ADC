<?php 
/* *******************************
 *
 * Developer by FelipheGomez
 *
 * ******************************/

class Usuario extends ModeloBase{
    public $username;
    
	public function __construct($adapter) {
        $table="users";
        parent::__construct($table, $adapter);
    }

    public function attributeLabels(){
        return [
			'id' => "ID", 
			'username' => "Usuario", 
			'password' => "Contraseña", 
			'identification_type' => "Tipo Documento identidad", 
			'identification_number' => "# Documento Identidad", 
			'names' => "Nombre(s)", 
			'surname' => "Apellido(s)", 
			'phone' => "Teléfono Fijo", 
			'mobile' => "Teléfono Móvil", 
			'address' => "Dirección", 
			'department' => "Departamento", 
			'city' => "Ciudad", 
			'email' => "Correo Electronico", 
			'avatar' => "Avatar", 
			'permissions' => "Permisos", 
			'registered' => "Fecha de registro", 
			'updated' => "Ultima actualizacion", 
			'last_connection' => "Ultima conexion",
			'bulletin' => "Boletín.<br/>Confirmo mi consentimiento para recibir su boletín",
			'marketing' => "Campañas de Marketing.<br/>Confirmo mi consentimiento para el procesamiento de mis datos personales con fines de marketing, que consisten en ofertas comerciales enviadas por correo electrónico.",
			'analytic' => "Campañas de Mejoramiento.<br/>Confirmo mi consentimiento para el procesamiento automatizado de mis datos personales, mediante la elaboración de perfiles, a fin de recibir ofertas comerciales personalizadas en función de mi comportamiento de navegación y compra.",
        ];
    }
	
	public function __sleep(){
		return [
			'id', 
			'username', 
			'password', 
			'identification_type', 
			'identification_number', 
			'names', 
			'surname', 
			'phone', 
			'mobile', 
			'address', 
			'department', 
			'city', 
			'email', 
			'avatar', 
			'permissions', 
			'registered', 
			'updated', 
			'last_connection', 
			'bulletin',
			'marketing',
			'analytic',
		];
	}

    public function rules()
    {
        return [
            // Datos de acceso
            ["username" => new PHPStrap\Form\Text([
                    "name" => "register_username", 
                    "placeholder" => "Usuario"
                ], [
                    new PHPStrap\Form\Validation\RequiredValidation('Ingresa tu usuario.')
                    , new PHPStrap\Form\Validation\LengthValidation(32)
					, new PHPStrap\Form\Validation\LambdaValidation("El usuario ya existe", function($value){
						$model = new Usuario($this->adapter);
						$exist = $model->getBy('username', $value);
						return (isset($exist[0]) && isset($exist[0]->id) && $exist[0]->id > 0) ? false : true;
					})
                ])]
            , ["email" => new PHPStrap\Form\Text([
                    "name" => "register_email", 
                    "placeholder" => "Correo Electronico"
                ], [
                    new PHPStrap\Form\Validation\EmailValidation('Ingrese un email.')
					, new PHPStrap\Form\Validation\LambdaValidation("El correo ya existe", function($value){
						$model = new Usuario($this->adapter);
						$exist = $model->getBy('email', $value);
						return (isset($exist[0]) && isset($exist[0]->id) && $exist[0]->id > 0) ? false : true;
					})
                ])]
            , ["password" => new PHPStrap\Form\Password([
                    "name" => "register_password", 
                    "placeholder" => "Contraseña"
                ], [
                    new PHPStrap\Form\Validation\RequiredValidation('Ingresa tu Contraseña')
					, new PHPStrap\Form\Validation\MinLengthValidation(5)
                ])]
            , ["password_validate" => new PHPStrap\Form\Password([
                    "name" => "register_password_validate", 
                    "placeholder" => "Confirmar Contraseña"
                ], [
                    new PHPStrap\Form\Validation\RequiredValidation('Ingresa tu Contraseña')
					, new PHPStrap\Form\Validation\MinLengthValidation(5)
                ]),]
			// Información Básica
			, ["identification_number" => new PHPStrap\Form\Text([
					"name" => "identification_number", 
					"placeholder" => "# Documento de identificación"
				], [
			])]
			, ["identification_type" => new PHPStrap\Form\Select(Types::OptionsForm($this->adapter, "identifications_types", [
					"key" => "id"
				]), [], [
					"name" => "identification_type", 
					"placeholder" => "Tipo de documento de identificación"
				], [
				new PHPStrap\Form\Validation\RequiredValidation('Requerido.')
			])]
			, ["names" => new PHPStrap\Form\Text([
					"name" => "names", 
					"placeholder" => "Nombre(s)"
				], [])]
			, ["surname" => new PHPStrap\Form\Text([
					"name" => "surname", 
					"placeholder" => "Apellido(s)"
				], [])]
			, ["phone" => new PHPStrap\Form\Text([
					"name" => "phone", 
					"placeholder" => "Teléfono Fijo"
				], [])]
			, ["phone" => new PHPStrap\Form\Text([
					"name" => "phone", 
					"placeholder" => "Teléfono Móvil"
				], [])]
			, ["address" => new PHPStrap\Form\Textarea("", [
					"name" => "address", 
					"placeholder" => "Dirección"
				], [])]
			, ["department" => new PHPStrap\Form\Select(Types::OptionsForm($this->adapter, "geo_departments", [
					"key" => "id",
					"label" => "name"
				]), [], [
					"name" => "department", 
					"placeholder" => "Departamento"
				], [])]
			, ["city" => new PHPStrap\Form\Select(Types::OptionsForm($this->adapter, "geo_citys", [
					"key" => "id"
				]), [], [
					"name" => "city", 
					"placeholder" => "Ciudad"
				], [])]
			, ["bulletin" => new PHPStrap\Form\Select(["1"=>"SI", "0"=>"NO"], ["0"], [
				"name" => "bulletin", 
				"placeholder" => "Boletín"
			])]
			, ["marketing" => new PHPStrap\Form\Select(["1"=>"SI", "0"=>"NO"], ["0"], [
				"name" => "marketing", 
				"placeholder" => "Campañas de Marketing"
			])]
			, ["analytic" => new PHPStrap\Form\Select(["1"=>"SI", "0"=>"NO"], ["0"], [
				"name" => "analytic", 
				"placeholder" => "Campañas de Mejoramiento"
			])]
        ];
    }
	
	public function setAll($array = []){
		if(isset($array[0])){
			foreach($array[0] as $k => $v){
				if($k == 'permissions'){
					$permisos = new Permissions($this->adapter);
					$permisos->getByIdGroup($v);
					$this->set($k, $permisos);
				} else {
					$this->set($k, $v);
				}
			}
		}
		return $this;
	}

	public function getById($id){
		return $this->setAll(parent::getById($id));
	}
	
	public function getEmailBoxes(){
		if($this->isValid()){
			$user_mails = new UsuarioMails($this->adapter);
			$user_mails->getByUser($this->id);
			return ($user_mails->boxes);
		} else {
			return [];
		}
	}
	
	public function isValid(){
		return isset($this->id) && $this->id > 0 ? true : false;
	}
    
}
<?php 
/* *******************************
 *
 * Developer by FelipheGomez
 *
 * ******************************/

class RegisterForm extends ModeloBase
{
    public $rememberMe = true;
    private $_user;
    public $succesOk;
    public $ErrorMessages = array();
    
	public function __construct($adapter) {
        $table="users";
        parent::__construct($table, $adapter);
       
    }
	
	public function createForm(){
		$this->formulario = $this->toFormHtml('','POST',0,"verifique sus datos.", "Bienvenid@.");
	}
    
    public function rules(){
        return [
            // username and password are both required
            new PHPStrap\Form\Text([
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
                ])
            , new PHPStrap\Form\Text([
                    "name" => "register_email", 
                    "placeholder" => "Correo Electronico"
                ], [
                    new PHPStrap\Form\Validation\EmailValidation('Ingrese un email.')
					, new PHPStrap\Form\Validation\LambdaValidation("El correo ya existe", function($value){
						$model = new Usuario($this->adapter);
						$exist = $model->getBy('email', $value);
						return (isset($exist[0]) && isset($exist[0]->id) && $exist[0]->id > 0) ? false : true;
					})
                ])
            , new PHPStrap\Form\Password([
                    "name" => "register_password", 
                    "placeholder" => "Contraseña"
                ], [
                    new PHPStrap\Form\Validation\RequiredValidation('Ingresa tu Contraseña')
					, new PHPStrap\Form\Validation\MinLengthValidation(5)
                ])
            , new PHPStrap\Form\Password([
                    "name" => "register_password_validate", 
                    "placeholder" => "Confirmar Contraseña"
                ], [
                    new PHPStrap\Form\Validation\RequiredValidation('Ingresa tu Contraseña')
					, new PHPStrap\Form\Validation\MinLengthValidation(5)
                ])
        ];
    }
	
    public function setFormRegisterResult($data = []){
		if(isset($data['register_username']) && isset($data['register_email']) && isset($data['register_password'])){
			$this->set('username', $data['register_username']);
			$this->set('email', $data['register_email']);
			$this->set('password', password_hash($data['register_password'], PASSWORD_DEFAULT));
		}
    }
	
    public function crearMin(){
        $sql = "INSERT INTO {$this->getTableUse()} (username, password, email) VALUES (?, ?, ?)";
        $id = (int) parent::getInsert($sql, [
			$this->username,
			$this->password,
			$this->email
		]);
		$this->id = ($id > 0) ? $id : 0;
		return ($this->id > 0) ? true : false;
    }

}
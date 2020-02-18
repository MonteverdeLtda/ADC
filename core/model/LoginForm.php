<?php 
/* *******************************
 *
 * Developer by FelipheGomez
 *
 * ******************************/

class LoginForm extends ModeloBase
{
    public $rememberMe = true;
    private $_user;
    public $succesOk;
    public $ErrorMessages = array();
    
	public function __construct($adapter) {
        $table="users";
        parent::__construct($table, $adapter);
       
    }
	
	public function createFormLogin(){
		$this->formulario = $this->toFormHtml('','POST',0,"verifique sus datos.", "Bienvenid@.");
	}
    
    public function rules()
    {
        return [
            // username and password are both required
            new PHPStrap\Form\Text([
                    "name" => "username", 
                    "placeholder" => "Usuario"
                ], [
                    //new PHPStrap\Form\Validation\EmailValidation('Ingrese un email.')
                    new PHPStrap\Form\Validation\RequiredValidation('Ingresa tu usuario.')
                ])
            , new PHPStrap\Form\Password([
                    "name" => "password", 
                    "placeholder" => "Contraseña"
                ], [
                    new PHPStrap\Form\Validation\RequiredValidation('Ingresa tu Contraseña')
                ])
        ];
    }
	
}
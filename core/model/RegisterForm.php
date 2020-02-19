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

    public function setData($data = []){
		if(is_array($data)){
			foreach($data as $k => $v){
				$this->set($k, $v);
				/*if($k == 'password'){
					$this->set($k, password_hash($v, PASSWORD_DEFAULT));
				}*/
			}
		}
    }
	
    public function createBasic(){
        $sql = "INSERT INTO {$this->getTableUse()} (username, password, names, surname, phone, mobile, email) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $id = (int) parent::getInsert($sql, [
			$this->username,
			password_hash($this->password, PASSWORD_DEFAULT),
			$this->names,
			$this->surname,
			$this->phone,
			$this->mobile,
			$this->email
		]);
		if($id > 0){
			$orig_pass = $this->password;
			$this->id = $id;
			$this->getById($id);
			$file = dirname(dirname(dirname(__DIR__) . "/../") ) . "/templates/mails/register.php";
			$fileExist = @file_exists($file);
			$template = "NONE {$file}";
			if($fileExist == true){
				$template = @htmlspecialchars(@file_get_contents($file, true));
				$template = (preg_replace([
					'/%username%/i',
					'/%email%/i',
					'/%password%/i',
				], [
					"{$this->username}",
					$this->email,
					$orig_pass,
				], $template));
			}
			$template = htmlspecialchars_decode(utf8_decode($template));
			
			$mail = new MailSend();
			$mail->setSubject("¡Te damos la bienvenida a Monteverde!");
			$mail->addTo($this->email, "{$this->names} {$this->surname}");
			$mail->setHtml(true);
			$mail->setMessage($template);
			$sendingMail = $mail->sendMail();
			return $sendingMail;
		} else {
			return false;
		}
    }
	
    public function IncludeInAccount($account = 0, $permissions = null){
		$permissions = ($permissions == null || (int) $permissions > 0) ? $permissions : null;
		if($this->id > 0 && $account > 0){
			$sql = "INSERT INTO accounts_users (user, account, permissions) VALUES (?, ?, ?)";
			$id = (int) parent::getInsert($sql, [
				$this->id,
				$account,
				$permissions
			]);
			if($id > 0){
				$file = dirname(dirname(dirname(__DIR__) . "/../") ) . "/templates/mails/addInAccount.php";
				$fileExist = @file_exists($file);
				$template = "NONE {$file}";
				if($fileExist == true){
					$template = @htmlspecialchars(@file_get_contents($file, true));
					$template = (preg_replace([
						'/%username%/i',
					], [
						"{$this->username}",
					], $template));
				}
				$template = htmlspecialchars_decode(utf8_decode($template));
				
				$mail = new MailSend();
				$mail->setSubject("¡Nueva cuenta agregada!");
				$mail->addTo($this->email, "{$this->names} {$this->surname}");
				$mail->setHtml(true);
				$mail->setMessage($template);
				$sendingMail = $mail->sendMail();
				return $sendingMail;
			} else {
				return false;
			}			
		} else {
			return false;
		}
    }

}
<?php 
/* *******************************
 *
 * Developer by FelipheGomez
 *
 * ******************************/

class RecoverForm extends ModeloBase
{
    public $rememberMe = true;
    private $_user;
    public $succesOk;
    public $ErrorMessages = array();
	public $key_recovery;
    
	public function __construct($adapter) {
        $table="users";
        parent::__construct($table, $adapter);
		$this->key_recovery = randomString(32);
    }
	
	public function createForm(){
		$this->formulario = $this->toFormHtml('','POST',0,"verifique sus datos.", "Bienvenid@.");
	}
    
    public function rules(){
        return [
           new PHPStrap\Form\Text([
                    "name" => "recover_email", 
                    "placeholder" => "Correo Electronico"
                ], [
                    new PHPStrap\Form\Validation\EmailValidation('Ingrese su email.')
					, new PHPStrap\Form\Validation\LambdaValidation("El correo no existe.", function($value){
						$model = new Usuario($this->adapter);
						$exist = $model->getBy('email', $value);
						return (isset($exist[0]) && isset($exist[0]->id) && $exist[0]->id > 0) ? true : false;
					})
                ])
        ];
    }
	
    public function setFormRegisterResult($data = []){
		if(isset($data['recover_email'])){
			$this->set('email', $data['recover_email']);
			$this->set('key_recovery', $this->key_recovery);
		}
    }
	
    public function resetHash(){
		try {
			$sql = "UPDATE `{$this->getTableUse()}` SET `key_recovery`=? WHERE `email`='{$this->email}';";
			$query = $this->db->prepare($sql);
			$success = $query->execute([
				$this->key_recovery
			]);
			return (boolean) $success;
		}catch (Exception $e){
			//throw $e;
			#echo "\n {$sql} \n";
			echo $e->getMessage();
			return false;
		}
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

}
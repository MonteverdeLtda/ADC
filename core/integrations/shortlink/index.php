<?php 
// DISPLAY ERRORS ENABLED
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once('config/settings.php');

class ShortLinks extends EntidadBase {
    public $conectar;
	public $adapter;
    public $formulario;
    public $table;
    public $db;
	public $isUnique;
    
    public function __construct() {
		$this->set('_get', (isset($_GET) ? $_GET : []));
		$this->set('_post', (isset($_POST) ? $_POST : []));
		$this->set('_put', (isset($_PUT) ? $_PUT : []));
		$this->set('_request', (isset($_REQUEST) ? $_REQUEST : []));
		$this->set('_delete', (isset($_DELETE) ? $_DELETE : []));
		$this->set('_files', (isset($_FILES) ? $_FILES : []));
		
        $this->conectar = new Conectar();
        $this->adapter = $this->conectar->conexion();
        $this->table = 'short_links';
		$this->db = $this->adapter;
        parent::__construct($this->table, $this->adapter);
        // $this->formulario = $this->toFormHtml();
    }

    public function toFormHtml($Action = "", $Method = "GET", $FormType = 0, $MessageError = "Datos invalidos.", $MessageSuccess = "OK."){
        $rules = $this->rules();
        $labels = $this->attributeLabels();
        $formulario = new PHPStrap\Form\Form($Action, $Method, $FormType, $MessageError, $MessageSuccess);      
        foreach($rules as $rul){
            $formulario->group($rul);
        }
        $formulario->addSubmitButton('Continuar', [
            "name" => "btn-submit", 
        ]);
        return $formulario;
    }

    public function isValid(){   
        return $this->formulario->isValid();
    }
    
    public function rules(){
        return [
        ];
    }

    public function attributeLabels(){
        return [
        ];
    }
	
	public function generateFormCreate($Action = "", $Method = "POST", $FormType = 0, $MessageError = "Error.", $MessageSuccess = "Creado con éxito"){
		$this->formulario = $this->toFormHtml($Action, $Method, $FormType, $MessageError, $MessageSuccess);
        return $this->formulario;
	}
};


$link = new ShortLinks();
if(isset($_GET['h'])){
	$result = $link->getBy('hash', $_GET['h']);
	if(isset($result[0])){
		$Item = ($result[0]);
		if(isset($Item->id) && $Item->id > 0){
			# echo PATH_SHORTLINK;
			header("Location: $Item->link");
		}
	}
}


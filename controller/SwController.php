<?php 
/* *******************************
 *
 * Developer by FelipheGomez
 *
 * ******************************/

class SwController extends ControladorBase{
    public function __construct() {
        parent::__construct();
        $this->theme['default'] = 'none';
        // $this->conectar = new Conectar();
        // $this->adapter = $this->conectar->conexion();
    }
	
    public function actionIndex(){
		if (!$this->isGuest){
			$this->actionHome_users();
		}  
		else {
			//$this->redirect('site', 'login');
		}
    }
    
    public function actionservice_worker(){
        //if ($this->isGuest){ header('HTTP/1.0 403 Forbidden'); exit(); }
        $this->render("install001", [
            "title" => "Service Worker",
			"description" => ""
        ]);
    }
    
    public function actionStaticMap(){
        if ($this->isGuest){ header('HTTP/1.0 403 Forbidden'); exit(); }
        $this->render("staticmap", [
            "title" => "Mapa",
			"description" => ""
        ]);
    }
	
    public function actionTest(){
        $this->render("test", [
            "title" => "Panel 1",
            "description" => "Ingrese su contenido..."
        ]);
    }
	
}
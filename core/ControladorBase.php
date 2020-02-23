<?php 
/* *******************************
 *
 * Developer by FelipheGomez
 *
 * ******************************/

class ControladorBase {
    public $conectar;
	public $adapter;
	
	public $theme;
	public $isGuest;
    public $session;
    public $ScriptsBefore = [];
    public $ScriptsAfter = [];
    public $errors = [];
	public $user;
	private $permissions = [];
	private $_get = [];
	private $_post = [];
	private $_put = [];
	private $_request = [];
	private $_delete = [];

	public function __construct($params = []) {
		$this->set('_get', (isset($_GET) ? $_GET : []));
		$this->set('_post', (isset($_POST) ? $_POST : []));
		$this->set('_put', (isset($_PUT) ? $_PUT : []));
		$this->set('_request', (isset($_REQUEST) ? $_REQUEST : []));
		$this->set('_delete', (isset($_DELETE) ? $_DELETE : []));
		$this->set('_files', (isset($_FILES) ? $_FILES : []));
		
        global $global_session;
        $this->session = $global_session;
		require_once 'Conectar.php';
        $this->conectar = new Conectar();
        $this->adapter = $this->conectar->conexion();
        require_once 'EntidadBase.php'; // Incluir EntidadBase
        require_once 'ModeloBase.php'; // Incluir ModeloBase
        foreach(glob("core/models/*.php") as $file){ require_once $file; }; // Incluir todos los modelos de la carpeta public_html/model/*
		
		$params['theme'] = isset($params['theme']) ? $params['theme'] : 'default';
		$this->setTheme($params['theme']);
        	
		$this->isGuest = $global_session->isGuest();
        $this->user = $this->getUser();
        //$global_session->close();
		
		if(isset($this->user->permissions->list)){
			$this->setPermissions($this->user->permissions->list);
		}
		$this->addScriptsBase();
		
    }
	
	public function set($key, $value){
		try {
			$this->{$key} = $value;
		} catch(Exception $e){
			
		}
	}
	
	public function getGet(){
		return $this->_get;
	}
	
	public function getFiles(){
		return $this->_files;
	}
	
	public function getRequest(){
		return $this->_request;
	}
	
	public function getPost(){
		return $this->_post;
	}
	
	public function getPut(){
		return $this->_put;
	}
	
	public function getDelete(){
		return $this->_delete;
	}
	
	private function addScriptsBase(){
		$toMessageFormat = 'Date.prototype.toMessageFormat = function() {
			months = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
			days = ["Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado"];
			hoy = new Date();
			if(this.getMonth() == hoy.getMonth()){
				if(this.getWeek() == hoy.getWeek()){
					if(this.getDate() == hoy.getDate()){
						return ((this.getHours() < 10) ? "0" + this.getHours() : this.getHours()) + ":" + ((this.getMinutes() < 10) ? "0" + this.getMinutes() : this.getMinutes()) + " (Hoy)";
					} else {
						if((hoy.getDate() - this.getDate()) == 1){
							return days[this.getDay()] + " " + this.getDate() + ", " + ((this.getHours() < 10) ? "0" + this.getHours() : this.getHours()) + ":" + ((this.getMinutes() < 10) ? "0" + this.getMinutes() : this.getMinutes()) + " (Ayer)";
						} else {
							return days[this.getDay()] + " " + this.getDate() + ", a las " + ((this.getHours() < 10) ? "0" + this.getHours() : this.getHours()) + ":" + ((this.getMinutes() < 10) ? "0" + this.getMinutes() : this.getMinutes());
						}
					}
				}
				else { return this.getDate() + " de " + months[this.getMonth()] + ", a las " + ((this.getHours() < 10) ? "0" + this.getHours() : this.getHours()) + ":" + ((this.getMinutes() < 10) ? "0" + this.getMinutes() : this.getMinutes()); }
			}
			else { return this.getDate() + " de " + months[this.getMonth()] + " del " + this.getFullYear() + ", a las " + ((this.getHours() < 10) ? "0" + this.getHours() : this.getHours()) + ":" + ((this.getMinutes() < 10) ? "0" + this.getMinutes() : this.getMinutes()); }
		};';
		$this->appendScriptBefore($toMessageFormat);
		$toMysqlFormat = 'Date.prototype.toMysqlFormat = function() {
			function twoDigits(d) {
				if(0 <= d && d < 10) return "0" + d.toString();
				if(-10 < d && d < 0) return "-0" + (-1*d).toString();
				return d.toString();
			}
			return this.getUTCFullYear() + "-" + twoDigits(1 + this.getUTCMonth()) + "-" + twoDigits(this.getUTCDate()) + " " + twoDigits(this.getUTCHours()) + ":" + twoDigits(this.getUTCMinutes()) + ":" + twoDigits(this.getUTCSeconds());
		};';
	}

    public function setPermissions($permissions = null){
		$this->permissions = [];
		if($permissions !== null && !is_object($permissions)){
			foreach(explode(',', $permissions) as $permiso){
				$this->permissions[] = strtolower($permiso);
			}
		}
    }
	
	public static function isHTML($string){
		return preg_match("/<[^<]+>/",$string,$m) != 0;
	}
	
	public function checkPermission($nameNode = 'guest'){
		$nameNode = strtolower($nameNode);
		$permisosBase = (array) $this->permissions;
		
		$permision = in_array('isadmin', $permisosBase) || in_array($nameNode, $permisosBase) ? true : false;
		return $permision;
	}
  
	public function getUser() {
		$model = new Me($this->adapter);
		$model->getById($this->session->getId());
		return $model;
	}
	
	private function themeDefault(){
		return CONFIG_PATH . '/themes/default.php';
	}
	
	private function validateTheme($theme = null){
		return !is_file(CONFIG_PATH . "/themes/{$theme}.php") ? $this->themeDefault() : CONFIG_PATH . "/themes/{$theme}.php";
	}
	
	public function getTheme(){
		return $this->theme;
	}
	
	public function setTheme($theme = null){
		$this->theme = require_once (!isset($theme) || $theme == null) ? ($this->themeDefault()) : ($this->validateTheme($theme));
	}
    
    //Plugins y funcionalidades
	public function appendScriptBefore($scripts){
		$this->ScriptsBefore[] = $scripts;
	}
	
	public function appendScriptAfter($scripts){
		$this->ScriptsAfter[] = $scripts;
	}
	
	public function getController(){
		return strtolower(str_replace('Controller', '', get_class($this)));
	}
	
    public function render($vista, $datos, $layout=null){
		$layout = !isset($layout) || $layout == null ? $this->theme['default'] : $layout;
		$datos["title"] = !isset($datos["title"]) ? "Titulo de la página" : $datos["title"];
		
		$this->view("layouts/{$layout}", [
			"title" => $datos["title"],
			"description" => [
				// "vista" => $vista, 
				"vista" => "{$this->getController()}/{$vista}", 
				"datos" => $datos
			]
		]);
    }
	
	public function view($vista, $datos){
        foreach ($datos as $id_assoc => $valor) {
            ${$id_assoc}=$valor; 
        }
        
        require_once 'core/AyudaVistas.php';
        $helper=new AyudaVistas();
    
        //require_once "view/{$vista}.php";
        require_once "view/{$vista}.php";
    }
	
	public function getView($description){
		if(is_array($description) && $description['vista']){
			$description['datos'] = !isset($description['datos']) ? [] : $description['datos'];
			$this->view($description['vista'], $description['datos']);
		}
	}
    
    public function redirect($controlador=CONTROLADOR_DEFECTO,$accion=ACCION_DEFECTO,$query=null){
		$query = $query != null ? '&'.@http_build_query($query) : "";
		
        header("Location:{$this->urlServer()}/index.php?controller=".$controlador."&action=".$accion.$query);
    }
	
	public function urlServer(){
		return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
	}

	public function goHome(){
		return $this->redirect();
	}
	
	public static function PowerBy() : string {
		return "©2019 All Rights Reserved. | Power By <a href=\"https://github.com/Feliphegomez\">FelipheGomez</a>";
	}
    //Métodos para los controladores
	
	public function getUrlAssets(){
		return $this->theme['assets']['url'];
	}
	
	public function head(){
		$datahead = @include('public/head.php');
		$r = "";
		$r .= is_string($datahead) ? $datahead : '';
		foreach($this->theme['assets']['includes']['head'] as $a){
			$url = (filter_var($a['file'], FILTER_VALIDATE_URL) === FALSE) ? "{$this->getUrlAssets()}{$a['file']}" : $a['file'];
				
			switch($a['type']){
				case 'meta': $r .= "<meta {$url}>\n"; break;
				case 'script': $r .= "<script src=\"{$url}\"></script>\n"; break;
				case 'stylesheet': $r .= "<link href=\"{$url}\" rel=\"stylesheet\">"; break;
				default: $r .= "<{$a['type']}>{$url}</{$a['type']}>"; break;
			}
		}
		$r .= "<script type=\"text/javascript\">" . implode($this->ScriptsBefore) . "</script>";
		return $r;
	}
	
	public function footerScripts(){
		$this->loadErrors();
		$r = "";
		foreach($this->theme['assets']['includes']['footer_scripts'] as $a){
			if($a['type'] == 'script'){
				$r .= "<script src=\"{$this->getUrlAssets()}{$a['file']}\"></script>\n";
			}
		}
		$r .= "<script type=\"text/javascript\">" . implode($this->ScriptsAfter) . "</script>";
		return $r;
	}
	
	public function loadErrors(){
		foreach($this->errors as $error){
			$error = json_encode($error);
			$this->ScriptsAfter[] = <<<EOF
$(function(){
	new PNotify($error);
});
EOF;
		}		
	}
	
	public function getLang(){
		return $this->theme['lang'];
	}
	
	public function getCharset(){
		return $this->theme['charset'];
	}
			
	public function saveFile($file){
		
	}

	public function getModals(){
		foreach(glob("view/modals/*.php") as $file){ require_once $file; }
	}
}
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
		
		$permision = in_array('isadmin', $permisosBase) || in_array('isAdmin', $permisosBase) || in_array($nameNode, $permisosBase) ? true : false;
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
		$vistaFolder = is_array($vista) && isset($vista[1]) ? $vista[1] : "view/{$this->getController()}";
		$vista = is_array($vista) ? $vista[0] : "{$vista}";
		
		
		$layout = !isset($layout) || $layout == null ? $this->theme['default'] : $layout;
		$datos["title"] = !isset($datos["title"]) ? "Titulo de la página" : $datos["title"];
		
		$this->view("view/layouts/{$layout}", [
			"title" => $datos["title"],
			"description" => [
				// "vista" => $vista, 
				"vista" => "{$vistaFolder}/{$vista}", 
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
        require_once "{$vista}.php";
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
		return "©2019 All Rights Reserved. " . BUSSINES_NAME_LG . " | Powered By <a href=\"https://github.com/Feliphegomez\">FelipheGomez</a>";
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

	public function actionIndex(){
		$dataPost = $this->getPost();
		if(isset($dataPost['action']) && method_exists($this, 'action'.$dataPost['action'])){
			$this->{'action'.$dataPost['action']}();
			exit();
		}
		
		$nodeSlugDefault = '/';
		$url = $_SERVER['REQUEST_URI'];
		$modelNode = new Router($this->adapter);
		$modelNode->getBySlug($_SERVER['REQUEST_URI']);
		if(!$modelNode->isValid() && isset($_SERVER['REDIRECT_URL'])){ $modelNode->getBySlug($_SERVER['REDIRECT_URL']); }
		if($modelNode->isValid()){
			if($modelNode->permission_access !== null){
				if ($this->isGuest){
					$this->actionLogin();
					exit();
				}
				else if ($this->checkPermission($modelNode->permission_access->tag) !== true){
					header('HTTP/1.0 403 Forbidden');
					echo "No tienes permisos para acceder a esta página. Redireccionando a la pagina principal...1\n";
					header('Location: ' . $this->urlServer());
					exit();
				}
			}
		
			$view = [];
			$view[0] = $modelNode->view;
			if($modelNode->type == 'system'){
				$view[1] = dirname(dirname(__FILE__) . '/../') . '/view/system/';
			};
			
			$this->title = $modelNode->title;
			
			$this->render($view, 
				[
				"title"=> $modelNode->title,
			], $modelNode->layout);
		} else {
			header('HTTP/1.0 404 Forbidden');
			echo "No se encuentra la pagina. Redireccionando a la pagina principal...2 {$this->urlServer()}\n";
			$server = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
			header('Location: ' . $this->urlServer());
			exit();
		};
		
	}
    
	// Login - Manejador de Ingreso y Registro
    public function actionLogin(){
		$error = null;
        $this->theme['default'] = 'demo-login';
        if (!$this->isGuest){ $this->goHome(); }
        $model = new LoginForm($this->adapter);
        $register = new RegisterForm($this->adapter);
		$model->createFormLogin();
		$register->createForm();
		if($model->formulario->isValid()){
			$user = $_REQUEST['username'];
			$pass = $_REQUEST['password'];
			$hash = password_hash($pass, PASSWORD_DEFAULT);
			
			// Buscar usuario.
			$searchUser = $model->getBy('username', $user);
			$searchUser = isset($searchUser[0]) ? $searchUser : $model->getBy('email', $user);
			if(isset($searchUser[0])){
				$verify = password_verify($pass, $searchUser[0]->password);
				if($verify === true){
					$this->session->setAll((array) $searchUser[0]);
					$this->redirect('site', 'login', [
						"error" => 'Bienvenid@'
					]);
				} else {
					$this->redirect('site', 'login', [
						"error" => 'Contraseña incorrecta.'
					]);
				}
				
				
			}else{
				$this->redirect('site', 'login', [
					"error" => "El usuario {$_REQUEST['username']} no existe."
				]);
			}
		}
		else if($register->formulario->isValid()){
			$valuesRegister = $register->formulario->submitedValues();
			$checkPass = $valuesRegister['register_password'] == $valuesRegister['register_password_validate'] ? true : false;
			$text = $checkPass == true ? "Espere.." : "Las contraseñas no coinciden.";
			$register->formulario->setSucessMessage($text);
			if($checkPass == false){
				$this->redirect('site', 'login', [
					"error" => 'Las contraseñas no coinciden.',
					"feliphegomez" => 'more/#signup'
				]);
			}
			
		
			
			$register->setFormRegisterResult($valuesRegister);
			$newUser = $register->crearMin();
			if($newUser = true){
				$searchUser = $model->getById($register->id);
				$this->session->setAll((array) $searchUser[0]);
				
			
				$file = dirname(dirname(__DIR__) . "/../") . "/templates/mails/register.php";
				//$file = "templates/mails/register.php";
				$fileExist = @file_exists($file);
				$template = @htmlspecialchars(@file_get_contents($file, true));
				if($fileExist == true){					
					$template = (preg_replace([
						'/%username%/i',
						'/%email%/i',
						'/%password%/i',
					], [
						$valuesRegister['register_username'],
						$valuesRegister['register_email'],
						$valuesRegister['register_password'],
					], $template));
				}
				$template = htmlspecialchars_decode(utf8_decode($template));
				
				$mail = new MailSend();
				$mail->setSubject("¡Te damos la bienvenida a Monteverde!");
				$mail->addTo($valuesRegister['register_email'], $valuesRegister['register_username']);
				$mail->setHtml(true);
				$mail->setMessage($template);
				$sendingMail = $mail->sendMail();
				if($sendingMail == true){
					// Enviado con exito
					// echo json_encode($sendTru);
				}
				
				
				$this->redirect('site', 'login', [
					"error" => 'Bienvenid@'
				]);
			} else {
				$this->redirect('site', 'login', [
					"error" => 'Hubo un error creando la cuenta.',
					"feliphegomez" => 'more/#signup'
				]);
			}
		}
		
		if(isset($_GET['error']) && $_GET['error'] != ""){
			$error = [
				"title" => "Ups! Hubo un error",
				"text" => $_GET['error'],
				"styling" => "bootstrap3",
				"type" => "error",
				"icon" => true,
				"animation" => "zoom",
				"hide" => false
			];
			
			$this->errors[] = $error;
		}
		$this->render("login", [
            "title" => "Iniciar sesión",
            "register" => $register,
            "model" => $model,
            "error" => $error
        ]);
    }
    
	// Login - Manejador de Cierre de sesion
	public function actionLogout(){
        $this->theme['default'] = 'demo-login';
        global $global_session;
        $global_session->close();
		
		$this->redirect('site', 'login', [
			//"error" => 'Session cerrada con exito.',
			"feliphegomez" => 'more/#'
		]);
    }
    
	// Login - Manejador de Cierre de sesion
	public function actionRecoverAccount(){
		$error = null;
        $this->theme['default'] = 'demo-login';
        global $global_session;
        $global_session->close();
			
        $this->theme['default'] = 'demo-login';
        if (!$this->isGuest){ $this->goHome(); }
		$getRequest = $this->getRequest();
		$description_text = 'Ingresa tu correo electronico y te enviaremos un enlace para el restablecimiento de tu contraseña.';
		if(isset($getRequest['key_recov']) && isset($getRequest['key_user'])){
			$description_text = 'Ingresa tu nueva contraseña.';
			$recover = new ResetHashForm($this->adapter);
			$recover->key_recovery = $getRequest['key_recov'];
			$recover->username = base64_decode($getRequest['key_user']);
			
			$recover->createForm();
			if($recover->formulario->isValid()){
				$valuesRecover = $recover->formulario->submitedValues();
				$recover->setFormRegisterResult($valuesRecover);
				$resetHash = $recover->resetHash();
				if($resetHash = true){
					$searchUser = $recover->getBy('email', $recover->email);
					//$searchUserInfo = $searchUser[0];
					//$this->session->setAll((array) $searchUser[0]);
					
					$this->redirect('site', 'index', [
						"error" => 'Bienvenid@'
					]);
				}
			}
			
		} else {
			$recover = new RecoverForm($this->adapter);
			$recover->createForm();
			if($recover->formulario->isValid()){
				$valuesRecover = $recover->formulario->submitedValues();
				
				$recover->setFormRegisterResult($valuesRecover);
				$resetHash = $recover->resetHash();
				if($resetHash = true){
					$searchUser = $recover->getBy('email', $recover->email);
					$searchUserInfo = $searchUser[0];
					
					
					$file = dirname(dirname(__DIR__) . "/../") . "/templates/mails/recover.php";
					$fileExist = @file_exists($file);
					$template = @file_get_contents($file, true);
					
					$template = htmlspecialchars(($template));
					
					if($fileExist == true){					
						$template = (preg_replace([
							'/%username%/i',
							'/%key_user%/i',
							'/%key_recovery%/i',
						], [
							$searchUserInfo->username,
							base64_encode($searchUserInfo->username),
							$searchUserInfo->key_recovery,
						], $template));
					}
					
					$template = htmlspecialchars_decode(utf8_decode($template));
					
					
					$mail = new MailSend();
					$mail->setSubject("Restablecimiento de contraseña - Monteverde LTDA");
					$mail->addTo($searchUserInfo->email, $searchUserInfo->username);
					$mail->setHtml(true);
					$mail->setMessage($template);
					$sendingMail = $mail->sendMail();
					if($sendingMail == true){
						// Enviado con exito
						// echo json_encode($sendTru);
					}
					
					
					$this->redirect('site', 'RecoverAccount', [
						"error" => 'Se envio un mensaje a tu cuenta de correo electronico.'
					]);
				} else {
					$this->redirect('site', 'RecoverAccount', [
						"error" => 'Hubo un error enviando el correo de recuperacion para tu cuenta.',
						"feliphegomez" => 'more/#signup'
					]);
				}
			}
			
		}
		
		
		if(isset($_GET['error']) && $_GET['error'] != ""){
			$error = [
				"title" => "Alerta",
				"text" => $_GET['error'],
				"styling" => "bootstrap3",
				"type" => "error",
				"icon" => true,
				"animation" => "zoom",
				"hide" => false
			];
			
			$this->errors[] = $error;
		}
		$this->render("recover", [
            "title" => "Iniciar sesión",
            "description_text" => $description_text,
            "recover" => $recover,
            "error" => $error
        ]);
    }
	
	public function actionViewPicture(){
        if ($this->isGuest){ header('HTTP/1.0 403 Forbidden'); exit(); }
		$request = $this->getRequest();
		if(isset($request['id']) && $request['id'] > 0){
			$model = new Picture($this->adapter);
			$model->getById($request['id']);
			#header("Content-type: {$model->type}");
			#echo $model->data;
			#$image = imagecreatefromstring($model->data);
			#print base64_encode($model->data);
				#echo $model->data;
			
			# echo '<img style="width:calc(95vw);height:calc(95vh);padding: calc(2.5vh) calc(2.5vw);" src="data:image/png;base64,'.base64_encode($model->data).'">';
			##$data = base64_decode(base64_encode($model->data));
			##print utf8_encode($data);
			$newData = base64_encode($model->data);
			## echo $newData;
			
			header('Content-Type: image/png');
			$im = imagecreatefromstring($newData);
			# $im = imagecreatefrompng($im);
			
			
			if ($im !== false) {
				header('Content-Type: image/png');
				imagepng($im);
				imagedestroy($im);
			}
			else {
				echo 'Ocurrió un error.';
			}
			/*
			$data = base64_decode(base64_encode($model->data));
			$im = imagecreatefromstring($newData);
			if ($im !== false) {
				header('Content-Type: image/jpeg');
				imagejpeg($im);
				imagedestroy($im);
			}
			else {
				echo 'Ocurrió un error.';
			}
			*/
		}
		
	}
}
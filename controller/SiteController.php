﻿<?php 
/* *******************************
 *
 * Developer by FelipheGomez
 *
 * ******************************/

class SiteController extends ControladorBase{
    public function __construct() {
        parent::__construct();
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
			
			$this->render($modelNode->view, 
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
			"error" => 'Session cerrada con exito.',
			"feliphegomez" => 'more/#signup'
		]);
    }
	
	public function actionMeJSON(){
        if ($this->isGuest){ header('HTTP/1.0 403 Forbidden'); exit(); }
		header("Content-type:application/json");
		
		echo json_encode($this->user, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_FORCE_OBJECT | JSON_UNESCAPED_SLASHES);
		return json_encode($this->user, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_FORCE_OBJECT | JSON_UNESCAPED_SLASHES);
		echo json_encode($this->user, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
		return json_encode($this->user, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
	}
	
	public function actionInviteUserInAccount(){
        if ($this->isGuest || ($this->checkPermission('me:accounts') !== true)){ header('HTTP/1.0 403 Forbidden'); exit(); }
		$sendJSON = new stdClass();
		$sendJSON->error = true;
		$requestIn = $this->getRequest();
		# $sendJSON->_request = $requestIn;
		$requestIn['phone'] = (!isset($requestIn['phone'])) ? '-' : $requestIn['phone'];
		$requestIn['mobile'] = (!isset($requestIn['mobile'])) ? '-' : $requestIn['mobile'];
		$requestIn['permissions'] = (!isset($requestIn['permissions'])) ? null : ($requestIn['permissions'] == null || (int) $requestIn['permissions'] > 0) ? $requestIn['permissions'] : null;
		
		if(isset($requestIn['username'])
			&& isset($requestIn['password'])
			&& isset($requestIn['names'])
			&& isset($requestIn['surname'])
			&& isset($requestIn['phone'])
			&& isset($requestIn['mobile'])
			&& isset($requestIn['email'])
			&& isset($requestIn['account'])
		){
			if(isset($requestIn['controller']))
				unset($requestIn['controller']);
			if(isset($requestIn['action']))
				unset($requestIn['action']);
			
			$permissions = $requestIn['permissions'];
			if(isset($requestIn['permissions']))
				unset($requestIn['permissions']);
			$account = $requestIn['account'];
			if(isset($requestIn['account']))
				unset($requestIn['account']);
			
			$sendJSON->userData = $requestIn;
			$sendJSON->account = $account;
			
			$register = new RegisterForm($this->adapter);
			$register->setData($requestIn);
			$newUser = $register->createBasic();
			if($newUser = true){
				$includeResponse = $register->IncludeInAccount($account, $permissions);
				$sendJSON->error = !$includeResponse;
					
			} else {
				
			}
		}
		
		
		header("Content-type:application/json");
		$result = json_encode($sendJSON, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_FORCE_OBJECT | JSON_UNESCAPED_SLASHES);
		echo $result;
		return $result;
	}
}
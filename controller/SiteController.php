<?php 
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

	// Reporte media - Subir Archivo en Reporte
	public function actionSend_Photo_Schedule(){
		if ($this->isGuest || ($this->checkPermission('reports:photographic:offline') !== true)){ header('HTTP/1.0 403 Forbidden'); exit(); }
		$error = null;
		$request = $this->getRequest();
		
		$year = (isset($request['year']) && (int) $request['year'] >= date("Y")) ? (int) $request['year'] : date("Y");
		
		$schedule = isset($request['schedule']) ? ($request['schedule']) : false;
		$route_name = isset($request['route_name']) ? base64_decode((string) $request['route_name']) : false;
		$group = isset($request['group']) ? ($request['group']) : false;
		$period = isset($request['period']) ? ($request['period']) : false;
		$date_executed = isset($request['date_executed']) ? ($request['date_executed']) : false;
		
		$group_name = isset($request['group_name']) ? base64_decode((string) $request['group_name']) : false;
		$period_name = isset($request['period_name']) ? base64_decode((string) $request['period_name']) : false;
		$lat = isset($request['lat']) ? (float) $request['lat'] : 0;
		$lng = isset($request['lng']) ? (float) $request['lng'] : 0;
		
		$type = isset($request['type']) ? $request['type'] : false;
		$typeText = ($type !== "A") ? ($type == "D") ? 'DESPUES' : 'OTRO' : 'ANTES';
		
		$ds          = DIRECTORY_SEPARATOR;
		$storeFolder = 'uploads';
		$files_detect = !isset($_FILES['file']) ? false : true;
		$getFiles = $this->getFiles();
		//$files = isset($getFiles['file']) ? is_array($getFiles['file']) == true && isset($getFiles[0]['file']) ? $getFiles['file'] : [$getFiles['file']] : isset($getFiles['files']) ? is_array($getFiles['files']) == true && isset($getFiles[0]['files']) ? $getFiles['files'] : [$getFiles['files']] : [];
		$files = isset($getFiles['file']) ? is_array($getFiles['file']) == true && isset($getFiles[0]['file']) ? $getFiles['file'] : [$getFiles['file']] : [];
		
		$returning = (object) [
			'error' 	=> true,
			'message' => "Cargando..",
			'success'    => 'error',
			'additional' => new stdClass(),
			'request' => $request,
			# '_GET' => (isset($_GET)) ? $_GET : [],
			# '_REQUEST' => (isset($_REQUEST)) ? $_REQUEST : [],
			# '_POST' => (isset($_POST)) ? $_POST : [],
			# '_FILES' => (isset($_FILES)) ? $_FILES : [],
			# '_FILE' => (isset($_FILE)) ? $_FILE : [],
		];
		$returning->additional->files = [];
		$returning->additional->files_origin = $files;
		
		
		try {
			if(
				$route_name !== false
				&& $schedule !== false
				&& $group !== false
				&& $group_name !== false
				&& $year !== false
				&& $period !== false
				&& $period_name !== false
				&& $date_executed !== false
				&& $type !== false
				&& $typeText !== false
			){
				$folderBase = [
					"reports-photographics",
					"en-revision",
					$year,
					$period_name,
					$group_name,
					$route_name,
					$typeText,
				];
				$targetPath = PUBLIC_PATH . $ds . implode($ds, $folderBase) . $ds;
				
				$returning->folderBase = $folderBase;
				
				if (count($files) > 0) {
					$isArray = is_array($files) ? true : [$files];
					if ( !file_exists($targetPath) && !is_dir($targetPath) ) { mkdir($targetPath, 0777, true); }; // Compruebe si la carpeta de carga si existe sino se crea la carpeta
					
					// Compruebe si la carpeta se creo o si existe
					if ( file_exists($targetPath) && is_dir($targetPath) ) {
						// Comprueba si podemos escribir en el directorio de destino
						if ( is_writable($targetPath) ) {
							// $returning->message = "multiples archivos."; //carpeta: {$targetPath}
							$total = count($files);
							$returning->total = $total;
							for($i = 0; $i < $total; $i++){
								// $files[$i]['name'] = mb_ereg_replace("([^\w\s\d\-_~,;\[\]\(\).])", '', $files[$i]['name']);
								//$files[$i]['name'] = mb_ereg_replace("([\.]{2,})", '', $files[$i]['name']);
								
								$model = new ReportPhotographicFile($this->adapter);
								$model->schedule = $schedule;
								$model->year = $year;
								$model->type = $type;
								$model->group = $group;
								$model->period = $period;
								$model->lat = $lat;
								$model->lng = $lng;
								$model->file_name = randomString(6, $files[$i]['name']);
								$model->file_type = $files[$i]['type'];
								$model->file_size = $files[$i]['size'];
								$model->file_path_short = $ds . "public" . $ds .implode($ds, $folderBase). $ds . $date_executed . "-" . $model->file_name;
								$model->file_path_full = $targetPath . $date_executed . "-" . $model->file_name;
								$model->create_by = $this->user->id;
								
								
								// Mover archivo
								$error_up = !$model->copyFile($files[$i]['tmp_name']);
								$returning->error = $error_up;
								if ($error_up == false) {
									$returning->additional->files[] = (object) [
										"id" => $model->id,
										"name" => $model->file_name,
										"type" => $model->file_type,
										"size" => $model->file_size,
										"path_short" => $model->file_path_short,
										"path_full" => $model->file_path_full,
										"error" => ($model->id > 0) ? false : true,
									];
									$returning->error = false;
									$returning->message = 'Archivo cargado con éxito.';
								} else {
									$returning->error = true;
									$returning->message = 'No se pudo cargar el archivo solicitado :(, ocurrió un misterioso error.';
								}
							}
						} else {
							$returning->message = "No hay permisos en la carpeta. {$targetPath}";
						}
					}else{
						$returning->message = "No existe la carpeta. {$targetPath}";
					}
				}else{
					$returning->message = "No se recibieron archivos.";
				}
			} else {
				$returning->message = "Campos incompletos";
			}
			
			$returning->success = $returning->error == false ? 'success' : 'error';
			$returning->additional->files = is_object(json_decode(json_encode($returning->additional->files))) ? [$returning->additional->files] : $returning->additional->files;
			
			header('Content-Type: application/json');
			echo json_encode($returning);
			return json_encode($returning);
		} catch(Exception $e){
			header('Content-Type: application/json');
			echo json_encode("Error");
			return json_encode("Error");
		}
	}
	
	// Reporte media - Subir Archivo en Reporte
	public function actionSend_Photo_eAAA(){
		if ($this->isGuest || ($this->checkPermission('reports:photographic:offline') !== true)){ header('HTTP/1.0 403 Forbidden'); exit(); }
		header('Content-Type: application/json');
		$error = null;
		$_get = (!empty($_GET)) ? $_GET : [];
		$_post = (!empty($_POST)) ? $_POST : [];
		$_files = (empty($_FILES['file'])) ? $this->getFiles() : ((is_array($_FILES['file']) && isset($_FILES['file'][0]) && is_array($_FILES['file'][0])) ? $_FILES['file'] : [$_FILES['file']]);
       
			
		$ds          = DIRECTORY_SEPARATOR;
		$storeFolder = 'uploads';
		$files_detect = count($_files) > 0 ? true : false;
		
		$returning = (object) [
			'error' 	=> true,
			'message' => "Cargando..",
			'success'    => 'error',
			'additional' => new stdClass(),
			//'files' => isset($_FILES['file']) ? $_FILES['file'] : [],
			//'_get' => $_get,
			//'_post' => $_post,
		];
		
		$returning->additional->files_detect = $_files;
		$returning->additional->files = [];
		
		$date_report = isset($_GET['date_report']) ? ($_GET['date_report']) : false;
		$group = isset($_GET['group']) ? ($_GET['group']) : false;
		$period = isset($_GET['period']) ? ($_GET['period']) : false;
		$year = (isset($_GET['year']) && (int) $_GET['year'] >= date("Y")) ? (int) $_GET['year'] : date("Y");
		$lat = isset($_GET['lat']) ? (float) $_GET['lat'] : false;
		$lng = isset($_GET['lng']) ? (float) $_GET['lng'] : false;
		$id_report = isset($_GET['id_report']) ? (float) $_GET['id_report'] : false;
		
		$group_name = isset($_GET['group_name']) ? base64_decode((string) $_GET['group_name']) : false;
		$period_name = isset($_GET['period_name']) ? base64_decode((string) $_GET['period_name']) : false;
		
		if(
			$group !== false
			&& $id_report !== false
			&& $group_name !== false
			&& $period !== false
			&& $period_name !== false
			&& $date_report !== false
			&& $lat !== false
			&& $lng !== false
		){
			$folderBase = [
				"reports-photographics",
				"{$year}",
				"{$period_name}",
				"{$group_name}",
				"observaciones",
				$date_report,
				"reporte-nro-" . $id_report,
				// $date_executed
			];
			$targetPath = PUBLIC_PATH . $ds . implode($ds, $folderBase) . $ds;
			$returning->message = $targetPath;
			$returning->folderBase = $folderBase;
			
			try {
				if (count($_files) > 0) {
					// Compruebe si la carpeta de carga si existe sino se crea la carpeta
					if ( !file_exists($targetPath) && !is_dir($targetPath) ) { mkdir($targetPath, 0755, true); };
					// Compruebe si la carpeta se creo o si existe
					if ( file_exists($targetPath) && is_dir($targetPath) ) {
						// Comprueba si podemos escribir en el directorio de destino
						if ( is_writable($targetPath) ) {
							$total = count($_files);
							$returning->total_det = $total;
							$returning->total_up = 0;
							
							for($i = 0; $i < $total; $i++){
								$model = new ReportNoveltyFile($this->adapter);
								$model->novelty = $id_report;
								$model->year = $year;
								$model->group = $group;
								$model->period = $period;
								$model->date_report = $date_report;
								$model->lat = $lat;
								$model->lng = $lng;
								$model->file_name = randomString(6, $_files[$i]['name']);
								$model->file_type = $_files[$i]['type'];
								$model->file_size = $_files[$i]['size'];
								$model->file_path_short = $ds . "public" . $ds .implode($ds, $folderBase). $ds . $model->file_name;
								$model->file_path_full = $targetPath . $model->file_name;
								$model->created_by = $this->user->id;
								
								// Mover archivo
								$error_up = !$model->copyFile($_files[$i]['tmp_name']);
								$returning->error = $error_up;
								if ($error_up == false) {
									
									
									
									
									$returning->total_up++;
									$returning->message = 'Archivo guardado correctamente.';
									$returning->additional->files[] = (object) [
										"id" => $model->id,
										"name" => $model->file_name,
										"type" => $model->file_type,
										"size" => $model->file_size,
										"path_short" => $model->file_path_short,
										"path_full" => $model->file_path_full,
										"error" => ($model->id > 0) ? false : true,
									];
								} else {
									$returning->error = true;
									$returning->message = 'No se pudo cargar el archivo solicitado :(, ocurrió un misterioso error.';
								}
							}
						} else {
							$returning->error = true;
							$returning->message = "No hay permisos en la carpeta. {$targetPath}";
						}
					}else{
						$returning->error = true;
						$returning->message = "no existe la carpeta. {$targetPath}";
					}
				}else{
					$returning->error = true;
					$returning->message = "No hay archivo(s)";
				}
				
				$returning->success = $returning->error == false ? 'success' : 'error';
				$returning->additional->files = is_object(json_decode(json_encode($returning->additional->files))) ? [$returning->additional->files] : $returning->additional->files;
				

				
				
				echo json_encode($returning);
				return json_encode($returning);
			} catch (Exception $e) {
				$returning->error = true;
				$returning->message = $e->getMessage();
				echo json_encode($returning);
				return json_encode($returning);
			}
		}

			echo json_encode($returning);
			return json_encode($returning);
		
	}
}
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
		ini_set('display_errors', 0);
		ini_set('display_startup_errors', 0);
		//error_reporting(NONE);

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
		# $files = (isset($_FILES[0]['file'])) ? $_FILES : [$_FILES['file']];
		
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
				// $targetPath = PUBLIC_PATH . "/files/{$year}/{$mouth}/{$day}/";
				$targetPath = PUBLIC_PATH . $ds . implode($ds, $folderBase) . $ds;
				$targetPath = PUBLIC_PATH . $ds . implode($ds, $folderBase) . $ds;
				
				$returning->folderBase = $folderBase;
				
				if (isset($files)) {
					$isArray = is_array($files) ? true : false;
					if ( !file_exists($targetPath) && !is_dir($targetPath) ) { mkdir($targetPath, 0777, true); }; // Compruebe si la carpeta de carga si existe sino se crea la carpeta
					
					// Compruebe si la carpeta se creo o si existe
					if ( file_exists($targetPath) && is_dir($targetPath) ) {
						// Comprueba si podemos escribir en el directorio de destino
						if ( is_writable($targetPath)  && $isArray == true) {
							// $returning->message = "multiples archivos."; //carpeta: {$targetPath}
							$total = count($files);
							$returning->total = $total;
							foreach($files as $file){
								if(isset($file['name'])){
									
									$fileNameTemp = $date_executed . "-" . randomString(16,  $file['name']);
									$urlShortFile = $ds . "public" . $ds .implode($ds, $folderBase). $ds . $fileNameTemp;
									$urlFullFile = $targetPath . $fileNameTemp;
									
									$model = new ReportPhotographicFile($this->adapter);
									$model->schedule = $schedule;
									$model->year = $year;
									$model->type = $type;
									$model->group = $group;
									$model->period = $period;
									$model->lat = $lat;
									$model->lng = $lng;
									$model->file_name = $fileNameTemp;
									$model->file_type = $file['type'];
									$model->file_size = $file['size'];
									$model->file_path_short = $urlShortFile;
									$model->file_path_full = $urlFullFile;
									$model->create_by = $this->user->id;
									
									// Mover archivo
									
									$error_up = !$model->copyFile($file['tmp_name']);
									$returning->error = $error_up;
									
									$returning->text = ($error_up == false) ? 'archivo no copiado' : 'Archivo Copiado con exito.'; // carpeta: {$targetPath}
									if ($error_up == false) {
										$returning->status = 'succes';
										$returning->error = false;
										$returning->message = 'Archivo cargado con éxito.';
										
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
										$returning->message = "No se pudo cargar el archivo solicitado :(, ocurrió un misterioso error. {$error_up}";
									}
								}
							}
							for($i = 0; $i < $total; $i++){								
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
	
	// Reporte media - 
	public function actionReport_Photo_Approve(){
        if ($this->isGuest || ($this->checkPermission('reports:photographic:validation') !== true)){ header('HTTP/1.0 403 Forbidden'); exit(); }
		$_get = (!empty($_GET)) ? $_GET : [];
		$error = null;
		$file_id = (isset($_GET['file_id']) && (int) $_GET['file_id'] > 0) ? (int) $_GET['file_id'] : 0;
		$fileModel = new ReportPhotographicFile($this->adapter);
		$fileModel->getById($file_id);
		$ds          = DIRECTORY_SEPARATOR;
		
		
		if($fileModel->status !== 1 && file_exists($fileModel->file_path_full)){
			// echo "Vamos" . "\r\n";
			
			$path_full = $fileModel->file_path_full;
			$parts_path_full = explode($ds, $path_full);
			$array_finish_pf = [];
			foreach($parts_path_full as $f){ if($f == 'en-revision' || $f == 'no-aprobado'){ $f = 'aprobado'; } $array_finish_pf[] = $f; }
			$new_path_full = implode($ds, $array_finish_pf);
			$nameDir = dirname($new_path_full);
			
			# echo $nameDir ."\r\n";
			
			
			$path_short = $fileModel->file_path_short;
			$parts_path_short = explode($ds, $path_short);
			$array_finish_ps = [];
			foreach($parts_path_short as $f){ if($f == 'en-revision' || $f == 'no-aprobado'){ $f = 'aprobado'; } $array_finish_ps[] = $f; }
			$new_path_short = implode($ds, $array_finish_ps);
			
			# echo $new_path_short ."\r\n";
			
			if ( !file_exists($nameDir) && !is_dir($nameDir) ) { mkdir($nameDir, 0755, true); };
			if ( file_exists($nameDir) && is_dir($nameDir) ) {
				if ( is_writable($nameDir) ) {
					echo "Podemos escribir en el directorio de destino.";
					$success = (rename($path_full, $new_path_full));
					if($success == true){
						echo "Resultado 1 : " . json_encode($success);
						
						$fileModel->status = 1;
						$fileModel->updated_by = $this->user->id;
						$fileModel->file_path_full = $new_path_full;
						$fileModel->file_path_short = $new_path_short;
						$succes = $fileModel->saveFolders();
						echo "Resultado 2 : " . json_encode($succes);
					}
				} else {
					echo "No podemos escribir en el directorio de destino.";
				}
			} else {
				echo "Compruebe si la carpeta se creo o si existe";
			}
		}
	}
	
	// Reporte media - 
	public function actionReport_Photo_NoPass(){
        if ($this->isGuest || ($this->checkPermission('reports:photographic:validation') !== true)){ header('HTTP/1.0 403 Forbidden'); exit(); }
		$_get = (!empty($_GET)) ? $_GET : [];
		$error = null;
		$file_id = (isset($_GET['file_id']) && (int) $_GET['file_id'] > 0) ? (int) $_GET['file_id'] : 0;
		$fileModel = new ReportPhotographicFile($this->adapter);
		$fileModel->getById($file_id);
		$ds          = DIRECTORY_SEPARATOR;
		
		
		if($fileModel->status !== 2 && file_exists($fileModel->file_path_full)){
			// echo "Vamos" . "\r\n";
			
			$path_full = $fileModel->file_path_full;
			$parts_path_full = explode($ds, $path_full);
			$array_finish_pf = [];
			foreach($parts_path_full as $f){ if($f == 'en-revision' || $f == 'aprobado'){ $f = 'no-aprobado'; } $array_finish_pf[] = $f; }
			$new_path_full = implode($ds, $array_finish_pf);
			$nameDir = dirname($new_path_full);
			
			# echo $nameDir ."\r\n";
			
			
			$path_short = $fileModel->file_path_short;
			$parts_path_short = explode($ds, $path_short);
			$array_finish_ps = [];
			foreach($parts_path_short as $f){ if($f == 'en-revision' || $f == 'aprobado'){ $f = 'no-aprobado'; } $array_finish_ps[] = $f; }
			$new_path_short = implode($ds, $array_finish_ps);
			
			# echo $new_path_short ."\r\n";
			
			if ( !file_exists($nameDir) && !is_dir($nameDir) ) { mkdir($nameDir, 0755, true); };
			if ( file_exists($nameDir) && is_dir($nameDir) ) {
				if ( is_writable($nameDir) ) {
					echo "Podemos escribir en el directorio de destino.";
					$success = (rename($path_full, $new_path_full));
					if($success == true){
						echo "Resultado 1 : " . json_encode($success);
						
						$fileModel->status = 2;
						$fileModel->updated_by = $this->user->id;
						$fileModel->file_path_full = $new_path_full;
						$fileModel->file_path_short = $new_path_short;
						$succes = $fileModel->saveFolders();
						echo "Resultado 2 : " . json_encode($succes);
					}
				} else {
					echo "No podemos escribir en el directorio de destino.";
				}
			} else {
				echo "Compruebe si la carpeta se creo o si existe";
			}
		}
	}
	
	// Reporte media - Subir Archivo en Reporte
	public function actionSend_File_Novelty(){
		if ($this->isGuest || ($this->checkPermission('emvarias:beta:reports:offline') !== true)){ header('HTTP/1.0 403 Forbidden'); exit(); }
		header('Content-Type: application/json');
		$error = null;
		$_get = (!empty($_GET)) ? $_GET : [];
		$_post = (!empty($_POST)) ? $_POST : [];
		$_files = (empty($_FILES['file'])) ? [] : ((is_array($_FILES['file']) && isset($_FILES['file'][0]) && is_array($_FILES['file'][0])) ? $_FILES['file'] : [$_FILES['file']]);
        
			
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
				"programas-novedades",
				"{$year}",
				"{$period_name}",
				"{$group_name}",
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
	
	public function actionCreateReportPDFNovelty(){		
		$ds          = DIRECTORY_SEPARATOR;
		$request = $this->getRequest();
		if(isset($request['novelty_general_id']) && $request['novelty_general_id'] > 0){
			// Creación del objeto de la clase heredada
			$model = new NoveltyGeneral($this->adapter);
			$pdf = new BaseReportEmvariasNoveltiesGeneralsPDF();
			$model->getById($request['novelty_general_id']);
			
			$folderBase = [
				"reports-photographics",
				"programas-novedades",
				"{$model->year}",
				"{$model->period->name}",
				"{$model->group->name}",
				$model->date_report,
				"reporte-nro-" . $model->id,
			];
			$targetPath = PUBLIC_PATH . $ds . implode($ds, $folderBase) . $ds;
			if ( !file_exists($targetPath) && !is_dir($targetPath) ) { mkdir($targetPath, 0777, true); }; // Compruebe si la carpeta de carga si existe sino se crea la carpeta
			$filename   = $targetPath . $ds . "reporte-nro-{$model->id}.pdf";
			
			#echo "$targetPath";
			#exit();
			$pdf->AliasNbPages();
			$pdf->AddPage();
			$pdf->SetFont('Times','',12);
			#$pdf->Cell(0,10,utf8_decode('aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa'));
			$pdf->Ln(20);
			$pdf->SetFont('Times','B',12);
			$pdf->Cell(0,10,utf8_decode("Fecha del reporte: "));
			$pdf->Ln();
			$pdf->SetFont('Times','',12);
			$pdf->Cell(0,10,utf8_decode($model->date_report));
			$pdf->Ln();
			$pdf->SetFont('Times','B',12);
			$pdf->Cell(0,10,utf8_decode("Resumen de los hechos: "));
			$pdf->Ln();
			$pdf->SetFont('Times','',12);
			$pdf->MultiCell(180,8, utf8_decode($model->notes));
			
			$pdf->Output($filename,'F');
			$pdf->Output();
					
			/*
			// $pdf->Cell(0,10,utf8_decode("Fecha de creacion: " . $model->created));
			$pdf->Ln(20);
			for($i=1;$i<=25;$i++)
				$pdf->Cell(0,7,utf8_decode('Imprimiendo línea número ').$i,0,1);
			*/
		}
	}
		
	public function actionCreateZipPhotos(){
		$ds          = DIRECTORY_SEPARATOR;
		$request = $this->getRequest();
		$year = (isset($request['year']) && (int) $request['year'] >= date("Y")) ? (int) $request['year'] : date("Y");
		$period_name = isset($request['period_name']) ? base64_decode((string) $request['period_name']) : false;
		
		if($period_name !== false){
			$rootPath = realpath(PUBLIC_PATH . $ds . 'reports-photographics' . $ds .'aprobado' . $ds . $year . $ds . $period_name);
			$zip = new ZipArchive;
			$archive_file_name = "Fotografias-reporte-{$year}-{$period_name}" . randomString(8) . '.zip';
			$zipSave = PUBLIC_PATH . '/tmpZip/' . $archive_file_name;
			$zip->open($zipSave, ZipArchive::CREATE | ZipArchive::OVERWRITE);
			$files = new RecursiveIteratorIterator(
				new RecursiveDirectoryIterator($rootPath),
				RecursiveIteratorIterator::LEAVES_ONLY
			);
			
			
			foreach ($files as $name => $file){
				// Skip directories (they would be added automatically)
				if (!$file->isDir())
				{
					// Get real and relative path for current file
					$filePath = $file->getRealPath();
					$relativePath = substr($filePath, strlen($rootPath) + 1);

					// Add current file to archive
					$zip->addFile($filePath, $relativePath);
				}
			}
			$zip->close();
			header("Content-type: application/zip"); 
			header("Content-Disposition: attachment; filename=$archive_file_name");
			//header("Content-length: " . filesize($zip));
			header("Pragma: no-cache"); 
			header("Expires: 0"); 
			readfile($zipSave);
		}
	}
	
	// Candidatos - Search Return IDs
	public function actionSearchCandidates(){
        if ($this->isGuest || ($this->checkPermission('candidates:admin') !== true)){ 
			header('HTTP/1.0 403 Forbidden');
			$this->render("errors", 
				[
				"code"=> "403",
				"title"=> "Acceso denegado",
				"description" => "",
			]); exit();	
		}
		$error = isset($_GET['searchText']) ? false : true;
		$text = isset($_GET['searchText']) ? $_GET['searchText'] : "";
		$items = array();
		$returning = (object) [
			'error' 	=> $error,
			'text' => $text,
			'records' => $items,
		];
		
		if ($error === false){
			// "Busqueda 1"
			$sql = "SELECT * FROM `candidates` 
			WHERE 
				`identification_number` LIKE '%{$text}%' 
				OR `names` LIKE '%{$text}%' 
				OR `surname` LIKE '%{$text}%' 
				OR `address` LIKE '%{$text}%' 
				OR `salary` LIKE '%{$text}%' 
				OR `email` LIKE '%{$text}%' 
				OR `phone` LIKE '%{$text}%' 
				OR `mobile` LIKE '%{$text}%' 
				OR `notes` LIKE '%{$text}%'";
			$conn = new EntidadBase('candidates', $this->adapter);
			$data = $conn->getSQL($sql);
			$records1 = [];
			foreach($data as $candidate){
				$candidate = is_array($candidate) ? (object) $candidate : $candidate;
				//$returning->records[] = $candidate->id;
				if(!isset($records1[$candidate->id])){
					$records1[] = $candidate->id;
				}
			}
			// "Busqueda 2" - Dentro de experiencia
			$sql2 = "SELECT * FROM `candidates_experience` 
			WHERE 
				`business` LIKE '%{$text}%' 
				OR `position` LIKE '%{$text}%' 
				OR `functions` LIKE '%{$text}%' ";
			$conn2 = new EntidadBase('candidates_experience', $this->adapter);
			$data2 = $conn2->getSQL($sql2);
			$records2 = [];
			foreach($data2 as $experience){
				$experience = is_array($experience) ? (object) $experience : $experience;
				if(!isset($records2[$experience->candidate])){
					$records2[] = $experience->candidate;
				}
			}
		}
		$returning->records = array_merge(array_unique(array_merge($records1, $records2)), array());
		echo json_encode($returning);
		return json_encode($returning);
	}
	
	// media - Subir Archivo
	public function actionUploadFile(){
		$error = null;
        if ($this->isGuest){ header('HTTP/1.0 403 Forbidden'); exit(); }
		$ds          = DIRECTORY_SEPARATOR;
		$storeFolder = 'uploads';
		$files_detect = !isset($_FILES['file']) ? false : true;
		$files = (isset($_FILES['file'])) ? (is_array($_FILES['file']) && isset($_FILES['file'][0]['tmp_name']) ? $_FILES['file'] : [$_FILES['file']]) : [];
		$returning = (object) [
			'error' 	=> true,
			'status'    => 'error',
			'result' => false,
			'files_detect' => $files_detect,
			'files' => [],
			//'files' => isset($_FILES['file']) ? $_FILES['file'] : [],
			'text' => ""
		];
		
		if (isset($files)) {
			$isArray = is_array($files) ? true : false;
			$day = date("d");
			$mouth = date("m");
			$year = date("Y");
			$targetPath = PUBLIC_PATH . "/files/{$year}/{$mouth}/{$day}/";
			// Compruebe si la carpeta de carga si existe sino se crea la carpeta
			if ( !file_exists($targetPath) && !is_dir($targetPath) ) { mkdir($targetPath, 0777, true); };
			// Compruebe si la carpeta se creo o si existe
			if ( file_exists($targetPath) && is_dir($targetPath) ) {
				// Comprueba si podemos escribir en el directorio de destino
				if ( is_writable($targetPath) ) {
					/** Empieza a bailar */
					if($isArray == true){
						// $returning->text = "multiples archivos."; //carpeta: {$targetPath}
						$total = count($files);
						for($i = 0; $i < $total; $i++){
							$model = new Media($this->adapter);
							$model->name = randomString(16, $files[$i]['name']);
							$model->type = $files[$i]['type'];
							$model->size = $files[$i]['size'];
							$model->path_short = "/public/files/{$year}/{$mouth}/{$day}/" . $model->name;
							$model->path_full = $targetPath . $model->name;
							$model->create_by = $this->user->id;
							
							// Mover archivo
							$error_up = !$model->copyFile($files[$i]['tmp_name']);
							$returning->error = $error_up;
								$returning->text = $error_up; // carpeta: {$targetPath}
							if ($error_up == false) {
								$returning->status = 'succes';
								$returning->files[] = (object) [
									"id" => $model->id,
									"name" => $model->name,
									"type" => $model->type,
									"size" => $model->size,
									"path_short" => $model->path_short,
									"path_full" => $model->path_full,
									"error" => ($model->id > 0) ? false : true,
								];
							} else {
								$returning->text = 'No se pudo guardar el archivo solicitado :(, ocurrió un misterioso error.';
							}
						}
					} else {
						$model = new Media($this->adapter);
						$model->name = randomString(16, $_FILES['name']);
						$model->type = $_FILES['type'];
						$model->size = $_FILES['size'];
						$model->path_short = "/public/files/{$year}/{$mouth}/{$day}/" . $model->name;
						$model->path_full = $targetPath . $model->name;
						$model->create_by = $this->user->id;
						
						// Mover archivo
						$error_up = !$model->copyFile($_FILES['tmp_name']);
						$returning->error = $error_up;
							$returning->text = $error_up; // carpeta: {$targetPath}
						if ($error_up == false) {
							$returning->files[] = (object) [
								"id" => $model->id,
								"name" => $model->name,
								"type" => $model->type,
								"size" => $model->size,
								"path_short" => $model->path_short,
								"path_full" => $model->path_full,
								"error" => ($model->id > 0) ? false : true,
							];
						} else {
							$returning->text = 'No se pudo cargar el archivo solicitado :(, ocurrió un misterioso error.';
						}
					}
				} else {
					$returning->text = "No hay permisos en la carpeta. ";
				}
			}else{
				$returning->text = "no existe la carpeta. {$targetPath}";
			}
		}
		
		$returning->status = $returning->error == false ? 'status' : 'error';
		$returning->files = is_object(json_decode(json_encode($returning->files))) ? [$returning->files] : $returning->files;
		echo json_encode($returning);
		return json_encode($returning);
	}
}
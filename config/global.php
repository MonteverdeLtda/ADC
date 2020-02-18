<?php 
/* *******************************
 *
 * Developer by FelipheGomez
 *
 * ******************************/

require_once 'settings.php';

define('HOME_PATH', dirname(__DIR__));
define('PUBLIC_PATH', HOME_PATH . "/public");
define('CONFIG_PATH', dirname(__DIR__ . "/../"));
define('CORE_PATH', dirname(CONFIG_PATH . '../') . '/core');

ini_set('memory_limit', '128M');


spl_autoload_register(function($className){
		$namespace = str_replace("\\","/", __NAMESPACE__);
		$className = str_replace("\\","/", $className);
		$ruta_1 = dirname(CONFIG_PATH . '../') . "/core/model/" . (empty($namespace) ? "" : $namespace . "/") . "{$className}.php";
		$ruta_2 = dirname(CONFIG_PATH . '../') . "/core/" . (empty($namespace) ? "" : $namespace . "/") . "{$className}.php";
		$ruta_3 = dirname(CONFIG_PATH . '../') . "/core/libs/" . (empty($namespace) ? "" : $namespace . "/") . "{$className}.php";
		
	try {
		if(@get_called_class() != false){			
			$ruta_4 = dirname(CONFIG_PATH . '../') . "/core/model/" . str_replace(substr(get_called_class(), 0, strrpos(get_called_class(), "\\")) . "/","", $className) . ".php";
			$ruta_5 = dirname(CONFIG_PATH . '../') . "/core/" . str_replace(substr(get_called_class(), 0, strrpos(get_called_class(), "\\")) . "/","", $className) . ".php";
			$ruta_6 = dirname(CONFIG_PATH . '../') . "/core/libs/" . str_replace(substr(get_called_class(), 0, strrpos(get_called_class(), "\\")) . "/","", $className) . ".php";
			$file = !is_file($ruta_1) ? !is_file($ruta_2) ? !is_file($ruta_3) ? !is_file($ruta_4) ? !is_file($ruta_5) ? !is_file($ruta_6) ? "" : $ruta_6 : $ruta_5 : $ruta_4 : $ruta_3 : $ruta_2 : $ruta_1;
			
			if($file != ""){
				require_once($file);
			}else{
				echo "Archivo no existe. " . $file . "\n";
				echo "Opcion 1: . " . $ruta_1 . "\n";
				echo "Opcion 2: . " . $ruta_2 . "\n";
				echo "Opcion 3: . " . $ruta_3 . "\n";
				echo "Opcion 4: . " . $ruta_4 . "\n";
				echo "Opcion 5: . " . $ruta_5 . "\n";
				echo "Opcion 6: . " . $ruta_6 . "\n";
				exit();
			}
		}else{
			throw new Exception('Division by zero.');
		}
		
		
	} 
	catch(Exception $e) {
		//check the stack trace at desired level
		//print_r($e->getTrace());
		$file = !is_file($ruta_1) ? !is_file($ruta_2) ? !is_file($ruta_3) ? "" : $ruta_3 : $ruta_2 : $ruta_1;
		
		if($file != ""){
			require_once($file);
		}else{
			echo "Archivo no existe. " . $file . "\n";
			echo "Opcion 1: . " . $ruta_1 . "\n";
			echo "Opcion 2: . " . $ruta_2 . "\n";
			echo "Opcion 3: . " . $ruta_3 . "\n";
			exit();
		}
	}

	
});

session_start();
require_once CORE_PATH . '/Session.php';
global $global_session;
$global_session = new Session();
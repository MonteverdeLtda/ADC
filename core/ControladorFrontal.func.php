<?php 
/* *******************************
 *
 * Developer by FelipheGomez
 *
 * ******************************/
#define('CORE_PATH', dirname(dirname(dirname(__DIR__ . '/../')."../")."../"));


//FUNCIONES PARA EL CONTROLADOR FRONTAL

function cargarControlador($controller){
    $controlador = ucwords($controller).'Controller';
    $strFileController = 'controller/'.$controlador.'.php';
    
    if(!is_file($strFileController)){
        $strFileController = 'controller/'.ucwords(CONTROLADOR_DEFECTO).'Controller.php';   
    }
    
    require_once $strFileController;
    $controllerObj=new $controlador();
    return $controllerObj;
}

function cargarAccion($controllerObj, $action){
    $accion = "action".ucwords(strtolower($action));
	if(method_exists($controllerObj, $accion)) {
		$controllerObj->$accion();
	} else {
		echo "El metodo {$accion} en ".get_class($controllerObj).", no existe.";
	}
}

function lanzarAccion($controllerObj){
    $_GET["action"] = !isset($_GET["action"]) ? ACCION_DEFECTO : $_GET["action"];
    $accion = "action".ucwords(strtolower($_GET["action"]));
	
    if(isset($accion) && method_exists($controllerObj, $accion)){
        cargarAccion($controllerObj, $_GET["action"]);
    }else{
		echo "El metodo {$_GET["action"]} en ".get_class($controllerObj).", no existe.";
    }
}

function linkRoute($controlador=CONTROLADOR_DEFECTO,$accion=ACCION_DEFECTO){
	return ("/index.php?controller=".$controlador."&action=".$accion);
}

function randomString($length = 16, $origin_str = "") {
	$str = "";
    $chars = "-_0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    for ($i = 0; $i < $length; $i++) {
        $str .= $chars[mt_rand(0, strlen($chars) - 1)];
    }
    return "{$str}-{$origin_str}";
}

class DateText extends DateTime{
	public function __construct($time = "now", $timezone = NULL){
		parent::__construct($time, $timezone);
	}
	
	public function __toString(){
		$hoy = new DateTime("now", new DateTimeZone('America/Bogota'));
		$dateFull = $this->format('Y-m-d H:i');
		$dateShort = $this->format('h:i a');
		$interval = $this->diff($hoy);
		$monthIndex = $this->format('n');
		$monthList = ['', 'Enero',  'Febrero',  'Marzo',  'Abril',  'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
		$monthText = $monthList[$monthIndex];
		
		$dayIndex = $this->format('w');
		$dayList = ['Domingo', 'Lunes',  'Martes',  'Miercoles',  'Jueves',  'Viernes',  'Sabado',  ];
		$dayText = $dayList[$dayIndex];
		
		#$indexHoy = date('Y-m-d H:i:s', $hoy->getTimestamp()) . "-" . date('z', $date->getTimestamp());
		#$indexDate = date('Y-m-d H:i:s', $date->getTimestamp()) . "-" . date('z', $date->getTimestamp());
		$total_años = $interval->format('%Y');
		$total_meses = $interval->format('%m');
		$total_dias = $interval->format('%d');
		$total_horas = $interval->format('%H');
		$total_minutos = $interval->format('%i');
		$total_segundos = $interval->format('%s');
		
		if($total_años > 0){
			return "{$dateFull}";
		} else {
			if($total_meses > 1){
				return "Hace {$total_meses} Mes(es) [{$dateFull}]";
			} else {
				if(1 >= $total_dias){
					return "{$dateShort}";
					#return "HOY: [{$dateShort}]";
				} else if(1 <= $total_dias && $total_dias <= 2){
					return "Ayer a las [{$dateShort}]";
				} else {
					if($total_dias > 7){
						return "{$dayText} {$this->format('d')} de {$monthText} a las {$dateShort}.";
					} else {
						return "Hace {$total_dias} días a las {$dateShort}, {$dayText} {$this->format('d')}.";
						# return "Hace {$total_dias} días. [{$dateFull}]";
					}
				}
				
			}
		}
		#return $interval->format('%Y-%m-%d %H:%i:%s');
		// Mon, 16 Sep 2019 15:54:47 +0000
	}

    /**
     * Return Age in Years
     *
     * @param Datetime|String $now
     * @return Integer
     */
    public function getAge($now = 'NOW') {
        return $this->diff($now)->format('%y');
    }
}

function cortar_string($string, $largo) { 
   $marca = "<!--corte-->"; 
   if (strlen($string) > $largo) { 
       $string = wordwrap($string, $largo, $marca); 
       $string = explode($marca, $string); 
       $string = $string[0]; 
   } 
   return $string;
}

function DMStoDD($deg,$min,$sec){
    // Converting DMS ( Degrees / minutes / seconds ) to decimal format
    return $deg+((($min*60)+($sec))/3600);
}    

function DDtoDMS($dec, $separator="."){
    // Converts decimal format to DMS ( Degrees / minutes / seconds )
	$dec = (float) $dec;
    $vars = explode($separator,$dec);
    $deg = $vars[0];
    $tempma = "0.".$vars[1];

    $tempma = $tempma * 3600;
    $min = floor($tempma / 60);
    $sec = $tempma - ($min*60);

    return array("deg"=>$deg,"min"=>$min,"sec"=>$sec);
}

function dirToArray($dir) {
   $result = array();
   $cdir = scandir($dir);
   foreach ($cdir as $key => $value)
   {
      if (!in_array($value,array(".","..")))
      {
         if (is_dir($dir . DIRECTORY_SEPARATOR . $value))
         {
            $result[$value] = dirToArray($dir . DIRECTORY_SEPARATOR . $value);
         }
         else
         {
            $result[] = $value;
         }
      }
   }
  
   return $result;
}
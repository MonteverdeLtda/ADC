<?php 
/* *******************************
 *
 * Developer by FelipheGomez
 *
 * ******************************/

class Conectar{
    private $driver;
    private $host, $user, $pass, $database, $charset;
  
    public function __construct() {
		$dir_path = dirname(__DIR__);
		
		if(is_file("{$dir_path}/config/database.php")){
			$db_cfg = require_once("{$dir_path}/config/database.php");
			$this->driver=$db_cfg["driver"];
			$this->host=$db_cfg["host"];
			$this->user=$db_cfg["user"];
			$this->pass=$db_cfg["pass"];
			$this->database=$db_cfg["database"];
			$this->charset=$db_cfg["charset"];
		}
		else {
			echo $dir_path.'/config/database.php';
		}
    }
    
    public function conexion($pdo=true){
        if($pdo == true){
			return $this->conexionPDO();
		} else {
			 if($this->driver=="mysql" || $this->driver==null){
				$con=new mysqli($this->host, $this->user, $this->pass, $this->database);
				$con->query("SET NAMES '".$this->charset."'");
				$con->query("SET SESSION sql_warnings=1;");
				$con->query("SET SESSION sql_mode = \"ANSI,TRADITIONAL\";");
			}
			return $con;
		}
    }
	
    public function conexionPDO(){
		try {
			if($this->driver=="mysql" || $this->driver==null){
				# $con=new mysqli($this->host, $this->user, $this->pass, $this->database);
				$pdo = new PDO(
					$this->driver.":host={$this->host};dbname={$this->database};charset={$this->charset}",
					"{$this->user}",
					"{$this->pass}",
					[
						# PDO:: ATTR_PERSISTENT => true,
						#PDO::MYSQL_ATTR_INIT_COMMAND => "SET lc_time_names='es_CO',NAMES '{$this->charset}'"
						#PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES {$this->charset}, lc_time_names='es_CO'"
						#PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES {$this->charset}"
					]
					);
				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
			}
			return $pdo;
		} catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
			die();
		}

    }
    
    public function startFluent(){
        require_once "FluentPDO/FluentPDO.php";
        
        if($this->driver=="mysql" || $this->driver==null){
            $pdo = new PDO($this->driver.":dbname=".$this->database.";charset=utf8mb4", $this->user, $this->pass,array
						(
							# PDO:: ATTR_PERSISTENT => true,
							PDO::MYSQL_ATTR_INIT_COMMAND
							=> 
							"SET lc_time_names='es_CO',NAMES '{$this->charset}'"
						));
            $fpdo = new FluentPDO($pdo);
        }
        
        return $fpdo;
    }
}
?>

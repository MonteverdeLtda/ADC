<?php 
/* *******************************
 *
 * Developer by FelipheGomez
 *
 * ******************************/

class ReportPhotographicFile extends ModeloBase{
    
	public function __construct($adapter) {
        $table="reports_photographic";
        parent::__construct($table, $adapter);
    }
	
	public function __sleep(){
		return $this->labels;
	}
    
	public function copyFile($tmp_name){
		$success = (@move_uploaded_file($tmp_name, $this->file_path_full));
		if ($success == true) {
			$this->save();
			return $this->id > 0 ? true : false;
		}else{
			return false;
		}
	}
	
	public function getTotalPendings(){
		//$status = ($status !== null) ? is_numeric($status) ? [$status] : is_array($status) ? $status : [$status] : [0];
		$total = 0;
		$sql = "SELECT COUNT(*) AS total FROM {$this->getTableUse()} WHERE `status` IN (?) ";
		
		try {
            $query = $this->db->prepare($sql);
            $query->execute([0]);
            $result = $query->fetchAll(PDO::FETCH_OBJ);
            return (isset($result[0]->total) && $result[0]->total > 0) ? $result[0]->total : 0;
        }
        catch(Exception $e){
            echo "<b>Error:</b> ".($e->getMessage() . " [SQL-FRONT]: $sql");
            return 0;
        }
	}
	
    public function save($columns = null){
		if($this->create_by > 0){} else { return 0; }
		$sql = "INSERT INTO {$this->getTableUse()} (`schedule`, `year`, `type`, `group`, `period`, `lat`, `lng`, `file_name`, `file_type`, `file_size`, `file_path_full`, `file_path_short`, `create_by`) 
		VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
		
		
		$query = $this->db()->prepare($sql);
		try {
			$success = $query->execute([
				$this->schedule,
				$this->year,
				$this->type,
				$this->group,
				$this->period,
				$this->lat,
				$this->lng,
				$this->file_name,
				$this->file_type,
				$this->file_size,
				$this->file_path_full,
				$this->file_path_short,
				$this->create_by,
			]);
			$this->id = $this->db()->lastInsertId();
			
			#return $this->id;
			return $this->id;
		}catch (Exception $e){
			//throw $e;
			#echo "\n {$sql} \n";
			echo $e->getMessage();
			return 0;
		}
    }
	
    public function saveFolders($columns = null){
		if($this->create_by > 0){} else { return 0; }
		$sql = "UPDATE {$this->getTableUse()} SET `schedule`=?, `year`=?, `type`=?, `status`=?, `group`=?, `period`=?, `lat`=?, `lng`=?, `file_name`=?, `file_type`=?, `file_size`=?, `file_path_full`=?, `file_path_short`=?, `create_by`=? WHERE `id`='{$this->id}'";
		
		
		$query = $this->db()->prepare($sql);

		try {
			$query->execute([
				$this->schedule,
				$this->year,
				$this->type,
				$this->status,
				$this->group,
				$this->period,
				$this->lat,
				$this->lng,
				$this->file_name,
				$this->file_type,
				$this->file_size,
				$this->file_path_full,
				$this->file_path_short,
				$this->create_by,
			]);
			return true;
		}catch (Exception $e){
			//throw $e;
			echo "\n {$sql} \n";
			echo $e->getMessage();
			return false;
		}
		
    }
	
	public function getById($id){
		$id = (isset($id) && $id > 0) ? $id : 0;
		$items = parent::getById($id);
		if(isset($items[0])){
			foreach($items[0] as $k=>$v){
				$this->{$k} = $v;
			}
		}
		return $items;
	}
}
?>
<?php 
/* *******************************
 *
 * Developer by FelipheGomez
 *
 * ******************************/

class ReportNoveltyFile extends ModeloBase{
    
	public function __construct($adapter) {
        $table="novelties_files";
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
	
    public function save($columns = null){
		if($this->created_by > 0){} else { return 0; }
		$sql = "INSERT INTO {$this->getTableUse()} (`novelty`, `year`, `group`, `period`, `date_report`, `lat`, `lng`, `file_name`, `file_type`, `file_size`, `file_path_full`, `file_path_short`, `created_by`) 
		VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
		
		
		$query = $this->db()->prepare($sql);
		try {
			$success = $query->execute([
				$this->novelty,
				$this->year,
				$this->group,
				$this->period,
				$this->date_report,
				$this->lat,
				$this->lng,
				$this->file_name,
				$this->file_type,
				$this->file_size,
				$this->file_path_full,
				$this->file_path_short,
				$this->created_by,
			]);
			$this->id = $this->db()->lastInsertId();
			
			return $this->id;
		}catch (Exception $e){
			echo $e->getMessage();
			return 0;
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
<?php 
/* *******************************
 *
 * Developer by FelipheGomez
 *
 * ******************************/

class Media extends ModeloBase{
    
	public function __construct($adapter) {
        $table="media";
        parent::__construct($table, $adapter);
    }
	
	public function __sleep(){
		return $this->labels;
	}
    
	public function copyFile($tmp_name){
		$success = (@move_uploaded_file($tmp_name, $this->path_full));
		if ($success == true) {
			$this->save();
			return $this->id > 0 ? true : false;
		}else{
			return false;
		}
	}
	
	public function deleteDB(){
		try {
			$sql = "DELETE FROM {$this->getTableUse()} WHERE id=?";
			$query = $this->db()->prepare($sql);
			$query->execute([$this->id]);
			return true;
		}
		catch(PDOException $e){
			echo $sql . "<br>" . $e->getMessage();
			return false;
		}
	}
	
    public function save($columns = null){
		if($this->create_by > 0){} else { return 0; }
		$sql = "INSERT INTO {$this->getTableUse()} (name, type, size, path_full, path_short, create_by) VALUES (?, ?, ?, ?, ?, ?)";
		$query = $this->db()->prepare($sql);
		try {
			$success = $query->execute([
				$this->name,
				$this->type,
				$this->size,
				$this->path_full,
				$this->path_short,
				$this->create_by,
			]);
			$this->id = $this->db()->lastInsertId();
			$this->addInUser();
			
			#return $this->id;
			return $this->id;
		}catch (Exception $e){
			//throw $e;
			#echo "\n {$sql} \n";
			echo $e->getMessage();
			return 0;
		}
    }
	
    public function addInUser(){
		if($this->id > 0){} else { return false; }
		if($this->create_by > 0){} else { return false; }
		$sql = "INSERT INTO media_users (media, user) VALUES (?, ?)";
		$query = $this->db()->prepare($sql);
		try {
			$success = $query->execute([
				$this->id,
				$this->create_by
			]);			
			return $success;
		}catch (Exception $e){
			return false;
		}
    }
	
}
?>
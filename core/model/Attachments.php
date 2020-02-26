<?php 
/* *******************************
 *
 * Developer by FelipheGomez
 *
 * *******************************
 */

class Attachments extends EntidadBase {
	public $adapter;
	
    public function __construct($adapter) {
		$this->adapter = $adapter;
        $table = "attachments";
        parent::__construct($table, $adapter);
    }
	
	public function __sleep(){
		return ["id", "name", "filename", "targetPath", "targetFile", "path_short", "filesize", "filetype"];
	}
	
	public function getById($id){
		$id = (isset($id) && $id > 0) ? $id : 0;
		$items = parent::getById($id);
		if(isset($items[0])){
			$this->setAllData($items[0]);
		}
	}
	
    public function crear($post = []){
        if(isset($post['path_short'])){
			$arrayInsert = [];
			$keys1 = [];
			foreach($this->__sleep() as $k){
				if(isset($post[$k])){
					$this->set($k, $post[$k]);
					$arrayInsert[$k] = $post[$k];
					#$keys1[] = ":{$k}";
					$keys1[] = "?";
				}
			}
			$exist = parent::getBy('path_short', $post['path_short']);
			if(isset($exist[0])){
				return $exist[0]->id;
			}else{
				$k1 = implode(',', array_keys($arrayInsert));
				$k2 = implode(',', $keys1);
				$sql = "INSERT INTO {$this->getTableUse()} ({$k1}) VALUES ({$k2})";
				$query = $this->db()->prepare($sql);
				
				try {
					$success = $query->execute(array_values($post));
					return $this->db()->lastInsertId();
				}catch (Exception $e){
					//throw $e;
					echo "{$e->getMessage()}\n {$sql} \n";
					return 0;
				}
				
			}
				
				
        }
    }
	
    public function eliminar(){
        if(isset($this->id) && $this->id > 0){
			try {
				$sql = "DELETE FROM $this->table WHERE id=?";
				$query = $this->db()->prepare($sql);
				$query->execute([$this->id]);
				return true;
			}
			catch(PDOException $e){
				#echo $sql . "<br>" . $e->getMessage();
				return false;
			}
		}else{
			return false;
		}
    }
}
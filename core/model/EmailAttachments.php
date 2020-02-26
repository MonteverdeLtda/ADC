<?php 
/* *******************************
 *
 * Developer by FelipheGomez
 *
 * *******************************
 */

class EmailAttachments extends EntidadBase {
	public $adapter;
	
    public function __construct($adapter) {
		$this->adapter = $adapter;
        $table = "emails_attachments";
        parent::__construct($table, $adapter);
    }
	
	public function getById($id){
		$id = (isset($id) && $id > 0) ? $id : 0;
		$items = parent::getById($id);
		if(isset($items[0])){
			$this->setAllData($items[0]);
		}
	}
	
    public function crear($post = []){
        if(isset($post['email']) && isset($post['attachment'])){
			$arrayInsert = [];
			$keys1 = [];
			foreach($this->__sleep() as $k){
				if(isset($post[$k])){
					$this->set($k, $post[$k]);
					$arrayInsert[$k] = $post[$k];
					$keys1[] = ":{$k}";
				}
			}
			$exist = parent::getSQL("SELECT * FROM {$this->getTableUse()} WHERE email=? AND attachment=?", [$post['email'], $post['attachment']]);
			if(isset($exist[0])){
				return $exist[0]->id;
			}else{
				$k1 = implode(',', array_keys($arrayInsert));
				$k2 = implode(',', $keys1);
				$sql = "INSERT INTO {$this->getTableUse()} (email,attachment) VALUES (?,?)";
				$query = $this->db()->prepare($sql);
				
				try {
					$success = $query->execute([$post['email'], $post['attachment']]);
					return $this->db()->lastInsertId();
				}catch (Exception $e){
					//throw $e;
					echo "\n {$sql} \n";
					echo $e->getMessage();
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
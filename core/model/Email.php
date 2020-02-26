<?php 
/* *******************************
 *
 * Developer by FelipheGomez
 *
 * *******************************
 */

class Email extends EntidadBase {
	private $listing = [];
	
    public function __construct($adapter) {
		$this->adapter = $adapter;
        $table = "emails";
        parent::__construct($table, $adapter);
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
	
	public function getByEmailFromBox($box_id, $id){
		$box_id = (isset($box_id) && $box_id > 0) ? $box_id : 0;
		$id = (isset($id) && $id > 0) ? $id : 0;
		$items = parent::getSQL("SELECT * FROM {$this->getTableUse()} WHERE id=? AND box=?", [$id, $box_id]);
		if(isset($items[0])){
			foreach($items[0] as $k=>$v){
				$this->{$k} = $v;
			}
			return $items[0];
		}
		return null;
	}
	
	public function emailExist($message_id, $uid){
		$items = parent::getSQL("SELECT * FROM {$this->getTableUse()} WHERE message_id=? AND uid=?", [$message_id, $uid]);
		if(isset($items[0])){
			return true;
		} else {
			return false;
		}
	}
	
    public function crear($post = []){
		$id = 0;
        if(isset($post['message_id']) && isset($post['uid'])){
			$exist = parent::getBy('message_id', $post['message_id']);
			
			if(isset($exist[0])){
				return $exist[0]->id;
			}else{
				$arrayInsert = [];
				$keys1 = [];
				$keys2 = [];
				
				$keys = array_keys($post);
				$values = [];
				foreach($keys as $key){
					if(isset($post[$key])){
						//$this->decodeIMAPText(
						//$post = Email::convertKeyValuesIMAP($post);
						if(!is_array($post[$key]) && !is_object($post[$key])){
							#$post[$key] = Email::decodeVal($post[$key]);
							$post[$key] = ($post[$key]);
						}else{
							$post[$key] = ($post[$key]);
						}
						$keys1[] = "`{$key}`";
						// $keys2[] = ":{$key}";
						$keys2[] = "?";
						
						$values[] = !is_array($post[$key]) && !is_object($post[$key]) ? (Email::decodeVal($post[$key])) : json_encode($post[$key]);
					}
					
				}
				
								
				$k1 = implode(',', ($keys1));
				$k2 = implode(',', ($keys2));
				$sql = "INSERT INTO {$this->getTableUse()} ({$k1}) VALUES ({$k2}) ";
				$query = $this->db()->prepare($sql);
				try {
					$success = $query->execute($values);
					
					foreach($post as $k=>$v){
						$this->{$k} = $v;
					}
					
					return $this->db()->lastInsertId();
				}catch (Exception $e){
					//throw $e;
					echo "\n {$sql} \n";
					echo $e->getMessage();
					return 0;
				}
			}
				
        }
		return $id;
    }
	
	public static function decodeIMAPText($str = "") : string {
		$op = '';
		$decode_header = imap_mime_header_decode($str);
		foreach ($decode_header AS $obj){
			$op .= htmlspecialchars(rtrim($obj->text, "\t"));
		}
		return ($op);
	}
	
	public static function convertKeyValuesIMAP($item){
		$new = new stdClass();
		foreach($item as $key=>$value){
			if(isset($value)){
				$new->{$key} = "";
				if (!is_array($value) && !is_object($value)) {
					$new->{$key} = Email::decodeVal($value);
				}else{
					$new->{$key} = Email::convertKeyValuesIMAP($value);
				}
			}
		}
		return $new;
	}
	
	public static function decodeVal($string = "") {
		$tabChaine=imap_mime_header_decode($string);
		$texte='';
		for ($i=0; $i<count($tabChaine); $i++) {
			switch (strtoupper($tabChaine[$i]->charset)) { //convert charset to uppercase
				case 'UTF-8': $texte.= $tabChaine[$i]->text; //utf8 is ok
					break;
				case 'DEFAULT': $texte.= $tabChaine[$i]->text; //no convert
					break;
				default: if (in_array(strtoupper($tabChaine[$i]->charset),$this->upperListEncode())) //found in mb_list_encodings()
							{$texte.= mb_convert_encoding($tabChaine[$i]->text,'UTF-8',$tabChaine[$i]->charset);}
						 else { 
							//try to convert with iconv()
							  $ret = iconv($tabChaine[$i]->charset, "UTF-8", $tabChaine[$i]->text);    
							  if (!$ret) $texte.=$tabChaine[$i]->text;  //an error occurs (unknown charset) 
							  else $texte.=$ret;
							}
					break;
				}
		}
			
		return $texte;    
	}
	
	public function loadMailsPending($boxes = []){
		$list = [];
		foreach($boxes as $a){
			$a = is_array($a) ? (object) $a : $a;
			$list[] = $a->id;
		}
		if(count($list) == 0){ return []; }
		$list = implode(',', $list);
		
		$sql = "SELECT * FROM emails WHERE 
				`status`='unread' 
			AND box IN ({$list}) ";
        return $this->FetchAllObject($sql);
	}
	
	public function getByBoxId($boxId = 0){
		$id = (isset($boxId) && $boxId > 0) ? $boxId : 0;
		
		$this->listing = [];
		$sql = "SELECT EM.* FROM emails AS EM WHERE EM.seen = 0 AND EM.box IN ({$list}) ORDER BY id DESC LIMIT 100";
		
		
		foreach(parent::getBy('box', $boxId) as $box){
			$box = is_array($box) ? (object) $box : $box;
			$box->message = htmlspecialchars_decode($box->message);
			$this->listing[] = $box;
		}
		
		return $this->listing;
	}
	
	public function getList(){
		return $this->listing;
	}
	
	public function updateBy($id, $colum = null, $value = null){
		if (isset($id) && $id > 0){
			if($colum !== null && $colum !== null){
				$sql = "UPDATE {$this->getTableUse()} SET $colum=? WHERE id='{$id}'";
				$query = $this->db()->prepare($sql);
				
				try {
					$query->execute([$value]);
					$this->{$colum} = $value;
					
					
					return true;
				}catch (Exception $e){
					//throw $e;
					echo "\n {$sql} \n";
					echo $e->getMessage();
					return false;
				}
			}
		} else {
			return "no_id";
		}
	}
	
	public function getByFilter($params = []){
		$params = is_object($params) ? (array) $params : is_array($params) ? $params : [];
		$this->listing = [];
		$filtros = "";
		foreach($params as $k=>$v){
			$v = is_array($v) ? "'".implode("','", $v)."'" : json_encode($v);
			$filtros .= " AND {$k} IN ({$v})";
		}
		
		$items = parent::getSQL("SELECT * FROM {$this->getTableUse()} WHERE id > 0 {$filtros} ORDER BY id DESC LIMIT 500");
		foreach($items as $mail){
			$mail = is_array($mail) ? (object) $mail : $mail;
			$mail->message = htmlspecialchars_decode($mail->message);
			$this->listing[] = $mail;
		}		
		return $this->listing;
	}
	
	public function updateByFilter($params = []){
		$params = is_object($params) ? (array) $params : is_array($params) ? $params : [];
		$this->listing = [];
		
		$filtros = [];
		foreach($params as $k=>$v){
			$v = is_array($v) ? implode("','", $v) : is_string($v) ? $v: json_encode($v);
			$filtros[] = "{$k}='{$v}'";
		}
		$sql = "UPDATE {$this->getTableUse()} SET " . implode(',', $filtros) . " WHERE id='{$this->id}'";
		try {
			return $this->adapter->prepare($sql)->execute();
		}catch(Exception $e){
			return false;
		}
	}
}
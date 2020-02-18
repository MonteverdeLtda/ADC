<?php 
/* *******************************
 *
 * Developer by FelipheGomez
 *
 * ******************************/

class Permissions extends ModeloBase{
	public $id = 0;
	public $name = "";
	public $description = "";
	private $list_a = [];
	private $list_t = [];
	public $list = "";
	
	public function __construct($adapter) {
        #$table="permissions_group";
        $table="permissions";
        parent::__construct($table, $adapter);
		
    }
	
	public function listing(){
		return implode(',', $this->list_a);
	}
	
	public function __sleep(){
		return ['id', 'name', 'description', 'list'];
	}
		
	public function getByIdGroup($groupId = null){
		
		if($groupId !== null){
			$sql = "SELECT 
					P.`group` AS `group_id`
					, PT.`id` AS `id`
					, PT.tag AS tag
					, PT.name AS name
					, PT.description AS description
					, PG.`name` AS `group_name`
					, PG.`description` AS `group_description`
				FROM 
					`permissions` AS P
						LEFT JOIN `permissions_group` AS PG
							ON PG.id = P.`group`
						LEFT JOIN `permissions_items` AS PT
							ON PT.id = P.permission
				WHERE `group`=?";
			
			$this->setAll(parent::getSQL($sql, [$groupId]));			
		}
		return $this;
	}
	
	public function setAll($array = []){
		if(isset($array[0])){
			foreach($array[0] as $k => $v){
				if($k == 'group_name'){ $this->set('name', $v); }
				else if($k == 'group_id'){ $this->set('id', $v); }
				else if($k == 'group_description'){ $this->set('description', $v); }
			}
			$this->setList($array);
		}
		return $this;
	}
	
	public function setList($array = []){
		if(count($array) > 0){
			foreach($array as $item){
				$this->list_a[$item->tag] = (object) [
					'id' => $item->id,
					'tag' => $item->tag,
					'name' => $item->name,
					'description' => $item->description
				];
				$this->list_t[strtolower($item->tag)] = $item->id > 0 ? true : false;
			}
			$this->list = is_array($this->list_t) ? implode(',', array_keys($this->list_t)) : "";
		}
		return $this->list_t;
	}
	
	public function validatePermission($nameNode = 'none'){
		$nameNode = strtolower($nameNode);
		return !isset($this->list_t['isadmin']) || !isset($this->list_t['isadmin']) 
			? false : true;
	}
}
?>
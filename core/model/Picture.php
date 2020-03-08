<?php 
/* *******************************
 *
 * Developer by FelipheGomez
 *
 * ******************************/

class Picture extends ModeloBase {
	
	public function __construct($adapter){
        $table = "pictures";
        parent::__construct($table, $adapter);
	}
	
	public function __sleep(){
		return [
			'id', 
			'name', 
			'description', 
			'size', 
			'data', 
			'type', 
			'created', 
			'updated', 
		];
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
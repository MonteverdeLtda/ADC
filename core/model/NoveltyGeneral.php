<?php 
/* *******************************
 *
 * Developer by FelipheGomez
 *
 * ******************************/

class NoveltyGeneral extends ModeloBase{
    
	public function __construct($adapter) {
        $table="novelties_generals";
        parent::__construct($table, $adapter);
    }
	
	public function __sleep(){
		return $this->labels;
	}
	
	public function getById($id){
		$id = (isset($id) && $id > 0) ? $id : 0;
		$items = parent::getById($id);
		if(isset($items[0])){
			foreach($items[0] as $k=>$v){
				$this->{$k} = $v;
				if($k == 'period'){
					$model = new Period($this->adapter);
					$model->getById($v);
					$this->{$k} = $model;
				}
				else if($k == 'group'){
					$model = new Group($this->adapter);
					$model->getById($v);
					$this->{$k} = $model;
				}
			}
		}
		return $items;
	}
}
?>
<?php 
/* *******************************
 *
 * Developer by FelipheGomez
 *
 * ******************************/

class EmailBox extends ModeloBase{
	private $list;
	
	public function __construct($adapter) {
        $table="emails_boxes";
        parent::__construct($table, $adapter);
    }
	
	public function getById($id){
		return $this->setAll(parent::getById($id));
	}
	
	public function getAll(){
		$items = parent::getAll();
		
		$this->list = $items;
		return $items;
	}
	
	public function getAllPendingSync(){
		$items = parent::getAll();
		
		$xmasDay = new DateTime('-15 seconds');
		$boxes_sync = [];
		foreach($items as $box){
			if($box->actived == 1){
				$datetime = new DateTime($box->last_sync);
				// echo "Fecha 1. xmasDay \n" . strtotime($xmasDay->format('Y-m-d H:i:s')) . " {$xmasDay->format('Y-m-d H:i:s')} \n";
				// echo "Fecha 2. datetime \n" . strtotime($datetime->format('Y-m-d H:i:s')) . " {$datetime->format('Y-m-d H:i:s')} \n";
				if(strtotime($xmasDay->format('Y-m-d H:i:s')) > strtotime($datetime->format('Y-m-d H:i:s'))) {
					$boxes_sync[] = $box;
				}
			}
		}
		$this->list = $boxes_sync;
		return $boxes_sync;
	}
	
	public function updateSync($idBox){
		$datetime = new DateTime();
		$sql = ("UPDATE `emails_boxes` SET `last_sync`='{$datetime->format('Y-m-d H:i:s')}' WHERE `id`={$idBox}");
		$query = $this->db()->prepare($sql);
		try {
			$success = $query->execute();
			return true;
		}catch (Exception $e){
			//throw $e;
			echo $e->getMessage();
			return false;
		}
	}
}
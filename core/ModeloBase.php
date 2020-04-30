<?php 
/* *******************************
 *
 * Developer by FelipheGomez
 *
 * ******************************/

class ModeloBase extends EntidadBase
{
    public $adapter;
    public $formulario;
    private $table;
    public $db;
	public $isUnique;
    
    public function __construct($table, $adapter) {
        $this->adapter = $adapter;
        $this->table = (string) $table;
		$this->db = $adapter;
        parent::__construct($table, $adapter);
        // $this->formulario = $this->toFormHtml();
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

    public function toFormHtml($Action = "", $Method = "GET", $FormType = 0, $MessageError = "Datos invalidos.", $MessageSuccess = "OK."){
        $rules = $this->rules();
        $labels = $this->attributeLabels();
        $formulario = new PHPStrap\Form\Form($Action, $Method, $FormType, $MessageError, $MessageSuccess);      
        foreach($rules as $rul){
            $formulario->group($rul);
        }
        $formulario->addSubmitButton('Continuar', [
            "name" => "btn-submit", 
        ]);
        return $formulario;
    }

    public function isValid(){   
        return $this->formulario->isValid();
    }
    
    public function rules(){
        return [
        ];
    }

    public function attributeLabels(){
        return [
        ];
    }
	
	public function generateFormCreate($Action = "", $Method = "POST", $FormType = 0, $MessageError = "Error.", $MessageSuccess = "Creado con éxito"){
		$this->formulario = $this->toFormHtml($Action, $Method, $FormType, $MessageError, $MessageSuccess);
        return $this->formulario;
	}

    public function save($columns = null){
		$columns = $columns !== null ? $columns : $this->__sleep();
		$key = [];
		$values = [];
		$sqlKey = [];
		foreach($columns as $key){
			if($key !== 'id' && $key !== 'created' && $key !== 'updated'){
				$sqlKey[] = "`{$key}`=:{$key}";
				//$sqlKey[] = "`{$key}`=?";


				$keys[] = ":{$key}";
				$values[$key] = !isset($this->{$key}) ? null : $this->{$key};
				#$values[] = !isset($this->{$key}) ? null : $this->{$key};
			}
		}
		
		#$sql = "UPDATE {$this->getTableUse()} SET ".implode(',', $sqlKey)." WHERE id='{$this->id}'";
		$sql = "UPDATE {$this->getTableUse()} SET ".implode(',', $sqlKey)." WHERE id='{$this->id}'";
		$query = $this->db()->prepare($sql);
		
		try {
			$success = $query->execute($values);
			return true;
		}catch (Exception $e){
			//throw $e;
			#echo "\n {$sql} \n";
			echo $e->getMessage();
			return false;
		}
    }

};
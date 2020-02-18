<?php 
/* *******************************
 *
 * Developer by FelipheGomez
 *
 * ******************************/
ini_set('memory_limit', '1024M');

class EntidadBase{
    private $adapter;
    private $table;
    private $db;
    private $conectar;
    private $columnas;
    public $labels;
    public $rules;

    public function __construct($table, $adapter = NULL) {
        $this->table = (string) $table;
        $this->columnas = [];
        $this->rules = [];
        $this->labels = [];

        $this->isUnique = false;
		/*
		require_once 'Conectar.php';
		$this->conectar=new Conectar();
		$this->db=$this->conectar->conexion();
		 */
		$this->conectar = null;
		$this->adapter = $adapter;
		$this->db = $adapter;
        if(method_exists($this, 'rules')) { $this->rules = $this->rules(); }
        $this->createModel();
        $this->loadLabels();
    }

	public function __sleep(){
		$r = [];
		foreach($this->columnas as $k){
			$col = $k->name;
			if(isset($this->{$col})){
				$r[] = $col;
			}
		}		
		return $r;
	}
	
	public function __toString(){
		#$r = new stdClass();
		$b = [];
		foreach($this->__sleep() as $k)
		{
			if(isset($this->{$k})){
				# $r->{$k} = $this->{$k};
				$b[] = [$k, $this->{$k}];
			}
		}	
		return (string) (PHPStrap\Table::borderedTable($b));
	}
	
    public function loadLabels(){
        if(method_exists($this, 'attributeLabels')) {
            foreach ($this->attributeLabels() as $key => $value) {
                if($this->labels[$key]){
                    $this->labels[$key] = $value;
                }
            }
        }
    }
	
	public function createModel(){
        $sql = "SELECT 
                `tbl_columns`.`ORDINAL_POSITION` AS `posicion_original`,
                `tbl_columns`.`COLUMN_NAME` AS `columna_nombre`, 
                `tbl_columns`.`IS_NULLABLE` AS `nullValido`,
                `tbl_columns`.`COLUMN_DEFAULT` AS `columna_value_default`,
                `tbl_columns`.`DATA_TYPE` AS `data_tipo`,
                `tbl_columns`.`COLUMN_TYPE` AS `columna_tipo`,
                `tbl_columns`.`CHARACTER_MAXIMUM_LENGTH` AS `length_max`,
                `tbl_columns`.`COLUMN_KEY` AS `columna_key`,
                `tbl_columns`.`EXTRA` AS `columna_extra`,
                `tbl_columns`.`COLUMN_COMMENT` AS `columna_comnetario`,

                `tbl_rship`.`REFERENCED_TABLE_NAME` AS `tabla_referencia`,
                `tbl_rship`.`REFERENCED_COLUMN_NAME` AS `columna_referencia` 
            FROM 
                `information_schema`.`columns` AS `tbl_columns` 
            LEFT JOIN 
                `information_schema`.`KEY_COLUMN_USAGE` AS `tbl_rship` 
            ON 
                `tbl_rship`.`CONSTRAINT_SCHEMA` = '" . DB_database . "' 
                AND `tbl_columns`.`COLUMN_NAME` = `tbl_rship`.`COLUMN_NAME` 
                AND `tbl_columns`.`table_name` = `tbl_rship`.`table_name`
                AND `tbl_rship`.`REFERENCED_TABLE_SCHEMA` IS NOT NULL 
             WHERE `tbl_columns`.`table_schema` = '" . DB_database . "' AND `tbl_columns`.`table_name` = '{$this->table}'
                ORDER BY
                    `tbl_columns`.`ORDINAL_POSITION` ASC";
        try {
            $query = $this->db->prepare($sql);
            $query->execute();

            foreach ($query->fetchAll(PDO::FETCH_OBJ) as $column) {
                $column = $this->modelInitial($column);
                /*
                Result: 
                    {
                      "posicion_original": 1,
                      "columna_nombre": "id",
                      "nullValido": "NO",
                      "columna_value_default": null,
                      "data_tipo": "int",
                      "columna_tipo": "int(11)",
                      "length_max": null,
                      "columna_key": "PRI",
                      "columna_extra": "auto_increment",
                      "columna_comnetario": "",
                      "tabla_referencia": null,
                      "columna_referencia": null
                    }
                */
                $this->columnas[] = $column;
                $this->{$column->name} = $column->value;
                $inArray = array_search('UNI', $column->key);

                if($this->isUnique == null && $inArray !== false){ $this->isUnique = true; }
                // Create RULE
                if(!method_exists($this, 'rules')) {
                    if($column->required == true){ $this->rules[] = [[$column->name, ], 'required']; }
                    if($column->length_max !== false){ $this->rules[] = [[$column->name, ], 'max' => $column->length_max]; }
                    if($column->unique == true){ $this->rules[] = [[$column->name, ], 'unique']; }
                }

                // CREATE LABELS
                $this->labels[$column->name] = $column->name;

            }
        }
        catch(Exception $e){
            return "<b>Error:</b> ".($e->getMessage());
            echo "<b>Error:</b> ".($e->getMessage());
            exit();
        }
	}

    public function modelInitial($columna){
        $column = new stdClass();
        if(!is_object($columna)){ return $column; }

        $column->name = isset($columna->columna_nombre) ? $columna->columna_nombre : 'no_detect';
        $column->nullValid = (isset($columna->nullValido) && $columna->nullValido == 'YES') ? true : false;
        $column->value_default = $columna->columna_value_default;
        $column->type = $columna->data_tipo;
        $column->key = array_filter(explode(',', $columna->columna_key));
        $column->extra = array_filter(explode(',', $columna->columna_extra));
        $column->tbl_ref = $columna->tabla_referencia;
        $column->tbl_column = $columna->columna_referencia;
        $column->auto_increment = (array_search('auto_increment', $column->extra) !== false) ? true : false;
        $column->unique = (array_search('UNI', $column->key) !== false) ? true : false;
        $column->primary = (array_search('PRI', $column->key) !== false) ? true : false;
        $column->mult = (array_search('MUL', $column->key) !== false) ? true : false;
        $column->length_max = isset($columna->length_max) ? (int) $columna->length_max : false;

        $column->value_default = isset($column->value_default) ? $column->value_default : null;
        $column->nullValid = isset($column->nullValid) ? $column->nullValid : true;
        $column->required = ($column->auto_increment == true) ? false : true;
        $column->required = ($column->nullValid == true) ? false : true;

        $column->value = ($column->nullValid == true) ? $column->value_default : $this->get_value_default_sql($column->type, $column->value_default);
        $column->value = (strip_tags($column->value) == strip_tags("CURRENT_TIMESTAMP")) ? date("Y-m-d H:i:s") : $column->value;

        return $column;
    }

    public function get_value_default_sql($type="varchar", $default=null){
        /*"boolean" o "bool"
            "integer" o "int"
            "float" o "double"
            "string"
            "array"
            "object"
            "null"*/

        switch ($type) {
            case 'varchar':
                return strip_tags($default);
                break;
            case 'text':
                return is_string($default) ? strip_tags($default) : $default;
                break;
            case 'int':
                return (int) $default;
                break;
            case 'datetime':
                return (string) $default;
                break;
            default:
                return is_string($default) ? strip_tags($default) : $default;
                break;
        }
    }
    
    public function getConetar(){ return $this->conectar; }
    
    public function db(){ return $this->db; }
    
    public function getAll(){
        $sql = "SELECT * FROM `{$this->table}` ORDER BY id DESC";
        return $this->FetchAllObject($sql, []);
    }
    
    public function getById($id){
        $sql = "SELECT * FROM `{$this->table}` WHERE `id`={$id} ORDER BY id DESC";
        return $this->FetchAllObject($sql, []);
    }
    
    public function getBy($column,$value){
        $sql = "SELECT * FROM `{$this->table}` WHERE `{$column}`=? ORDER BY id DESC";
        return $this->FetchAllObject($sql, [$value]);
    }
	
    public function getSQL($sql, $values = []){
        return $this->FetchAllObject($sql, $values);
    }

    public function FetchAllObject($sql, $params = []){
        try {
            $query = $this->db->prepare($sql);
            $query->execute($params);
            $result = $query->fetchAll(PDO::FETCH_OBJ);
            return $result;
        }
        catch(Exception $e){
            echo "<b>Error:</b> ".($e->getMessage() . " [SQL-FRONT]: $sql");
            return [];
        }
    }
    
    public function deleteById($id){
        $sql = "DELETE FROM $this->table WHERE id=$id";
        return $this->FetchAllObject($sql, []);
        #$query=$this->db->query("DELETE FROM $this->table WHERE id=$id"); 
        #return $query;
    }
    
    public function deleteBy($column,$value){
        $sql = "DELETE FROM $this->table WHERE $column='$value'";
        return $this->FetchAllObject($sql, [$value]);
        #$query=$this->db->query("DELETE FROM $this->table WHERE $column='$value'"); 
        #return $query;
    }
	
	public function getTableUse(){
		return $this->table;
	}
    
	public function set($key, $value){
		$this->{$key} = $value;
	}
	
	public function setAll($array = []){
		if(isset($array[0])){
			foreach($array[0] as $k => $v){
				$this->set($k, $v);
			}
		}
		return $this;
	}
	
    /*
     * Aqui podemos montarnos un monton de métodos que nos ayuden
     * a hacer operaciones con la base de datos de la entidad
     */
	
	public function getInsert($sql = "", $values = []){
		$query = $this->db()->prepare($sql);
		try {
			$success = $query->execute($values);
			$id = (int) $this->db()->lastInsertId();
			return ($id > 0) ? $id : 0;
		}catch (Exception $e){
			//throw $e;
			#echo "\n {$sql} \n";
			echo $e->getMessage();
			return 0;
		}
	}
}
?>

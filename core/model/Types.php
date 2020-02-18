<?php 
/* *******************************
 *
 * Developer by FelipheGomez
 *
 * ******************************/

class Types extends ModeloBase{
	public function __construct($adapter, $table = null) {
        if($table !== null){
			parent::__construct($table, $adapter);
		}
    }

	public static function OptionsForm($adapter = null, $table = null, $keyAndValue = []){
		$types = new Types($adapter, $table);
		$options_it = ["" => "Seleccione una opcion..."];
		foreach(array_reverse($types->getAll()) as $it){
			$it = is_array($it) ? (object) $it : $it;
			$key = (is_array($keyAndValue) && isset($keyAndValue['key'])) ? (isset($it->{$keyAndValue['key']}) ? $keyAndValue['key'] : "id") : "id";
			$label = (is_array($keyAndValue) && isset($keyAndValue['label'])) ? (
				isset($it->{$keyAndValue['label']}) ? $it->{$keyAndValue['label']} : ((!isset($it->code)) ? (!isset($it->name) ? $it->id : $it->name) : "{$it->code} - {$it->name}")
			) : (
				(!isset($it->code)) ? (!isset($it->name) ? $it->id : $it->name) : "{$it->code} - {$it->name}"
			);

			$options_it[$it->{$key}] = $label;
		}
		return $options_it;
	}
}
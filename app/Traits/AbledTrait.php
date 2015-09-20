<?php

trait AbledTrait{

	private $config = [
		'bank'            => "whoable",
	];

	public function abled($key=null){
		if(is_null($key))
			$key = $this->modelName();

		$type = $this->config[$key]."_type";
		$id = $this->config[$key]."_id";
		$obj = new $this->$type();
		// if($obj instanceof Sales){
		// 	return $obj->whereUserId($this->$id)->first();
		// }
		return $obj->find($this->$id);

	}

}
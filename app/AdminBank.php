<?php namespace App;
use App\Perecdent;

class AdminBank extends Perecdent
{
	public static function add(Bank $bank, $name, $account, $address='')
   	{
   		return self::saveData([
   			'status' 	=> 1,
   			'bank_id' 	=> $bank->id,
   			'bank_name' => $bank->name,
   			'address' 	=> $address,
   			'name' 		=> $name,
   			'account' 	=> $account
   		]);
   	}

   	public function toggleStatus()
   	{
   		if (!in_array($this->status, [0, 1])) {
   			return false;
   		}

   		$status = $this->status ? 0 : 1;

   		$this->status = $status;
   		return $this->save();
   	}    
}

<?php 
/* *******************************
 *
 * Developer by FelipheGomez
 *
 * ******************************/

class UsuarioMails extends ModeloBase{
	public $boxes = [];
	
	public function __construct($adapter) {
        $table="emails_users";
        parent::__construct($table, $adapter);
    }
	
	public function __sleep(){
		return ['boxes'];
	}
	
	public function __toString(){
		return json_encode($this->boxes);
	}
	
	public function getByUser($user){
		$rows = parent::getBy('user', $user);
		foreach($rows as $item){
			if(isset($item->email) && $item->email > 0){
				$email = new EmailBox($this->adapter);
				$email->getById($item->email);
				if(isset($email->id)){
					if(is_object($email)){ $email->send_enabled = $item->send_enabled; }
					if(is_array($email)){ $email['send_enabled'] = $item->send_enabled; }
					
					$this->boxes[] = $email;
				}
			}
		}
		return $this->setAll([['boxes' => $this->boxes]]);
	}
	
	public function getById($id){
		$rows = parent::getById($id);
		foreach($rows as $item){
			if(isset($item->email) && $item->email > 0){
				$email = new EmailBox($this->adapter);
				$email->getById($item->email);
				if(isset($email->id)){
					/*
					$this->boxes[] = [
						'label' 	=> $email->label,
						'enable'	=> $email->actived == 1 ? true : false,
						'mailbox' 	=> "{{$email->host}:{$email->port}{$email->args_add}}INBOX",
						'username' 	=> "{$email->user}",
						'password' 	=> "{$email->pass}"
					];
					*/
					$this->boxes[] = $email;
				}
			}
		}
		return $this->setAll([['boxes' => $this->boxes]]);
	}
}
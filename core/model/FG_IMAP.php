<?php 

/* *******************************
 *
 *
 * Developer by FelipheGomez
 *
 * ******************************/

// Funciones para correo electronico
function getBody($uid, $imap){
	$body = get_part($imap, $uid, "TEXT/HTML");
	// if HTML body is empty, try getting text body
	if ($body == "") {
		$body = get_part($imap, $uid, "TEXT/PLAIN");
	}
	return $body;
}

function get_part($imap, $uid, $mimetype, $structure = false, $partNumber = false){
	if (!$structure) {
		$structure = imap_fetchstructure($imap, $uid, FT_UID);
	}
	if ($structure) {
		if ($mimetype == get_mime_type($structure)) {
			if (!$partNumber) {
				$partNumber = 1;
			}
			$text = imap_fetchbody($imap, $uid, $partNumber, FT_UID);
			switch ($structure->encoding) {
				case 3:
					return imap_base64($text);
				case 4:
					return imap_qprint($text);
				default:
					return $text;
			}
		}

		// multipart
		if ($structure->type == 1) {
			foreach ($structure->parts as $index => $subStruct) {
				$prefix = "";
				if ($partNumber) {
					$prefix = $partNumber . ".";
				}
				$data = get_part($imap, $uid, $mimetype, $subStruct, $prefix . ($index + 1));
				if ($data) {
					return $data;
				}
			}
		}
	}
	return false;
}

function get_mime_type($structure){
	$primaryMimetype = ["TEXT", "MULTIPART", "MESSAGE", "APPLICATION", "AUDIO", "IMAGE", "VIDEO", "OTHER"];

	if ($structure->subtype) {
		return $primaryMimetype[(int)$structure->type] . "/" . $structure->subtype;
	}
	return "TEXT/PLAIN";
}

if(!function_exists("randomString")) {
	function randomString($length = 16, $origin_str = "") {
		$str = "";
		$chars = "-_0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
		for ($i = 0; $i < $length; $i++) {
			$str .= $chars[mt_rand(0, strlen($chars) - 1)];
		}
		return "{$str}-{$origin_str}";
	}
}




class FG_IMAP extends EntidadBase{
	private $is_valid = false;
	private $parameters;
	private $host;
	private $imap;
	
	public function __construct($parameters = null, $adapter = null){
		if($parameters !== null && $adapter !== null){
			$parameters->host = isset($parameters->host) ? $parameters->host : (isset($parameters->mailbox) ? $parameters->mailbox : null);
			$this->adapter = $adapter;
			$table = "emails";
			parent::__construct($table, $adapter);
			$this->parameters = $parameters;
			$parameters = is_array($parameters) ? (object) $parameters : $parameters;
			$this->host = "{{$parameters->host}:{$parameters->port}/imap{$parameters->args_add}}";
			$this->imap = @imap_open($this->host, $parameters->user, $parameters->pass
				#, NULL, 1, ['DISABLE_AUTHENTICATOR' => 'PLAIN']
			);
			if($this->imap !== false){ $this->is_valid = true; }
		}
	}
	
	public function getConn(){
		return $this->imap;
	}
	
	public function isValid() {
		return $this->is_valid;
	}
	
	public static function decodeMimeStr($string, $charset = "UTF-8"){
		$newString = '';
		$elements=imap_mime_header_decode($string);
		for($i=0;$i<count($elements);$i++){
			// if ($elements[$i]->charset == 'default') $elements[$i]->charset = 'iso-8859-1';
			if ($elements[$i]->charset == 'default'){
				$elements[$i]->charset = 'iso-8859-1';
				$elements[$i]->charset = 'Windows-1252';
			}
			$newString .= @iconv($elements[$i]->charset, $charset, $elements[$i]->text);
		}
		return ($newString);
	}
	
	/*
		# $emails = $complete = false ? imap_search($inbox, 'SINCE '. date('d-M-Y',strtotime("-1 hour"))) : @imap_search($inbox, 'ALL');
		# $emails = @imap_search($inbox, 'SINCE '. date('d-M-Y',strtotime("-1 hour")));
		# $emails = @imap_search($inbox, 'SINCE '. date('d-M-Y',strtotime("-1 week")));
		# $emails = @imap_search($inbox, 'UNSEEN');
		# $emails = @imap_search($inbox, 'SINCE '. date('d-M-Y',strtotime("-1 hour")));
	*/
	public function searchBy($search = 'INBOX'){
		$mails = [];
		$emails = @imap_search($this->imap, $search);
		if ($emails !== false && count($emails) > 0) {
			rsort($emails);
			foreach($emails as $i){
				$mails[] = $i;
			};
		}
		return $mails;
	}
	
	public function checkIMAP(){
		return @imap_check($this->imap);
	}
	
	public function getAttachments($email = 0){
		$day = date("d");
		$mouth = date("m");
		$year = date("Y");
		$structure = imap_fetchstructure($this->getConn(), $email);
		$files = [];
		$attachments = [];
		$structure->parts = !isset($structure->parts) ? [] : $structure->parts;
		if(count($structure->parts) == 0){
			$structure->parts[] = $structure;
		}
		
		if( isset($structure->parts) && count($structure->parts) ) {
			for($i = 0; $i < count($structure->parts); $i++) {
				$attachment = [
					'id' => $structure->parts[$i]->ifid == 1 ? $structure->parts[$i]->id : "none",
					'size' => !isset($structure->parts[$i]->bytes) ? 0 : $structure->parts[$i]->bytes,
					'type' => $structure->parts[$i]->subtype,
					'is_attachment' => false,
					'filename' => '',
					'name' => '',
					'attachment' => ''
				];
				if($structure->parts[$i]->ifdparameters) {
					foreach($structure->parts[$i]->dparameters as $object) {
						if(strtolower($object->attribute) == 'filename') {
							$attachment['is_attachment'] = true;
							$attachment['filename'] = ($object->value); //FG_IMAP::decodeMimeStr
							$attachment['charset'] = ($object->value);
						}
					}
				}
				if($structure->parts[$i]->ifparameters) {
					foreach($structure->parts[$i]->parameters as $object) {
						if(strtolower($object->attribute) == 'name') {
							$attachment['is_attachment'] = true;
							$attachment['name'] = ($object->value);
							$attachment['charset'] = ($object->value);
						} 
						else if(strtolower($object->attribute) == 'charset') {
						}
					}
				}
				
				if($attachment['is_attachment']) {
					$attachment['attachment'] = @imap_fetchbody($this->getConn(), $email, $i+1, FT_PEEK); 
					// 3 = BASE64 encoding
					if($structure->parts[$i]->encoding == 3) {
						$attachment['attachment'] = @base64_decode($attachment['attachment']);
					}
					// 4 = QUOTED-PRINTABLE encoding // imap_qprint
					elseif($structure->parts[$i]->encoding == 4) {
						$attachment['attachment'] = @quoted_printable_decode($attachment['attachment']);
					}
					
					
					if($attachment['attachment'] !== false && $attachment['attachment'] !== null){
						$files[] = $attachment;
					}
				}
			}
		}
		
			
		foreach($files as $attachment){
			$attachment['id'] = str_replace(["<", ">"], "", $attachment['id']);			
			$name = isset($attachment['name']) && $attachment['name'] !== "" ? ($attachment['name']) : null;
			$filename = isset($attachment['filename']) && $attachment['filename'] !== "" ? ($attachment['filename']) : null;
			$name = ($name !== null) ? FG_IMAP::decodeMimeStr($name) : ($filename !== null) ? FG_IMAP::decodeMimeStr($filename) : FG_IMAP::randomString();
			$filename = ($filename);
			$name = !isset($name) || $name == null ? ($filename !== null) ? $filename : randomString() : $name;
			
			
			$folderSrv = (dirname(__DIR__)) . "/public/attachments/{$this->parameters->host}/{$this->parameters->user}/{$year}-{$mouth}-{$day}/{$email}/";
			$folderPub = "/public/attachments/{$this->parameters->host}/{$this->parameters->user}/{$year}-{$mouth}-{$day}/{$email}/";
			$path_srv = $folderSrv . $name;
			$path_pub = $folderPub . $name;
			
			if (!is_dir(dirname($path_srv))) {
				mkdir(dirname($path_srv), 0755, true);
			}
			
			if(is_dir($path_srv) || $name == "" ){
				echo "- - - Error - - - \n";
				echo json_encode($filename)." \n";
				echo json_encode($name)." \n";
				echo "{$path_srv} \n";
				echo "- - - /Error - - - \n";
			}else{
				if (!file_exists($path_srv)) {
					$fp = fopen($path_srv, "w+");
					fwrite($fp, $attachment['attachment']);
					fclose($fp);
				}
				
				$dataFile = [
					"name" => $name,
					"filename" => $filename,
					"targetFile" => $attachment['id'],
					"targetPath" => $path_srv,
					"path_short" => $path_pub,
					"filesize" => $attachment['size'],
					"filetype" => $attachment['type'],
				];
				// Adjunto
				if (file_exists($path_srv)) {
					$fileBase = new Attachments($this->adapter);
					$idFile = $fileBase->crear($dataFile);
					if ($idFile > 0){
						$dataFile['id'] = $idFile;
						$attachments[] = $dataFile;
					}
				}
			}
		}
		return $attachments;
		#return ["attachments" => $attachments, "structure" => $structure];
	}
	
	public function getOverview($sequence = 0, $options = 0){
		$r = [];
		$r['to'] = [];
		//$MC = $this->checkIMAP();
		$overview = @imap_fetch_overview($this->getConn(), $sequence, 0);
		$size = sizeof($overview);
		for($i = $size-1; $i>=0; $i--){
			$val = $overview[$i];
			foreach($val as $k => $v){
				$v = FG_IMAP::decodeMimeStr($v);
				// $r["{$k}_email"] = $v;
				if($k === 'message_id'){
					preg_match('/[a-z\d._%+-]+@[a-z\d.-]+\.[a-z]{2,4}\b/i', $v, $b);
					$v = !isset($b[0]) ? $v : $b[0];
				} 
				else if($k === 'from'){
					// $r["{$k}_email"] = $v;
					$original_email = $v;
					preg_match('/[a-z\d._%+-]+@[a-z\d.-]+\.[a-z]{2,4}\b/i', $v, $b);
					$b[0] = !isset($b[0]) ? $v : $b[0];
					$label = str_replace([" <{$b[0]}>", "<{$b[0]}>", "{$b[0]}"], "", $v);
					preg_match_all('/[a-z0-9_\-\+\.]+@[a-z0-9\-]+\.([a-z]{2,4})(?:\.[a-z]{2})?/i', $b[0], $matches);
					$address_mail = ($matches[0]);
					$r["{$k}_email"] = (isset($address_mail[0])) ? $address_mail[0] : $k;
					$v = isset($label) ? $label : "";
				} else if($k === 'udate'){
				} else if($k === 'to'){
					$original_email = $v;
					preg_match('/[a-z\d._%+-]+@[a-z\d.-]+\.[a-z]{2,4}\b/i', $v, $b);
					$b[0] = !isset($b[0]) ? $v : $b[0];
					$label = str_replace([" <{$b[0]}>", "<{$b[0]}>", "{$b[0]}"], "", $v);
					preg_match_all('/[a-z0-9_\-\+\.]+@[a-z0-9\-]+\.([a-z]{2,4})(?:\.[a-z]{2})?/i', $b[0], $matches);
					$address_mail = ($matches[0]);
					$r['to'][] = (object) ['label' => $label, 'address_mail' => $address_mail[0]];
				} else if($k === 'subject'){
				} else if($k === 'date'){
					//$v = date("Y-m-d H:i:s", $v);
				} else if($k === 'size' || $k === 'uid' || $k === 'msgno'){
					$v = (int) $v;
				} else if($k === 'recent' || $k === 'new' || $k === 'seen' || $k === 'flagged' || $k === 'answered' || $k === 'deleted' || $k === 'draft' || $k === 'deleted'){
					#$v = (!isset($v) || empty($v) || $v == 0) ? 0 : ($v === true || $v === 1 || $v == 'true') ? 1 : 0;
				} else {
				}
				if($k !== 'to'){
					$r[$k] = $v;
				}				
			}
		}
		return $r;
	}
	
	public function getMail($sequence = 0, $options = 0){
		$Overview = (object) $this->getOverview($sequence, $options);
		$Attachments = $this->getAttachments($sequence);
		
		$replaces = [];
		$replaces_to = [];
		$attachments_finish = [];
		foreach($Attachments as $attachment){
			$attachment = is_array($attachment) ? (object) $attachment : $attachment;
			#echo ($attachment->path_short)."\n";
			$replaces[] = "{$attachment->targetFile}";
			$replaces_to[] = $attachment->path_short;
			
			$replaces[] = "cid:{$attachment->targetFile}";
			$replaces_to[] = $attachment->path_short;
			
			if(isset($attachment->name)){
				$replaces[] = "{$attachment->name}";
				$replaces_to[] = $attachment->path_short;
			}
			if(isset($attachment->filename)){
				$replaces[] = "{$attachment->filename}";
				$replaces_to[] = $attachment->path_short;
			}
			
			if($attachment->id > 0){
				$attachments_finish[] = $attachment;
			}
		}
		
		$Message = getBody($Overview->uid, $this->getConn());
		$Message = str_replace($replaces, $replaces_to, $Message);
		$Message = ($Message);
		if($Message == ""){
			$Message = $this->getBody($sequence);
		}
		
		$mailInsert = [
			"box" => $this->parameters->id,
			"message_id" => ($Overview->message_id),
			"uid" => $Overview->uid,
			"status" => $Overview->seen ? 'read' : 'unread',
			"subject" => $Overview->subject,
			"from" => isset($Overview->from) ? $Overview->from : "Anon",
			"from_email" => isset($Overview->from_email) ? $Overview->from_email : "Anon",
			"to" => $Overview->to,
			"date" => $Overview->date,
			#"message" => (utf8_encode($Message)),
			"message" => mb_convert_encoding(utf8_decode($Message), 'UTF-8', 'Windows-1252'),
			#"message" => mb_convert_encoding($string, 'UTF-8', 'Windows-1254'),
			"size" => $Overview->size,
			"msgno" => $Overview->msgno,
			"recent" => $Overview->recent,
			"flagged" => $Overview->flagged,
			"answered" => $Overview->answered,
			"deleted" => $Overview->deleted,
			"seen" => $Overview->seen,
			"draft" => $Overview->draft,
			"attachments" => $attachments_finish
		];
		
		$creaMail = new Email($this->adapter);
		$idMailSQL = $creaMail->crear($mailInsert);
		$mailInsert['id'] = $idMailSQL;
		
		foreach($attachments_finish as $attachment){
			$attachment = is_array($attachment) ? (object) $attachment : $attachment;
			// Agregar Attachements al Email
			$requests_media = new EmailAttachments($this->adapter);
			$AttachementInEmail = $requests_media->crear([
			  'email' => $mailInsert['id'],
			  'attachment' => $attachment->id
			]);
		}
		return (object) $mailInsert;
	}

	public static function randomString($length = 16, $origin_str = "") {
		$str = "";
		$chars = "-_0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
		for ($i = 0; $i < $length; $i++) {
			$str .= $chars[mt_rand(0, strlen($chars) - 1)];
		}
		return "{$str}-{$origin_str}";
	}
	
	public function get_mime_type($structure){
		$primaryMimetype = ["TEXT", "MULTIPART", "MESSAGE", "APPLICATION", "AUDIO", "IMAGE", "VIDEO", "OTHER"];
		if ($structure->subtype) {
			return $primaryMimetype[(int)$structure->type] . "/" . $structure->subtype;
		}
		return "TEXT/PLAIN";
	}
	
	public function get_part($sequence, $mimetype, $structure = false, $partNumber = false){
		if (!$structure) {
			$structure = imap_fetchstructure($this->getConn(), $sequence);
		}
		
		if ($structure) {
			if ($mimetype == $this->get_mime_type($structure)) {
				if (!$partNumber) {
					$partNumber = 1;
				}
				$text = imap_fetchbody($this->getConn(), $sequence, $partNumber, FT_PEEK);
				
				switch ($structure->encoding) {
					case 3:
						return imap_base64($text);
					case 4:
						return imap_qprint($text);
					default:
						return FG_IMAP::decodeMimeStr($text);
				}
			}

			// multipart
			if ($structure->type == 1) {
				foreach ($structure->parts as $index => $subStruct) {
					$prefix = "";
					if ($partNumber) {
						$prefix = $partNumber . ".";
					}
					$data = $this->get_part($sequence, $mimetype, $subStruct, $prefix . ($index + 1));
					if ($data) {
						return ($data);
					}
				}
			}
		}
		return false;
	}
	
	public static function decodeVal($string) {
		$tabChaine=imap_mime_header_decode($string);
		$texte='';
		for ($i=0; $i<count($tabChaine); $i++) {
			switch (strtoupper($tabChaine[$i]->charset)) { //convert charset to uppercase
				case 'UTF-8': $texte.= $tabChaine[$i]->text; //utf8 is ok
					break;
				case 'DEFAULT': $texte.= $tabChaine[$i]->text; //no convert
					break;
				default: if (in_array(strtoupper($tabChaine[$i]->charset),$this->upperListEncode())) //found in mb_list_encodings()
							{$texte.= mb_convert_encoding($tabChaine[$i]->text,'UTF-8',$tabChaine[$i]->charset);}
						 else { //try to convert with iconv()
							  $ret = iconv($tabChaine[$i]->charset, "UTF-8", $tabChaine[$i]->text);    
							  if (!$ret) $texte.=$tabChaine[$i]->text;  //an error occurs (unknown charset) 
							  else $texte.=$ret;
							}                    
					break;
				}
		}
			
		return $texte;    
	}
	
	public function getBodyPart($sequence = 0){
		//$message = imap_fetchbody($this->getConn(), $sequence, 1, FT_PEEK);
		//return FG_IMAP::decodeMimeStr($message);
		$body = ($this->get_part($sequence, "TEXT/HTML"));
		// if HTML body is empty, try getting text body
		if ($body == "") {
			$body = $this->get_part($sequence, "TEXT/PLAIN");
		}
		return ($body);
	}
	
	public function getBody($sequence = 0){
		$message = $this->getBodyPart($sequence);
		if(trim($message) == ''){
			$message = imap_fetchbody($this->getConn(), $sequence, '1.2', FT_PEEK);
			if ( trim($message) == '' ){ $message = imap_fetchbody($this->getConn(), $sequence, 2, FT_PEEK); $message = FG_IMAP::decodeMimeStr($message); }
			if ( trim($message) == '' ){ $message = imap_fetchbody($this->getConn(), $sequence, 1, FT_PEEK); $message = FG_IMAP::decodeMimeStr($message); }
		}
		return htmlspecialchars_decode(htmlspecialchars($message));
	}
	

	/*
	$folders = imap_list($imap, $host, "*");
	foreach ($folders as $folder) {
		$folder = str_replace($host, "", imap_utf7_decode($folder));
		echo '<li><a href="mail.php?folder=' . $folder . '&func=view">' . $folder . '</a></li>';
	}
	*/
}


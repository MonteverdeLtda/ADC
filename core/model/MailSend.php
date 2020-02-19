<?php 
/* *******************************
 *
 * Developer by FelipheGomez
 *
 * ******************************/
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class MailSend {
	private $mail;
	public $from_mail = MAIL_DEFAULT_FROM_EMAIL;
	public $from_name = MAIL_DEFAULT_FROM_NAME;
	public $to = [];
	public $reply_mail = MAIL_DEFAULT_REPLY_EMAIL;
	public $reply_name = MAIL_DEFAULT_REPLY_NAME;
	public $subject = MAIL_DEFAULT_SUBJECT;
	public $message = MAIL_DEFAULT_MESSAGE;
	public $MessageID = null;
	public $isHtml = false;
	public $attachments = [];
	
	public function __construct(){
	}
	
	public function addAttachments($files = false){
		if($files !== false){
			if(is_array($files)){
				foreach($files as $file){
					$this->attachments[] = $file;
				}
			} else {
				$this->attachments[] = $files;
			}
		}
	}
	
	public function setHtml($isHtml = false){
		$this->isHtml = $isHtml;
	}
	
	public function setFrom($from_email = null, $from_name = null){
		$this->from_mail = ($from_email !== null && FelipheGomez\verifyEmail::validate($from_email)) ? $from_email : MAIL_DEFAULT_FROM_EMAIL;
		$this->from_name = ($from_name !== null) ? $from_name : MAIL_DEFAULT_FROM_NAME;
	}
	
	public function setMessage($message = null){
		if($message !== null){
			$this->message = ($message);
		}
	}
	
	public function setSubject($subject = null){
		if($subject !== null){
			$this->subject = utf8_decode($subject);
		}
	}
	
	public function set($key = null, $value){
		if($key !== null && $value !== null){
			$this->{$key} = utf8_decode($value);
		}
	}
	
	public function addTo($email = null, $name = null){
		if($email !== null){
			$name = ($name !== null) ? $name : $email;
			$this->to[] = (object) ["email" => $email, "name" => utf8_decode($name)];
		}
	}
	
	public function setReply($email = null, $name = null){
		if($email !== null){
			$name = ($name !== null) ? $name : $email;
			$this->reply_mail = $email;
			$this->reply_name = utf8_decode($name);
		}
	}
	
	function removeElementsByTagName($tagName, $document) {
	  $nodeList = $document->getElementsByTagName($tagName);
	  for ($nodeIdx = $nodeList->length; --$nodeIdx >= 0; ) {
		$node = $nodeList->item($nodeIdx);
		$node->parentNode->removeChild($node);
	  }
	}
	
	public function sendMail(){
		$this->mail = new PHPMailer(true);
		try {
			//Server settings
			//$this->mail->SMTPDebug = 2;                   // Enable verbose debug output
			$this->mail->isSMTP();                         // Set mailer to use SMTP
			$this->mail->Host        = MAIL_SERVER_HOST;          // Specify main and backup SMTP servers
			$this->mail->SMTPAuth    = MAIL_SERVER_SMTPAuth;      // Enable SMTP authentication
			$this->mail->SMTPAutoTLS = MAIL_SERVER_SMTPAutoTLS;
			$this->mail->Username    = MAIL_SERVER_USER;      // SMTP username
			$this->mail->Password    = MAIL_SERVER_PASS;      // SMTP password
			$this->mail->SMTPSecure  = MAIL_SERVER_SMTPSecure;    // Enable TLS encryption, `ssl` also accepted
			$this->mail->Port        = MAIL_SERVER_PORT;          // TCP port to connect to
			$this->mail->AddCustomHeader(
				"List-Unsubscribe:", 
				MAIL_DEFAULT_LIST_UNSUBSCRIBE
			);
			
			//Recipients
			$this->mail->setFrom($this->from_mail, $this->from_name);
			foreach($this->to as $to){
				$this->mail->addAddress($to->email, $to->name);     // Add a recipient
			}
			$this->mail->addReplyTo($this->reply_mail, $this->reply_name);
			# $this->mail->addCC('cc@example.com');
			if(MAIL_DEFAULT_BCC !== false && MAIL_DEFAULT_BCC !== null){ $this->mail->addBCC(MAIL_DEFAULT_BCC); } // Copia de respaldo de envíos

			// Attachments
			foreach($this->attachments as $fileAttach){
				$this->mail->addAttachment($fileAttach);					// Add attachments
				# $this->mail->addAttachment('/tmp/image.jpg', 'new.jpg');	// Optional name
			}

			// Content
			$this->mail->isHTML($this->isHtml);                                  // Set email format to HTML
			$this->mail->Subject = $this->subject;
			$this->mail->Body    = $this->message;
			$this->mail->AltBody = strip_tags($this->message);
			$this->mail->send();
			$this->MessageID = $this->mail->getLastMessageID();
			return true;
		} catch (Exception $e) {
			return false;
		}
	}
}
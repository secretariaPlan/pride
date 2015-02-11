<?php
//para manejar el envio de correos mas eficientemente
//Pendientes: Q el correo pueda enviar html, que el subject se guarde en un arreglo


class cMail {
var $to,$subject,$message,$coma,$sheader,$sNewline;

function cMail($sNewline = "") {
	$this->message = "";
	//$this->to[] = "jalpizar@nyeomicron.com.mx";
	$this->coma = ", ";
	if ($sNewline == "HTML") {
		$this->sheader  = "MIME-Version: 1.0\r\n";
		$this->sheader .= "Content-type: text/html; charset=iso-8859-1\r\n";
		$this->sNewline = "<br>";
	}
	//$this->sheader .= "From: sistemas@educapsc.com \r\n";


}

function To($to){
	$this->to[] = $to;
}

function Subject($subject){
	$this->subject = $subject;
}

function Message($message){
	$this->message .= $message."\n ";
}

function Header_($header) {
$this->sheader .= $header; 
}

function From($from) {
$this->sheader .= "From: ".$from."\r\n";
}

function Send() {
	$aTo = $this->to;
	foreach($aTo as $valor) {
		$sTo = $valor;
		//eregi("^[_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,3}$",$sTo);
		ereg_replace("\n", "", $sTo); 
		//echo "xx"; echo $sTo; echo "yy<br>";
		mail($sTo, $this->subject, $this->message, $this->sheader);
	}
}

function getMessage(){
	return $this->message;
}

}
?>

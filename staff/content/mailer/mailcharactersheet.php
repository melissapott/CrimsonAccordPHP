<?php
include_once $_SERVER['DOCUMENT_ROOT']."/includes/db_connect.php";
require_once 'PHPMailerAutoload.php';

//find out which game number we're processing and get the calendar information
$game_number = $_GET[game_number];
$sql = "SELECT * FROM calendar WHERE game_number = " . $game_number;
$result = $mysqli->query($sql);
$calendar = $result->fetch_assoc();


		//begin PHPMailer code
	$results_messages = array();

	require_once 'PHPMailerAutoload.php';
	$mail = new PHPMailer(true);
	$mail->CharSet = 'utf-8';
	ini_set('default_charset', 'UTF-8');

	class phpmailerAppException extends phpmailerException {}

	$mail->isSMTP();
	$mail->SMTPDebug  = 0;
	$mail->Host       = "mail.dreamhost.com";
	//$mail->Host = gethostbyname('tls://smtp.crimsonaccord.com');
	$mail->Port       = "25";
	$mail->SMTPSecure = "none";
	$mail->SMTPAuth   = true;
	$mail->Username   = "website@crimsonaccord.com";
	$mail->Password   = "566N-VQy";
	$mail->addReplyTo("website@crimsonaccord.com", "website");
	$mail->setFrom("website@crimsonaccord.com", "website");


//get a list of all characters to loop through
// $sql = "SELECT c.*, p.email, p.username, p.testemail FROM `character` c JOIN players p on c.player_id = p.id";
// $result = $mysqli->query($sql);

//get the character sheets from the database and loop through them
$sql = "SELECT s.*, c.*, p.* FROM `character_sheets` s JOIN `character` c on s.char_id = c.id JOIN players p on p.id = c.player_id WHERE game_number = " . $game_number;

$narrative = $mysqli->query($sql);

while($row=$narrative->fetch_assoc()){

	set_time_limit(30);
	$mail->addAddress($row["testemail"], $row["username"]);
	$mail->Subject  = "Crimson Accord Game #" . $game_number;

	$body = $row["username"] . ",\nGame packet files for " . $row["char_name"] . " are attached.\n";
	$body = $body . "We hope to see you on " . $calendar["game_date"] . " at " . $calendar["location"];
	$body = $body . " for the next game.\nRegards,\nThe Crimson Accord Staff";
	$body = nl2br($body); //process the new line characters
	$mail->WordWrap = 78;
	$mail->msgHTML($body, dirname(__FILE__), true); //Create message bodies and embed images
	//$mail->addAttachment('images/phpmailer_mini.png','phpmailer_mini.png');  // optional name
	//$mail->addAttachment('images/phpmailer.png', 'phpmailer.png');  // optional name




	$mail->AddStringAttachment($string=$row['content'],$filename=$row['file_name'],$encoding='base64',$type=$row['type']);



	if(!$mail->Send()) {
		echo "Mailer Error (" . str_replace("@", "&#64;", $row["email"]) . ') ' . $mail->ErrorInfo . '<br>';
		$logmes = "Mailer Error (" . str_replace("@", "&#64;", $row["email"]) . ') ' . $mail->ErrorInfo . '<br>';
	} else {
		echo "Message sent to: " . $row["username"] . ' (' . str_replace("@", "&#64;",$row["email"]) . ')<br>';
		$logmes = "Message sent to: " . $row["username"] . ' (' . str_replace("@", "&#64;",$row["email"]) . ')<br>';
	}

	//write to the log table
	$sql = $mysqli->prepare ("INSERT INTO mail_log (calendar_id, player_id, message) VALUES (?,?,?)");
	$sql->bind_param("sss", $game_number, $row["player_id"], $logmes);
	$sql->execute();
	$mail->ClearAddresses();
	$mail->ClearAttachments();
}
?>

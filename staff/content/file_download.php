<?php
include_once $_SERVER['DOCUMENT_ROOT']."/includes/file_functions.php"; 


$sql = "SELECT file_name, type, size, content FROM " . $_GET["file"] .  " WHERE id = " . $_GET["id"];
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {

	$row=$result->fetch_assoc();
	
	$size=$row["size"];
	$type=$row["type"];
	$name=$row["file_name"];

	header("Content-type: " . $type . "\"");
	header('Content-Transfer-Encoding: binary');
	header('Content-Description: File Transfer');
	header("Content-length: ". $size);
	header("Content-Disposition: inline; filename=".$name); 
	echo $row["content"];
}

exit;

?>




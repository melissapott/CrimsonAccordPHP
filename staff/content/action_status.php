<?php
$sql = "SELECT * FROM status_messages WHERE status_name='" . $_GET['status'] . "'";
$result = $mysqli->query($sql);
if ($result->num_rows > 0){
	$row=$result->fetch_assoc();
	echo "<h2>" . $row['status_message'] . "</h2>";
}


?>
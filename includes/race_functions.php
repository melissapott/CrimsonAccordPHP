<?php
include_once 'db_connect.php';

if (isset($_POST["activity"])){
	if($_POST["activity"]==='add'){
		race_add($_POST["racename"], $mysqli);
	}
	if($_POST["activity"] === 'edit'){
		race_edit($_POST["id"], $_POST["racename"], $mysqli);
	}
	if($_POST["activity"]==='delete'){
		race_delete($_POST["id"], $mysqli);
	}

}

function race_status($status){
	
	header('Location: ../staff/index.php?page=action_status.php&status=' . $status);

}

function race_delete($id, $mysqli){
	$sql = $mysqli->prepare ("DELETE FROM races WHERE id=?");
	$sql->bind_param("i", $id);
	
	if($sql->execute() === TRUE){
		race_status("deleteok");
	} else {
		race_status("deleteerror");
	}
}

function race_edit($id, $racename, $mysqli){
	$sql = $mysqli->prepare ("UPDATE races SET race_name = ? WHERE id = ?");
	$sql->bind_param("si", $racename, $id);
	
	if ($sql->execute() === TRUE) {
		race_status("editok");
	} else {
		race_status("error");
	}
}
function race_add($race, $mysqli){
	if($race === ""){
		race_status("missing");
	} else {
		$sql = $mysqli->prepare ("INSERT INTO races (race_name) VALUES (?)");
		$sql->bind_param("s", $race);
	
		if ($sql->execute() === TRUE) {
			race_status("addok"); 
    
		} else {
			race_status("error");
		}
	}
}

function list_races($mysqli){
	$sql="SELECT * FROM races";
	$result = $mysqli->query($sql);
	
	if($result->num_rows >0){
		echo "<table class=\"table\"> <thead> <tr> <th>Race</th> <th>Edit</th> <th>Delete</th></tr> </thead> <tbody>";
		while($row=$result->fetch_assoc()){
			echo "<tr><td>" . $row["race_name"] . "</td>";
			echo "<td><a href=\"index.php?page=race_edit.html&id=" . $row["id"] . "\"><span class=\"glyphicon glyphicon-edit\"></span></a></td>";
			echo "<td><a href=\"index.php?page=race_delete.html&id=" . $row["id"] . "\"><span class=\"glyphicon glyphicon-trash\"></span></a></td>";
		}
		echo "</table>";
	}

}
?>
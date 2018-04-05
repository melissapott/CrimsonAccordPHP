<?php
include_once 'db_connect.php';

if (isset($_POST["activity"])){
	if($_POST["activity"]==='add'){
		faction_add($_POST["factionname"], $mysqli);
	}
	if($_POST["activity"] === 'edit'){
		faction_edit($_POST["id"], $_POST["factionname"], $mysqli);
	}
	if($_POST["activity"]==='delete'){
		faction_delete($_POST["id"], $mysqli);
	}

}

function faction_status($status){
	
	header('Location: ../staff/index.php?page=action_status.php&status=' . $status);

}

function faction_delete($id, $mysqli){
	$sql = $mysqli->prepare ("DELETE FROM factions WHERE id=?");
	$sql->bind_param("i", $id);
	
	if($sql->execute() === TRUE){
		faction_status("deleteok");
	} else {
		faction_status("deleteerror");
	}
}

function faction_edit($id, $factionname, $mysqli){
	$sql = $mysqli->prepare ("UPDATE factions SET faction_name = ? WHERE id = ?");
	$sql->bind_param("si", $factionname, $id);
	
	if ($sql->execute() === TRUE) {
		faction_status("editok");
	} else {
		faction_status("error");
	}
}
function faction_add($faction, $mysqli){
	if($faction === ""){
		faction_status("missing");
	} else {
		$sql = $mysqli->prepare ("INSERT INTO factions (faction_name) VALUES (?)");
		$sql->bind_param("s", $faction);
	
		if ($sql->execute() === TRUE) {
			faction_status("addok"); 
    
		} else {
			faction_status("error");
		}
	}
}

function list_factions($mysqli){
	$sql="SELECT * FROM factions";
	$result = $mysqli->query($sql);
	
	if($result->num_rows >0){
		echo "<table class=\"table\"> <thead> <tr> <th>Faction</th> <th>Edit</th> <th>Delete</th></tr> </thead> <tbody>";
		while($row=$result->fetch_assoc()){
			echo "<tr><td>" . $row["faction_name"] . "</td>";
			echo "<td><a href=\"index.php?page=faction_edit.html&id=" . $row["id"] . "\"><span class=\"glyphicon glyphicon-edit\"></span></a></td>";
			echo "<td><a href=\"index.php?page=faction_delete.html&id=" . $row["id"] . "\"><span class=\"glyphicon glyphicon-trash\"></span></a></td>";
		}
		echo "</table>";
	}

}
?>
<?php
include_once 'db_connect.php';


if (isset($_POST["activity"])){
	if($_POST['activity'] === "add_character"){
		add_character($mysqli, $_POST['race_select'], $_POST['charactername'], $_POST['player_select']);
	} else if ($_POST['activity'] === "edit_character"){
		edit_character($mysqli, $_POST['id'], $_POST['race_select'], $_POST['charactername'], $_POST['player_select']);
	} else if ($_POST['activity'] === "edit_player"){
		edit_player($mysqli, $_POST['username'], $_POST['email'], $_POST['id']);
	} else if ($_POST['activity'] === "add_player"){
		add_player($mysqli, $_POST['username'], $_POST['email']);
	} else if ($_POST['activity'] === "delete_player"){
		delete_player($mysqli, $_POST['id']);
	} else if($_POST['activity'] === "delete_character"){
		delete_character($mysqli, $_POST['id']);
	}
} else {
	$status="error";
	//character_status($status);
}

function character_status($status){

	header('Location: ../staff/index.php?page=action_status.php&status=' . $status);

}

function get_players($mysqli,$selected=null){
$sql = "SELECT * FROM players ORDER BY username";
$result = $mysqli->query($sql);

if ($result->num_rows > 0){
	echo "<div class=\"form-group\"><label for \"player_select\" class=\"control-label col-sm-3\">Select Player: </label>";
	echo "<div class=\"col-sm-4\">";
	echo "<select class=\"form-control\" id=\"player_select\" name=\"player_select\">";
	while($row=$result->fetch_assoc()){
		echo "<option";
		if($selected === $row["id"]){
			echo " selected";
		}
		echo " value=\"" . $row["id"] . "\">" . $row["username"] . "</option>";
	}
	echo "</select></div></div>";
}

}

function get_characters($mysqli, $selected=null){
$sql="SELECT * FROM `character` ORDER BY char_name";
$character_result = $mysqli->query($sql);

if ($character_result->num_rows > 0){
	echo "<div class=\"form-group\"><label for \"character_select\" class=\"control-label col-sm-3\">Select Character: </label>";
	echo "<div class=\"col-sm-4\">";
	echo "<select class=\"form-control\" id=\"character_select\" name=\"character_select\">";
	while($row=$character_result->fetch_assoc()){
		echo "<option";
		if($selected === $row["id"]){
			echo " selected";
		}
		echo " value=\"" . $row["id"] . "\">" . $row["char_name"] . "</option>";
	}
	echo "</select></div></div>";
}
}

function add_character($mysqli, $race, $name, $player){
	//adds a new record to the character table
	$sql = $mysqli->prepare ("INSERT INTO `character` (player_id, char_name, race_id) VALUES (?,?,?)");
	$sql->bind_param("isi", $player, $name, $race);

	if ($sql->execute() === TRUE) {
		character_status("addok");

	} else {
		character_status("error");
	}
}

function edit_character($mysqli, $id, $race, $name, $player){
	//update an existing character record
	$sql = $mysqli->prepare ("UPDATE `character` SET player_id = ?, race_id = ?, char_name = ? WHERE id = ?");
	$sql->bind_param("iisi", $player, $race, $name, $id);

	if ($sql->execute() === TRUE) {
		character_status("editok");
	} else {
		character_status("error");
	}
}

function edit_player($mysqli, $username, $email, $id){
	//update an existing character record
	$sql = $mysqli->prepare ("UPDATE players SET username = ?, email = ? WHERE id = ?");
	$sql->bind_param("ssi", $username, $email, $id);

	if ($sql->execute() === TRUE) {
		character_status("editok");
	} else {
		character_status("error");
	}
}

function add_player($mysqli, $username, $email){
	//add a new character record
	$sql = $mysqli->prepare("INSERT INTO players (username, email) values (?,?)");
	$sql->bind_param("ss", $username, $email);

	if ($sql->execute() === TRUE){
		character_status("addok");
	} else {
		character_status("error");
	}
}

function delete_player($mysqli, $id){
	//delete a player record
	$sql = $mysqli->prepare("DELETE FROM players WHERE id = ?");
	$sql->bind_param("i", $id);

	if ($sql->execute() === TRUE){
		character_status("deleteok");
	} else {
		character_status("deleteerror");
	}
}

function delete_character($mysqli, $id){
	//delete a character record
	$sql = $mysqli->prepare("DELETE FROM `character` WHERE id = ?");
	$sql->bind_param("i", $id);

	if ($sql->execute() === TRUE){
		character_status("deleteok");
	} else {
		character_status("deleteerror");
	}
}

?>
<?php
include_once 'db_connect.php';


$error_msg = "";


if(isset( $_POST["activity"]))
{
	if ($_POST["activity"]=== "add_times") {
		if(isset($_POST["game_select"], $_POST["datepicker"], $_FILES['userfile']['name'], $_FILES['userfile']['tmp_name'], $_FILES['userfile']['type'], $_FILES['userfile']['size'])
			 && $_FILES['userfile']['size'] > 0) {
			add_newspaper($_POST["game_select"], $_POST["datepicker"], $_FILES['userfile']['name'], $_FILES['userfile']['tmp_name'], $_FILES['userfile']['type'], $_FILES['userfile']['size'], $mysqli);
			// upload_newspaper($_FILES['userfile']['name'], $_FILES['userfile']['tmp_name']);
		}
	} 	else if($_POST["activity"]==="edit_times") {
			$status="unavailable";
			file_status($status);
	} 	else if($_POST["activity"] === "delete_times"){
			newspaper_delete($_POST["id"], $mysqli);
	}	else if($_POST["activity"] === "add_faction" && $_FILES['userfile']['size']>0){
			add_faction_sheet($_POST["game_select"], $_POST["faction_select"], $_FILES['userfile']['name'], $_FILES['userfile']['tmp_name'], $_FILES['userfile']['type'], $_FILES['userfile']['size'], $mysqli);
	}	else if($_POST["activity"] === "edit_faction_sheet"){
			faction_sheet_edit($_POST["id"], $mysqli, $_POST["game_select"], $_POST["faction_select"], $_POST["optionsAction"]);
	}	else if($_POST['activity'] === "add_race" && $_FILES['userfile']['size'] > 0) {
			add_race_sheet($_POST["game_select"], $_POST["race_select"], $_FILES['userfile']['name'], $_FILES['userfile']['tmp_name'], $_FILES['userfile']['type'], $_FILES['userfile']['size'], $mysqli);
	}	else if($_POST['activity'] === "edit_race_sheet"){
			race_sheet_edit($_POST["id"], $mysqli, $_POST["game_select"], $_POST["race_select"], $_POST["optionsAction"]);
	}	else if($_POST['activity'] === "add_narrative" && $_FILES['userfile']['size'] > 0){
			add_narrative($_POST["game_select"], $_POST["character_select"], $_FILES['userfile']['name'], $_FILES['userfile']['tmp_name'], $_FILES['userfile']['type'], $_FILES['userfile']['size'], $mysqli);
	}	else if($_POST['activity'] === "character_narrative_select"){
			echo "nothing here!";
	}	else if($_POST['activity'] === "edit_character_narrative"){
			character_narrative_edit($mysqli, $_POST['id'], $_POST['game_select'], $_POST['character_select'], $_POST['optionsAction']);
	}	else if($_POST['activity'] === "add_character_sheet"){
			add_character_sheet($_POST["game_select"], $_POST["character_select"], $_FILES['userfile']['name'], $_FILES['userfile']['tmp_name'], $_FILES['userfile']['type'], $_FILES['userfile']['size'], $mysqli);
	}	else if($_POST['activity'] === "edit_character_sheet"){
			edit_character_sheet($mysqli, $_POST['id'], $_POST['game_select'], $_POST['character_select'], $_POST['optionsAction']);
	}	else if($_POST['activity'] === "add_power_sheet"){
			add_power_sheet($_POST["character_select"], $_FILES['userfile']['name'], $_FILES['userfile']['tmp_name'], $_FILES['userfile']['type'], $_FILES['userfile']['size'], $mysqli);
	}	else if($_POST['activity'] === "delete_power_sheet"){
			delete_power_sheet($mysqli, $_POST['id']);
	}
		else {
			$status="error";
			file_status($status);
		}
}

function file_status($status){

	header('Location: ../staff/index.php?page=action_status.php&status=' . $status);

}

function delete_power_sheet($mysqli, $id){
	$sql = $mysqli->prepare ("DELETE FROM power_sheets WHERE id = ?");
	$sql->bind_param("i", $id);
	if($sql->execute() === TRUE){
		file_status("deleteok");
	} else {
		file_status("deleteerror");
	}
}


function edit_character_sheet($mysqli, $id, $game_number, $character_select, $action){	
//we can update or edit here, so first check which action we're trying to perform
	if($action === "update"){ 
		//first check to see if the requested update would make a duplicate, and if so send an error, if not, do the update
		$sql = "SELECT * FROM character_sheets WHERE game_number = " . $game_number . " AND char_id = " . $character_select;
		$result = $mysqli->query($sql);
		if ($result->num_rows > 0){
			file_status("editdupe");
		} else {
			//go ahead and edit, there's no duplicates
			$sql = $mysqli->prepare ("UPDATE character_sheets SET game_number = ?, char_id = ? WHERE id = ?");
			$sql->bind_param("iii", $game_number, $character_select, $id);
			if($sql->execute() === TRUE){
				file_status("editok");
			} else {
				file_status("error");
			}
		}
	} else if($action === "delete"){
		//do the delete stuff here
		$sql = $mysqli->prepare ("DELETE FROM character_sheets WHERE id = ?");
		$sql->bind_param("i", $id);
		if($sql->execute() === TRUE){
			file_status("deleteok");
		} else {
			file_status("deleteerror");
		}
	} 
}

function character_narrative_edit($mysqli, $id, $game_number, $character_select, $action){	
//we can update or edit here, so first check which action we're trying to perform
	if($action === "update"){ 
		//first check to see if the requested update would make a duplicate, and if so send an error, if not, do the update
		$sql = "SELECT * FROM character_narratives WHERE game_number = " . $game_number . " AND char_id = " . $character_select;
		$result = $mysqli->query($sql);
		if ($result->num_rows > 0){
			file_status("editdupe");
		} else {
			//go ahead and edit, there's no duplicates
			$sql = $mysqli->prepare ("UPDATE character_narratives SET game_number = ?, char_id = ? WHERE id = ?");
			$sql->bind_param("iii", $game_number, $character_select, $id);
			if($sql->execute() === TRUE){
				file_status("editok");
			} else {
				file_status("error");
			}
		}
	} else if($action === "delete"){
		//do the delete stuff here
		$sql = $mysqli->prepare ("DELETE FROM character_narratives WHERE id = ?");
		$sql->bind_param("i", $id);
		if($sql->execute() === TRUE){
			file_status("deleteok");
		} else {
			file_status("deleteerror");
		}
	} 
}


function race_sheet_edit($id, $mysqli, $game_number, $race_select, $action){	
//we can update or edit here, so first check which action we're trying to perform
	if($action === "update"){ 
		//first check to see if the requested update would make a duplicate, and if so send an error, if not, do the update
		$sql = "SELECT * FROM race_sheets WHERE game_number = " . $game_number . " AND race_id = " . $race_select;
		$result = $mysqli->query($sql);
		if ($result->num_rows > 0){
			file_status("editdupe");
		} else {
			//go ahead and edit, there's no duplicates
			$sql = $mysqli->prepare ("UPDATE race_sheets SET game_number = ?, race_id = ? WHERE id = ?");
			$sql->bind_param("iii", $game_number, $race_select, $id);
			if($sql->execute() === TRUE){
				file_status("editok");
			} else {
				file_status("error");
			}
		}
	} else if($action === "delete"){
		//do the delete stuff here
		$sql = $mysqli->prepare ("DELETE FROM race_sheets WHERE id = ?");
		$sql->bind_param("i", $id);
		if($sql->execute() === TRUE){
			file_status("deleteok");
		} else {
			file_status("deleteerror");
		}
	} else if($action === "view"){
		race_download($id, $mysqli);
	}
}

function faction_sheet_edit($id, $mysqli, $game_number, $faction_select, $action){	
//we can update or edit here, so first check which action we're trying to perform
	if($action === "update"){ 
		//first check to see if the requested update would make a duplicate, and if so send an error, if not, do the update
		$sql = "SELECT * FROM faction_sheets WHERE game_number = " . $game_number . " AND faction_id = " . $faction_select;
		$result = $mysqli->query($sql);
		if ($result->num_rows > 0){
			file_status("editdupe");
		} else {
			//go ahead and edit, there's no duplicates
			$sql = $mysqli->prepare ("UPDATE faction_sheets SET game_number = ?, faction_id = ? WHERE id = ?");
			$sql->bind_param("iii", $game_number, $faction_select, $id);
			if($sql->execute() === TRUE){
				file_status("editok");
			} else {
				file_status("error");
			}
		}
	} else if($action === "delete"){
		//do the delete stuff here
		$sql = $mysqli->prepare ("DELETE FROM faction_sheets WHERE id = ?");
		$sql->bind_param("i", $id);
		if($sql->execute() === TRUE){
			file_status("deleteok");
		} else {
			file_status("deleteerror");
		}
	} else if($action === "view"){
		faction_download($id, $mysqli);
	}
}

function add_power_sheet($character_select, $filename, $tmpName, $filetype, $filesize, $mysqli){

	/* open the file, read the contents, and escape any special characters in the file */
	$fp      = fopen($tmpName, 'r');
	$content = fread($fp, filesize($tmpName));
	/*$content = $mysqli->real_escape_string($content);*/
	fclose($fp);

	/*uploading a new power sheet will invalidate a previous one, so delete any existing ones for a particular character first*/
	$sql = $mysqli->prepare ("DELETE FROM power_sheets WHERE char_id = ?");
	$sql->bind_param("i", $character_select);
	$sql->execute();

	/* build the sql statment and insert into database */
	$sql = $mysqli->prepare ("INSERT INTO power_sheets (char_id, file_name, type, size, content) VALUES (?,?,?,?,?)");
	$sql->bind_param("issis", $character_select, $filename, $filetype, $filesize, $content);

	if ($sql->execute() === TRUE) {
		file_status("uploadok");

	} else {
		file_status("uploaderror");
	}
}

function add_character_sheet($game_number, $character_select, $filename, $tmpName, $filetype, $filesize, $mysqli){

	/* open the file, read the contents, and escape any special characters in the file */
	$fp      = fopen($tmpName, 'r');
	$content = fread($fp, filesize($tmpName));
	/*$content = $mysqli->real_escape_string($content);*/
	fclose($fp);


	/* build the sql statment and insert into database */
	$sql = $mysqli->prepare ("INSERT INTO character_sheets (game_number, char_id, file_name, type, size, content) VALUES (?,?,?,?,?,?)");
	$sql->bind_param("iissis", $game_number, $character_select, $filename, $filetype, $filesize, $content);

	if ($sql->execute() === TRUE) {
		file_status("uploadok"); 

	} else {
		file_status("uploaderror");

	}
}

function add_narrative($game_number, $character_select, $filename, $tmpName, $filetype, $filesize, $mysqli){

	/* open the file, read the contents, and escape any special characters in the file */
	$fp      = fopen($tmpName, 'r');
	$content = fread($fp, filesize($tmpName));
	/*$content = $mysqli->real_escape_string($content);*/
	fclose($fp);


	/* build the sql statment and insert into database */
	$sql = $mysqli->prepare ("INSERT INTO character_narratives (game_number, char_id, file_name, type, size, content) VALUES (?,?,?,?,?,?)");
	$sql->bind_param("iissis", $game_number, $character_select, $filename, $filetype, $filesize, $content);

	if ($sql->execute() === TRUE) {
		file_status("uploadok"); 

	} else {
		file_status("uploaderror");

	}
}

function add_faction_sheet($game_number, $faction_select, $filename, $tmpName, $filetype, $filesize, $mysqli){

	/* open the file, read the contents, and escape any special characters in the file */
	$fp      = fopen($tmpName, 'r');
	$content = fread($fp, filesize($tmpName));
	/*$content = $mysqli->real_escape_string($content);*/
	fclose($fp);


	/* build the sql statment and insert into database */
	$sql = $mysqli->prepare ("INSERT INTO faction_sheets (game_number, faction_id, file_name, type, size, content) VALUES (?,?,?,?,?,?)");
	$sql->bind_param("iissis", $game_number, $faction_select, $filename, $filetype, $filesize, $content);

	if ($sql->execute() === TRUE) {
		file_status("uploadok"); 

	} else {
		file_status("uploaderror");

	}
}

function add_race_sheet($game_number, $race_select, $filename, $tmpName, $filetype, $filesize, $mysqli){

	/* open the file, read the contents, and escape any special characters in the file */
	$fp      = fopen($tmpName, 'r');
	$content = fread($fp, filesize($tmpName));
	/*$content = $mysqli->real_escape_string($content);*/
	fclose($fp);


	/* build the sql statment and insert into database */
	$sql = $mysqli->prepare ("INSERT INTO race_sheets (game_number, race_id, file_name, type, size, content) VALUES (?,?,?,?,?,?)");
	$sql->bind_param("iissis", $game_number, $race_select, $filename, $filetype, $filesize, $content);

	if ($sql->execute() === TRUE) {
		file_status("uploadok");

	} else {
		file_status("uploaderror");

	}
}
function newspaper_delete($id, $mysqli){
	//first, find the thumbnail file on the server and delete it

	$target_file = $_SERVER['DOCUMENT_ROOT'] . "/news/archives/times" . $id . ".png";
	if(file_exists($target_file)){
		unlink($target_file);
	}

	//now, delete the record from the database
	$sql = "DELETE FROM newspaper WHERE id = " . $id;
	if ($mysqli->query($sql) === TRUE){
		file_status("deleteok");
	} else {
		file_status("deleteerror");
	}

}

function faction_download($id, $mysqli)
{

$sql = "SELECT file_name, type, size, content FROM faction_sheets WHERE id = " . $id;
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {

	$row=$result->fetch_assoc();

	$size=$row["size"];
	$type=$row["type"];
	$name=$row["file_name"];

	header("Content-type: application/pdf");
	header('Content-Transfer-Encoding: binary');
	header('Content-Description: File Transfer');
	header("Content-length: ". $size);
	header("Content-Disposition: inline; filename=".$name); 
	echo $row["content"];
}

exit;
}



function get_game_numbers($mysqli, $selected=null){
$sql = "SELECT * FROM calendar ORDER BY game_date DESC";
$result = $mysqli->query($sql);

if ($result->num_rows > 0){
	echo "<div class=\"form-group\"><label for \"game_select\" class=\"control-label col-sm-3\">Select Game: </label>";
	echo "<div class=\"col-sm-6\">";
	echo "<select class=\"form-control\" id=\"game_select\" name=\"game_select\">";
	while($row=$result->fetch_assoc()){
		echo "<option value=\"" . $row["game_number"] . "\"";
		if($row["game_number"] === $selected){
			echo " selected";
		}
		echo "> Game # " . $row["game_number"] . " - " . $row["game_date"] . "</option>";
	}
	echo "</select></div></div>";
}

}


function get_factions($mysqli,$selected=null){
$sql = "SELECT * FROM factions ORDER BY faction_name DESC";
$result = $mysqli->query($sql);

if ($result->num_rows > 0){
	echo "<div class=\"form-group\"><label for \"faction_select\" class=\"control-label col-sm-3\">Select Faction: </label>";
	echo "<div class=\"col-sm-4\">";
	echo "<select class=\"form-control\" id=\"faction_select\" name=\"faction_select\">";
	while($row=$result->fetch_assoc()){
		echo "<option";
		if($selected === $row["id"]){
			echo " selected";
		} 
		echo " value=\"" . $row["id"] . "\">" . $row["faction_name"] . "</option>";
	}
	echo "</select></div></div>";
}

}

function get_races($mysqli,$selected=null){
$sql = "SELECT * FROM races ORDER BY race_name DESC";
$result = $mysqli->query($sql);

if ($result->num_rows > 0){
	echo "<div class=\"form-group\"><label for \"race_select\" class=\"control-label col-sm-3\">Select Race: </label>";
	echo "<div class=\"col-sm-4\">";
	echo "<select class=\"form-control\" id=\"race_select\" name=\"race_select\">";
	while($row=$result->fetch_assoc()){
		echo "<option";
		if($selected === $row["id"]){
			echo " selected";
		} 
		echo " value=\"" . $row["id"] . "\">" . $row["race_name"] . "</option>";
	}
	echo "</select></div></div>";
}

}

function add_newspaper($gamenumber, $newsdate, $filename, $tmpName, $filetype, $filesize, $mysqli){

	/* open the file, read the contents, and escape any special characters in the file */
	$fp      = fopen($tmpName, 'r');
	$content = fread($fp, filesize($tmpName));
	/*$content = $mysqli->real_escape_string($content);*/
	fclose($fp);

	/* make sure the date is properly formatted */
	$newsdate = strtotime($newsdate);
	$newsdate = date("Y-m-d", $newsdate);

	/* build the sql statment and insert into database */
	$sql = $mysqli->prepare ("INSERT INTO newspaper (game_number, news_date, file_name, type, size, content) VALUES (?,?,?,?,?,?)");
	$sql->bind_param("isssis", $gamenumber, $newsdate, $filename, $filetype, $filesize, $content);

	if ($sql->execute() === TRUE) {
		$last_id = $mysqli->insert_id;
		$filename = "times" . $last_id;
		genPdfThumbnail($content, $filename);
		file_status("uploadok");
	} else {
		file_status("uploaderror");
	}

}

function genPdfThumbnail($source, $filename){
//creates a thumbnail from a PDF source
$target = $_SERVER['DOCUMENT_ROOT'] . "/news/archives/" . $filename . ".png";

//$target = preg_replace('/\\.[^.\\s]{3,4}$/', '', $source) . ".png"; 
$im = new Imagick();
$im->readimageblob($source);
$im->setiteratorindex(0); //gives us the first page instead of the last
$im->setimageformat("png");
$im->thumbnailimage(400,400,true, false); // width and height
$im->writeimage($target);
$im->clear();
$im->destroy();

}

function get_newspaper_staff($mysqli){
//get the current contents of the newspaper table

$sql = "SELECT * FROM newspaper ORDER BY game_number DESC";
$result = $mysqli->query($sql);

if ($result->num_rows > 0){
//build an html table and display each row from database
	echo "<table class=\"table\"> <thead> <tr> <th>Game #</th> <th>Date</th> <th>File Name</th> <th>File Type</th><th></th></tr> </thead> <tbody>";
	while($row=$result->fetch_assoc()){
		echo "<tr><td>" . $row["game_number"] . "</td><td>" . $row["news_date"] . "</td><td><a href=\"content/file_download.php?id=" .$row["id"] . "&file=newspaper\" target=\"_blank\">" . $row["file_name"] . "</a></td><td>" . $row["type"];
		echo "</td><td><a href=\"index.php?page=times_delete.html&id=" . $row["id"] . "\" data-toggle=\"tooltip\" title=\"delete file upload\"><span class=\"glyphicon glyphicon-trash\"></span></a></td>";
	}
	echo "</table>";
} else {
	echo "0 results";
}

}


function get_edit_date($id, $mysqli){

	$sql = "SELECT * FROM newspaper WHERE id = " . $id;
	$result = $mysqli->query($sql);
	$row = $result->fetch_assoc();

	return $row;

}

function currentNewspaper($mysqli){
	$sql = "SELECT * FROM newspaper ORDER BY game_number DESC LIMIT 1";
	$result = $mysqli->query($sql);
	$row = $result->fetch_assoc();
}


function newspaperDownload($mysqli, $id)
{

if ($id){
	$sql = "SELECT * FROM newspaper WHERE id = " . $id;
} else {
	$sql = "SELECT * FROM newspaper ORDER BY game_number DESC LIMIT 1";
}

$result = $mysqli->query($sql);

if ($result->num_rows > 0){

	$row=$result->fetch_assoc();

	$size=$row["size"];
	$type=$row["type"];
	$name=$row["file_name"];

	header("Content-type: application/pdf");
	header('Content-Transfer-Encoding: binary');
	header('Content-Description: File Transfer');
	header("Content-length: ". $size);
	header("Content-Disposition: inline; filename=".$name); 
	print $row["content"];
} else {
	echo "Sorry, the issue you requested cannot be found.";
}
}

function newspaperArchives($mysqli){
	$sql = "SELECT * FROM newspaper ORDER BY game_number DESC";
	$result = $mysqli->query($sql);

	while($row=$result->fetch_assoc()){
		echo "<div class=\"col-md-4\">";
		echo "<a href=\"/news/index.php?id=" . $row["id"] . "\">";
		echo "<img src=\"/news/archives/times" . $row["id"] . ".png\">";
		echo "</a>";
		echo "</div>";
	}

}

function newspaperSidebar($mysqli){
	$sql = "SELECT * FROM newspaper ORDER BY game_number DESC LIMIT 6 OFFSET 1";
	$result = $mysqli->query($sql);

	while($row=$result->fetch_assoc()){
		echo "<a href=\"/news/index.php?id=" . $row["id"] . "\">";
		echo "<img src=\"/news/archives/times" . $row["id"] . ".png\" max-width=\"300px\">";
		echo "</a>"; 
	}
}

?>

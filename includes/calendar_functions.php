<?php


include_once 'db_connect.php';

$error_msg = "";

if(isset($_POST["datepicker"], $_POST["location"], $_POST["status"], $_POST["gamenumber"], $_POST["activity"]))
{
	if ($_POST["activity"] === "add") {
		add_game($_POST["datepicker"], $_POST["gamenumber"], $_POST["location"], $_POST["status"], $mysqli);
	}
	
	if ($_POST["activity"] === "edit") {
		edit_game($_POST["id"], $_POST["datepicker"], $_POST["gamenumber"], $_POST["location"], $_POST["status"], $mysqli);
	}
	
		if ($_POST["activity"] === "delete") {
		delete_game($_POST["id"], $_POST["gamenumber"], $mysqli);
	}
}


function file_status($status){
	
	header('Location: ../staff/index.php?page=action_status.php&status=' . $status);

}

function add_game($gamedate, $gamenumber, $location, $status, $mysqli){
//this function will add a new game date to the calendar table

$gamedate= strtotime($gamedate);
$gamedate = date("Y-m-d", $gamedate);

//enforce rule of only one "current" status game allowed
if ($status === "current") {
	if (game_status_check($mysqli) > 0) {
		if ($gamedate > date("Y-m-d")) {
			$status = "future";
		} else {
			$status = "closed";
		}
	}
}

$sql = $mysqli->prepare ("INSERT INTO calendar (game_number, game_date, location, status) VALUES (?,?,?,?)");
$sql->bind_param("ssss", $gamenumber, $gamedate, $location, $status);

if ($sql->execute() === TRUE) {
	$status="addok";
} else {
    $status="calendarerror";
}
file_status($status);

}


function edit_game($id, $gamedate, $gamenumber, $location, $status, $mysqli){
//this function will edit a game in the calendar table

$gamedate = strtotime($gamedate);
$gamedate = date("Y-m-d", $gamedate);

//enforce rule of only one "current" status game allowed
if ($status === "current") {
	if (game_status_check($mysqli) > 0) {
		if ($gamedate > date("Y-m-d")) {
			$status = "future";
		} else {
			$status = "closed";
		}
	}
}

$sql = $mysqli->prepare ("UPDATE calendar SET game_number = ?, game_date = ?, location = ?, status = ? WHERE id = ?");
$sql->bind_param("ssssi", $gamenumber, $gamedate, $location, $status, $id);

if($sql->execute() === TRUE) {
	$status = "editok";
} else {
	$status = "calendarerror";
}
file_status($status);
}

function delete_game($id, $game_number, $mysqli){
//this function will delete a game from the calendar table

 if (delete_game_check($game_number, $mysqli) === "true"){
	$status = "gamedeleteerror";
 } else {
	$sql = $mysqli->prepare ("DELETE FROM calendar WHERE id = ?");
	$sql->bind_param("i",$id);
		
	if($sql->execute()=== TRUE) {
		$status="deleteok";
		} else {
		$status="delete error";
		}
	}
	file_status($status);

}

function game_status_check($mysqli){
//only one game can be considered "current" at a time, so this function will check for
//existing games with a current status in the event a user is trying to edit a record to be current
//or add a new record with a current status

$sql = "SELECT * FROM calendar WHERE status = 'current'";
$result = $mysqli->query($sql);
if ($result->num_rows <1) {
	return 0;
} else {
	$row=$result->fetch_assoc();
	return $row["id"];
}

}

function delete_game_check($game_number, $mysqli){
//this function will scout for potential foreign key issues before doing a delete from the calendar table
		$conflict = "false";
		
		$sql = "SELECT * FROM character_packets WHERE game_number = " . $game_number;
		$result = $mysqli->query($sql);
		if ($result->num_rows > 0){
			$conflict = "true"; }
			else {
				$sql = "SELECT * FROM character_sheets WHERE game_number = " . $game_number;
				$result = $mysqli->query($sql);
				if ($result->num_rows > 0){
					$conflict = "true"; }
					else {
						$sql = "SELECT * FROM character_downtimes WHERE game_number = " . $game_number;
						$result = $mysqli->query($sql);
						if ($result->num_rows > 0){
							$conflict = "true";}
							else {
								$sql = "SELECT * FROM character_narratives WHERE game_number = " . $game_number;
								$result = $mysqli->query($sql);
								if($result->num_rows > 0){
									$conflict = "true";}
									else {
										$sql = "SELECT * FROM race_sheets WHERE game_number = " . $game_number;
										$result = $mysqli->query($sql);
										if($result->num_rows > 0){
											$conflict = "true";}
											else {
												$sql = "SELECT * FROM faction_sheets WHERE game_number = " . $game_number;
												$result = $mysqli->query($sql);
												if($result->num_rows > 0){
													$conflict = "true";}
													else {
														$sql = "SELECT * FROM newspaper WHERE game_number = " . $game_number;
														$result = $mysqli->query($sql);
														if($result->num_rows > 0){
															$conflict = "true";}
															else {
																$sql = "SELECT * FROM power_sheets WHERE game_number = " . $game_number;
																$result = $mysqli->query($sql);
																if($result->num_rows > 0){
																	$conflict = "true";}
																}
											}
										}
									}
							}
					}
			}

		return $conflict;
			}


function get_dates_staff($mysqli){
//get the current contents of the calendar table

$sql = "SELECT * FROM calendar ORDER BY game_date DESC";
$result = $mysqli->query($sql);

if ($result->num_rows > 0){
//build an html table and display each row from database
	echo "<table class=\"table\"> <thead> <tr> <th>Game #</th> <th>Date</th> <th>Location</th> <th>Status</th><th></th><th></th></tr> </thead> <tbody>";
	while($row=$result->fetch_assoc()){
		echo "<tr><td>" . $row["game_number"] . "</td><td>" . $row["game_date"] . "</td><td>" . $row["location"] . "</td><td>" . $row["status"];
		echo "</td><td><a href=\"index.php?page=calendar_edit.html&id=" . $row["id"] . "\" data-toggle=\"tooltip\" title=\"edit game\"><span class=\"glyphicon glyphicon-edit\"></span></a></td>";
		echo "</td><td><a href=\"index.php?page=calendar_delete.html&id=" . $row["id"] . "\" data-toggle=\"tooltip\" title=\"delete game\"><span class=\"glyphicon glyphicon-trash\"></span></a></td></tr>";
	}
	echo "</table>";
} else {
	echo "0 results";
}

	
}

function get_dates_player($mysqli){
//get the current contents of the calendar table, and display them in a panel for those earlier than today
//and another panel for those later than today

$sql = "SELECT * FROM calendar WHERE game_date > CURDATE() ORDER BY game_date DESC";
$result = $mysqli->query($sql);

echo "<div class=\"panel panel-default\"><div class=\"panel-heading text-center\"><h2>Upcoming Events</h2></div><div class=\"panel-body text-center\">";
while($row=$result->fetch_assoc()){
	echo "<p>Game #" . $row["game_number"] . " - " . $row["location"] . " - " . $row["game_date"] . "</p>";
}		
echo "</div></div>";

$sql = "SELECT * FROM calendar WHERE game_date < CURDATE() ORDER BY game_date DESC";
$result = $mysqli->query($sql);

echo "<div class=\"panel panel-default\"><div class=\"panel-heading text-center\"><h2>Past Events</h2></div><div class=\"panel-body text-center\">";
while($row=$result->fetch_assoc()){
	echo "<p>Game #" . $row["game_number"] . " - " . $row["location"] . " - " . $row["game_date"] . "</p>";
}		
echo "</div></div>";
	
}

function get_edit_date($id, $mysqli){

	$sql = "SELECT * FROM calendar WHERE id = " . $id;
	$result = $mysqli->query($sql);
	$row = $result->fetch_assoc();

	return $row;

}




?>
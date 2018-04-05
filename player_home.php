<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
 
sec_session_start();
?>
<!DOCTYPE html>
<html>
    <head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE-edge">
		<meta name="viewport" content="width=device-width, initial-scale=1"> 
		<title>Crimson Accord - Player Home</title>
		<link href='http://fonts.googleapis.com/css?family=Orbitron:500,700,900,400' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" href="css/blueimp-gallery.min.css">
    </head>
    <body>
			<div class = "container">
			<div class = "row">
				<?php
					if (login_check($mysqli) == true) {
						require 'navbar_player.html';
						} else {
							require 'navbar.html';
								}
				?>
			</div>
			<div class = "row">
				<div class = "col-md-4">
					<img src="images/header_col1.jpg" class="img-responsive" alt="header image">
				</div>
				<div class = "col-md-8">
					<div class = "row">
						<img src="images/header_col2_r1.jpg" class="img-responsive" alt="night time city scapes"></img>
					</div>
					<div class = "row">
						<img src="images/header_col2_r2.jpg" class="img-responsive" alt="Crimson Accord 2025"></img>
					</div>
					<div class = "row">
						<hr></hr>
					</div>
					<div>
					<!-- logged in character header -->
					     <?php if (login_check($mysqli) == true) : ?>
							<div class="form-group">
								<label for="selectChar">Current Character:</label>
								<select class="form-control" id="selChar">
									<option>Active Character Name (Bob)</option>
									<option>Dead Character (Jeff)</option>
									<option>Inactive Character (Tom)</option>
								</select>
							</div>
						
						<?php else : ?>
							<p>
								<span class="error">You are not authorized to access this page.</span> Please <a href="login.php">login</a>.
							</p>
						<?php endif; ?>
					<!-- end logged in character header -->
					</div>
					
				</div>
			</div>
			<div class="row">
				<p></p>
			</div>
			<div class = "row">
				<div class="col-md-2">
					<!--This is the left sidebar area-->
					<?php require 'player_menu.php' ?>
				
				</div>
			
				<div class="col-md-8">
					<!--This is the main content area-->
					<?php if (login_check($mysqli) == true) : ?>
					
						<div class="panel panel-primary">
							<div class="panel-heading">
								<span class="panel-title">Game Status </span>
							</div>
							<div class="panel-body">
								This is "panel-primary" class.  It would judge by the current date what the current game is, what the next game
								date is, and generate a message indicating the packets are ready to be downloaded or not
							</div>
						</div>
						<div class="panel panel-success">
							<div class="panel-heading">
								<span class="panel-title">Downtime Narrative<span>
							</div>
							<div class="panel-body">
								this would check the database to see if a downtime for the upcoming game has been received for the character.  If not, 
								a message and link to submit the narrative.  If it has been received, a message of its status (submitted, in review, or approved)
								this is class "panel-success".
							</div>						
						</div>
						<div class="panel panel-info">
							<div class="panel-heading">
								<span class="panel-title">Plot Points / XP</span>
							</div>
							<div class="panel-body">
								this is class "panel-info".  Character "Bob" currently has X plot points and Z experience points.
								Points were last updated on (date from database)
							</div>						
						</div>
						<div class="panel panel-warning">
							<div class="panel-heading">
								<span class="panel-title">Game Packets</span>
							</div>
							<div class="panel-body">
								this is class "panel-warning".  2 possible messages would be 1) packets are in progress - or - 2) packets are done
								with a <a href="#">link to download</a>
							</div>						
						</div>
						<div class="panel panel-danger">
							<div class="panel-heading">
								<span class="panel-title">Important Message!</span>
							</div>
							<div class="panel-body">
								This is a class "panel-danger" message.  It would be used for urgent messages, like a game was cancelled, although that would likely be posted on Facebook
							</div>						
						</div>
					
						          
					<?php else : ?>
						<p>
							
						</p>
					<?php endif; ?>
					
				</div>
				
				<div class="col-md-2">
					<?php require 'adpane.html' ?>
				</div>
				
				
			</div
			
		</div>

	
	
	
	
	
	
	
	

    </body>
</html>

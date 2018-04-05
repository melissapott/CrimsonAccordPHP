<?php
//include_once '/includes/db_connect.php';
include_once $_SERVER['DOCUMENT_ROOT']."/includes/db_connect.php";
//include_once '/includes/functions.php';
include_once $_SERVER['DOCUMENT_ROOT']."/includes/functions.php";
sec_session_start();
if (login_check($mysqli) == true) {
    $logged = 'in';
} else {
    $logged = 'out';
}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE-edge">
		<meta name="viewport" content="width=device-width, initial-scale=1"> 
		<title>Crimson Accord</title>
		<link href='http://fonts.googleapis.com/css?family=Orbitron:500,700,900,400' rel='stylesheet' type='text/css'>
		<link href="https://fonts.googleapis.com/css?family=Merriweather" rel="stylesheet">
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
					
				</div>
			</div>
			<div class="row">
				<p></p>
			</div>
			<div class = "row">
				<div class="col-md-10">
					<!--This is the main content area-->
					
					<?php
						if (isset($_GET['page'])) {
							$pagename = "content/".$_GET['page'];
							require $pagename;
						}
						else {
						require 'content/home.html';
						}
					?>

					
				</div>
				<div class="col-md-2">
					<!--This is the right sidebar area-->
					<?php require 'adpane.html' ?>
				
				</div>
				
				
			</div
			
		</div>

		
	</body>
</html>
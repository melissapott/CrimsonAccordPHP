<?php
include_once $_SERVER['DOCUMENT_ROOT']."/includes/db_connect.php";
include_once $_SERVER['DOCUMENT_ROOT']."/includes/staff_functions.php";

 
sec_session_start();
?>
<!DOCTYPE html>
<html>
    <head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE-edge">
		<meta name="viewport" content="width=device-width, initial-scale=1"> 
		<title>Crimson Accord - Staff Home</title>
		<link href='http://fonts.googleapis.com/css?family=Orbitron:500,700,900,400' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		<link rel="stylesheet" type="text/css" href="../css/style.css">
		<link rel="stylesheet" href="../css/blueimp-gallery.min.css">

    </head>
    <body>
			<div class = "container">
			<div class = "row">
				<?php
					if (login_check($mysqli) == true) {
						require 'navbar_staff.html';
						}
				?>
			</div>
			<div class = "row">
				<div class = "col-md-4">
					<img src="../images/header_col1.jpg" class="img-responsive" alt="header image">
				</div>
				<div class = "col-md-8">
					<div class = "row">
						<img src="../images/header_col2_r1.jpg" class="img-responsive" alt="night time city scapes"></img>
					</div>
					<div class = "row">
						<img src="../images/header_col2_r2.jpg" class="img-responsive" alt="Crimson Accord 2025"></img>
					</div>
					<div class = "row">
						<hr></hr>
						
					</div>
					<div>

					</div>
					
				</div>
			</div>
			<div class="row">
				<p></p>
			</div>
			<div class = "row">
				<div class="col-md-2">
					<!--This is the left sidebar area-->
				
				
				</div>
			
				<div class="col-md-8">
					<!--This is the main content area-->
					<?php 
						if (login_check($mysqli) !== true) : 
							echo "<h3>You are not authorized to be here.  Please <a href='staff_login.php'>Log In</a> or return to the 
							<a href='../index.php'>home page</a></h3>";		
						else : 
							if (isset($_GET['page'])) {
								$pagename = "content/".$_GET['page'];
								require $pagename;
						
								}
							else {
								require 'content/home.html';
								}
						endif; 
					?>
					
				</div>
				
				<div class="col-md-2">
					
				</div>
				
				
			</div
			
		</div>

	
	
	
	
	
	
	
	

    </body>
</html>

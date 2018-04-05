<?php
//include_once '/includes/db_connect.php';
include_once $_SERVER['DOCUMENT_ROOT']."/includes/db_connect.php";
//include_once '/includes/functions.php';
include_once $_SERVER['DOCUMENT_ROOT']."/includes/staff_functions.php";
sec_session_start();
if (login_check($mysqli) == true) {
    $logged = 'in';
} else {
    $logged = 'out';
}
?>
<?php
        if (isset($_GET['error'])) {
            echo '<p class="error">Error Logging In!</p>';
        }
?> 

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE-edge">
		<meta name="viewport" content="width=device-width, initial-scale=1"> 
		<title>Crimson Accord - Staff Login</title>
		<link href='http://fonts.googleapis.com/css?family=Orbitron:500,700,900,400' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		<link rel="stylesheet" type="text/css" href="../css/style.css">
		<link rel="stylesheet" href="../css/blueimp-gallery.min.css">
		<script type="text/JavaScript" src="../js/sha512.js"></script> 
        <script type="text/JavaScript" src="../js/forms.js"></script> 
		
	</head>
	<body>
		<div class = "container">
			<div class = "row">
				<!-- this is where the navbar would go -->
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
					
				</div>
			</div>
			<div class="row">
				<p></p>
			</div>
			<div class = "row">
				<div class="col-md-10">
					<!--This is the main content area-->
					
					<form class="form-horizontal" action="../includes/staff_process_login.php" method="post" name="login_form">                      
						<div class="form-group">
							<label for "email" class="control-label col-sm-2">Email:</label>
							<div class="col-sm-10">
								<input type="email" class="form-control" id="email" name="email" placeholder="email">
							</div>
						</div>
						<div class="form-group">
							<label for "password" class="control-label col-sm-2">Password:</label>
							<div class="col-sm-10">
								<input type="password" class="form-control" name="password" id="password" placeholder="password">
							</div>
						</div>
						 <div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<input class="btn" type="button" value="Login" onclick="formhash(this.form, this.form.password);" /> 
							</div>
						</div>
					</form>
 
				<div class="col-sm-offset-2 col-sm-10">
				<?php
						if (login_check($mysqli) == true) {
										echo '<p>Currently logged ' . $logged . ' as ' . htmlentities($_SESSION['username']) . '.</p>';
				 
							echo '<p>Do you want to change user? <a href="/includes/logout.php">Log out</a>.</p>';
						} else {
										echo '<p>Currently logged ' . $logged . '.</p>';
										echo "<p>If you don't have a login, please <a href='register.php'>register</a></p>";
								}
				?>  
				
					
				</div>
				</div>
				<div class="col-md-2">
					<!--This is the right sidebar area-->
				
				
				</div>
				
				
			</div
			
		</div>

		
	</body>
</html>
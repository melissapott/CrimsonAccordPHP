<?php
include_once $_SERVER['DOCUMENT_ROOT']."/includes/db_connect.php";
include_once $_SERVER['DOCUMENT_ROOT']."/includes/staff_functions.php";
include_once $_SERVER['DOCUMENT_ROOT']."/includes/staff_register.inc.php";


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
		<title>Crimson Accord - Staff</title>
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
					
					       <!-- Registration form to be output if the POST variables are not
							set or if the registration script caused an error. -->
					<h1>Add a New Staff Member</h1>
					<?php
					if (!empty($error_msg)) {
						echo $error_msg;
					}
					?>
					<ul>
						<li>Usernames may contain only digits, upper and lowercase letters and underscores</li>
						<li>Emails must have a valid email format</li>
						<li>Passwords must be at least 6 characters long</li>
						<li>Passwords must contain
							<ul>
								<li>At least one uppercase letter (A..Z)</li>
								<li>At least one lowercase letter (a..z)</li>
								<li>At least one number (0..9)</li>
							</ul>
						</li>
						<li>Your password and confirmation must match exactly</li>
					</ul>
		
					<form class="form-horizontal" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>" method="post" name="registration_form">
						<div class="form-group">
							<label for "username" class="control-label col-sm-2">Username:</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="username" name="username" placeholder="username"/>
							</div>
						</div>
						<div class="form-group">
							<label for "email" class="control-label col-sm-2">Email:</label>
							<div class="col-sm-10">
								<input type="email" class="form-control" id="email" name="email" placeholder="email"/>
							</div>
						</div>
						<div class="form-group">
							<label for "password" class="control-label col-sm-2">Password:</label>
							<div class="col-sm-10">
								<input type="password" class="form-control" id="password" name="password" placeholder="password" />
							</div>
						</div>
						<div class="form-group">
							<label for "confirmpwd" class="control-label col-sm-2">Confirm password:</label>
							<div class="col-sm-10">
								<input type="password" class="form-control" name="confirmpwd" id="confirmpwd" placeholder="password again" />
							</div>
						</div>
						<div class="col-sm-offset-2 col-sm-10">
							<input class="btn" type="button" value="Register" onclick="return regformhash(this.form, this.form.username, this.form.email, this.form.password, this.form.confirmpwd);" /> 
						</div>
					</form>
					
					
<p>Go to the <a href="staff_login.php">login page</a>.</p>
				
			
				</div>
				<div class="col-md-2">
					<!--This is the right sidebar area-->
					
				
				</div>
				
				
			</div>
			
		</div>

		
	</body>
</html>
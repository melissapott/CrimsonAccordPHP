<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE-edge">
		<meta name="viewport" content="width=device-width, initial-scale=1"> 
		<title>The New Amsterdam Times</title>
		<link href='http://fonts.googleapis.com/css?family=Orbitron:500,700,900,400' rel='stylesheet' type='text/css'>
		<link href="https://fonts.googleapis.com/css?family=Merriweather" rel="stylesheet">
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		<link rel="stylesheet" type="text/css" href="../css/news.css">
		<link rel="stylesheet" href="css/blueimp-gallery.min.css">
		
	</head>
	<body>
		<div class="container">

			<nav class="navbar navbar-default col-md-12">
				<div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="/news/index.php">The New Amsterdam Times Online</a>
					</div>

				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav navbar-right">
						<li><a href="/news/index.php">Current Issue</a></li>
						<li><a href="#">Full Archives</a></li>
						<li><a href="newscontact.html">Contact Us</a></li>
					</ul>
				</div><!-- /.navbar-collapse -->
				</div><!-- /.container-fluid -->
			</nav>

<?php 
	include_once $_SERVER['DOCUMENT_ROOT']."/includes/file_functions.php"; 
	newspaperArchives($mysqli);
	?>


		</div> <!-- end container -->
	</body>
</html>
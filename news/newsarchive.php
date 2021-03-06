<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE-edge">
		<meta name="viewport" content="width=device-width, initial-scale=1"> 
		<title>New Amsterdam Times Archive</title>
		<link href='http://fonts.googleapis.com/css?family=Orbitron:500,700,900,400' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Share+Tech+Mono' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		<script type='text/javascript' src='http://code.jquery.com/jquery-1.10.2.min.js'> </script>
		<script src="/js/crawler.js" type="text/javascript"></script>
		<link rel="stylesheet" type="text/css" href="news.css">

	</head>
	<body>
	
	<div class="container">
		<div class="row dateline"> <!-- dateline section -->
			<div class="col-md-6" align="left">
			New Amsterdam Times - Historical Archives
			</div>
			<div class="col-md-6" align="right">
			
			</div>
		</div>
		<!-- end dateline div section -->
		<div class="row center"> <!-- header banner section -->
			<br>
			<p>
			<img src="/images/news/banner.gif" class="img-responsive" alt="The New Amsterdam Times"></img>
			</p>
		</div>
		<!-- end header banner section --></!-->

this is where we need the archive list
		<div class="row">
			<br></br>
			<div class="marquee" id="newscrawler">
				
				<span class="stockup">AY 23.29 +0.87 AYK 23.22 +0.21 </span>
				<span class="stockdown">AO 7.53 -0.13 </span>
				<span class="stockup">CKZ 82.90 +0.99 TMG 15.14 +0.02</span>
				<span class="stockdown">UAL 57.15 -0.68 UBCP 8.26 -0.38</span>
				
			</div>
		</div>
		
		<div class="row"><br></br></div>
		
		
		
		<nav class="navbar navbar-default">
			<div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#">The New Amsterdam Times Online</a>
				</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li><a href="index.html">Top Stories</a></li>
					<li><a href="news2.html">City Beat</a></li>
					<li><a href="news3.html">Society Pages</a></li>
					<li><a href="news404.html">Sports</a></li>
					<li><a href="newscontact.html">Contact Us</a></li>
					<li class="current-menu-item"><a href="newsarchive.php">Archives<span class="sr-only">(current)</span></a></li>
       
				</ul>

 
			</div><!-- /.navbar-collapse -->
			</div><!-- /.container-fluid -->
		</nav>

  
   </div>



	
	<script type="text/javascript">
		marqueeInit({
			uniqueid: 'newscrawler',
			style: {
				
				'height': '30px',
				'background': 'black',
				//'border': '1px solid #CC3300',
				'vertical-align': 'middle',
				
			},
		inc: 5, //speed - pixel increment for each iteration of this marquee's movement
		mouse: 'pause', //mouseover behavior ('pause' 'cursor driven' or false)
		moveatleast: 2,
		neutral: 150,
		persist: true,
		savedirection: true
		});
	</script>
		
	</body>
</html>
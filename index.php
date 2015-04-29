<!DOCTYPE html>
<html>

<head>
  <title>Xiaochen Zhuo's Home</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
  <style>
      #map-canvas {
        width: 300px;
        height: 270px;
      }
  </style>
  <script src="https://maps.googleapis.com/maps/api/js"></script>
  <script>
      function initialize() {
        var mapCanvas = document.getElementById('map-canvas');
        var mapOptions = {
          center: new google.maps.LatLng(36.991412,-122.060872),
          zoom: 12,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        var map = new google.maps.Map(mapCanvas, mapOptions)
      }
      google.maps.event.addDomListener(window, 'load', initialize);
  </script>
</head>


<body>
	<nav class="navbar navbar-default" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
     		<a class="navbar-brand" href="index.php"><p>Home</p></a>
    		</div>
      		<ul class="nav navbar-nav navbar-right">
        		<li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
        		<li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
			</ul>
   	 	</div>
	</nav>	
	<div class="container">
		<div class="jumbotron">
			<FONT FACE="modern"><h1 FACE="modern">Xiaochen Zhuo</h1></FONT>
		</div>
		
		<div class="row">
			<div class="col-sm-4">
				<h3>UC Santa Cruz is home.</h3>
				<div id="map-canvas"></div>
			</div>
			<div class="col-sm-4">
				<br>
				<h3>You are the
				<?php
				/* counter */
				//opens countlog.txt to read the number of hits
				$datei = fopen("/home/xiaobytg/public_html/data/countlog.txt","r");
				$count = fgets($datei,100);
				fclose($datei);
				$count=$count + 1 ;
				echo "$count-th";
				// opens countlog.txt to change new hit number
				$datei = fopen("/home/xiaobytg/public_html/data/countlog.txt","w");
				fwrite($datei, $count);
				fclose($datei);
				?>
				visitor.</h3>
				<p>Welcome.</p>
				<p>This site is being built by a CS graduate student came from China 
				two years ago, who has spent this precious two years studying useless 
				things.</p>
				<p>Now he has to teach himself some web development skills in
				order to get a job in CA so that he won't get dumped by his girlfriend,
				 at least for the moment.</p>
				<p>More features will be available.</p>
				<p align="right">4/26/2015</p>
				
			</div>
			<div class="col-sm-4">
				<br><br>
				<a href="/about/about.html" target="_blank" style="text-decoration:none;"> 
						<button type="button" class="btn btn-info btn-block">
							<h1> Projects</h1>
						</button>
				</a>
				<br>
				<br>
				<button type="button" class="btn btn-info btn-block" data-toggle="modal" data-target="#myModal">
 					<h1> Contact</h1>
				</button>
				<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  				<div class="modal-dialog">
    			<div class="modal-content">
      			<div class="modal-header">
       			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
       			<h3 class="modal-title" id="myModalLabel" align="center">Contact</h3>
     			</div>
      			<div class="modal-body">
       			<p>Email: xiaochenzhuo03@163.com</p>
       			<p>Phone: (+1)8312392778</p>
       			<p><a href="https://github.com/xiaochenzhuo03">Github: xiaochenzhuo03<a></p>
      			</div>
      			<div class="modal-footer">
      			</div>
   				</div>
 			    </div>
 			    </div>
			</div>
	<br>
	<br>
		</div>
	<footer id="foot01"></footer>
	<script src="script.js"></script>
	</div>
</body>

</html>
<?php	
	session_start();
	$host = $_SERVER["HTTP_HOST"];
  $path = rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
	if (!isset($_SESSION["authenticated"]) || $_SESSION["authenticated"] != true){
    header("Location: http://$host$path/index.php");
    exit;
	}
	$title = "Trade Center: Buy";
	include("../include/header.php");
?>
	
	
	
	
  </head>
	<body>
	
	<div align="center">
  		<h1>Trade Center: Buy</h1>
  </div>
  <font size=4>
  <div align="right">
  	<?php 
  		echo "welcome, ".htmlspecialchars($_SESSION["user"])."&nbsp&nbsp&nbsp&nbsp<br>";
  		echo "<a href =\"portfolio.php\"><u>my account</u></a>&nbsp|&nbsp";
  		echo "<a href=\"../logout.php\"><u>log out</u></a> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
  	?>
  </div>
  </font>
  <br><br><br>
  <div class="col-sm-4">
  </div>
	<div class="col-sm-4" align="center">
		<div align="center">
			 <p>We will charge <font color="green">0.099%</font> on all transaction.</p>
		<br>
		</div>
	</div>
	
	<div class="col-sm-4" align="center">
	</div>

<?
	include("../include/footer.php");
?>

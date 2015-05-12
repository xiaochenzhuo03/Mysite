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
	include("price.php");
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
  		echo "<a href =\"../home.php\" target=\"_blank\"><u>Home</u></a>&nbsp|&nbsp";
  		echo "<a href =\"portfolio.php\"><u>my account</u></a>&nbsp|&nbsp";
  		echo "<a href=\"../logout.php\"><u>log out</u></a> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
  	?>
  </div>
  </font>
  <br><br><br>
  
  
  <div class="col-sm-4">
  	<?
	





		?>
  </div>
	<div class="col-sm-4">
		<div>
			 <p>We will charge <font color="green">0.099%</font> on all transaction.</p>
		</div>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" id="price" method="POST">
			<br>
			<input type="text" name="stockID" size="40" placeholder=" Enter Symbol "> <br><br>
			<input type="text" name="stockVolume" size="40" placeholder=" Enter Volume: multiply of 100 ">
			<br><br>
			<input class="btn btn-default btn-clock" size="30" type="submit" value="Check">
		</form>

	</div>
	
	<div class="col-sm-4" align="center">
	</div>

<?
	include("../include/footer.php");
?>

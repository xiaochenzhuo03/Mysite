<?php	
	session_start();
	$host = $_SERVER["HTTP_HOST"];
  $path = rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
	if (!isset($_SESSION["authenticated"]) || $_SESSION["authenticated"] != true){
    header("Location: http://$host$path/index.php");
    exit;
	}
	$title = "Home";
	include("include/header.php");
?>
	
	
	
	
  </head>
	<body>
	
	<div align="center">
  		<h1>Xiaochen's Stock Exchange</h1>
  </div>
  <font size=4>
  <div align="right">
  	<?php 
  		echo "welcome, ".htmlspecialchars($_SESSION["user"])."&nbsp&nbsp&nbsp&nbsp<br>";
  		echo "<a href =\"trade/portfolio.php\"><u>my account</u></a>&nbsp|&nbsp";
  		echo "<a href=\"logout.php\"><u>log out</u></a> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
  	?>
  </div>
  </font>
  <br><br><br>
  <div class="col-sm-4">
  	<div align="center">
  	<h2>Search</h2>
  	</div>
  	<br>
  	<br>
  <div align="center">
  	<form action="trade/price.php" id="price" method="POST">
			<br>
			<input type="text" name="stockID" size="30" placeholder=" Enter Symbol ">  
			<input class="btn btn-default" type="submit" value="Look up">
		</form>
	</div>
	 &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
	 You may search for the symbol
  		<a href="http://finance.yahoo.com" target="_blank"><u>here</u></a>.
  <?
  require ("trade/price.php")
  ?>
	</div>
	<div class="col-sm-4" align="center">
		<h2>Buy&Sell</h2>
	</div>
	<div class="col-sm-4" align="center">
		<h2>Rank</h2>
	</div>
<?
	include("include/footer.php");
?>

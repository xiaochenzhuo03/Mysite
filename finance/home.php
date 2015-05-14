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
	require_once("control/model.php");
	require ('trade/refresh.php');
?>
	
	
	
	
  </head>
	<body>
	<div align="center">
  		<h1>Xiaochen's Stock Exchange</h1>
  </div>
  <br>
  <font size=4>
  <div align="right">
  	<?php 
  		echo "welcome, ".htmlspecialchars($_SESSION["user"])."&nbsp&nbsp&nbsp&nbsp<br>";
  		echo "<a href =\"trade/portfolio.php\" target=\"_blank\"><u>My account</u></a>&nbsp|&nbsp";
  		echo "<a href=\"logout.php\" target=\"_blank\"><u>Log out</u></a> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
  	?>
  </div>
  </font>
  
  
  
  
  

  <div class="col-sm-4">
  	<div align="center">
  	<h2>Search</h2>
  	</div>
  	
  

	<?
	require ("trade/search.php");
	?>
	</div>

	<div class="col-sm-4" align="center">
		<h2>Trade Center</h2>
		<br>
		<div align="center">
			<p>We will charge <font color="green">0.099%</font>&nbsp (or a minimum of <font color="green">$50</font> )&nbsp on all transaction. All fee will go to <font color="blue">xiaochenzhuo</font>'s account.</p>
		<br>
		<a href="trade/buy.php" role="button" class="btn btn-primary" target="_blank" ><h4>Buy Stock</h4></a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
		<a href= "trade/sell.php" role="button" class="btn btn-primary" target="_blank"><h4>Sell Stock</h4></a>
		</div>
	</div>
	
	<div class="col-sm-4" align="center">
		<h2>Hall of Fame</h2>
		<br><br>
		<?
			require ('trade/rank.php');
		?>
	</div>

<?
	include("include/footer.php");
?>

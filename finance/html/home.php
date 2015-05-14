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
  <br>
  <div class="col-sm-4">
  	<div align="center">
  	<h2>Search</h2>
  	</div>
  <div align="center">
  	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" id="price" method="POST">
			<br>
			<input type="text" name="stockID" size="40" placeholder=" Enter Symbol ">  
			<input class="btn btn-default" type="submit" value="Look up">
		</form>
	</div>
	 &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
	 You may search for the symbol
  		<a href="http://finance.yahoo.com" target="_blank"><u>here</u></a>.
	<div>
	</div>
	<div align = "center">
<?
	require ("trade/price.php");
	require ("include/connect.php");
	if (isset($_POST["stockID"])){
		if ($_POST["stockID"]==""){
			echo "Please Enter A Symbol";
		}	elseif ($stock["last_trade"] == 'N/A'){
			echo "No such stock!!";
		} else {
			echo "<table border=\"1\" style=\"width:100%\" align=\"center\">";
			echo "<tr><td>Symbol</td><td>Price</td><td>Name</td></tr>";
			echo "<tr><td>".$stock_symbol."</td>";
			echo "<td>".$stock_price."</td>";
			echo "<td>".$company_name."</td></tr>";
			echo "</table>";
			echo "<br>";
			include('include/checkstock.php');
			echo "<div align=\"left\">";
			echo "you owns <font color = \"green\"> ".$own."</font> shares of this stock."."<br>";
			echo "<br>";
			echo "you have <font color = \"green\">".$money."</font> dollars "."<br>";
			echo "<br>";
			echo "you can buy total <font color = \"green\"> ".$n." </font>shares of this stock <br>"; 
			echo "<br>";
			echo "transaction fee will be <font color = \"red\"> ".$fee." </font> dollars";
			echo "</div>";
		}
	}
	?>
	</div>
	</div>
	<div class="col-sm-4" align="center">
		<h2>Trade Center</h2>
		<br>
		<div align="center">
			<p>We will charge <font color="green">0.099%</font> on all transaction.</p>
		<br>
		<a href="trade/buy.php" role="button" class="btn btn-primary" target="_blank" ><h4>Buy Stock</h4></a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
		<a href= "trade/sell.php" role="button" class="btn btn-primary" target="_blank"><h4>Sell Stock</h4></a>
		</div>
	</div>
	
	<div class="col-sm-4" align="center">
		<h2>Rank</h2>
		<br><br>
		<?
			require ('trade/rank.php');
		?>
	</div>

<?
	include("include/footer.php");
?>

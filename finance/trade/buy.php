<?php	
	session_start();
	$host = $_SERVER["HTTP_HOST"];
  $path = rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
	if (!isset($_SESSION["authenticated"]) || $_SESSION["authenticated"] != true){
    header("Location:http://xiaochenzhuo.com/finance/index.php");
    exit;
	}
	$title = "Trade Center: Buy";
	include("../include/header.php");
	require_once("../control/model.php");
	require ('refresh.php');
	include("price.php");
	$_SESSION[flag]=0;
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
  		echo "<a href =\"portfolio.php\" target=\"_blank\"><u>My account</u></a>&nbsp|&nbsp";
  		echo "<a href=\"../logout.php\" target=\"_blank\"><u>Log out</u></a> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
  	?>
  </div>
  </font>
  <br>
<div class="col-sm-4">
<div align = "center">
<?
include("display.php");
if (isset($_POST["stockID"])){
	if ($_POST["stockID"]==""){
		echo "Please Enter A Symbol";
	}	elseif ($stock["last_trade"] == 'N/A'){
			echo "No such stock!!";
	} else {
			echo "<br>";
			echo "<table border=\"1\" style=\"width:100%\" align=\"center\">";
			echo "<tr><td>Symbol</td><td>Price</td><td>Name</td></tr>";
			echo "<tr><td>".$stock_symbol."</td>";
			echo "<td>".$stock_price."</td>";
			echo "<td>".$company_name."</td></tr>";
			echo "</table>";
			echo "<br>";
			require ("../include/connect.php");
			include('../include/checkstock.php');
			echo "<div align=\"left\">";
			echo "You can buy another <font color = \"green\"> ".$n." </font>shares of <font color=\"blue\">"." \"".$stock_symbol."\"".".</font>". "<br>"; 
			$ok_to_submit = 0;
			if (isset($_POST['volume'])){
				if ($_POST['volume']%100 != 0){
					echo "<font color=\"red\">You can only buy muliply of 100 shares of stock, please re-enter volume</font>.";
				} elseif ($_POST['volume']<0){
				echo "Don't even think of it :)";
				} 
				else{
					$total = $stock_price*$_POST['volume']*1.00099;
					$total = round($total,2);
					$fee = $stock_price*$_POST['volume']*0.00099;
					$fee = round($fee, 2);
					if ($fee <50){$fee = 50;}
					if ($total > $money){
						echo "<font color=\"red\">Sorry you don't have enough money to buy ".$_POST['volume']." shares of</font> <font color=\"blue\">"." \"".$stock_symbol."\""."</font>";
					} else {
						echo "Buying ".$_POST['volume']." shares of \""."<font color=\"blue\">".$stock_symbol."</font>"."\" will cost you 
						<font color = \"green\">$".$total." </font>Including <font color = \"red\">$"
						.$fee." </font> transaction fee. (number might be different in final transaction)";
						$_SESSION[flag]=1;
					}
				}
			}
			echo "</div>";
	}
}
?>
</div>
</div>
	<div class="col-sm-4" align="center">

		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" id="price" method="POST">
			<br>
			<input type="text" name="stockID" size="35" placeholder=" Enter Symbol "><br><br><br> 
			<input type="text" name="volume" size="35" placeholder=" Enter Volume: multiple of 100 ">
			<br><br><br>
			<input class="btn btn-primary btn-clock" size="40" type="submit" value="Check">
		</form>
		<br>
		<br>

	</div>
	<div class="col-sm-4" align="left">
<?
	if($_SESSION[flag]==1){
	echo "<P><font size=\"4\"><h3>Your Order: Buy</h3></font></P><br>";
	echo "<div align=\"left\">";
	echo "Stock Symbol: <font color=\"blue\">".$stock_symbol."</font>";
	$_SESSION[symbol]=$stock_symbol;
	echo "<br>";
	echo "Price: <font color=\"blue\">$" .$stock_price."</font>";
	$_SESSION[price]=$stock_price;
	echo "<br>";
	echo "Volume: ".$_POST['volume'];
	$_SESSION[volume]=$_POST['volume'];
	echo "<br>";
	echo "Transaction fee: "."<font color=\"red\">$".$fee."</font>";
	$_SESSION[fee]=$fee;
	echo "<br>";
	echo "Total: $"."<font color=\"green\">".$total."</font>";
	$_SESSION[total]=$total;
	echo "</div>";
	echo "<div align=\"center\">";
	echo "</div>";
	echo "<br>";
	echo "<br>";
	echo "<div align=\"left\">";
	echo "<form action=\"buy_stock.php\" method=\"post\">";
	echo "<input type='hidden' name='symbol' value=\"$stock_symbol\"> ";
	echo "<input class=\"btn btn-primary btn-danger\" size=\"40\" type=\"submit\" name=\"submit1\" value=\"Place Order\" >";
	echo "</form>";
	echo "</div>";
	}
?>


	</div>

<?
	include("../include/footer.php");
?>

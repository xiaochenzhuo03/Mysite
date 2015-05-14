<?php	
	session_start();
	$host = $_SERVER["HTTP_HOST"];
  $path = rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
	if (!isset($_SESSION["authenticated"]) || $_SESSION["authenticated"] != true){
    header("Location:http://xiaochenzhuo.com/finance/index.php");
    exit;
	}
	$title = "Trade Center: Sell";
	include("../include/header.php");
	require_once("../control/model.php");
	require ('refresh.php');
	include("price.php");
	$_SESSION[flag]=0;
?>
	

  </head>
	<body>
	
	<div align="center">
  		<h1>Trade Center: Sell</h1>
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
  <br><br><br>
<div class="col-sm-4">
<?
require ("display.php");
?>
</div>










<div class="col-sm-4" align="center">
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" id="price" method="POST">
			<br>
			<input type="text" name="stockID" size="35" placeholder=" Enter Symbol "><br><br>
			<input type="text" name="volume" size="35" placeholder=" Enter Volume: multiple of 100 ">
			<br><br><br>
			<input class="btn btn-primary btn-clock" size="40" type="submit" value="Check">
</form>
</div>
<?
if (isset($_POST['stockID']) and isset($_POST['volume'])){
	$conn = connect_database();
	$table = "portfolio_".$_SESSION['userid'];
	$symbol = $_POST['stockID'];
	$sql = "select $table.stocksymbol, share, stockprice from $table join stock_list where $table.stocksymbol = stock_list.stocksymbol and stock_list.stocksymbol ='$symbol'";
	$stmt = $conn->query($sql);
	$result = $stmt->fetch();
	$stock = $_POST['stockID'];
	$price = $result['stockprice'];
	$volume = $_POST['volume'];
	if (empty($result)){
		echo "You don't own this stock";
		}elseif ($_POST['volume']<0){
		echo "Don't even think of it :)";
		}
		else if ($volume > $share ){
		echo " You only own&nbsp ".$share."shares of <font color=\"blue\">".$symbol."<\font>";
	}else{
		$total = $price*$volume*(1-0.00099);
		$total = round($total,2);
		$fee = $price*$volume*0.00099;
		$fee = round($fee, 2);
		if ($fee <50){$fee = 50;}
		$_SESSION[flag]=1;
		}
	}
?>




















<div class="col-sm-4">
<?
	if($_SESSION[flag]==1){
	echo "<P><font size=\"4\"><h3>Your Order:Sell</h3></font></P><br>";
	echo "<div align=\"left\">";
	echo "Stock Symbol: <font color=\"blue\">".$symbol."</font>";
	$_SESSION[symbol]=$symbol;
	echo "<br>";
	echo "Price: <font color=\"blue\">$" .$price."</font>";
	$_SESSION[price]=$price;
	echo "<br>";
	echo "Volume: ".$_POST['volume'];
	$_SESSION[volume]=$volume;
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
	echo "<form action=\"sell_stock.php\" method=\"post\">";
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

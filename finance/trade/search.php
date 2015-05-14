<div align="center">
  	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" id="price" method="POST">
			<br>
			<input type="text" name="stockID" size="40" placeholder=" Enter Symbol ">  
			<input class="btn btn-default" type="submit" value="Look up">
		</form>
</div>
	 &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
	 You may search the symbol
  		<a href="http://finance.yahoo.com" target="_blank"><u>here</u></a>.
<div align = "center">
<?
	echo "<br>";
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
			echo "you can buy another <font color = \"green\"> ".$n." </font>shares of this stock <br>"; 
			echo "transaction fee will be <font color = \"red\"> ".$fee." </font> dollars";
			echo "</div>";
		}
	}
	?>
	</div>
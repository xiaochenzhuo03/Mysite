<?php
$conn = connect_database();

//update stock_list
foreach($conn->query("SELECT * FROM stock_list ") as $row) {
	$symbol = $row['stocksymbol'];
	$stock = get_quote_data($symbol);
	$price=$stock["last_trade"];
	$price=round($price,2);
	$conn->query("update stock_list set stockprice = '$price' where stocksymbol = '$symbol'");	
}

//update user using portfolio 
foreach($conn->query("SELECT userid FROM user ") as $row1) {
	$table = "portfolio_".$row1[userid];
	$total1 = 0;
	foreach($conn->query("SELECT * FROM $table where 1 ") as $row2){
		$symbol = $row2['stocksymbol'];
		$volume = $row2['share'];
		$temp = $conn->query("SELECT stockprice FROM stock_list where stocksymbol='$symbol'");
		$row = $temp->fetch();
		$price = $row['stockprice'];
		$total1 = $total1 + $volume*$price;
	}
		$temp = $conn->query("SELECT money FROM user where userid = '$row1[userid]'");
		$row = $temp->fetch();
		$cash = $row['money'];
		$total1 = $total1 +$cash;
		$conn->query("UPDATE user SET total = '$total1' WHERE userid = '$row1[userid]'");
}
?>
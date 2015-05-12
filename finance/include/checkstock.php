<?php
	$table = "portfolio_".$_SESSION['userid'];
	$table = (string)$table;
	$symbol = strtolower($stock_symbol);
	$query = "SELECT share FROM ".$table." WHERE stocksymbol='".$symbol."'";
	$stmt = $conn->prepare($query);
  $stmt->execute();
	$result = $stmt->fetch(PDO::FETCH_ASSOC);
	if ($stmt->rowCount() > 0){
		$own=$result[share];
	}else{
		$own=0;
	}
	$id = $_SESSION['userid'];
	$stmt = $conn->prepare("select money from user where userid = '$id'");
  $stmt->execute();
	$result = $stmt->fetch(PDO::FETCH_ASSOC);
	$money = $result[money];
	$n = intval(
	($money/($stock_price*1.00099))/100
	)*100;
	$fee = $n*$stock_price*0.099/100;
	$fee = round($fee,2);
?>
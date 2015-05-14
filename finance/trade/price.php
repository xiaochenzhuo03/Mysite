<?php
if (!isset($_SESSION["authenticated"]) || $_SESSION["authenticated"] != true){
    header("Location: http://$host$path/index.php");
    exit;
}

$temp = test_input($_POST["stockID"]);
$stock = get_quote_data($temp);

if (isset($_POST["stockID"])){
	if ($stock["last_trade"] == 'N/A'){
		$no_stock = 1;
	} else {
		$stock_symbol=$stock["symbol"];
		$stock_symbol = strtolower($stock_symbol);
		$stock_price=$stock["last_trade"];
		$company_name=$stock["name"];
	}
}
?>
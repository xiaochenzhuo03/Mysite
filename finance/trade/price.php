<?php
if (!isset($_SESSION["authenticated"]) || $_SESSION["authenticated"] != true){
    header("Location: http://$host$path/index.php");
    exit;
}
function get_quote_data($symbol)
{
	$result = array();
	$url = "http://download.finance.yahoo.com/d/quotes.csv?s={$symbol}&f=sl1n&e=.csv";
	$handle = fopen($url, "r");
	if ($row = fgetcsv($handle))
		if (isset($row[1]))
			$result = array("symbol" => $row[0],
							"last_trade" => $row[1],
							"name" => $row[2]);
	fclose($handle);
	return $result;
}

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}

$temp = test_input($_POST["stockID"]);
$stock = get_quote_data($temp);

if (isset($_POST["stockID"])){
	if ($stock["last_trade"] == 'N/A'){
		$no_stock = 1;
	} else {
		$stock_symbol=$stock["symbol"];
		$stock_price=$stock["last_trade"];
		$company_name=$stock["name"];
	}
}
?>
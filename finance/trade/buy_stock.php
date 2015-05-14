<?php
	session_start();
	if ($_SESSION[flag]==0){
	header("Location: http://xiaochenzhuo.com/finance/trade/buy.php");
	}
	$_SESSION[flag]=0;
	$symbol=$_SESSION[symbol];
	$price=$_SESSION[price];
	$price=round($price,2);
	$volume=$_SESSION[volume];
	$fee=$_SESSION[fee];
	$total=$_SESSION[total];
	$userid=$_SESSION[userid];
	include ("../include/header.php");
	require_once("../control/model.php");	
	$conn = connect_database();		
	
//update stock_list
	$sql1 = "update stock_list set stockprice = '$price' where stocksymbol='$symbol'";
	$sql2 = "insert into stock_list (stocksymbol, stockprice) values ('$symbol','$price')";
	$stmt = $conn->query("SELECT * FROM `stock_list` where stocksymbol='$symbol'");
	
	if ($stmt->rowCount()>0){
    $conn->exec($sql1);} 
    else {
		$conn->exec($sql2);
		}

//update portfolio	
	$table = "portfolio_".$userid;
	$sql3 = "select share from $table where stocksymbol = '$symbol'";
	$stmt = $conn->query($sql3);	
	$sql2 = "insert into $table (stocksymbol, share) values ('$symbol','$volume')";	
	if ($stmt->rowCount()>0){
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		$share = $result[share];
		$share = $share+$volume;
		$sql1 = "update $table set share = '$share' where stocksymbol='$symbol'";
    $conn->exec($sql1);} 
    else {
		$conn->exec($sql2);
		}

//update user
$sql1 = "update user set money = round((money-'$total'),2),total = round((total-'$fee'),2) where userid='$userid'";
$conn->exec($sql1);


//update xiaochen's account
$sql1 = "update user set money = round((money+'$fee'),2),total = round((total+'$fee'),2) where userid='xiaochenzhuo'";
$conn->exec($sql1);






?>


  </head>
	<body>
<div align="center">
	<h1><font color="Green">
	Order placed !
	</font></h1>
</div>

<div class="col-sm-4">
<br>
</div>
<div  class="col-sm-4">
<br>
<div align="left">
<br>
<p> you've bought
<?
echo $volume." shares of <font color=\"blue\">".$symbol."</font> with <font color=\"red\">$";
echo $total."</font> including <font color=\"red\">$".$fee."</font> fee.";
?>
</div>
<br>
	<a class="btn btn-primary btn-block" size="35" href="portfolio.php" target="_blank">My portfolio</a>
	<a class="btn btn-primary btn-block" size="35" href="../home.php" target="_blank">Home</a>
</div>
<div class="col-sm-4">
<br>
</div>

<?
include ("../include/footer.php");
?>
<?php
	session_start();
	if ($_SESSION[flag]==0){
	header("Location: http://xiaochenzhuo.com/finance/trade/sell.php");
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
	
//update portfolio	
	$table = "portfolio_".$userid;
	$sql3 = "select share from $table where stocksymbol = '$symbol'";
	$stmt = $conn->query($sql3);	
	$result = $stmt->fetch(PDO::FETCH_ASSOC);
	$share = $result[share];
	$share = $share-$volume;
	$sql1 = "update $table set share = '$share' where stocksymbol='$symbol'";
  $conn->exec($sql1);

//update user
$sql1 = "update user set money = round((money+'$total'),2),total = round((total-'$fee'),2) where userid='$userid'";
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
<p> You've sell
<?
echo $volume." shares of <font color=\"blue\">".$symbol."</font>, you get <font color=\"red\">$";
echo $total."</font> , you paid <font color=\"red\">$".$fee."</font> transaction fee.";
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
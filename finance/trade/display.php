<?php

require_once("../control/model.php");
require ('refresh.php');

$conn= connect_database();
$id = $_SESSION['userid'];
$table = "portfolio_".$id;
?>

<div align="left">
<?
$conn=connect_database();
$temp = $conn->query("SELECT * FROM `user` where userid = '$id'");
$row = $temp->fetch();
$cash=$row['money'];
$total = $row['total'];
?>
<h5>
Total Balance:
<?
echo "<font color=\"red\">$";
echo $total;
echo "</font>";	
?>
 <br>Cash:
<?
echo "<font color=\"green\">$";
echo $cash;
echo "</font>";	
?> 
</h5>
</div>

<div align="left">
</div>
<div align="center">
<?
$conn=connect_database();
echo "<table border=\"1\" style=\"width:100%\" align=\"center\">";
echo "<tr><td>Stock</td><td>Share</td><td>Price</td><td>Value</td></tr>";
$sql1 = "select * from $table ";
foreach ($conn->query($sql1) as $row){
		$symbol = $row['stocksymbol'];
		$share = $row ['share'];
		$sql2 = "select stockprice from stock_list where stocksymbol = '$symbol'";
		$stmt = $conn->query($sql2);
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		$price = $result['stockprice'];
		echo "<tr><td><font color=\"blue\">".$symbol."</font></td>";
		echo "<td>".$share."</td>";
		echo "<td><font color=\"red\">$".$price."</font></td>";
		echo "<td><font color=\"red\">$".$price*$share."</font></td></tr>";
  }
  echo "</table>";



?>
</div>


<br>
<div align="left">
</div>
<div align="center">
</div>



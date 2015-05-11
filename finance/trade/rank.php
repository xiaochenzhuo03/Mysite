<?php

	if (!isset($_SESSION["authenticated"]) || $_SESSION["authenticated"] != true){
    header("Location: http://$host$path/index.php");
    exit;
	}
	$DB_HOST = "localhost";
	$DB_NAME = "xiaobytg_f";
	$DB_USERNAME = "xiaobytg_God";
	$DB_PASSWORD = "0332005b";
	$conn = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", $DB_USERNAME, $DB_PASSWORD);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $results = $conn->query("SELECT  `username`, `total` FROM `user` order by 'total' limit 6");
  echo "<table border=\"1\" style=\"width:100%\" align=\"center\">";
	echo "<tr><td>Rank</td><td>Name</td><td>Total Balance</td></tr>";
	$n = 1;
	foreach ($results as $result){
		echo "<tr><td>".$n."</td>";
		echo "<td>".$result["username"]."</td>";
		echo "<td>".$result["total"]."</td></tr>";
		$n=$n+1;
  }
  echo "</table>";

?>
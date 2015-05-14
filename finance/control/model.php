<?php

function check_logged() {
	if (!isset($_SESSION["authenticated"]) || $_SESSION["authenticated"] != true){
    header("Location: http://$host$path/../index.php");
    exit;
	}
}
	
function connect_database(){
	$DB_HOST = "localhost";
	$DB_NAME = "xiaobytg_f";
	$DB_USERNAME = "xiaobytg_God";
	$DB_PASSWORD = "0332005b";
	$conn = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", $DB_USERNAME, $DB_PASSWORD);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  return $conn;
}

function display_rank(){
	$results = $conn->query("SELECT  `username`, `total` FROM `user` order by 'total' limit 10");
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
}

function create_session(){
		$_SESSION["authenticated"] = true;
    $_SESSION["user"] = $user;
    $stmt = $conn->prepare("select userid from user where username = '$user'");
  	$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		$_SESSION["userid"] = $result[userid];
		setcookie("user", $_POST["user"], time() + 7 * 24 * 60 * 60);
}

function go_to_homepage(){
	$host = $_SERVER["HTTP_HOST"];
  $path = rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
  header("Location: http://$host$path/html/home.php");
  exit; 	
}

function go_to_index(){
	$host = $_SERVER["HTTP_HOST"];
  $path = rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
  header("Location: http://$host$path/../index.php");
  exit; 	
}
		
function display_user_bar(){
	echo"<font size=4><div align=\"right\">";
	echo "welcome, ".htmlspecialchars($_SESSION["user"])."&nbsp&nbsp&nbsp&nbsp<br>";
  echo "<a href =\"../home.php\" target=\"_blank\"><u>Home</u></a>&nbsp|&nbsp";
  echo "<a href =\"portfolio.php\"><u>my account</u></a>&nbsp|&nbsp";
  echo "<a href=\"../logout.php\"><u>log out</u></a> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
  echo"</div></font>";
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



?>
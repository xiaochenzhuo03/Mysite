<?
	session_start();
	$host = $_SERVER["HTTP_HOST"];
  $path = rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
  
	$DB_HOST = "localhost";
	$DB_NAME = "xiaobytg_f";
	$DB_USERNAME = "xiaobytg_God";
	$DB_PASSWORD = "0332005b";
	$conn = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", $DB_USERNAME, $DB_PASSWORD);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
if (isset($_POST["user"]) && isset($_POST["pass1"])){
	$user = $_POST["user"];
	$pass = $_POST["pass1"];
	$stmt = $conn->prepare("SELECT * FROM user Where username= '$user'");
  $stmt->execute();
  if ($stmt->rowCount() > 0) {
  	$conn = null;
  	header("Location: http://$host$path/register.php");
    exit; 	
		} else {
			//insert userinfo
			$stmt = $conn->prepare("INSERT INTO `user`(`username`, `password`) VALUES ('$user','$pass')");
  		$stmt->execute();
  		
  		//get new userid
  		$stmt = $conn->prepare("select userid from user where username = '$user'");
  		$stmt->execute();
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
			$n = $result[userid];
			$name = "portfolio_".$n;
			$stmt = $conn->prepare("CREATE TABLE $name(
				stockid int(32),
				stockprice double,
				share int(32)
				)");	
			$stmt->execute();	
	
 			$conn = null;
			$_SESSION["authenticated"] = true;
   		$_SESSION["user"] = $_POST["user"];
   		$_SESSION["userid"] = $n;
   		setcookie("user", $_POST["user"], time() + 7 * 24 * 60 * 60);
 			header("Location: http://$host$path/home.php");
  		exit;	
  	}
}
?>
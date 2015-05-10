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
			$stmt = $conn->prepare("INSERT INTO `user`(`username`, `password`) VALUES ('$user','$pass')");
  		$stmt->execute();
  		$conn = null;
			$_SESSION["authenticated"] = true;
   		$_SESSION["user"] = $_POST["user"];
    	setcookie("user", $_POST["user"], time() + 7 * 24 * 60 * 60);
 			header("Location: http://$host$path/home.php");
  		exit;		
	}
}
?>
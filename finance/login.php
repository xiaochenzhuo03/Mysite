<?
	session_start();
	$host = $_SERVER["HTTP_HOST"];
  $path = rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
  if (isset($_SESSION["authenticated"]) && $_SESSION["authenticated"] == true){
    header("Location: http://$host$path/home.php");
    exit;
  }
	$DB_HOST = "localhost";
	$DB_NAME = "xxxxxxx";
	$DB_USERNAME = "xxxxxxxx";
	$DB_PASSWORD = "xxxxxx";
	$conn = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", $DB_USERNAME, $DB_PASSWORD);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
if (isset($_POST["user"]) && isset($_POST["pass"])){
	$user=$_POST["user"];
	$pass=$_POST["pass"];
	$stmt = $conn->prepare("SELECT * FROM user Where username= '$user' and password= '$pass'");
  $stmt->execute();
	$conn = null;
  if ($stmt->rowCount() > 0) {
  	$_SESSION["authenticated"] = true;
    $_SESSION["user"] = $user;
    setcookie("user", $_POST["user"], time() + 7 * 24 * 60 * 60);
    header("Location: http://$host$path/home.php");
    exit; 	
		} else {
 			header("Location: http://$host$path/index.php");
  		exit;		
	}
}
?>

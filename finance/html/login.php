<?
	session_start();
	$host = $_SERVER["HTTP_HOST"];
  $path = rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
  if (isset($_SESSION["authenticated"]) && $_SESSION["authenticated"] == true){
    header("Location: http://$host$path/home.php");
    exit;
  }
	include('include/connect.php');
	
if (isset($_POST["user"]) && isset($_POST["pass"])){
	$user=$_POST["user"];
	$pass=$_POST["pass"];
	$stmt = $conn->prepare("SELECT * FROM user Where username= '$user' and password= '$pass'");
  $stmt->execute();
  if ($stmt->rowCount() > 0) {
  	$_SESSION["authenticated"] = true;
    $_SESSION["user"] = $user;
    $stmt = $conn->prepare("select userid from user where username = '$user'");
  	$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		$conn = null;
		$n = $result[userid];
		$_SESSION["userid"] = $n;
    setcookie("user", $_POST["user"], time() + 7 * 24 * 60 * 60);
    header("Location: http://$host$path/home.php");
    exit; 	
		} else {
 			header("Location: http://$host$path/index.php");
  		exit;		
	}
}
?>

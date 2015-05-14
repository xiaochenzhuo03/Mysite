<? 

    session_start();
    setcookie("user", "", time() - 3600);
    setcookie("pass", "", time() - 3600);
    setcookie(session_name(), "", time() - 3600);
    session_destroy();
?>

<!DOCTYPE html>

<html>
  <head>
    <title>Logged Out</title>
  </head>
  <body>
  	<div align="center">
    <h1>You are logged out!</h1>
    <h3><a href="home.php">home</a></h3>
    </div>
  </body>
</html>

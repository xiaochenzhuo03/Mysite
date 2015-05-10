<?
	session_start();
	$host = $_SERVER["HTTP_HOST"];
  $path = rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
	if (isset($_SESSION["authenticated"]) && $_SESSION["authenticated"] == true){
    header("Location: http://$host$path/home.php");
    exit;
	}
?>
<?php 
	$title = 'Home Page';
	require 'include/header.php';
?>
	<script>
		function validate(){
			var u = document.forms.login.user.value;
			var p = document.forms.login.pass.value;
			var check = document.forms.login.agreement;
			if (u == ""||u.length >32 || u.length<5 ){
				alert("You must provide an username of length 5-32.");
        		return false;
			}
			if (p == ""|| p.length >32 || p.length<5 ){
				alert("You must provide a password of length 5-32 .");
				return false;
   			}
    		else if(!check.checked){
				alert("You must agree to terms and conditions.");
       			return false;
   			}
    		return true;
		}
	</script>
	</head>	
	<body>
	<h1 align="center">Xiaochen Zhuo's Stock exchange</h1>
	<br><br><br>
	<div align="center">
		<form action="login.php" id="login" onsubmit="return validate()" method="POST">
			<br>
			<input type="text" name="user" size="30" placeholder=" Enter Username "><br>
			<br>
			<input type="password" name="pass" size="30" placeholder=" Enter Password ">
			<br><br>
	
			I agree to the terms and conditions: 
			<input name="agreement" type="checkbox"><br><br>
    		
			<input class="btn btn-default" type="submit" value="Log on">
			<a class="btn btn-default" href="register.php">Open An Account</a>
		</form>
	</div>
	
<?php
	require('include/footer.php');
?>

<?php
	$title = "Register";
	require('include/header.php');
?>
<script>
	function validate(){
		var u = document.forms.login.user.value;
		var p1 = document.forms.login.pass1.value;
		var p2 = document.forms.login.pass2.value;
		if (u == ""||u.length >32 || u.length<5 ){
			alert("You must provide an username of length 5-32.");
      return false;
		}	else if(p1!=p2){
				alert("Password are not identical");
       	return false;
   	}	else if (p1 == ""|| p1.length >32 || p1.length<5 ){
			alert("You must provide a password of length 5-32 .");
			return false;
   	}
   	
    return true;
	}
</script>
</head>
<body>
	<div align="center">
  		<h1>New User Registration</h1>
  </div><br><br><br>
  <div align="center">
  	<form action="create.php" id="login" onsubmit="return validate()" method="POST">
			Username:<br>
			<input type="text" name="user" size="30"><br>
	
			Password:<br>
			<input type="password" name="pass1" size="30"><br>
			
			Password(again):<br>
			<input type="password" name="pass2" size="30"><br>
			
			<input class="btn btn-default" type="submit" value="Submit">
		</form>
	</div>
<? require('include/footer.php');?>
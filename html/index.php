<?php
	session_start();
	$_SESSION["user"] = "0" ;
	$now = time();
	if(isset($_SESSION["log_error"])){
		header("Location: error.php");
	}	
	if(isset($_SESSION["lockout_time"])){ 
		$time_passed = $now - $_SESSION["lockout_time"];
		if($time_passed <30){
			$time_left = 30-$time_passed;
			$_SESSION["lockout_error"] = "Too many login attempts. Please wait " . $time_left . " seconds";
			$_SESSION["log_error"]=null;
			$_SESSION["add_error"]=null;

			header("Location: error.php");
		}
		else{
			$_SESSION["lockout_time"]=null;
			$_SESSION["login_fails"]=null;
			$_SESSION["lockout_error"] = null;
		}
	}
?>
<style>
body{
background-image: url("images/bg2.jpg");
background-size:1920px;
}
.login {
border: 5px solid;
margin: auto;
width: 15%;
padding: 10px;
background-color:black;
}
h2 {
color:white;
font-family: Courier New, monospace;
text-align: center;
}
a {
color:white;
font-family: Courier New, monospace;
margin: 0 auto;
display:block;
text-align:center;
}
form {
color:white;
font-family: Courier New, monospace;
}
</style>
<html>
	<head>
		<title>Login</title>
	</head>
	<body>
		<div class=login>
			<h2>User Login</h2><br>
			<form action="index_handler.php" method="post">
				<label>Username:</label><input type="text" name="uname"><br><br>
				<label>Password:</label><input type="password" name="pswd"><br><br>
				<input type="submit">
			</form>
			<br>
			<a href="./newuser.php">New User</a>
		</div>
	</body>
</html>

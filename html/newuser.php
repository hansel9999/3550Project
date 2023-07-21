<style>
body{
background-image: url("images/bg2.jpg");
background-size:1920px;
}
.login {
border: 5px solid;
margin: auto;
width: 20%;
padding: 10px;
background-color:black;
}
.mediation {
color: red;
border: 0px;
margin: auto;
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
		<div class="login">
			<h2>User Registration</h2><br>
			<form action="newuser_handler.php" method="post">
				<label>Username:</label><input type="text" name="uname"><br><br>
				<label>Password:</label><input type="password" name="pswd1" id=password><br><br>
				<h5 id=length_message class=mediation></h5><br>
				<label>Confirm Password:</label><input type="password" name="pswd2" id=confirm><br><br>
				<h5 id=confirm_message class=mediation></h5><br>
				<input type="submit">
			</form>
			<a href="index.php">Return to Login</a>
		</div>
	<script>
		const minLength = 8;
		const maxLenth = 40;
		document.getElementById("password").addEventListener("input", function(){
			const pass1 = this.value;
			const pass2 = document.getElementById("confirm").value;
			const length_msg = document.getElementById("length_message");
			const confirm_msg = document.getElementById("confirm_message");
			if(pass1.length > 40 || pass1.length <8) {
				length_msg.innerText="Password must be between 8 and 40 characters";
			} else {
				length_msg.innerText="";
			}
			if(pass1 !== pass2) {
				confirm_msg.innerText="Passwords do not match";
			} else {
				confirm_msg.innerText="";
			}

		});
		document.getElementById("confirm").addEventListener("input", function(){
			const pass2 = this.value;
			const pass1 = document.getElementById("password").value;
			const confirm_msg = document.getElementById("confirm_message");
			if(pass1 !== pass2) {
				confirm_msg.innerText="Passwords do not match";
			} else {
				confirm_msg.innerText="";
			}
		});
	</script>

	</body>
</html>

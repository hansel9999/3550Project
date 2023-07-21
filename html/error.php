<style>
body{
background-image: url("images/bg2.jpg");
background-size:1920px;
}
a {
color:white;
font-family: Courier New, monospace;
margin: 0 auto;
display:block;
text-align:center;
}
div {
margin: auto;
width: 15%;
height: 25%;
background-color:black;
color:red;
text-align:center;
}
</style>
<html>
<body>
<?php session_start();
?>
<div>
<?php if($_SESSION["add_error"]) : ?>
	<?php echo $_SESSION["add_error"];?>
	<br><br><br><br><br><a href="newuser.php">Try Again</a>
	
<?php endif; ?>
<?php if($_SESSION["log_error"]) : ?>
	<?php echo $_SESSION["log_error"]; $_SESSION["log_error"]=null;?>
	<br><br><br><br><br><a href="index.php">Try Again</a><br>
<?php endif; ?>
<?php if($_SESSION["lockout_error"]) : ?>
	<?php echo $_SESSION["lockout_error"];?>
	<br><br><br><br><br><a href="index.php">Try Again</a>
<?php endif; ?>
</div>
</body>
</html>

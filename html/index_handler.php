<?php
session_start();

$filename = './passhashes.txt';
$targetLine = null;
$_SESSION["log_error"] = null;
$_SESSION["add_error"] = null;
$username = $_POST["uname"];
$password = $_POST["pswd"];

//adding salt to password
$password .= $username;

//computing hash
for ($i=0; $i<10; $i++) {
	$password = hash('sha256', $password);
}

//finding username in file
if (file_exists($filename)) {
    $handle = fopen($filename, 'r');
    if ($handle) {
        while (($line = fgets($handle)) !== false) {
            $line = trim($line);
            $words = preg_split('/\s+/', $line);
	    if (isset($words[0]) && $words[0] === $username) {
	    	$targetLine = $line;
		break; 	
	    }
	}
	fclose($handle);
    }
    else {
	    exit;
    }
}
else {
	exit;

}
//checking if hashes match and directing to main page / sending error message
if ($targetLine !== null) {
	$targetWords = preg_split('/\s+/', $targetLine);
	if (isset($targetWords[1]) && $targetWords[1] === $password) {
		$_SESSION["user"]=1;
		$_SESSION["login_fails"]=null;
		header("Location: ./main.php");
		exit;
	}
	else {
		$_SESSION["log_error"] = "Username or Password not found";
		if(isset($_SESSION["login_fails"])){
			$_SESSION["login_fails"]++;
		}
		else{
			$_SESSION["login_fails"]=1;
		}
		if(isset($_SESSION["login_fails"]) && $_SESSION["login_fails"]>=3){
			$_SESSION["lockout_time"] = time();
		}
		header("Location: index.php");
		exit;
	}
}
else{
	$_SESSION["log_error"] = "Username or Password not found";
	if(isset($_SESSION["login_fails"])){
		$_SESSION["login_fails"]++;
	}
	else{
		$_SESSION["login_fails"]=1;
	}
	if(isset($_SESSION["login_fails"]) && $_SESSION["login_fails"]>=3){
		$_SESSION["lockout_time"] = time();
	}
	header("Location: index.php");
	exit;
}
?>

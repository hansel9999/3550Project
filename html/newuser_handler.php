<?php
session_start();

$filename = './passhashes.txt';
$username = $_POST["uname"];
$hash = $_POST["pswd1"]; 
$check = $_POST["pswd2"];
$_SESSION["log_error"] = null;
$_SESSION["add_error"] = null;

//checking password length
if (strlen($hash) < 8 || strlen($hash)>40){
	$_SESSION["add_error"] = "Password must be between 8 and 40 characters";
	header("Location: error.php");
	exit;
}

//checking if username is taken
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
if ($targetLine !== null) {
	$_SESSION["add_error"] = "Username is already taken";
	header("Location: error.php");
	exit;
}

//checking if both entered passwords match
if($hash !== $check){
	$_SESSION["add_error"] = "Passwords do not match";
	header("Location: ./error.php");
	exit;
}

//salting password
$hash .= $username;

//iterating hash 10 times to deter attacks
for($i=0; $i<10; $i++){
	$hash=hash('sha256', $hash);
}

//adding username and hash to password file
if(file_exists($filename)){
	$handle = fopen($filename, 'a');
	if($handle){
		$entry=$username . " " . $hash . "\n";
		fwrite($handle, $entry);
		fclose($handle);
    	}
    	else{
		exit;
    	}
}
else{
	exit;
}
//redirecting to login page
header("Location: index.php");
?>


<?php
// Login

if (!isset($_SESSION)){
	session_start();
}
require_once "pdo_connect.php";


if (!isset($_SESSION['username'])){
			
	$username = trim($_POST["username"]);
	$password = trim($_POST["password"]);
	
	// http://www.stepblogging.com/php-login-script-using-pdo/
	
	$records = $pdo->prepare("SELECT username,password FROM user WHERE username = :username");
	$records->bindParam(':username', $username);
	$records->execute();
	$results = $records->fetch(PDO::FETCH_ASSOC);
/*	
	echo '//';
	echo $password;
	echo '//';
	echo '--';
	echo $results["password"];
	echo '--';
*/
	if ($password == $results["password"]){
		$_SESSION['username'] = $results['username'];
		//echo "login successful";
		//echo $_SESSION['username'];
		header("refresh:0; url=home.php");
		exit;
		
	}
	else{
		echo "<h4 id='shift_right'>LOGIN FAILED</h4>";
		header("refresh:4; url=home.php");
		exit;
	}
	$pdo = null;
}
else{
	echo "<h4 id='shift_right'>YOU ARE ALREADY LOGGED IN</h4>";
	header("refresh:4; url=home.php");
	exit;
}
?>

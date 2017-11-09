<?php
$user = $_SESSION['username'];
$userTable = $pdo->query("SELECT * FROM User");
while($row = $userTable->fetch(PDO::FETCH_ASSOC)){
	if($row['username'] == $user){
		$userID = $row["userID"];
	}
}
?>
<?php
session_start();				
if (isset($_SESSION['username'])){
	echo '<li class="page-scroll">';
		echo '<a>';
			echo 'Logged in: ';
			echo $_SESSION['username'];
		echo '</a>';
	echo '</li>';
	echo '<li class="page-scroll">';
		echo '<a href="logout_script.php">Logout</a>';
	echo '</li>';
}
?>
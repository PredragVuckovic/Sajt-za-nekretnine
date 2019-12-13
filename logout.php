<?php
	if (isset($_COOKIE['zapamti'])) {
		setcookie('zapamti','',time()-1000,'/');
	}
	session_start();
	session_unset();
	session_destroy();
	header("Location:login.php");
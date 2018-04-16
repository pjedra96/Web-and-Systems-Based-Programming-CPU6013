<?php
	session_start();
	if(isset($_SESSION['username'])){
		unset($_SESSION['username']);  //Is Used To Destroy Specified Session
		session_destroy();
		header('location:../index.html');
		exit();
	}
?>
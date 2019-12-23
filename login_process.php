<?php 
	session_start();
	include "function/myfunction.php";
	include "koneksi/koneksi.php";

	$username = $_POST['username'];
	$password = $_POST['password'];
	$login_as = $_POST['login_as'];

	$login = login($username, $password, $login_as, $con);

	if($login == true && $login_as == "admin"){
		header("location: admin/index.php");
	}elseif($login == false && $login_as == "admin"){
		header("location: admin.php?login=false");
	}elseif ($login == true && $login_as == "guru") {
		header("location: guru/index.php");
	}elseif($login == false && $login_as == "guru"){
		header("location: login.php?login=false");
	}
?>
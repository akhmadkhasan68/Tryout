<?php 
	session_start();
	include "function/myfunction.php";
	include "koneksi/koneksi.php";

	$username = $_POST['username'];
	$password = $_POST['password'];
	$login_as = $_POST['login_as'];

	$login = login($username, $password, $login_as, $con);

	if($login == true){
		header("location: admin/index.php");
	}else{
		header("location: admin.php?login=false");
	}
?>
<?php
	error_reporting(0);

    $db_server = 'localhost';
    $db_username = 'root';
    $db_pass = '';
    $db_name = 'tryout';

    $con = mysqli_connect($db_server, $db_username, $db_pass, $db_name);
    if(!$con){
        echo "Gagal connect";
    }
?>
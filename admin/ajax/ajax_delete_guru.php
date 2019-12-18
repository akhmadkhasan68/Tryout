<?php 
	include "../../function/myfunction.php";
	include "../../koneksi/koneksi.php";

	$id = $_POST['id'];

	$delete = delete_data($con, "tbl_guru", $id);

	if($delete == TRUE){
		$json_data = [
			'result' => TRUE,
			'message' => array('head' => 'Selamat', 'body' => 'Data Guru berhasil dihapus!')
		];

		print json_encode($json_data);
	}else{
		$json_data = [
			'result' => FALSE,
			'message' => array('head' => 'Gagal', 'body' => 'Data Guru gagal dihapus!')
		];

		print json_encode($json_data);
	}
?>
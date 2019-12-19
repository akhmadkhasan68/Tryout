<?php 
	include "../../function/myfunction.php";
	include "../../koneksi/koneksi.php";

	$id = $_POST['id'];

	$delete = delete_data($con, "tbl_ruangan", $id);

	if($delete == TRUE){
		$json_data = [
			'result' => TRUE,
			'message' => array('head' => 'Selamat', 'body' => 'Data Ruangan berhasil dihapus!')
		];

		print json_encode($json_data);
	}else{
		$json_data = [
			'result' => FALSE,
			'message' => array('head' => 'Gagal', 'body' => 'Data Ruangan gagal dihapus!')
		];

		print json_encode($json_data);
	}
?>
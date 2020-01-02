<?php 
	include "../../function/myfunction.php";
	include "../../koneksi/koneksi.php";

	$id = $_POST['id'];
	$pembayaran = '1';

	$data = [
		'pembayaran' => $pembayaran
	];

	$result = update_data($con, "tbl_siswa", $data, NULL, $id);

	if($result == TRUE){
		$json_data = [
			'result' => TRUE,
			'message' => array('head' => 'Sukses', 'body' => 'Selamat, data berhasil diubah!')
		];
	}else{
		$json_data = [
			'result' => FALSE,
			'message' => array('head' => 'Gagal', 'body' => 'Mohon maaf, data gagal diubah!')
		];
	}

	print json_encode($json_data);
?>
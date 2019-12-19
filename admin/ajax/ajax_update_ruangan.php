<?php 
	include "../../function/myfunction.php";
	include "../../koneksi/koneksi.php";

	$id = $_POST['id'];
	$nama_ruangan = $_POST['nama_ruangan'];
	$kapasitas = $_POST['kapasitas'];

	$data = [
		'nama_ruangan' => $nama_ruangan,
		'kapasitas' => $kapasitas,
	];

	$form_validation = [
		'nama_ruangan' => $nama_ruangan
	];

	$validation = validation_data($con, "tbl_ruangan", $form_validation, TRUE, $id);

	if($validation == TRUE){
		$result = update_data($con, "tbl_ruangan", $data, NULL, $id);

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
	}else{
		$json_data = [
			'result' => FALSE,
			'message' => array('head' => 'Gagal', 'body' => 'Mohon maaf, data tidak boleh duplikat!')
		];

		print json_encode($json_data);
	}

?>
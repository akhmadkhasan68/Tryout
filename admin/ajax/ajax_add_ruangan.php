<?php 
	include "../../function/myfunction.php";
	include "../../koneksi/koneksi.php";

	$nama_ruangan = $_POST['nama_ruangan'];
	$kapasitas = $_POST['kapasitas'];

	$data = [
		'nama_ruangan' => $nama_ruangan,
		'kapasitas' => $kapasitas,
	];

	$form_validation = [
		'nama_ruangan' => $nama_ruangan
	];

	$validation = validation_data($con, "tbl_ruangan", $form_validation);

	if($validation == TRUE){
		$result = insert_data($con, "tbl_ruangan", $data);

		if($result == TRUE){
			$json_data = [
				'result' => TRUE,
				'message' => array('head' => 'Sukses', 'body' => 'Selamat, data berhasil ditambahkan!')
			];
		}else{
			$json_data = [
				'result' => FALSE,
				'message' => array('head' => 'Gagal', 'body' => 'Mohon maaf, data gagal ditambahkan!')
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
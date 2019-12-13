<?php 
	include "../../function/myfunction.php";
	include "../../koneksi/koneksi.php";

	$id = $_POST['id'];
	$nama_sekolah = $_POST['nama_sekolah'];
	$npsn = $_POST['npsn'];
	$alamat = $_POST['alamat'];

	$data = [
		'nama_sekolah' => $nama_sekolah,
		'npsn' => $npsn,
		'alamat' => $alamat
	];

	$form_validation = [
		'nama_sekolah' => $nama_sekolah,
		'npsn' => $npsn,
	];

	$validation = validation_data($con, "tbl_sekolah", $form_validation, TRUE, $id);

	if($validation == TRUE){
		$result = update_data($con, "tbl_sekolah", $data, $id);

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
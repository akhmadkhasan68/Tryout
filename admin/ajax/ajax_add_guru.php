<?php 
	include "../../function/myfunction.php";
	include "../../koneksi/koneksi.php";

	$nama = $_POST['nama'];
	$nik = $_POST['nik'];
	$id_sekolah = $_POST['id_sekolah'];
	$nomor_tlp = $_POST['nomor_tlp'];
	$username = $_POST['username'];
	$alamat = $_POST['alamat'];

	$data = [
		'nama' => $nama,
		'nik' => $nik,
		'id_sekolah' => $id_sekolah,
		'nomor_tlp' => $nomor_tlp,
		'username' => $username,
		'alamat' => $alamat
	];

	$md5 = [
		'password' => $nik
	];

	$form_validation = [
		'nik' => $nik,
		'username' => $username,
		'nomor_tlp' => $nomor_tlp
	];

	$validation = validation_data($con, "tbl_guru", $form_validation);

	if($validation == TRUE){
		$result = insert_data($con, "tbl_guru", $data, $md5);

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
<?php 
	include "../../function/myfunction.php";
	include "../../koneksi/koneksi.php";

	$nama = $_POST['nama'];
    $nisn = $_POST['nisn'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $nomor_tlp = $_POST['nomor_tlp'];
    $asal_sekolah = $_POST['asal_sekolah'];
    $alamat = $_POST['alamat'];

	$data = [
		'nama' => $nama,
	    'nisn' => $nisn,
	    'jenis_kelamin' => $jenis_kelamin,
	    'nomor_tlp' => $nomor_tlp,
	    'asal_sekolah' => $asal_sekolah,
	    'alamat' => $alamat
	];


	$form_validation = [
		'nisn' => $nisn
	];

	$validation = validation_data($con, "tbl_siswa_individu", $form_validation);
	$validation2 = validation_data($con, "tbl_siswa", $form_validation);

	if($validation == TRUE && $validation2 == TRUE){
		//SELECT LAST ID UNTUK TBL NOMOR PESERTA
		$select_nopeserta = select_data($con, "*", "tbl_nomor_peserta")

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
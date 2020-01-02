<?php 
	include "../../function/myfunction.php";
	include "../../koneksi/koneksi.php";

	$nama = $_POST['nama'];
    $nisn = $_POST['nisn'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $nomor_tlp = $_POST['nomor_tlp'];
    $asal_sekolah = $_POST['asal_sekolah'];
    $alamat = $_POST['alamat'];

	$form_validation = [
		'nisn' => $nisn,
		'nomor_tlp' => $nomor_tlp
	];

	$validation = validation_data($con, "tbl_siswa", $form_validation);

	if($validation == TRUE){
		//SELECT LAST ID UNTUK TBL NOMOR PESERTA
		$select_nopeserta = select_data($con, "MAX(nomor_peserta) as nomor_peserta", "tbl_nomor_peserta");
		$rnp = mysqli_fetch_assoc($select_nopeserta);
		$nomor_peserta = $rnp['nomor_peserta']+1;

		$insert_nopeserta = insert_data($con, "tbl_nomor_peserta", ["nomor_peserta" => $nomor_peserta]);

		$last_id = mysqli_insert_id($con);

		//SET FOR INSERT DATA TO TBL_SISWA_INDIVIDU
		$data = [
			'nama' => $nama,
		    'nisn' => $nisn,
		    'jenis_kelamin' => $jenis_kelamin,
		    'nomor_tlp' => $nomor_tlp,
		    'asal_sekolah' => $asal_sekolah,
		    'alamat' => $alamat,
		    'id_nomor_peserta' => $last_id
		];

		//INSERT TO TBL_SISWA_INDIVIDU
		$result = insert_data($con, "tbl_siswa", $data);

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
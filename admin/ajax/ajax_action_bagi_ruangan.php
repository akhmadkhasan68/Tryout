<?php 
	include "../../koneksi/koneksi.php";

	$id_ruangan = $_POST['id_ruangan'];

	//SELECT RUANGAN 
	$select_ruangan = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM tbl_ruangan WHERE id = '$id_ruangan'"));
	$kapasitas = $select_ruangan['kapasitas'];

	//SELECT RUANG UJIAN 
	$select_ruang_ujian = mysqli_query($con, "SELECT * FROM tbl_ruang_ujian");
	if(mysqli_num_rows($select_ruang_ujian) == 0){
		$sql_select_siswa = "SELECT * FROM tbl_siswa ORDER BY rand() LIMIT $kapasitas";
	}else{
		$id_siswa = [];
		while($rru = mysqli_fetch_assoc($select_ruang_ujian)){
			array_push($id_siswa, $rru['id_siswa']);
		}
		$sql_select_siswa = "SELECT * FROM tbl_siswa WHERE id NOT IN ( '" . implode( "', '" , $id_siswa ) . "' ) ORDER BY rand() LIMIT $kapasitas";
	}

	//SELECT SISWA RANDOM
	$select_siswa = mysqli_query($con, $sql_select_siswa);
	while ($row = mysqli_fetch_assoc($select_siswa)) {
		$id_siswa = $row['id'];	

		//INSERT TBL RUANG UJIAN 
		$insert_ruang = mysqli_query($con, "INSERT INTO tbl_ruang_ujian VALUES ('', '$id_siswa', '$id_ruangan')");
	}

	if($insert_ruang){
		$json_data = [
			'result' => TRUE,
			'message' => array('head' => 'Sukses', 'body' => 'Selamat, ruang ujian berhasil diisi!')
		];
	}else{
		$json_data = [
			'result' => FALSE,
			'message' => array('head' => 'Gagal', 'body' => 'Maaf, ada kesalahan saat mengisi ruang ujian.')
		];
	}

	print json_encode($json_data);
?>
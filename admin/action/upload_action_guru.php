<?php 
	include "../../koneksi/koneksi.php";
	include "../../function/excel_reader2.php";

	session_start();

	//DELETE ALL DATA 
	$delete_guru = mysqli_query($con, "DELETE FROM tbl_guru");

	// upload file xls
	$target = basename($_FILES['file']['name']) ;
	move_uploaded_file($_FILES['file']['tmp_name'], $target);
	 
	// beri permisi agar file xls dapat di baca
	chmod($_FILES['file']['name'],0777);
	 
	// mengambil isi file xls
	$data = new Spreadsheet_Excel_Reader($_FILES['file']['name'],false);
	// menghitung jumlah baris data yang ada
	$jumlah_baris = $data->rowcount($sheet_index=0);
	 
	// jumlah default data yang berhasil di import
	$berhasil = 0;
	$gagal = 0;
	for ($i=2; $i<=$jumlah_baris; $i++){
	 
		// menangkap data dan memasukkan ke variabel sesuai dengan kolumnya masing-masing
		echo $nama     = $data->val($i, 1);
		echo $nik  = $data->val($i, 2);
		echo $npsn   = $data->val($i, 3);
		echo $tlp   = $data->val($i, 4);
		echo $alamat   = $data->val($i, 5);
		echo $username   = $data->val($i, 6);
	 	
		$check_data = mysqli_query($con, "SELECT * FROM tbl_guru WHERE nik = '$nik' OR username = '$username' OR nomor_tlp = '$tlp'");
		if(mysqli_num_rows($check_data ) > 0){
			$gagal++;
		}else{
			if($nama != "" && $nik != "" && $npsn != "" && $tlp != "" && $alamat != "" && $username != ""){
				//SELECT ID SEKOLAH
				$select_sekolah = mysqli_query($con, "SELECT *  FROM tbl_sekolah WHERE npsn = '$npsn'");
				$rs = mysqli_fetch_assoc($select_sekolah);
				$id_sekolah = $rs['id'];

				// INPUT DATA KE DATABASE TBL_GURU
				$upload = mysqli_query($con,"INSERT into tbl_guru values('','$nama','$nik','$id_sekolah', '$tlp', '$alamat', '$username', md5('$nik'))");
				if($upload){
					$berhasil++;
				}else{
					$gagal++;
				}
			}else{
				$gagal++;
			}
		}
	}
	 
	// hapus kembali file .xls yang di upload tadi
	unlink($_FILES['file']['name']);

	$_SESSION['guru_gagal'] = $gagal;
	$_SESSION['guru_berhasil'] = $berhasil;

	header("location: ../index.php?page=import_data_guru&upload=TRUE");
?>
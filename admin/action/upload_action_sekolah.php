<?php 
	include "../../koneksi/koneksi.php";
	include "../../function/excel_reader2.php";

	session_start();

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
		echo $nama_sekolah     = $data->val($i, 1);
		echo $npsn  = $data->val($i, 2);
		echo $alamat   = $data->val($i, 3);
	 	
		$check_data = mysqli_query($con, "SELECT * FROM tbl_sekolah WHERE nama_sekolah = '$nama_sekolah' OR npsn = '$npsn'");
		if(mysqli_num_rows($check_data ) > 0){
			$gagal++;
		}else{
			if($nama_sekolah != "" && $npsn != "" && $alamat != ""){
				// input data ke database (table data_pegawai)
				$upload = mysqli_query($con,"INSERT into tbl_sekolah values('','$nama_sekolah','$npsn','$alamat')");
				if($upload){
					$berhasil++;
				}else{
					$gagal++;
				}
			}
		}
	}
	 
	// hapus kembali file .xls yang di upload tadi
	unlink($_FILES['file']['name']);

	$_SESSION['sekolah_gagal'] = $gagal;
	$_SESSION['sekolah_berhasil'] = $berhasil;

	header("location: ../index.php?page=import_sekolah_excel&upload=TRUE");
?>
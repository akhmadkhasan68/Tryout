<?php  
	include "../../koneksi/koneksi.php";
	include "../../function/myfunction.php";

	$date =  date('d');
	$month =  date('m');
	$year =  date('Y');

	if($month == "1"){
		$month_string = "Januari";
	}elseif ($month == "2") {
		$month_string = "Februari";
	} elseif ($month == "3") {
		$month_string = "Maret";
	} elseif ($month == "4") {
		$month_string = "April";
	} elseif ($month == "5") {
		$month_string = "Mei";
	} elseif ($month == "6") {
		$month_string = "Juni";
	} elseif ($month == "7") {
		$month_string = "Juli";
	} elseif ($month == "8") {
		$month_string = "Agustus";
	} elseif ($month == "9") {
		$month_string = "September";
	} elseif ($month == "10") {
		$month_string = "Oktober";
	} elseif ($month == "11") {
		$month_string = "November";
	} elseif ($month == "12") {
		$month_string = "Desember";
	}

	$date_now = $date." ".$month_string." ".$year;

	$id = $_GET['id'];
	$select_sekolah = select_data($con, "g.nama, s.id, s.nama_sekolah, s.npsn", "tbl_guru g", ["tbl_sekolah s ON s.id = g.id_sekolah"], ["s.id = '$id'"]);
	$rs = mysqli_fetch_assoc($select_sekolah);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Cetak Undangan <?php echo $rs['nama_sekolah']; ?></title>
	<!-- <link rel="stylesheet" href="../../assets/css/vendor.bundle.css">
    <link rel="stylesheet" href="../../assets/css/app.bundle.css"> -->
	<style type="text/css">
		body{
			font-size:12px;
		}
		.table{
			width: 100%;
			text-align: center;
		}
		tr td{
			/*border: 1px solid #ddd;*/
		}
		.text-head{
			font-size: 18px;
		}
		h1{
			font-size: 16px;
		}
	</style>
</head>
<body>
	<div class="section-to-print">
	 	<table class="table">
	 		<tr>
	 			<td width="5%">
	 				<img src="../../assets/front/img/logo-sch.png" width="70px">
	 			</td>
	 			<td width="95%">
					<center style="line-height: 0.9; margin-right: 70px;">
						<span class="text-head">SMP MUHAMMADIYAH 06 DAU</span>
						<h1>UNDANGAN TRYOUT AKBAR 2020</h1>
						<i>
							No, Jl. Margo Basuki No.48 Telpon Central (0341) 460972 Jetis, Mulyoagung, <br> Kec. Dau, Malang, Jawa Timur 65151
						</i>
					</center>
				</td>
	 		</tr>
			<tr>
				
			</tr>
			<tr>
				<td colspan="2">
					<hr style="border: 2px solid black;">
				</td>
			</tr>
	 	</table>
	 	<table class="table">
	 		<tr>
	 			<td width="50%" style="text-align: left;">
	 				Nomor &nbsp;:&nbsp; 660.2/..../B.IV.3/DLH/2019
	 				<br>
	 				<br>
	 				Sifat &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp; Undangan
	 				<br>
	 				<br>
	 				Hal	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :&nbsp; <b style="line-height: 1.6;">Surat undangan untuk mengikuti kegiatan Try Out Akbar 2020 SMP Muhamadiyah 06 DAU</b>
	 			</td>
	 			<td width="50%" style="text-align: right;">
	 				Malang, <?php echo $date_now;?>
	 				<br>
	 				<br>
	 				Kepada <br><br>
	 				Yth. <?php echo $rs['nama']; ?>
	 				<br>
	 				<br>
	 				<b>Di Tempat</b>
	 			</td>
			</tr>
	 	</table>

	 	<table class="table">
	 		<tr>
	 			<td width="15%">
	 				
	 			</td>
	 			<td width="75%" align=”justify” style="text-align: justify; font-size: 12px;">
	 				<p style="display: inline-block; line-height: 1.6;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Dalam rangka meningkatkan kualitas pembelajaran siswa, mendorong minat kompetisi siswa dalam belajar, dan mempersiapkan siswa untuk mengikuti Ujian Nasional kami pihak SMP Muhammadiyah 06 Dau mengajak siswa/siswi kelas 6 dari <?php echo $rs['nama_sekolah']; ?> untuk mengikuti kegiatan Try Out Akbar 2020 yang diadakan SMP Muhammadiyah 06 Dau pada:</p>
	 			</td>
	 			<td width="10%">
	 				
	 			</td>
			</tr>
	 	</table>
	 	
	 	<table class="table">
	 		<tr>
	 			<td width="20%">
	 				
	 			</td>
	 			<td width="60%" align=”justify” style="text-align: justify; font-size: 12px;">
	 				<p style="line-height: 1.6;">
	 					<b>Hari/Tanggal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;</b> Senin, 12 Februari 2020 <br>
	 					<b>Waktu&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;</b> 07.00 s.d Selesai (WIB) <br>
	 					<b>Tempat&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;</b> Ruang Kelas SMP Muhammadiyah 06 Dau <br>
	 				</p>
	 			</td>
	 			<td width="20%">
	 				
	 			</td>
			</tr>
	 	</table>
	 	
	 	<table class="table">
	 		<tr>
	 			<td width="15%">
	 				
	 			</td>
	 			<td width="75%" align=”justify” style="text-align: justify; font-size: 12px;">
	 				<p style="display: inline-block; line-height: 1.6;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sehubungan degan undangan ini diharapkan <?php echo $rs['nama_sekolah']; ?> dapat mengajak siswa/siswi nya untuk berpartisipasi dalam acara ini. Demikian disampaikan atas perhatian dan kerjasamanya diucapkan terimakasih.</p>
	 			</td>
	 			<td width="10%">
	 				
	 			</td>
			</tr>
	 	</table>
	 	<br>
	 	<br>
	 	<br>
	 	<br>
	 	<table class="table">
	 		<tr>
	 			<td width="50%" style="text-align: left; padding-left: 100px;">
	 				
	 			</td>
	 			<td width="50%" style="text-align: right;">
	 				Malang, <?php echo $date_now; ?><br><br>
	 				Kepala Sekolah SMP Muhammadiyah 06 Dau,
	 				<br>
	 				<br>
	 				<br>
	 				<br>
	 				<br>
	 				<br>
	 				<br>
	 				<br>
	 				<b><u>MUH. HARAHAB EFENDY. SP,D</u></b>
	 				<br>
	 				<br>
	 				NIP. 18021901892109012990
	 			</td>
			</tr>
	 	</table>
 	</div>
	<script>
		window.print();
	</script>
	
</body>
</html>
<?php 
session_start();
if($_SESSION['logged_in'] == FALSE){
	header("location: ../login.php");
}
include "../koneksi/koneksi.php";
include "../function/myfunction.php";

//SELECT DATA SEKOLAH AND GURU FROM SESSION
$data_guru = select_data($con, "g.id, g.nama, g.nik, g.nomor_tlp, g.alamat as alamat_guru, g.username, h.nama_sekolah, h.npsn, h.alamat as alamat_sekolah", "tbl_guru g", ["tbl_sekolah h ON h.id = g.id_sekolah"], ["username = '$_SESSION[username]'"]);
$fetch_guru = mysqli_fetch_assoc($data_guru);

$nama_sekolah = $fetch_guru['nama_sekolah'];
$nik_guru = $fetch_guru['nik'];
$nama_guru = $fetch_guru['nama'];
$nomor_tlp = $fetch_guru['nomor_tlp'];
$npsn = $fetch_guru['npsn'];
?>
<!DOCTYPE html>
<html lang="en">

	<head>
	    <meta charset="UTF-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	    <meta name="description" content="">
	    <meta name="keywords" content="">
	    <title>Guru - SMP Muhammadiyah 06 Dau</title>
	    <link rel="stylesheet" href="assets/css/vendor.bundle.css">
	    <link rel="stylesheet" href="assets/css/app.bundle.css">
	    <link rel="stylesheet" href="assets/css/theme-a.css">
	    <link rel="stylesheet" href="assets/css/toastr.css">
        <script src="assets/js/jquery-3.2.1.min.js"></script>
        <script src="assets/js/toastr.min.js"></script>
	    <script src="assets/js/vendor.bundle.js"></script>
        <script src="assets/js/app.bundle.js"></script>
	</head>

    <body>
        <div id="app_wrapper">
            <header id="app_topnavbar-wrapper">
                <nav role="navigation" class="navbar topnavbar">
                    <div class="nav-wrapper">
                        <ul class="nav navbar-nav pull-left left-menu">
                            <li class="app_menu-open">
                                <a href="javascript:void(0)" data-toggle-state="app_sidebar-left-open" data-key="leftSideBar">
                                    <i class="zmdi zmdi-menu"></i>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav navbar-nav pull-right">
                            <li class="dropdown avatar-menu">
                                <a href="javascript:void(0)" data-toggle="dropdown" aria-expanded="false">
                                    <span class="meta">
									<span class="avatar">
										<img src="assets/img/profiles/rn.jpg" alt="" class="img-circle max-w-35">
										<i class="badge mini success status"></i>
									</span>
                                    <span class="name"><?php echo $nama_guru;?></span>
                                    <span class="caret"></span>
                                    </span>
                                </a>
                                <ul class="dropdown-menu btn-primary dropdown-menu-right">
                                    <li>
                                        <a href="page-profile.html"><i class="zmdi zmdi-account"></i> Profil</a>
                                    </li>
                                    <li>
                                        <a href="../logout.php"><i class="zmdi zmdi-sign-in"></i> Keluar</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <aside id="app_sidebar-left">
                <div id="logo_wrapper">
                    <ul>
                        <li class="logo-icon">
                            <a href="index-2.html">
                                <!-- <div class="logo">
                                    <img src="assets/img/logo/logo-icon.png" alt="Logo">
                                </div> -->
                                <h1 class="" style="margin-left: 10px; color:#f4f4f4; font-size: 20px;">Halaman Guru</h1>
                            </a>
                        </li>
                        <li class="menu-icon">
                            <a href="javascript:void(0)" role="button" data-toggle-state="app_sidebar-menu-collapsed" data-key="leftSideBar">
                                <i class="mdi mdi-backburger"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <nav id="app_main-menu-wrapper" class="scrollbar">
                    <div class="sidebar-inner sidebar-push">
                        <ul class="nav nav-pills nav-stacked">
                            <li class="sidebar-header">MENU</li>
                            <li <?php if($_REQUEST['page'] == "dashboard" || $_REQUEST['page'] == ""){echo 'class="active"';}?>><a href="index.php?page=dashboard"><i class="zmdi zmdi-view-dashboard"></i>Dashboard</a></li>
                            <li <?php if($_REQUEST['page'] == "data_peserta"){echo 'class="active"';}?>><a href="index.php?page=data_peserta"><i class="zmdi zmdi-account"></i>Data Peserta</a></li>
                            <li <?php if($_REQUEST['page'] == "pembayaran"){echo 'class="active"';}?>><a href="index.php?page=pembayaran"><i class="zmdi zmdi-money"></i>Pembayaran</a></li>
                            <li <?php if($_REQUEST['page'] == "cetak_kartu"){echo 'class="active"';}?>><a href="index.php?page=cetak_kartu"><i class="zmdi zmdi-card"></i>Cetak Kartu Peserta</a></li>
                            <li <?php if($_REQUEST['page'] == "lihat_nilai"){echo 'class="active"';}?>><a href="index.php?page=lihat_nilai"><i class="zmdi zmdi-assignment"></i>Lihat Nilai</a></li>
                        </ul>
                    </div>
                </nav>
            </aside>
            <section id="content_outer_wrapper">
                <div id="content_wrapper" class="card-overlay">
                    <!-- BEGIN CONTENT -->
                    <div id="header_wrapper" class="header-md" style="background-color: #28be63;">
					    <div class="container">
	                        <div class="row">
	                            <div class="col-xs-12">
	                                <header id="header">
	                                    <?php
					                    	$halaman = $_GET['page'];
					                    	switch ($halaman) {
					                    		case 'dashboard':
					                    			echo "<h1>Dashboards</h1>";
					                    			break;
					                    		case 'data_peserta':
					                    			echo "<h1>Data Peserta</h1>";
					                    			break;
					                    		case 'pembayaran':
					                    			echo "<h1>Pembayaran</h1>";
					                    			break;
					                    		case 'cetak_kartu':
					                    			echo "<h1>Cetak Kartu</h1>";
					                    			break;
					                    		default:
					                    			echo "<h1>Dashboards</h1>";
					                    			break;
					                    	}
					                    ?>
	                                    <ol class="breadcrumb">
	                                        <!-- <li><a href="index-2.html">Dashboard</a></li>
	                                        <li><a href="javascript:void(0)">Components</a></li>
	                                        <li class="active">Modals</li> -->
	                                        <?php
						                    	$halaman = $_GET['page'];
						                    	switch ($halaman) {
						                    		case 'dashboard':
						                    			echo "<li class='active'>Dashboard</li>";
						                    			break;
						                    		case 'data_peserta':
						                    			echo "<li class='active'>Data Peserta Yang Terdaftar</li>";
						                    			break;
						                    		case 'pembayaran':
						                    			echo "<li class='active'>Konfirmasi Pembayaran Peserta</li>";
						                    			break;
						                    		case 'cetak_kartu':
						                    			echo "<li class='active'>Cetak Kartu Peserta</li>";
						                    			break;
						                    		default:
						                    			echo "
						                    			<li><a>Dashboard</a></li>
						                    			";
						                    			break;
						                    	}
						                    ?>
	                                    </ol>
	                                </header>
	                            </div>
	                        </div>
	                    </div>
					</div>
                    <?php
                    	switch ($halaman) {
                    		case 'dashboard':
                    			include "page/dashboard.php";
                    			break;
                    		case 'data_peserta':
                    			include "page/data_peserta.php";
                    			break;
                    		case 'pembayaran':
                    			include "page/pembayaran.php";
                    			break;
                    		case 'cetak_kartu':
                    			include "page/cetak_kartu.php";
                    			break;
                    		default:
                    			include "page/dashboard.php";
                    			break;
                    	}
                    ?>

                    <!-- ENDS $content -->
                </div>
                <footer id="footer_wrapper">
	                <div class="footer-content" style="background-color: #28be63;">
	                    <div class="row">
	                        <div class="col-xs-12 col-sm-8">
	                            <h6>Ingin bekerjasama dengan kami?</h6>
	                            <p>Kami dari kelas Informatika A dari Universitas Muhammadiyah Malang menerma kerjasama untuk membuat sistem <i>Web Application</i> dari berbagai macam sistem. Kami telah melayani dari berbagai macam <i>background</i> sistem seperti pendidikan, pariwisata, pemerintahan, dll.</p>
	                        </div>
	                        <div class="col-xs-12 col-sm-4">
	                            <h6>Masukkan Email</h6>
	                            <p>Masukkan e-mail untuk bekerjasama dengan kami.</p>
	                            <div class="form-group is-empty">
	                                <div class="input-group">
	                                    <label class="control-label sr-only" for="footerEmail">Email Address</label>
	                                    <input type="email" class="form-control" id="footerEmail" placeholder="Enter your email address...">
	                                    <span class="input-group-btn">
									<button type="button" class="btn btn-white btn-fab animate-fab btn-fab-sm">
										<i class="zmdi zmdi-mail-send"></i>
									</button>
								</span>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                    <div class="row copy-wrapper">
	                        <div class="col-xs-8">
	                            <p class="copy">&copy; Copyright
	                                <time class="year"></time>	Informatika - Universitas Muhammadiyah Malang</p>
	                        </div>
	                        <div class="col-xs-4">
	                            <ul class="social">
	                                <li>
	                                    <a href="javascript:void(0)"> </a>
	                                </li>
	                                <li>
	                                    <a href="javascript:void(0)"> </a>
	                                </li>
	                                <li>
	                                    <a href="javascript:void(0)"> </a>
	                                </li>
	                                <li>
	                                    <a href="javascript:void(0)"> </a>
	                                </li>
	                            </ul>
	                        </div>
	                    </div>
	                </div>
	            </footer>
            </section>
        </div>
    </body>
</html>
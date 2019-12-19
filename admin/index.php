<?php 
session_start();
if($_SESSION['logged_in'] == FALSE){
	header("location: ../login.php");
}
include "../koneksi/koneksi.php";
include "../function/myfunction.php";
?>
<!DOCTYPE html>
<html lang="en">

	<head>
	    <meta charset="UTF-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	    <meta name="description" content="">
	    <meta name="keywords" content="">
	    <title>Admin - SMP Muhammadiyah 06 Dau</title>
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
                                    <span class="name"><?php echo $_SESSION['username'];?></span>
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
                                <h1 class="" style="margin-left: 10px; color:#f4f4f4; font-size: 20px;">Halaman Admin</h1>
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

                            <li <?php if($_REQUEST['page'] == "data_sekolah"){echo 'class="active"';}?>><a href="index.php?page=data_sekolah"><i class="zmdi zmdi-home"></i>Data Sekolah</a></li>

                            <li class="nav-dropdown <?php if($_REQUEST['page'] == "data_peserta" || $_REQUEST['page'] == "input_individu" || $_REQUEST['page'] == "data_guru"){echo 'active';}?>"><a href="#"><i class="zmdi zmdi-account"></i>Peserta</a>
                                <ul class="nav-sub">
                                	<li <?php if($_REQUEST['page'] == "data_guru"){echo 'class="active"';}?>><a href="index.php?page=data_guru">Data Guru</a></li>
                                    <li <?php if($_REQUEST['page'] == "data_peserta"){echo 'class="active"';}?>><a href="index.php?page=data_peserta">Data Peserta</a></li>
                                    <li <?php if($_REQUEST['page'] == "input_individu"){echo 'class="active"';}?>><a href="index.php?page=input_individu">Input Individu</a></li>
                                </ul>
                            </li>

                            <li <?php if($_REQUEST['page'] == "pembayaran"){echo 'class="active"';}?>><a href="index.php?page=pembayaran"><i class="zmdi zmdi-money"></i>Pembayaran</a></li>
                             <li class="nav-dropdown <?php if($_REQUEST['page'] == "data_ruangan" || $_REQUEST['page'] == "pembagian_ruangan"){echo 'active';}?>"><a href="#"><i class="zmdi zmdi-view-toc"></i>Ruangan</a>
                                <ul class="nav-sub">
                                    <li <?php if($_REQUEST['page'] == "data_ruangan"){echo 'class="active"';}?>><a href="index.php?page=data_ruangan">Data Ruangan</a></li>
                                    <li <?php if($_REQUEST['page'] == "pembagian_ruangan"){echo 'class="active"';}?>><a href="index.php?page=pembagian_ruangan">Pembagian Ruangan Peserta</a></li>
                                </ul>
                            </li>

                             <li class="nav-dropdown <?php if($_REQUEST['page'] == "cetak_kartu" || $_REQUEST['page'] == "cetak_undangan"){echo 'active';}?>"><a href="#"><i class="zmdi zmdi-card"></i>Cetak Data</a>
                                <ul class="nav-sub">
                                    <li <?php if($_REQUEST['page'] == "cetak_kartu"){echo 'class="active"';}?>><a href="index.php?page=cetak_kartu">Cetak Kartu Peserta</a></li>
                                    <li <?php if($_REQUEST['page'] == "cetak_undangan"){echo 'class="active"';}?>><a href="index.php?page=cetak_undangan">Cetak Undangan</a></li>
                                </ul>
                            </li>

                            <li <?php if($_REQUEST['page'] == "input_nilai"){echo 'class="active"';}?>><a href="index.php?page=input_nilai"><i class="zmdi zmdi-assignment"></i>Input Nilai Peserta</a></li>
                        </ul>
                    </div>
                </nav>
            </aside>
            <section id="content_outer_wrapper">
                <div id="content_wrapper" class="card-overlay">
                    <!-- BEGIN CONTENT -->
                    <div id="header_wrapper" class="header-md">
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
					                    		case 'data_sekolah':
					                    			echo "<h1>Data Sekolah</h1>";
					                    			break;
					                    		case 'data_guru':
					                    			echo "<h1>Data Guru</h1>";
					                    			break;
					                    		case 'data_peserta':
					                    			echo "<h1>Data Peserta</h1>";
					                    			break;
					                    		case 'input_individu':
					                    			echo "<h1>Input Peserta Individu</h1>";
					                    			break;
					                    		case 'pembayaran':
					                    			echo "<h1>Pembayaran</h1>";
					                    			break;
					                    		case 'data_ruangan':
					                    			echo "<h1>Data Ruangan</h1>";
					                    			break;
					                    		case 'pembagian_ruangan':
					                    			echo "<h1>Pembagian Ruangan Peserta</h1>";
					                    			break;
					                    		case 'cetak_kartu':
					                    			echo "<h1>Cetak Kartu Peserta</h1>";
					                    			break;
					                    		case 'cetak_undangan':
					                    			echo "<h1>Cetak Undangan</h1>";
					                    			break;
					                    		case 'input_nilai':
					                    			echo "<h1>Input Nilai Peserta</h1>";
					                    			break;
					                    		case 'import_sekolah_excel':
					                    			echo "<h1>Import Data Excel</h1>";
					                    			break;
					                    		case 'import_data_guru':
					                    			echo "<h1>Import Data Excel</h1>";
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
						                    		case 'data_sekolah':
						                    			echo "<li class='active'>Data Sekolah</li>";
						                    			break;
						                    		case 'data_guru':
						                    			echo "
						                    			<li><a>Peserta</a></li>
						                    			<li class='active'>Data Guru</li>
						                    			";
						                    			break;
						                    		case 'data_peserta':
						                    			echo "
						                    			<li><a>Peserta</a></li>
						                    			<li class='active'>Data Peserta</li>
						                    			";
						                    			break;
						                    		case 'input_individu':
						                    			echo "
						                    			<li><a>Peserta</a></li>
						                    			<li class='active'>Input Peserta Individu</li>
						                    			";
						                    			break;
						                    		case 'pembayaran':
						                    			echo "<li class='active'>Pembayaran</li>";
						                    			break;
						                    		case 'data_ruangan':
						                    			echo "
						                    			<li><a>Ruangan</a></li>
						                    			<li class='active'>Data Ruangan</li>
						                    			";
						                    			break;
						                    		case 'pembagian_ruangan':
						                    			echo "
						                    			<li><a>Ruangan</a></li>
						                    			<li class='active'>Pembagian Ruangan Peserta</li>
						                    			";
						                    			break;
						                    		case 'cetak_kartu':
						                    			echo "
						                    			<li><a>Cetak Data</a></li>
						                    			<li class='active'>Cetak Kartu Peserta</li>
						                    			";
						                    			break;
						                    		case 'cetak_undangan':
						                    			echo "
						                    			<li><a>Cetak Data</a></li>
						                    			<li class='active'>Cetak Undangan</li>
						                    			";
						                    			break;
						                    		case 'input_nilai':
						                    			echo "
						                    			<li><a>Input Nilai Peserta</a></li>
						                    			";
						                    			break;
						                    		case 'import_sekolah_excel':
						                    			echo "
						                    			<li><a>Import Data Sekolah Excel</a></li>
						                    			";
						                    			break;
						                    		case 'import_data_guru':
						                    			echo "
						                    			<li><a>Import Data Guru Excel</a></li>
						                    			";
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
                    		case 'data_sekolah':
                    			include "page/data_sekolah.php";
                    			break;
                    		case 'data_guru':
                    			include "page/data_guru.php";
                    			break;
                    		case 'data_peserta':
                    			include "page/data_peserta.php";
                    			break;
                    		case 'input_individu':
                    			include "page/input_individu.php";
                    			break;
                    		case 'pembayaran':
                    			include "page/pembayaran.php";
                    			break;
                    		case 'data_ruangan':
                    			include "page/data_ruangan.php";
                    			break;
                    		case 'pembagian_ruangan':
                    			include "page/pembagian_ruangan.php";
                    			break;
                    		case 'cetak_kartu':
                    			include "page/cetak_kartu.php";
                    			break;
                    		case 'cetak_undangan':
                    			include "page/cetak_undangan.php";
                    			break;
                    		case 'input_nilai':
                    			include "page/input_nilai.php";
                    			break;
                    		case 'import_sekolah_excel':
                    			include "page/import_sekolah_excel.php";
                    			break;
                    		case 'import_data_guru':
                    			include "page/import_data_guru.php";
                    			break;
                    		default:
                    			include "page/dashboard.php";
                    			break;
                    	}
                    ?>

                    <!-- ENDS $content -->
                </div>
                <footer id="footer_wrapper">
	                <div class="footer-content">
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
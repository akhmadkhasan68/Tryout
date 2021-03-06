<!-- <link rel="stylesheet" type="text/css" href="assets/css/cetak.min.css"> -->
<?php 
    $cek_ruangujian = select_data($con, "*", "tbl_ruang_ujian");
    if (mysqli_num_rows($cek_ruangujian) < 1) {
?>
    <div id="content" class="container-fluid">
        <div class="content-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="alert alert-warning">
                                <b>Perhatian!</b> anda belum bisa mengakses halaman ini karena anda belum melakukan pembagian ruang ujian. <a href="index.php?page=pembagian_ruangan">Klik disini!</a> untuk melakuakan.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
    die();
    }
?>
<div id="content" class="container-fluid">
    <div class="content-body">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        Total Data Peserta
                        <h1 style="font-size: 60px;">
                            <?php 
                                $count = select_data($con, "*", "tbl_siswa", NULL, ["pembayaran = '1'"]);
                                echo mysqli_num_rows($count);
                            ?>
                        </h1>
                        <span style="color: #b0b0b0;">Data Guru Yang Terdaftar Dalam Dalam Sistem</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-heading">
                        Cetak Kartu Peserta
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-info">
                                    <b>Info!</b> Halaman ini digunakan untuk mencetak kartu peserta Try Out yang sudah melakukan pembayaran. Kartu peserta dapat di cetak secara massal atau peserta dapat mencetaknya secara mandiri.
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <form action="" method="GET">
                                <div class="col-md-6">
                                    <input type="hidden" name="page" value="cetak_kartu">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Filter Data</label>
                                        <select name="asal_sekolah" class="select form-control" onchange="form.submit()">
                                            <option value="0">Filter Asal Sekolah</option>
                                            <?php 
                                                $select_asal_sekolah = select_data($con, "*", "tbl_siswa GROUP BY asal_sekolah");
                                                while ($rs = mysqli_fetch_assoc($select_asal_sekolah)) {
                                            ?>
                                                <option value="<?php echo $rs['asal_sekolah']; ?>" <?php if($_REQUEST['asal_sekolah'] == $rs['asal_sekolah']){echo "selected";} ?>><?php echo $rs['asal_sekolah']; ?></option>
                                            <?php
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </form>
                            <form method="GET" action="">
                                <div class="col-md-6">
                                    <input type="hidden" name="page" value="cetak_kartu">
                                    <select name="id_ruangan" class="select form-control" onchange="form.submit();">
                                        <option value="0">Filter Ruangan</option>
                                        <?php 
                                            $select_ruangan = select_data($con, "*", "tbl_ruangan");
                                            while ($rr = mysqli_fetch_assoc($select_ruangan)) {
                                        ?>
                                            <option value="<?php echo $rr['id']; ?>" <?php if($_REQUEST['id_ruangan'] == $rr['id']){echo "selected";} ?>><?php echo $rr['nama_ruangan']; ?></option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                            </form>
                        </div>

                        <?php 
                            if($_REQUEST['asal_sekolah'] != "0" && $_REQUEST['asal_sekolah'] != ""){
                                echo '<iframe src="page/cetak_kartu_print.php?asal_sekolah='.$_REQUEST[asal_sekolah].'" style="display:none;" name="frame"></iframe>';
                            }elseif($_REQUEST['id_ruangan'] != "0" && $_REQUEST['id_ruangan'] != ""){
                                echo '<iframe src="page/cetak_kartu_print.php?id_ruangan='.$_REQUEST[id_ruangan].'" style="display:none;" name="frame"></iframe>';
                            }else{
                                echo '<iframe src="page/cetak_kartu_print.php" style="display:none;" name="frame"></iframe>';
                            }
                        ?>

                        <div class="row">
                            <div class="col-md-3">
                                <a onClick="frames['frame'].print()" class="btn btn-warning btn-block btn-round"><i class="zmdi zmdi-print"></i> Cetak Kartu</a>
                            </div>
                        </div>
                        <div class="row">
                        <?php 
                            if($_REQUEST['asal_sekolah'] != "0" && $_REQUEST['asal_sekolah'] != ""){
                                $select_peserta = select_data($con, "*", "tbl_ruang_ujian ru", ["tbl_ruangan r ON r.id = ru.id_ruangan", "tbl_siswa s ON s.id = ru.id_siswa", "tbl_nomor_peserta np ON np.id = s.id_nomor_peserta"], ["s.asal_sekolah = '$_REQUEST[asal_sekolah]'"]);
                            }elseif($_REQUEST['id_ruangan'] != "0" && $_REQUEST['id_ruangan'] != ""){
                                $select_peserta = select_data($con, "*", "tbl_ruang_ujian ru", ["tbl_ruangan r ON r.id = ru.id_ruangan", "tbl_siswa s ON s.id = ru.id_siswa", "tbl_nomor_peserta np ON np.id = s.id_nomor_peserta"], ["ru.id_ruangan = '$_REQUEST[id_ruangan]'"]);
                            }else{
                                $select_peserta = select_data($con, "*", "tbl_ruang_ujian ru", ["tbl_ruangan r ON r.id = ru.id_ruangan", "tbl_siswa s ON s.id = ru.id_siswa", "tbl_nomor_peserta np ON np.id = s.id_nomor_peserta"]);
                            }
                            
                            while ($row = mysqli_fetch_assoc($select_peserta)) {
                        ?>
                            <div class="col-md-4">
                                <table style="width:8.5cm;border:1px solid black; line-height: 25px; margin-top:20px;">
                                    <tbody>
                                        <tr>
                                            <td colspan="3" style="border-bottom:1px solid black">
                                                <table width="100%" style="background-color:#FFFFFF" border="1">
                                                    <tbody>
                                                        <tr>
                                                            <td align="center" style="padding: 12px;" width="27%">
                                                                <canvas width="50" height="50" style="display: none;"></canvas>
                                                                <img src="../assets/front/img/logo-sch.png" height="60">
                                                            </td>
                                                            <td align="center" style="font-weight:bold">
                                                                <font color="#" >KARTU PESERTA <br>
                                                                    SMP MUHAMMADIYAH 06</br>
                                                                </font> 
                                                                
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="115">&nbsp;Nama Peserta</td><td width="1">:</td><td> &nbsp;<?php echo $row['nama']; ?></td>
                                        </tr>
                                        <tr>
                                            <td width="115">&nbsp;Asal Sekolah</td><td width="1">:</td><td>&nbsp;<?php echo $row['asal_sekolah']; ?></td>
                                        </tr>
                                        <tr>
                                            <td width="115">&nbsp;No.Peserta</td><td>:</td><td style="font-size:12px;font-weight:bold;">&nbsp;<?php echo $row['nisn']; ?>/<?php echo $row['nomor_peserta']; ?></td>
                                        </tr>
                                        <tr>
                                            <td width="115">&nbsp;Ruangan</td><td>:</td><td style="font-size:12px;font-weight:bold;">&nbsp;<?php echo $row['nama_ruangan']; ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3">
                                                <center>
                                                    <table border="1px" width="92%">
                                                        <tbody>
                                                            <tr>
                                                                <br>
                                                                <td style="width: 300 px; text-align: center;">Kartu ini adalah tanda peserta Try Out Akbar SMP muhammadiyah 06 Dau. Harap Simpan Baik-Baik kartu ini.</td>

                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <br>
                                                </center>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        <?php }?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

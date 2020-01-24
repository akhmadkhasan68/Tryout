<link rel="stylesheet" href="../assets/css/vendor.bundle.css">
<link rel="stylesheet" href="../assets/css/app.bundle.css">
<!-- <link rel="stylesheet" href="../assets/css/theme-a.css"> -->
<!-- <div class="row"> -->
<?php 
	include "../../koneksi/koneksi.php";
	include "../../function/myfunction.php";

    $select_peserta = select_data($con, "*", "tbl_ruang_ujian ru", ["tbl_ruangan r ON r.id = ru.id_ruangan", "tbl_siswa s ON s.id = ru.id_siswa", "tbl_nomor_peserta np ON np.id = s.id_nomor_peserta"]);
    
    while ($row = mysqli_fetch_assoc($select_peserta)) {
?>
    <!-- <div class="col-md-4"> -->
        <table style="width:8.5cm;border:1px solid black; line-height: 25px; margin-top:20px;  margin-left: 20px; display: inline-block;">
            <tbody>
                <tr>
                    <td colspan="3" style="border-bottom:1px solid black">
                        <table width="100%" style="background-color:#FFFFFF" border="1">
                            <tbody>
                                <tr>
                                    <td align="center" style="padding: 12px;" width="27%">
                                        <canvas width="50" height="50" style="display: none;"></canvas>
                                        <img src="../../assets/front/img/logo-sch.png" height="60">
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
    <!-- </div> -->
<?php }?>
<!-- </div> -->
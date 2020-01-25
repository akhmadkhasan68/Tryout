	<div id="content" class="container">
    <div class="content-body">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        Total Peserta
                        <h1 style="font-size: 60px;">
                            <?php  
                                $count_peserta = select_data($con, "*", "tbl_siswa", NULL, ["pembayaran = '1' AND asal_sekolah = '$nama_sekolah'"]);
                                echo mysqli_num_rows($count_peserta);
                            ?>
                        </h1>
                        <span style="color: #b0b0b0;">Peserta Terdaftar Dalam Sistem</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        Peserta Telah Melakukan Pembayaran
                        <h1 style="font-size: 60px;">
                            <?php  
                                $count_peserta_paid = select_data($con, "*", "tbl_siswa", NULL, ["pembayaran = '1' AND asal_sekolah = '$nama_sekolah'"]);
                                echo mysqli_num_rows($count_peserta_paid);
                            ?>
                        </h1>
                        <span style="color: #b0b0b0;">Peserta yang sudah melakukan pembayaran</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        Peserta Belum Melakukan Pembayaran
                        <h1 style="font-size: 60px;">
                            <?php  
                                $count_peserta_unpaid = select_data($con, "*", "tbl_siswa", NULL, ["pembayaran = '0' AND asal_sekolah = '$nama_sekolah'"]);
                                echo mysqli_num_rows($count_peserta_unpaid);
                            ?>
                        </h1>
                        <span style="color: #b0b0b0;">Peserta yang belum melakukan pembayaran</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
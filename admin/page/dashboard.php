<div id="content" class="container">
    <div class="content-body">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        Total Peserta
                        <h1 style="font-size: 60px;">
                            <?php  
                                $count_peserta = select_data($con, "*", "tbl_siswa", NULL, ["pembayaran = '1'"]);
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
                        Total Sekolah Mendaftar
                        <h1 style="font-size: 60px;">
                            <?php  
                                $count_sekolah = select_data($con, "*", "tbl_sekolah");
                                echo mysqli_num_rows($count_sekolah);
                            ?>
                        </h1>
                        <span style="color: #b0b0b0;">Sekolah Terdaftar Dalam Sistem</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        Total Ruangan
                        <h1 style="font-size: 60px;">
                            <?php  
                                $count_ruangan = select_data($con, "*", "tbl_ruangan");
                                echo mysqli_num_rows($count_ruangan);
                            ?>
                        </h1>
                        <span style="color: #b0b0b0;">Ruangan Terdaftar Dalam Sistem</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
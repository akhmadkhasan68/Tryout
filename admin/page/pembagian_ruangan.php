<?php 
    $cek_sekolah = select_data($con, "*", "tbl_sekolah");
    if (mysqli_num_rows($cek_sekolah) < 1) {
?>
    <div id="content" class="container-fluid">
        <div class="content-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="alert alert-warning">
                                <b>Perhatian!</b> anda belum bisa mengakses halaman ini karena anda belum memiliki data sekolah. <a href="index.php?page=data_sekolah">Klik disini!</a> untuk menambahkan data sekolah.
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
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        Total Data Sekolah
                        <h1 style="font-size: 60px;">
                            <?php 
                                $count = select_data($con, "*","tbl_siswa group by asal_sekolah");
                                echo mysqli_num_rows($count);
                            ?>
                        </h1>
                        <span style="color: #b0b0b0;">Data Sekolah Dalam Sistem</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        Total Data Ruangan
                        <h1 style="font-size: 60px;">
                            <?php 
                                $count = select_data($con, "*","tbl_ruangan");
                                echo mysqli_num_rows($count);
                            ?>
                        </h1>
                        <span style="color: #b0b0b0;">Data Ruang Dalam Sistem</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        Total Kapasitas Ruangan
                        <h1 style="font-size: 60px;">
                            <?php 
                                $count_kapasitas = select_data($con, "*", "tbl_ruangan", NULL, NULL, NULL);
                                $kapasitas_ruangan = 0;
                                while ($rr = mysqli_fetch_assoc($count_kapasitas)) {
                                    $kapasitas += $rr['kapasitas'];
                                }
                                echo $kapasitas;
                            ?>
                        </h1>
                        <span style="color: #b0b0b0;">Total Kapasitas Ruang</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        Total Siswa Peserta
                        <h1 style="font-size: 60px;">
                            <?php 
                                $count = select_data($con, "*","tbl_siswa", NULL, ["pembayaran = '1'"]);
                                echo mysqli_num_rows($count);
                            ?>
                        </h1>
                        <span style="color: #b0b0b0;">Siswa Peserta</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-heading">
                        Data Ruangan
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-warning">
                                    <b>Peringatan!</b> Pembagian ruang hanya berlaku 1 (satu) kali untuk setiap ruang. Pastikan ketika akan melakukan proses ini data sudah benar. Data ruang yang sudah dibagi tidak dapat dihapus atau diubah.
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <?php
                                //SELECT RUANGAN
                                $select_ruangan = select_data($con, "*", "tbl_ruangan");
                                $jum_ruangan = mysqli_num_rows($select_ruangan);

                                if($jum_ruangan <= 4){
                                    $col_row = round(12/$jum_ruangan);
                                }else{
                                    $col_row = 3;
                                }

                                while ($row = mysqli_fetch_assoc($select_ruangan)) {
                            ?>
                                <div class="col-md-<?php echo $col_row;?>">
                                    <div class="card card-blue">
                                        <header class="card-heading">
                                            <h2 class="card-title">
                                                <?php 
                                                    echo $row['nama_ruangan'];
                                                ?>
                                            </h2>
                                        </header>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    Total Kapasitas Ruangan
                                                    <h1 style="font-size: 60px; color:#fff;">
                                                        <?php 
                                                            echo $row['kapasitas'];
                                                        ?>
                                                    </h1>
                                                    <?php 
                                                        $select_ruang_ujian = select_data($con, "*", "tbl_ruang_ujian", NULL, ["id_ruangan = '$row[id]'"]);
                                                        if(mysqli_num_rows($select_ruang_ujian) == 0){
                                                            echo '<div class="label label-danger">Ruangan belum diisi</div>';
                                                            $is_disabled = "";
                                                        }else{
                                                            echo '<div class="label label-success">Ruangan sudah diisi</div>';
                                                            $is_disabled = "disabled";
                                                        }
                                                    ?>
                                                </div>
                                            </div>
                                            <br>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <input type="hidden" name="id_ruangan" id="id-ruangan-<?php echo $row[id]?>" value="<?php echo $row['id']?>">
                                                    <button id="kirim-<?php echo $row[id]?>" class="btn btn-primary btn-round btn-block <?php echo $is_disabled;?>" <?php echo $is_disabled;?>>
                                                        Isi Ruang
                                                    </button>
                                                </div>
                                            </div>
                                        </div>    
                                    </div>
                                </div>

                                <script type="text/javascript">
                                    $(document).ready(function(){
                                        $("#kirim-<?php echo $row[id]?>").on('click', function(){
                                            var id_ruangan = $("#id-ruangan-<?php echo $row[id]?>").val();
                                            $("#loading-spin").show(); 
                                            $.ajax({
                                                url: 'ajax/ajax_action_bagi_ruangan.php',
                                                method: 'POST',
                                                data: {id_ruangan: id_ruangan},
                                                dataType: 'json',
                                                success: function(response){
                                                    $("#loading-spin").hide(); 
                                                    if(response.result == false)
                                                    {
                                                        toastr.error(response.message.body, response.message.head,{showMethod:"slideDown",hideMethod:"slideUp",timeOut:2e3});
                                                    }
                                                    if(response.result == true)
                                                    {
                                                        toastr.success(response.message.body, response.message.head,{showMethod:"slideDown",hideMethod:"slideUp",timeOut:2e3});

                                                        setTimeout(function () {
                                                            window.location.replace("index.php?page=pembagian_ruangan");
                                                        }, 1000);
                                                    }
                                                },
                                                error: function(){
                                                    alert('Error!');
                                                }
                                            });
                                        });
                                    });
                                </script>
                            <?php
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

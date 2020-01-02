<!--  -->
<div id="content" class="container-fluid">
    <div class="content-body">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-info">
                                    <b>Info!</b> Fitur ini digunakan untuk konfirmasi pembayaran peserta yang mendaftar. Pastikan setiap transaksi yang dilakukan terkonfirmasi.
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <a href="index.php?page=pembayaran&type=individu" class="btn btn-block btn-<?php if($_REQUEST[type] == '' || $_REQUEST[type] == 'individu'){echo 'primary';}else{echo 'default';}?>">Peserta Individu</a>
                            </div>
                            <div class="col-md-6">
                                <a href="index.php?page=pembayaran&type=sekolah" class="btn btn-block btn-<?php if($_REQUEST[type] == 'sekolah'){echo 'primary';}else{echo 'default';}?>">Peserta Sekolah</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <header class="card-heading ">
                        <?php 
                            if($_REQUEST['type'] == '' || $_REQUEST['type'] == 'individu'){
                        ?>
                            <h2 class="card-title">Data Peserta Individu</h2>
                        <?php
                            }elseif($_REQUEST['type'] == 'sekolah'){
                        ?>
                            <h2 class="card-title">Data Peserta Per-Sekolah</h2>  
                        <?php
                            }
                        ?>
                    </header>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <?php 
                                    if($_REQUEST['type'] == '' || $_REQUEST['type'] == 'individu'){
                                ?>
                                    <table class="table table-bordered table-striped">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>NISN</th>
                                            <th>Nomor Peserta</th>
                                            <th>Asal Sekolah</th>
                                            <th>Status Pembayaran</th>
                                            <th>Konfirmasi</th>
                                        </tr>
                                        <?php 
                                            $sekolah = [];
                                            $select_sekolah = select_data($con, "*", "tbl_sekolah");
                                            while ($rs = mysqli_fetch_assoc($select_sekolah)) {
                                                array_push($sekolah, $rs['nama_sekolah']);
                                            }
                                            $sql_where_not = '';
                                            for($i = 0; $i < count($sekolah); $i++){
                                                if($i == 0){
                                                    $sql_where_not .= "'".$sekolah[$i]."'";
                                                }
                                                else{
                                                    $sql_where_not .= ", '".$sekolah[$i]."'";   
                                                }
                                            }

                                            $no = 1;
                                            $select_individu = select_data($con, "s.id, s.nama, s.nisn, s.asal_sekolah, s.pembayaran, n.nomor_peserta", "tbl_siswa s", ["tbl_nomor_peserta n ON n.id = s.id_nomor_peserta"],["asal_sekolah NOT IN($sql_where_not)"]);
                                            if(mysqli_num_rows($select_individu) < 1){
                                        ?>
                                            <tr>
                                                <td colspan="7">
                                                    <div class="alert alert-warning">
                                                        Anda belum memiliki data!
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php      
                                            die();
                                            }
                                            while ($ri = mysqli_fetch_assoc($select_individu)) {
                                        ?>
                                            <tr>
                                                <td><?php echo $no++; ?></td>
                                                <td><?php echo $ri['nama'];?></td>
                                                <td><?php echo $ri['nisn'];?></td>
                                                <td><?php echo $ri['nisn']."/".$ri['nomor_peserta'];?></td>
                                                <td><?php echo $ri['asal_sekolah'];?></td>
                                                <td><?php if($ri['pembayaran'] == "1"){echo "<div class='label label-success'>Sudah melakukan pembayaran</div>";}else{echo "<div class='label label-danger'>Belum melakukan pembayaran</div>";}?></td>
                                                <td>
                                                    <?php 
                                                        if($ri['pembayaran'] == "1"){
                                                            echo "<div class='label label-success'>Sudah melakukan pembayaran</div>";
                                                        }else{
                                                    ?>
                                                        <a data-toggle="modal" data-target="#modal-confirm-<?php echo $ri[id];?>" class="btn btn-android btn-fab btn-fab-sm">
                                                        <i class="zmdi zmdi-check"></i>
                                                        </a>
                                                    <?php } ?>
                                                </td>
                                            </tr>

                                            <!-- MODAL CONFIRM  -->
                                            <div class="modal fade" id="modal-confirm-<?php echo $ri[id];?>" tabindex="-1" role="dialog" aria-labelledby="modal-notification" >
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h6 class="modal-title">Apakah anda yakin?</h6>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="alert alert-warning">
                                                                <b>Peringatan!</b> Apakah anda yakin untuk melakukan konfirmasi pembayaran peserta ini? Klik Ok untuk melanjutkan!</b>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-success" id="confirmOk-<?php echo $ri[id];?>">Ok</button>
                                                            <button type="button" class="btn btn-danger" id="confirmCancel-<?php echo $ri[id];?>" data-dismiss="modal">Batal</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- END MODAL CONFIRM -->

                                            <script type="text/javascript">
                                                $(document).ready(function(){
                                                    $("#confirmOk-<?php echo $ri[id];?>").on('click', function(){
                                                        var id = '<?php echo $ri[id]; ?>';
                                                        $.ajax({
                                                            url: 'ajax/ajax_update_confirm_individu.php',
                                                            method: 'POST',
                                                            data: {id: id},
                                                            dataType: 'JSON',
                                                            success: function(response){
                                                                if(response.result == false)
                                                                {
                                                                    toastr.error(response.message.body, response.message.head,{showMethod:"slideDown",hideMethod:"slideUp",timeOut:2e3});
                                                                }
                                                                if(response.result == true)
                                                                {
                                                                    toastr.success(response.message.body, response.message.head,{showMethod:"slideDown",hideMethod:"slideUp",timeOut:2e3});

                                                                    setTimeout(function () {
                                                                        window.location.replace("index.php?page=pembayaran&type=individu");
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
                                    </table>
                                <?php
                                    }elseif($_REQUEST['type'] == 'sekolah'){
                                ?>
                                    <table class="table table-bordered table-striped">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Guru</th>
                                            <th>NIK</th>
                                            <th>Asal Sekolah</th>
                                            <th>Jumlah Peserta</th>
                                            <th>Status Pembayaran</th>
                                            <th>Konfirmasi</th>
                                        </tr>
                                        <?php 
                                            $no = 1;
                                            $select_sekolah_peserta = select_data($con, "g.id, g.nama, g.nik, s.nama_sekolah, g.pembayaran", "tbl_guru g", ["tbl_sekolah s ON s.id = g.id_sekolah"]);
                                            if(mysqli_num_rows($select_sekolah_peserta) < 1){
                                        ?>
                                            <tr>
                                                <td colspan="7">
                                                    <div class="alert alert-warning">
                                                        Anda belum memiliki data!
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php      
                                            die();
                                            }
                                            while ($row = mysqli_fetch_assoc($select_sekolah_peserta)) {
                                        ?>
                                            <tr>
                                                <td><?php echo $no++; ?></td>
                                                <td><?php echo $row['nama']; ?></td>
                                                <td><?php echo $row['nik']; ?></td>
                                                <td><?php echo $row['nama_sekolah']; ?></td>
                                                <td>
                                                    <?php 
                                                        $nama_sekolah = $row['nama_sekolah']; 
                                                        $select_peserta = select_data($con, "*", "tbl_siswa", NULL, ["asal_sekolah = '$nama_sekolah'"]);
                                                        if(mysqli_num_rows($select_peserta)> 0){
                                                            echo mysqli_num_rows($select_peserta)." Peserta terdaftar dalam sistem";
                                                        }else{
                                                            echo '<div class="label label-danger">Belum ada siswa yang terdaftar</div>';
                                                        }
                                                    ?>    
                                                </td>
                                                <td>
                                                    <?php 
                                                        if($row['pembayaran'] == 0){
                                                            echo '<div class="label label-danger">Belum Melakukan Pembayaran</div>';
                                                        }else{
                                                            echo '<div class="label label-success">Sudah Melakukan Pembayaran</div>';
                                                        }
                                                    ?>
                                                </td>
                                                <td>
                                                   <?php 
                                                        $check_pembayaran_peserta = select_data($con, "*", "tbl_siswa", NULL, ["asal_sekolah = '$nama_sekolah' AND pembayaran = '0'"]);
                                                        if(mysqli_num_rows($select_peserta) == 0){
                                                    ?>
                                                        <div class="label label-danger">Belum ada siswa yang terdaftar</div>
                                                    <?php
                                                        }elseif($row['pembayaran'] == 0 && mysqli_num_rows($check_pembayaran_peserta) > 0){
                                                    ?>

                                                        <div class="label label-warning">Beberapa peserta dalam sekolah ini belum melakukan pembayaran</div>
                                                    <?php
                                                        }elseif($row['pembayaran'] == 0 && mysqli_num_rows($select_peserta) > 0 &&mysqli_num_rows($check_pembayaran_peserta) == 0){
                                                    ?>
                                                        <a data-toggle="modal" data-target="#modal-confirm-<?php echo $row[id];?>" class="btn btn-android btn-fab btn-fab-sm">
                                                        <i class="zmdi zmdi-check"></i>
                                                        </a>
                                                    <?php
                                                        }else{
                                                    ?>
                                                        <div class="label label-success">Sudah melakukan pembayaran</div>
                                                    <?php } ?>
                                                </td>
                                            </tr>

                                            <!-- MODAL CONFIRM  -->
                                            <div class="modal fade" id="modal-confirm-<?php echo $row[id];?>" tabindex="-1" role="dialog" aria-labelledby="modal-notification" >
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h6 class="modal-title">Apakah anda yakin?</h6>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="alert alert-warning">
                                                                <b>Peringatan!</b> Apakah anda yakin untuk melakukan konfirmasi pembayaran peserta ini? Klik Ok untuk melanjutkan!</b>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-success" id="confirmOk-<?php echo $row[id];?>">Ok</button>
                                                            <button type="button" class="btn btn-danger" id="confirmCancel-<?php echo $row[id];?>" data-dismiss="modal">Batal</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- END MODAL CONFIRM -->

                                            <script type="text/javascript">
                                                $(document).ready(function(){
                                                    $("#confirmOk-<?php echo $row[id];?>").on('click', function(){
                                                        var id = '<?php echo $row[id]; ?>';
                                                        $.ajax({
                                                            url: 'ajax/ajax_update_confirm_sekolah.php',
                                                            method: 'POST',
                                                            data: {id: id},
                                                            dataType: 'JSON',
                                                            success: function(response){
                                                                if(response.result == false)
                                                                {
                                                                    toastr.error(response.message.body, response.message.head,{showMethod:"slideDown",hideMethod:"slideUp",timeOut:2e3});
                                                                }
                                                                if(response.result == true)
                                                                {
                                                                    toastr.success(response.message.body, response.message.head,{showMethod:"slideDown",hideMethod:"slideUp",timeOut:2e3});

                                                                    setTimeout(function () {
                                                                        window.location.replace("index.php?page=pembayaran&type=sekolah");
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
                                    </table>
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
</div>


<script type="text/javascript">
    $(document).ready(function(){
        $("#batal-add").on('click', function(){
            window.location.replace("index.php?page=data_sekolah");
        });

        $("#submit-add").on("click", function(){
            var nama_sekolah = $("#nama_sekolah").val();
            var npsn = $("#npsn").val();
            var alamat = $("#alamat").val();

            $.ajax({
                url: 'ajax/ajax_add_sekolah.php',
                method: 'POST',
                dataType: 'json',
                data: {
                    nama_sekolah: nama_sekolah,
                    npsn: npsn,
                    alamat: alamat
                },
                success: function(response){
                    if(response.result == false)
                    {
                        toastr.error(response.message.body, response.message.head,{showMethod:"slideDown",hideMethod:"slideUp",timeOut:2e3});
                    }
                    if(response.result == true)
                    {
                        toastr.success(response.message.body, response.message.head,{showMethod:"slideDown",hideMethod:"slideUp",timeOut:2e3});

                        setTimeout(function () {
                            window.location.replace("index.php?page=data_sekolah");
                        }, 1000);
                    }
                },
                error: function(){
                    alert("Error");
                }
            });
        });
    });
</script>

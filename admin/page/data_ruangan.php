<?php 
    $cek_sekolah = select_data($con, "*", "tbl_sekolah", NULL, NULL, NULL);
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
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        Total Data Ruangan
                        <h1 style="font-size: 60px;">
                            <?php 
                                $count = select_data($con, "*", "tbl_ruangan", NULL, NULL, NULL);
                                echo mysqli_num_rows($count);
                            ?>
                        </h1>
                        <span style="color: #b0b0b0;">Data Ruangan Yang Terdaftar Dalam Dalam Sistem</span>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
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
                        <span style="color: #b0b0b0;">Total Kapasitas Ruangan Yang Terdaftar Dalam Dalam Sistem</span>
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
                        <!-- BEGIN BUTTON ROW -->
                        <div class="row">
                            <div class="col-md-4">
                                <a data-toggle="modal" data-target="#modal_add" class="btn btn-info btn-block"><i class="zmdi zmdi-plus"></i>Tambah Data</a>
                            </div>
                            <div class="col-md-4">
                                <a href="index.php?page=import_data_ruangan" class="btn btn-success btn-block"><i class="zmdi zmdi-file-plus"></i>Import Data Excel</a>
                            </div>
                            <div class="col-md-4">
                                <a href="../berkas/format_data_ruangan.xls" class="btn btn-warning btn-block"><i class="zmdi zmdi-download"></i>Download Format Excel</a>
                            </div>
                        </div>
                        <!-- END BUTTON ROW -->

                        <br>

                        <!-- BEGIN TABLE ROW -->
                        <table class="table table-bordered table-striped">
                            <tr>
                                <th>No</th>
                                <th>Nama Ruangan</th>
                                <th>Kapasitas</th>
                                <th>Aksi</th>
                            </tr>
                            <?php 
                                $no = 1;
                                $select = select_data($con, "*", "tbl_ruangan");
                                if(mysqli_num_rows($select) > 0){
                                    while($row = mysqli_fetch_assoc($select)){
                            ?>
                                        <tr>
                                            <td><?php echo $no++;?></td>
                                            <td><?php echo $row['nama_ruangan']; ?></td>
                                            <td><?php echo $row['kapasitas']; ?></td>
                                            <td>
                                                <button class="btn btn-success btn-fab btn-fab-sm" data-toggle="modal" data-target="#modal_edit_<?php echo $row[id];?>"><i class="zmdi zmdi-edit"></i><div class="ripple-container"></div></button>
                                                <button class="btn btn-danger btn-fab btn-fab-sm" data-toggle="modal" data-target="#modal-confirm-<?php echo $row[id];?>"><i class="zmdi zmdi-delete"></i><div class="ripple-container"></div></button>
                                            </td>
                                        </tr>

                                        <!-- MODAL ADD BEGIN -->
                                        <div class="modal fade" id="modal_edit_<?php echo $row[id];?>" tabindex="-1" role="dialog" aria-labelledby="modal_edit_<?php echo $row[id];?>">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">

                                                        <h4 class="modal-title" id="myModalLabel-2">Edit Data Ruangan</h4>
                                                        <ul class="card-actions icons right-top">

                                                            <a href="javascript:void(0)" data-dismiss="modal" class="text-white" aria-label="Close">
                                                                <i class="zmdi zmdi-close"></i>
                                                            </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label>Nama</label>
                                                                <input type="text" name="nama_ruangan_<?php echo $row[id]?>" id="nama_ruangan_<?php echo $row[id]?>" placeholder="Nama Ruangan" class="form-control" value="<?php echo $row['nama_ruangan'] ?>">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label>Kapasitas</label>
                                                                <input type="number" name="kapasitas_<?php echo $row[id]?>" id="kapasitas_<?php echo $row[id]?>" placeholder="Kapasitas Ruangan" class="form-control" value="<?php echo $row['kapasitas'] ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button id="batal-update-<?php echo $row[id];?>" class="btn btn-default btn-flat" data-dismiss="modal">Batal</button>
                                                        <button id="submit-update-<?php echo $row[id];?>" class="btn btn-primary">Kirim</button>
                                                    </div>
                                                </div>
                                                <!-- modal-content -->
                                            </div>
                                            <!-- modal-dialog -->
                                        </div>
                                        <!-- MODAL ADD END -->

                                        <!-- MODAL CONFIRM  -->
                                        <div class="modal fade" id="modal-confirm-<?php echo $row[id];?>" tabindex="-1" role="dialog" aria-labelledby="modal-notification" >
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h6 class="modal-title">Apakah anda yakin?</h6>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="alert alert-danger">
                                                            <b>Peringatan!</b> Menghapus data ruangan akan sekaligus menghapus data siswa yang terhubung dengan data ruangan. <b>Klik Ok untuk melanjutkan!</b>
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
                                                $("#batal-update-<?php echo $row[id];?>").on('click', function(){
                                                    window.location.replace("index.php?page=data_ruangan");
                                                });

                                                $("#confirmOk-<?php echo $row[id];?>").on('click', function(){
                                                    var id = '<?php echo $row[id]; ?>';

                                                    $.ajax({
                                                        url: 'ajax/ajax_delete_ruangan.php',
                                                        method: 'POST',
                                                        dataType: 'json',
                                                        data: {
                                                            id: id
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
                                                                    window.location.replace("index.php?page=data_ruangan");
                                                                }, 1000);
                                                            }
                                                        },
                                                        error: function(){
                                                            alert("Error");
                                                        }
                                                    });
                                                });

                                                $("#submit-update-<?php echo $row[id];?>").on("click", function(){
                                                    var id = '<?php echo $row[id]; ?>';
                                                    var nama_ruangan = $("#nama_ruangan_<?php echo $row[id]; ?>").val();
                                                    var kapasitas = $("#kapasitas_<?php echo $row[id]; ?>").val();

                                                    $.ajax({
                                                        url: 'ajax/ajax_update_ruangan.php',
                                                        method: 'POST',
                                                        dataType: 'json',
                                                        data: {
                                                            nama_ruangan: nama_ruangan,
                                                            kapasitas: kapasitas,
                                                            id: id
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
                                                                    window.location.replace("index.php?page=data_ruangan");
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
                            <?php
                                    }
                                }else{
                                    echo "
                                    <tr>
                                        <td colspan='8'>
                                            <div class='alert alert-warning'>Anda belum memiliki data ruangan!</div>
                                        </td>
                                    </tr>";
                                }
                            ?>
                        </table>
                        <!-- END TABLE ROW -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL ADD BEGIN -->
<div class="modal fade" id="modal_add" tabindex="-1" role="dialog" aria-labelledby="modal_add">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title" id="myModalLabel-2">Tambah Data Ruangan</h4>
                <ul class="card-actions icons right-top">

                    <a href="javascript:void(0)" data-dismiss="modal" class="text-white" aria-label="Close">
                        <i class="zmdi zmdi-close"></i>
                    </a>
                    </li>
                </ul>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <input type="text" name="nama_ruangan" id="nama_ruangan" placeholder="Nama Ruangan" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <input type="number" name="kapasitas" id="kapasitas" placeholder="Kapasitas Ruangan" class="form-control">
                    </div>
                </div>  
            </div>
            <div class="modal-footer">
                <button id="batal-add" class="btn btn-default btn-flat" data-dismiss="modal">Batal</button>
                <button id="submit-add" class="btn btn-primary">Kirim</button>
            </div>
        </div>
        <!-- modal-content -->
    </div>
    <!-- modal-dialog -->
</div>
<!-- MODAL ADD END -->

<script type="text/javascript">
    $(document).ready(function(){
        $("#batal-add").on('click', function(){
            window.location.replace("index.php?page=data_ruangan");
        });

        $("#submit-add").on("click", function(){
            var nama_ruangan = $("#nama_ruangan").val();
            var kapasitas = $("#kapasitas").val();

            $.ajax({
                url: 'ajax/ajax_add_ruangan.php',
                method: 'POST',
                dataType: 'json',
                data: {
                    nama_ruangan: nama_ruangan,
                    kapasitas: kapasitas,
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
                            window.location.replace("index.php?page=data_ruangan");
                        }, 1000);
                    }
                    //console.log(response);
                },
                error: function(){
                    alert("Error");
                }
            });
        });
    });
</script>

<div id="content" class="container-fluid">
    <div class="content-body">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        Total Data Sekolah
                        <h1 style="font-size: 60px;">
                            <?php 
                                $count = select_data($con, "tbl_sekolah", NULL, NULL);
                                echo mysqli_num_rows($count);
                            ?>
                        </h1>
                        <span style="color: #b0b0b0;">Data Sekolah Dalam Sistem</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-heading">
                        Data Sekolah
                    </div>
                    <div class="card-body">
                        <!-- BEGIN BUTTON ROW -->
                        <div class="row">
                            <div class="col-md-4">
                                <a data-toggle="modal" data-target="#modal_add" class="btn btn-info btn-block"><i class="zmdi zmdi-plus"></i>Tambah Data</a>
                            </div>
                            <div class="col-md-4">
                                <a href="index.php?page=import_sekolah_excel" class="btn btn-success btn-block"><i class="zmdi zmdi-file-plus"></i>Import Data Excel</a>
                            </div>
                            <div class="col-md-4">
                                <a href="../berkas/format_data_sekolah.xlsx" class="btn btn-warning btn-block"><i class="zmdi zmdi-download"></i>Download Format Excel</a>
                            </div>
                        </div>
                        <!-- END BUTTON ROW -->

                        <br>

                        <!-- BEGIN TABLE ROW -->
                        <table class="table table-bordered table-striped">
                            <tr>
                                <th>No</th>
                                <th>Nama Sekolah</th>
                                <th>NPSN Sekolah</th>
                                <th>Alamat</th>
                                <th>Aksi</th>
                            </tr>
                            <?php 
                                $no = 1;
                                $select = select_data($con, "tbl_sekolah", NULL, NULL);
                                if(mysqli_num_rows($select) > 0){
                                    while($row = mysqli_fetch_assoc($select)){
                            ?>
                                        <tr>
                                            <td><?php echo $no++;?></td>
                                            <td><?php echo $row['nama_sekolah']; ?></td>
                                            <td><?php echo $row['npsn']; ?></td>
                                            <td><?php echo $row['alamat']; ?></td>
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

                                                        <h4 class="modal-title" id="myModalLabel-2">Edit Data Sekolah</h4>
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
                                                                <input type="text" name="nama_sekolah" id="nama_sekolah_<?php echo $row[id];?>" placeholder="Nama Sekolah" class="form-control" value="<?php echo $row[nama_sekolah];?>">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <input type="text" name="npsn" id="npsn_<?php echo $row[id];?>" placeholder="NPSN Sekolah" class="form-control" value="<?php echo $row[npsn]; ?>">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <textarea name="alamat" id="alamat_<?php echo $row[id];?>" placeholder="Alamat Sekolah" class="form-control"><?php echo $row[alamat]; ?></textarea>
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
                                                            <b>Peringatan!</b> Menghapus data kelas akan sekaligus menghapus data terkait dengan data kelas. Seperti: Data siswa, data nilai, data pembayaran, dan kartu peserta. <b>Klik Ok untuk melanjutkan!</b>
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
                                                    window.location.replace("index.php?page=data_sekolah");
                                                });

                                                $("#confirmOk-<?php echo $row[id];?>").on('click', function(){
                                                    var id = '<?php echo $row[id]; ?>';

                                                    $.ajax({
                                                        url: 'ajax/ajax_delete_sekolah.php',
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
                                                                    window.location.replace("index.php?page=data_sekolah");
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
                                                    var nama_sekolah = $("#nama_sekolah_<?php echo $row[id];?>").val();
                                                    var npsn = $("#npsn_<?php echo $row[id];?>").val();
                                                    var alamat = $("#alamat_<?php echo $row[id];?>").val();

                                                    $.ajax({
                                                        url: 'ajax/ajax_update_sekolah.php',
                                                        method: 'POST',
                                                        dataType: 'json',
                                                        data: {
                                                            nama_sekolah: nama_sekolah,
                                                            npsn: npsn,
                                                            alamat: alamat,
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
                            <?php
                                    }
                                }else{
                                    echo "
                                    <tr>
                                        <td colspan='5'>
                                            <div class='alert alert-warning'>Anda belum memiliki data kelas!</div>
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

                <h4 class="modal-title" id="myModalLabel-2">Tambah Data Sekolah</h4>
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
                        <input type="text" name="nama_sekolah" id="nama_sekolah" placeholder="Nama Sekolah" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="npsn" id="npsn" placeholder="NPSN Sekolah" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <textarea name="alamat" id="alamat" placeholder="Alamat Sekolah" class="form-control"></textarea>
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

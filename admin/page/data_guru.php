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
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        Total Data Guru
                        <h1 style="font-size: 60px;">
                            <?php 
                                $count = select_data($con, "*", "tbl_guru", NULL, NULL, NULL);
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
                                <a href="../berkas/format_data_sekolah.xls" class="btn btn-warning btn-block"><i class="zmdi zmdi-download"></i>Download Format Excel</a>
                            </div>
                        </div>
                        <!-- END BUTTON ROW -->

                        <br>

                        <!-- BEGIN TABLE ROW -->
                        <table class="table table-bordered table-striped">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>NIK</th>
                                <th>Sekolah</th>
                                <th>Nomor Telepon</th>
                                <th>Alamat</th>
                                <th>Aksi</th>
                            </tr>
                            <?php 
                                $no = 1;
                                $select = select_data($con, "g.id, g.nama, g.nik, g.id_sekolah, g.nomor_tlp, g.alamat, g.username, s.nama_sekolah, s.npsn", "tbl_guru g", ["tbl_sekolah s ON s.id = g.id_sekolah"], NULL, NULL);
                                if(mysqli_num_rows($select) > 0){
                                    while($row = mysqli_fetch_assoc($select)){
                            ?>
                                        <tr>
                                            <td><?php echo $no++;?></td>
                                            <td><?php echo $row['nama']; ?></td>
                                            <td><?php echo $row['username']; ?></td>
                                            <td><?php echo $row['nik']; ?></td>
                                            <td><?php echo $row['nama_sekolah']; ?></td>
                                            <td><?php echo $row['nomor_tlp']; ?></td>
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

                                                        <h4 class="modal-title" id="myModalLabel-2">Edit Data Guru</h4>
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
                                                                <input type="text" name="nama" id="nama_<?php echo $row[id]?>" placeholder="Nama Guru" class="form-control" value="<?php echo $row[nama] ?>">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label>NIK</label>
                                                                <input type="text" name="nik" id="nik_<?php echo $row[id]?>" placeholder="NIK Guru" class="form-control" value="<?php echo $row[nik] ?>">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label>Asal Sekolah</label>
                                                                <select class="select form-control" id="id_sekolah_<?php echo $row[id]?>" name="id_sekolah">
                                                                    <option value="0">Pilih Asal Sekolah</option>
                                                                    <?php  
                                                                        $sekolah = select_data($con, "*", "tbl_sekolah", NULL, NULL, NULL);
                                                                        while ($rs = mysqli_fetch_assoc($sekolah)) {
                                                                    ?>  
                                                                        <option value="<?php echo $rs['id'] ?>" <?php if($rs['id'] == $row['id_sekolah']){echo "selected";}?>><?php echo $rs['nama_sekolah'] ?></option>
                                                                    <?php
                                                                        }
                                                                    ?>
                                                                  </select>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label>Nomor Telepon</label>
                                                                <input type="text" name="nomor_tlp" id="nomor_tlp_<?php echo $row[id]?>" placeholder="Nomor Telepon" class="form-control" value="<?php echo $row[nomor_tlp] ?>">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <label>Username</label>
                                                                <input type="text" name="username" id="username_<?php echo $row[id]?>" placeholder="Username" class="form-control" value="<?php echo $row[username] ?>">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <label>Alamat</label>
                                                                <textarea name="alamat" id="alamat_<?php echo $row[id]?>" class="form-control" placeholder="Alamat Lengkap"><?php echo $row[alamat] ?></textarea>
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
                                                            <b>Peringatan!</b> Menghapus data guru akan sekaligus menghapus data siswa yang terhubung dengan data guru. <b>Klik Ok untuk melanjutkan!</b>
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
                                                    window.location.replace("index.php?page=data_guru");
                                                });

                                                $("#confirmOk-<?php echo $row[id];?>").on('click', function(){
                                                    var id = '<?php echo $row[id]; ?>';

                                                    $.ajax({
                                                        url: 'ajax/ajax_delete_guru.php',
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
                                                                    window.location.replace("index.php?page=data_guru");
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
                                                    var nama = $("#nama_<?php echo $row[id]; ?>").val();
                                                    var nik = $("#nik_<?php echo $row[id]; ?>").val();
                                                    var id_sekolah = $("#id_sekolah_<?php echo $row[id]; ?>").val();
                                                    var nomor_tlp = $("#nomor_tlp_<?php echo $row[id]; ?>").val();
                                                    var username = $("#username_<?php echo $row[id]; ?>").val();
                                                    var alamat = $("#alamat_<?php echo $row[id]; ?>").val();

                                                    $.ajax({
                                                        url: 'ajax/ajax_update_guru.php',
                                                        method: 'POST',
                                                        dataType: 'json',
                                                        data: {
                                                            nama: nama,
                                                            nik: nik,
                                                            id_sekolah: id_sekolah,
                                                            nomor_tlp: nomor_tlp,
                                                            username: username,
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
                                                                    window.location.replace("index.php?page=data_guru");
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
                                            <div class='alert alert-warning'>Anda belum memiliki data sekolah!</div>
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

                <h4 class="modal-title" id="myModalLabel-2">Tambah Data Guru</h4>
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
                        <input type="text" name="nama" id="nama" placeholder="Nama Guru" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="nik" id="nik" placeholder="NIK Guru" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                          <select class="select form-control" id="id_sekolah" name="id_sekolah">
                            <option value="0">Pilih Asal Sekolah</option>
                            <?php  
                                $sekolah = select_data($con, "*", "tbl_sekolah", NULL, NULL, NULL);
                                while ($rs = mysqli_fetch_assoc($sekolah)) {
                            ?>  
                                <option value="<?php echo $rs['id'] ?>"><?php echo $rs['nama_sekolah'] ?></option>
                            <?php
                                }
                            ?>
                          </select>
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="nomor_tlp" id="nomor_tlp" placeholder="Nomor Telepon" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <input type="text" name="username" id="username" placeholder="Username" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <textarea name="alamat" id="alamat" class="form-control" placeholder="Alamat Lengkap"></textarea>
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
            window.location.replace("index.php?page=data_guru");
        });

        $("#submit-add").on("click", function(){
            var nama = $("#nama").val();
            var nik = $("#nik").val();
            var id_sekolah = $("#id_sekolah").val();
            var nomor_tlp = $("#nomor_tlp").val();
            var username = $("#username").val();
            var alamat = $("#alamat").val();

            $.ajax({
                url: 'ajax/ajax_add_guru.php',
                method: 'POST',
                dataType: 'json',
                data: {
                    nama: nama,
                    nik: nik,
                    id_sekolah: id_sekolah,
                    nomor_tlp: nomor_tlp,
                    username: username,
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
                            window.location.replace("index.php?page=data_guru");
                        }, 1000);
                    }
                    console.log(response);
                },
                error: function(){
                    alert("Error");
                }
            });
        });
    });
</script>

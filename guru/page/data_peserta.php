<div id="content" class="container-fluid">
    <div class="content-body">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        Total Data Peserta 
                        <h1 style="font-size: 60px;">
                            <?php 
                                $count = select_data($con, "*", "tbl_siswa", NULL, ["asal_sekolah = '$nama_sekolah'"]);
                                echo mysqli_num_rows($count);
                            ?>
                        </h1>
                        <span style="color: #b0b0b0;">Data Peserta <?php echo $nama_sekolah; ?> Yang Terdaftar Dalam Sistem</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-heading">
                        Data Peserta
                    </div>
                    <div class="card-body">
                        <!-- BEGIN BUTTON ROW -->
                        <div class="row">
                            <div class="col-md-4">
                                <a data-toggle="modal" data-target="#modal_add" class="btn btn-info btn-block"><i class="zmdi zmdi-plus"></i>Tambah Data</a>
                            </div>
                            <div class="col-md-4">
                                <a href="index.php?page=import_data_guru" class="btn btn-success btn-block"><i class="zmdi zmdi-file-plus"></i>Import Data Excel</a>
                            </div>
                            <div class="col-md-4">
                                <a href="../berkas/format_data_guru.xls" class="btn btn-warning btn-block"><i class="zmdi zmdi-download"></i>Download Format Excel</a>
                            </div>
                        </div>
                        <!-- END BUTTON ROW -->

                        <br>

                        <!-- BEGIN TABLE ROW -->
                        <table class="table table-bordered table-striped">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>NISN</th>
                                <th>Nomor Peserta</th>
                                <th>Asal Sekolah</th>
                                <th>Status Pembayaran</th>
                                <th>Aksi</th>
                            </tr>
                            <?php 
                                $no = 1;
                                $select = select_data($con, "s.id, s.nama, s.nisn, s.asal_sekolah, s.jenis_kelamin, s.nomor_tlp, s.alamat, s.pembayaran, s.tgl_mendaftar, np.nomor_peserta", "tbl_siswa s", ["tbl_nomor_peserta np ON np.id = s.id_nomor_peserta"], ["s.asal_sekolah = '$nama_sekolah'"]);
                                if(mysqli_num_rows($select) > 0){
                                    while($row = mysqli_fetch_assoc($select)){
                            ?>
                                        <tr>
                                            <td><?php echo $no++;?></td>
                                            <td><?php echo $row['nama']; ?></td>
                                            <td><?php echo $row['nisn']; ?></td>
                                            <td><?php echo $row['nisn']."/".$row['nomor_peserta']; ?></td>
                                            <td><?php echo $row['asal_sekolah']; ?></td>
                                            <?php 
                                                $date = date('d, M Y H:i:s', strtotime("+1 day", strtotime($row['tgl_mendaftar'])));
                                            ?>
                                            <td><?php if($row['pembayaran'] == 0){echo "<div class='label label-danger' style='font-size:7.5px;'>Belum Melakukan Pembayaran. Berakhir pada $date</div>"; }else{echo "<div class='label label-success' style='font-size:7.5px;'>Sudah Melakukan Pembayaran</div>";} ?>
                                                
                                            </td>
                                            <td>
                                                <button class="btn btn-primary btn-fab btn-fab-sm" data-toggle="modal" data-target="#moda_detail_<?php echo $row[id];?>"><i class="zmdi zmdi-info"></i><div class="ripple-container"></div></button>
                                            </td>
                                        </tr>

                                        <!-- MODAL DETAIL BEGIN -->
                                        <div class="modal fade" id="moda_detail_<?php echo $row[id];?>" tabindex="-1" role="dialog" aria-labelledby="moda_detail_<?php echo $row[id];?>">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header" style="background-color: #28be63;">

                                                        <h4 class="modal-title" id="myModalLabel-2">Datail Peserta</h4>
                                                        <ul class="card-actions icons right-top">

                                                            <a href="javascript:void(0)" data-dismiss="modal" class="text-white" aria-label="Close">
                                                                <i class="zmdi zmdi-close"></i>
                                                            </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <b>Nama</b>    : <?php echo $row['nama']; ?><br><br>
                                                                <b>NISN</b>    : <?php echo $row['nisn']; ?><br><br>
                                                                <b>Nomor Peserta</b>    : <?php echo $row['nisn']; ?>/<?php echo $row['nomor_peserta']; ?><br><br>
                                                                <b>Asal Sekolah</b>    : <?php echo $row['asal_sekolah']; ?><br><br>
                                                                <b>Jenis Kelamin</b>    : <?php echo $row['jenis_kelamin']; ?><br><br>
                                                                <b>Nomor Telepon</b>    : <?php echo $row['nomor_tlp']; ?><br><br>
                                                                <b>Mendaftar Pada</b>    : <?php echo date('d, M Y H:i:s', strtotime($row['tgl_mendaftar'])); ?><br><br>
                                                                <b>Status Pembayaran</b>    : <?php if($row['pembayaran'] == 0){echo "<div class='label label-danger' style='font-size:7.5px;'>Belum Melakukan Pembayaran. Berakhir pada $date</div>"; }else{echo "<div class='label label-success' style='font-size:7.5px;'>Sudah Melakukan Pembayaran</div>";} ?><br><br>
                                                                <b>Alamat </b>   : <?php echo $row['alamat']; ?><br><br>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button id="batal-<?php echo $row[id];?>" class="btn btn-default btn-flat" data-dismiss="modal">Batal</button>
                                                    </div>
                                                </div>
                                                <!-- modal-content -->
                                            </div>
                                            <!-- modal-dialog -->
                                        </div>
                                        <!-- MODAL DETAIL END -->

                                        <!-- MODAL DETAIL BEGIN -->
                                        <div class="modal fade" id="modal_edit_<?php echo $row[id];?>" tabindex="-1" role="dialog" aria-labelledby="modal_edit_<?php echo $row[id];?>">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header" style="background-color: #28be63;">

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
                                            <div class='alert alert-warning'>Anda belum memiliki data peserta!</div>
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
            <div class="modal-header" style="background-color: #28be63;">

                <h4 class="modal-title" id="myModalLabel-2">Tambah Data Peserta</h4>
                <ul class="card-actions icons right-top">

                    <a href="javascript:void(0)" data-dismiss="modal" class="text-white" aria-label="Close">
                        <i class="zmdi zmdi-close"></i>
                    </a>
                    </li>
                </ul>
            </div>
            <div class="modal-body">
                <input type="hidden" name="asal_sekolah" id="asal_sekolah" value="<?php echo $nama_sekolah; ?>">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group label-floating is-empty">
                            <label class="control-label">Nama Peserta</label>
                            <input type="text" class="form-control" name="nama" id="nama">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group label-floating is-empty">
                            <label class="control-label">NISN</label>
                            <input type="text" class="form-control" name="nisn" id="nisn">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group label-floating ">
                            <label class="control-label">Jenis Kelamin</label>
                            <input type="radio" name="jenis_kelamin" value="Laki-laki" class="jenis_kelamin"> Laki-laki
                            &nbsp;
                            <input type="radio" name="jenis_kelamin" value="Perempuan" class="jenis_kelamin"> Perempuan
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group label-floating is-empty">
                            <label class="control-label">Nomor Telepon</label>
                            <input type="text" class="form-control" name="nomor_tlp" id="nomor_tlp">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group label-floating is-empty">
                            <label class="control-label">Alamat</label>
                            <textarea name="alamat" id="alamat" class="form-control"></textarea>
                        </div>
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
            window.location.replace("index.php?page=data_peserta");
        });

        $("#submit-add").on("click", function(){
            var nama = $("#nama").val();
            var nisn = $("#nisn").val();
            var jenis_kelamin = $(".jenis_kelamin").val();
            var nomor_tlp = $("#nomor_tlp").val();
            var alamat = $("#alamat").val();
            var asal_sekolah = $("#asal_sekolah").val();

            $.ajax({
                url: 'ajax/ajax_add_peserta.php',
                method: 'POST',
                dataType: 'json',
                data: {
                    nama: nama,
                    nisn: nisn,
                    jenis_kelamin: jenis_kelamin,
                    nomor_tlp: nomor_tlp,
                    asal_sekolah: asal_sekolah,
                    alamat:alamat, 
                    asal_sekolah:asal_sekolah
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
                            window.location.replace("index.php?page=data_peserta");
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

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
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        Total Data Peserta
                        <h1 style="font-size: 60px;">
                            <?php 
                                $count = select_data($con, "*", "tbl_siswa");
                                echo mysqli_num_rows($count);
                            ?>
                        </h1>
                        <span style="color: #b0b0b0;">Data Peserta Yang Terdaftar Dalam Dalam Sistem</span>
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
                        <!-- <div class="row">
                            <div class="col-md-4">
                                <a data-toggle="modal" data-target="#modal_add" class="btn btn-info btn-block"><i class="zmdi zmdi-plus"></i>Tambah Data</a>
                            </div>
                            <div class="col-md-4">
                                <a href="index.php?page=import_sekolah_excel" class="btn btn-success btn-block"><i class="zmdi zmdi-file-plus"></i>Import Data Excel</a>
                            </div>
                            <div class="col-md-4">
                                <a href="../berkas/format_data_sekolah.xls" class="btn btn-warning btn-block"><i class="zmdi zmdi-download"></i>Download Format Excel</a>
                            </div>
                        </div> -->
                        <!-- END BUTTON ROW -->

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
                                $select = select_data($con, "s.id, s.nama, s.nisn, s.jenis_kelamin, s.nomor_tlp, s.nomor_peserta, s.pembayaran, s.alamat, s.tgl_mendaftar, ss.nama_sekolah", "tbl_siswa s", ["tbl_sekolah ss ON ss.id = s.id_asal_sekolah"]);
                                if(mysqli_num_rows($select) > 0){
                                    while($row = mysqli_fetch_assoc($select)){
                            ?>
                                        <tr>
                                            <td><?php echo $no++;?></td>
                                            <td><?php echo $row['nama']; ?></td>
                                            <td><?php echo $row['nisn']; ?></td>
                                            <td><?php echo $row['nomor_peserta']; ?></td>
                                            <td><?php echo $row['nama_sekolah']; ?></td>
                                            <?php 
                                                $date = date('d, M Y H:i:s', strtotime("+1 day", strtotime($row['tgl_mendaftar'])));
                                            ?>
                                            <td><?php if($row['pembayaran'] == 0){echo "<div class='label label-danger' style='font-size:7.5px;'>Belum Melakukan Pembayaran. Berakhir pada $date</div>"; }else{echo "<div class='label label-success' style='font-size:7.5px;'>Sudah Melakukan Pembayaran</div>";} ?>
                                                
                                            </td>
                                            <td>
                                                <button class="btn btn-primary btn-fab btn-fab-sm" data-toggle="modal" data-target="#moda_detail_<?php echo $row[id];?>"><i class="zmdi zmdi-info"></i><div class="ripple-container"></div></button>
                                            </td>
                                        </tr>

                                        <!-- MODAL ADD BEGIN -->
                                        <div class="modal fade" id="moda_detail_<?php echo $row[id];?>" tabindex="-1" role="dialog" aria-labelledby="moda_detail_<?php echo $row[id];?>">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">

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
                                                                <b>Nomor Peserta</b>    : <?php echo $row['nomor_peserta']; ?><br><br>
                                                                <b>Asal Sekolah</b>    : <?php echo $row['nama_sekolah']; ?><br><br>
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
                                                $("#batal-<?php echo $row[id];?>").on('click', function(){
                                                    window.location.replace("index.php?page=data_peserta");
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

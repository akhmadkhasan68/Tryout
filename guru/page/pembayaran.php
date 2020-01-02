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
                                <div class="alert alert-success">
                                    <?php 
                                        $select_sudah = select_data($con, "*", "tbl_siswa", NULL, ["asal_sekolah = '$nama_sekolah' AND pembayaran = '1'"]);
                                    ?>
                                    <h1 style="font-size: 60px; color: #fafafa;"><?php echo mysqli_num_rows($select_sudah); ?></h1>
                                    <span style="color: #fafafa;">Data Peserta <?php echo $nama_sekolah; ?> Yang Sudah Melakukan Pembayaran</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="alert alert-warning">
                                    <?php 
                                        $select_belum = select_data($con, "*", "tbl_siswa", NULL, ["asal_sekolah = '$nama_sekolah' AND pembayaran = '0'"]);
                                    ?>
                                    <h1 style="font-size: 60px; color: #fafafa;"><?php echo mysqli_num_rows($select_belum); ?></h1>
                                    <span style="color: #fafafa;">Data Peserta <?php echo $nama_sekolah; ?> Yang Belum Melakukan Pembayaran</span>
                                </div>
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
                        <h2 class="card-title">Data Peserta</h2>
                    </header>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
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
                                        while($row = mysqli_fetch_assoc($select)){
                                    ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $row['nama']; ?></td>
                                            <td><?php echo $row['nisn']; ?></td>
                                            <td><?php echo $row['nisn']."/".$row['nomor_peserta']; ?></td>
                                            <td><?php echo $row['asal_sekolah']; ?></td>
                                            <td><?php if($row['pembayaran'] == 0){echo "<div class='label label-danger' style='font-size:7.5px;'>Belum Melakukan Pembayaran.</div>"; }else{echo "<div class='label label-success' style='font-size:7.5px;'>Sudah Melakukan Pembayaran</div>";} ?>
                                                
                                            </td>
                                            <td>
                                                <?php 
                                                    if($row['pembayaran'] == 0){
                                                ?>
                                                    <a data-toggle="modal" data-target="#modal-confirm-<?php echo $row[id];?>" class="btn btn-android btn-fab btn-fab-sm">
                                                        <i class="zmdi zmdi-check"></i>
                                                <?php
                                                    }else{
                                                        echo "<div class='label label-success' style='font-size:7.5px;'>Sudah Melakukan Pembayaran</div>";
                                                    } 
                                                ?>
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
                                                        url: 'ajax/ajax_update_confirm.php',
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
                                                                    window.location.replace("index.php?page=pembayaran");
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
                                    <?php } ?>
                                </table>
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

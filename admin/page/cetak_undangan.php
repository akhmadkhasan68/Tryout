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
                       <div class="row">
                           <div class="col-md-12">
                               <div class="alert alert-info">
                                    <b>Perhatian!</b> Fitur ini digunakan untuk mencetak undangan yang akan disebar ke berbagai sekolah peserta.
                                </div>
                           </div>
                       </div>
                       <div class="row">
                           <div class="col-md-12">
                               <table class="table table-bordered table-striped">
                                   <tr>
                                       <th width="5%">No</th>
                                       <th>Nama Sekolah</th>
                                       <th>NPSN</th>
                                       <th>Wali Kelas</th>
                                       <th>Cetak</th>
                                   </tr>
                                    <?php
                                        $no = 1;
                                        $show_sekolah = select_data($con, "g.nama, s.id, s.nama_sekolah, s.npsn", "tbl_guru g", ["tbl_sekolah s ON s.id = g.id_sekolah"]);
                                        while ($row = mysqli_fetch_assoc($show_sekolah)) {
                                    ?>
                                       <tr>
                                           <td><?php echo $no++; ?></td>
                                           <td><?php echo $row['nama_sekolah']; ?></td>
                                           <td><?php echo $row['npsn']; ?></td>
                                           <td><?php echo $row['nama']; ?></td>
                                           <td>
                                               <a href="page/cetak_undangan_sekolah.php?id=<?php echo $row['id']?>" target="_blank" class="btn btn-android btn-fab btn-fab-sm">
                                                   <i class="zmdi zmdi-print"></i>
                                               </a>
                                           </td>
                                       </tr>
                                    <?php
                                        }
                                    ?>   
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
       
    });
</script>

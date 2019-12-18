<?php 
    session_start();

    if(isset($_SESSION['sekolah_berhasil']) && isset($_SESSION['sekolah_gagal']) && $_REQUEST['upload'] != "TRUE"){
        unset($_SESSION["sekolah_berhasil"]);
        unset($_SESSION["sekolah_gagal"]);
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
                                <div class="alert alert-warning">
                                    <b>Perhatian!</b> Fungsi ini digunakan untuk import data sekolah dari file excel. Menjalankan fungsi ini akan menghapus semua data sekolah dan data yang terhubung sebelumnya.
                                </div>
                            </div>
                        </div>
                        <?php  
                            if(isset($_SESSION['sekolah_berhasil']) && isset($_SESSION['sekolah_gagal'])){
                        ?>
                        <div class="row">
                            <div class="col-md-2">
                                <span class="label label-success"><?php echo $_SESSION['sekolah_berhasil'];?> Berhasil diupload</span>&nbsp;&nbsp;<span class="label label-danger"><?php echo $_SESSION['sekolah_gagal'];?> Gagal diupload</span>
                            </div>
                        </div>
                        <br>
                        <?php }?>
                        <form action="action/upload_action_sekolah.php" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Upload File Excel <span class="text-danger">*File harus memiliki ekstensi .xls</span></label>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <br>
                                            <input type="file" name="file">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-2">
                                    <a href="index.php?page=data_sekolah" class="btn btn-danger btn-block"><i class="zmdi zmdi-chevron-left"></i> Kembali</a>
                                </div>
                                <div class="col-md-2">
                                    <input type="submit" name="submit" value="Upload File" class="btn btn-info btn-block">
                                </div>
                            </div>
                        </form>
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

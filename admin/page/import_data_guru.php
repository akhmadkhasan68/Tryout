<?php 
    session_start();

    if(isset($_SESSION['guru_berhasil']) && isset($_SESSION['guru_gagal']) && $_REQUEST['upload'] != "TRUE"){
        unset($_SESSION["guru_berhasil"]);
        unset($_SESSION["guru_gagal"]);
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
                                    <b>Perhatian!</b> Fungsi ini digunakan untuk import data guru dari file excel. Menjalankan fungsi ini akan menghapus semua data guru dan data yang terhubung sebelumnya.
                                </div>
                            </div>
                        </div>
                        <?php  
                            if($_REQUEST['upload'] == "TRUE"){
                        ?>
                        <div class="row">
                            <div class="col-md-2">
                                <span class="label label-success"><?php echo $_SESSION['guru_berhasil'];?> Berhasil diupload</span>&nbsp;&nbsp;<span class="label label-danger"><?php echo $_SESSION['guru_gagal'];?> Gagal diupload</span>
                            </div>
                        </div>
                        <br>
                        <?php }?>
                        <form action="action/upload_action_guru.php" method="POST" enctype="multipart/form-data">
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
                                    <a href="index.php?page=data_guru" class="btn btn-danger btn-block"><i class="zmdi zmdi-chevron-left"></i> Kembali</a>
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

<?php  
	$cek_nilai = select_data($con, "*", "tbl_nilai n", ["tbl_siswa s ON s.id = n.id_siswa"], ["s.asal_sekolah = '$nama_sekolah'"]);
	if(mysqli_num_rows($cek_nilai) == 0){
?>
		<div id="content" class="container-fluid">
	        <div class="content-body">
	            <div class="row">
	                <div class="col-md-12">
	                    <div class="card">
	                        <div class="card-body">
	                            <div class="alert alert-warning">
	                                <b>Perhatian!</b> Data nilai masih kosong. Anda belum bisa mengakses halaman ini.
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
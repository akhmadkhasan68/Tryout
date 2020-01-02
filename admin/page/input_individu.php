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
                                $count_individu = select_data($con, "*", "tbl_siswa_individu");
                                
                                echo $siswa_count = mysqli_num_rows($count) + mysqli_num_rows($count_individu);
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
                        Input Data Peserta Individu
                    </div>
                    <div class="card-body">
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
                        	<div class="col-md-6">
                        		<div id="select-sekolah">
									<div class="form-group label-floating">
										<label class="control-label">Asal Sekolah</label>
										<select class="select form-control" name="asal_sekolah" id="asal_sekolah">
											<option value="0">Pilih Sekolah Asal</option>
											<option value="others">Lainnya</option>
											<?php 
												$select_sekolah = select_data($con, "*", "tbl_siswa GROUP BY asal_sekolah");
												while ($rs = mysqli_fetch_assoc($select_sekolah)) {
											?>
											<option value="<?php echo $rs['asal_sekolah']; ?>"><?php echo $rs['asal_sekolah']; ?></option>
											<?php
												}
											?>
										</select>
									</div>
                        		</div>
                        		<div id="input-sekolah">
                        			<div class="form-group label-floating is-empty">
									<label class="control-label">Asal Sekolah</label>
									<input type="text" class="form-control" name="asal_sekolah" id="asal_sekolah_input">
								</div>
                        		</div>
                        	</div>
                        	<div class="col-md-6">
								<div class="form-group label-floating is-empty">
									<label class="control-label">Alamat</label>
									<textarea name="alamat" id="alamat" class="form-control"></textarea>
								</div>
                        	</div>
                        </div>
                         <div class="row">
                        	<div class="col-md-12">
								<button class="btn btn-primary btn-block btn-round" id="submit-add">Tambahkan</button>
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
    	$("#input-sekolah").css('display','none');

    	$("#asal_sekolah").on('change', function(){
    		var val = $(this).val();
    		if(val == "others"){
    			$("#input-sekolah").css('display','block');
    			$("#select-sekolah").css('display','none');
    		}
    	});

        $("#submit-add").on("click", function(){
            var nama = $("#nama").val();
            var nisn = $("#nisn").val();
            var jenis_kelamin = $(".jenis_kelamin").val();
            var nomor_tlp = $("#nomor_tlp").val();
            if($("#asal_sekolah").val() == "others"){
            	var asal_sekolah = $("#asal_sekolah_input").val();
            }else{
            	var asal_sekolah = $("#asal_sekolah").val();
            }
            var alamat = $("#alamat").val();

            $.ajax({
                url: 'ajax/ajax_add_peserta_individu.php',
                method: 'POST',
                dataType: 'json',
                data: {
                    nama: nama,
					nisn: nisn,
					jenis_kelamin: jenis_kelamin,
					nomor_tlp: nomor_tlp,
					asal_sekolah: asal_sekolah,
					alamat:alamat
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

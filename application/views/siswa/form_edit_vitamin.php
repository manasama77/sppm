<script>
	$(document).ready(function(){
		$('#images').on('change', function(){
			setTempPhoto(this);
		});

		$('#kota').on('change', function(){
			$.ajax({
				url: '<?=site_url();?>get_kecamatan/'+$(this).val(),
				method: 'get',
				dataType: 'json',
				beforeSend: function(){
					$.blockUI({message: '<i class="fa fa-spinner fa-spin"></i> Silahkan Tunggu...'});
					$('#kecamatan').attr('disabled', true).html('<option val=""></option>');
					$('#desa').attr('disabled', true).html('<option val=""></option>');
				},
				statusCode: {
					200: function(){
						console.log(200);
						$.unblockUI();
					},
					400: function(){
						console.log(400);
						toastr.warning('Error 400', 'Oops...');
						$.unblockUI();
					},
					404: function(){
						console.log(404);
						toastr.warning('Error 404', 'Oops...');
						$.unblockUI();
					},
					500: function(){
						console.log(500);
						toastr.warning('Error 500', 'Oops...');
						$.unblockUI();
					}
				}
			})
			.done(function(res){
				lkecamatan = '<option value=""></option>';
				if(res.code == '200'){
					$.each(res.data, function(i, k){
						lkecamatan += `<option value="${k.id}">${k.nama_kecamatan}</option>`;
					});
					$('#kecamatan').attr('disabled', false).html(lkecamatan);
				}else if(res.code == '500'){
					toastr.warning('Error 500', 'Oops...');
				}
			});
		});

		$('#kecamatan').on('change', function(){
			$.ajax({
				url: '<?=site_url();?>get_desa/'+$(this).val(),
				method: 'get',
				dataType: 'json',
				beforeSend: function(){
					$.blockUI({message: '<i class="fa fa-spinner fa-spin"></i> Silahkan Tunggu...'});
					$('#desa').attr('disabled', true).html('<option val=""></option>');
				},
				statusCode: {
					200: function(){
						console.log(200);
						$.unblockUI();
					},
					400: function(){
						console.log(400);
						toastr.warning('Error 400', 'Oops...');
						$.unblockUI();
					},
					404: function(){
						console.log(404);
						toastr.warning('Error 404', 'Oops...');
						$.unblockUI();
					},
					500: function(){
						console.log(500);
						toastr.warning('Error 500', 'Oops...');
						$.unblockUI();
					}
				}
			})
			.done(function(res){
				ldesa = '<option value=""></option>';
				if(res.code == '200'){
					$.each(res.data, function(i, k){
						ldesa += `<option value="${k.id}">${k.nama_desa}</option>`;
					});
					$('#desa').attr('disabled', false).html(ldesa);
				}else if(res.code == '500'){
					toastr.warning('Error 500', 'Oops...');
				}
			});
		});

		$('#kota').val('<?=$siswas->row()->kota;?>').trigger('change');

		setTimeout(function(){
			$('#kecamatan').val('<?=$siswas->row()->kecamatan;?>').trigger('change');
			setTimeout(function(){
				$('#desa').val('<?=$siswas->row()->desa;?>').trigger('change');
			}, 2000);
		}, 2000);

		$('#kelas').val('<?=$siswas->row()->kelas;?>').trigger('change');

		$('#form-create').validate({
			debug: true,
			errorElement: 'span',
			errorClass: 'help-block help-block-error text-danger',
			focusInvalid: true,
			ignore: "",
			rules: {
				images: { required: false, extension: "jpg|jpeg|png|JPG|JPEG|PNG" },
				nis: { required: true },
				nama: { required: true, minlength:3 },
				jenis_kelamin: { required: true },
				alamat: { required: true, minlength:10 },
				kota: { required: true },
				kecamatan: { required: true },
				desa: { required: true },
				tempat_lahir: { required: true },
				tanggal_lahir: { required: true },
				nama_wali: { required: true },
				tanggal_masuk: { required: true },
				kelas: { required: true },
			},
			errorPlacement: function (error, element) {
				$(error[0]).insertAfter(element[0]);
			},
			highlight: function (element) {
				$(element).closest('.form-group').removeClass("has-success").addClass('has-error');
			},
			unhighlight: function (element) { },
			success: function (label, element) {
				var icon = $(element).parent('.input-icon').children('i');
				$(element).closest('.form-group').removeClass('has-error').addClass('has-success');
				icon.removeClass("fa-warning").addClass("fa-check");
			},
			submitHandler: function (form) {
				$.ajax({
					url: '<?=site_url();?>update_siswa',
					method: 'post',
					data: new FormData(form),
					contentType: false,
					processData: false,
					dataType: 'json',
					beforeSend: function(){
						$.blockUI({message: '<i class="fa fa-spinner fa-spin"></i> Proses Update Data'});
					},
					statusCode: {
						200: function(){
							console.log(200);
							$.unblockUI();
						},
						400: function(){
							console.log(400);
							toastr.warning('Error 400', 'Oops...');
							$.unblockUI();
						},
						404: function(){
							console.log(404);
							toastr.warning('Error 404', 'Oops...');
							$.unblockUI();
						},
						500: function(){
							console.log(500);
							toastr.warning('Error 500', 'Oops...');
							$.unblockUI();
						}
					}
				})
				.done(function(res){
					if(res.code == '200'){
						swal.fire('Success', 'Proses Update Data Berhasil', 'success');
						setTimeout(function(){
							window.location.replace('<?=site_url();?>siswa');
							$.unblockUI();
						}, 2000);
					}else if(res.code == '400'){
						swal.fire('Oops...', 'NIS Telah Digunakan', 'error');
					}else if(res.code == '500'){
						toastr.warning('Error 500', 'Oops...');
					}
				});	
			}

		});

	});

function setTempPhoto(input)
{
	if (input.files && input.files[0]) {
		var reader = new FileReader();

		reader.onload = function(e) {
			$('#temp_photo').attr('src', e.target.result);
		}

		reader.readAsDataURL(input.files[0]);
	}

}
</script>
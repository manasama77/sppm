<script>
	$(document).ready(function(){

		$('#images').on('change', function(){
			setTempPhoto(this);
		});

		$('#flag_admin').on('change', function(){
			$('#portlet_admin').toggle();
		});

		$('#form-create').validate({
			debug: true,
			errorElement: 'span',
			errorClass: 'help-block help-block-error text-danger',
			focusInvalid: true,
			ignore: "",
			rules: {
				images: { required: false, extension: "jpg|jpeg|png|JPG|JPEG|PNG" },
				nik: { required: true },
				name: { required: true, minlength:3 },
				tempat_lahir: { required: true, minlength:3 },
				tanggal_lahir: { required: true },
				alamat: { required: true, minlength:10 },
				jenis_kelamin: { required: true },
				no_telepon: { required: true, minlength:10 },
				pendidikan_terakhir: { required: true },
				tanggal_masuk: { required: true },
				password: { required: false, minlength:4 },
			},
			errorPlacement: function (error, element) {
				$(error[0]).insertAfter(element[0]);
			},
			highlight: function (element) {
        $(element).closest('.form-group').removeClass("has-success").addClass('has-error'); // set error class to the control group   
      },
      unhighlight: function (element) { },
      success: function (label, element) {
      	var icon = $(element).parent('.input-icon').children('i');
      	$(element).closest('.form-group').removeClass('has-error').addClass('has-success');
      	icon.removeClass("fa-warning").addClass("fa-check");
      },
      submitHandler: function (form) {
      	if($('#flag_admin').val() == 1 && $('#password').val().length == 0){
      		swal.fire('Oops...', 'Password Tidak Boleh Kosong', 'warning');
      	}else{
      		$.ajax({
      			url: '<?=site_url();?>guru/store',
      			method: 'post',
      			data: new FormData(form),
      			contentType: false,
      			processData: false,
      			dataType: 'json',
      			beforeSend: function(){
      				$.blockUI({message: '<i class="fa fa-spinner fa-spin"></i> Proses Tambah Data'});
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
      				swal.fire('Success', 'Proses Tambah Data Berhasil', 'success');
      				setTimeout(function(){
      					window.location.replace('<?=site_url();?>guru/index');
      					$.unblockUI();
      				}, 2000);
      			}else if(res.code == '400'){
      				swal.fire('Oops...', 'Nik Telah Digunakan', 'error');
      			}else if(res.code == '500'){
      				toastr.warning('Error 500', 'Oops...');
      			}
      		});	
      	}
      	
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
<script>
	$(document).ready(function(){

		$('#kepala_sekolah').val('<?=$applications->row()->kepala_sekolah;?>').trigger('change');

		$('#logo').on('change', function(){
			setTempPhoto(this);
		});

		$('#form-create').validate({
			debug: true,
			errorElement: 'span',
			errorClass: 'help-block help-block-error text-danger',
			focusInvalid: true,
			ignore: "",
			rules: { 
				nama_sekolah: { required: true }, 
				motto: { required: true },
				alamat: { required: true },
				kepala_sekolah: { required: true }
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
				$.blockUI();
				processInsert(form);
			}

		});
	});

	function processInsert(form)
	{
		$.ajax({
			url: '<?=site_url();?>setup/update_aplikasi',
			method: 'post',
  		data: new FormData(form),
  		contentType: false,
  		processData: false,
  		dataType: 'json',
			beforeSend: function(){
				$.blockUI({message: '<i class="fa fa-spinner fa-spin"></i> Proses Update'});
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
				Swal.fire('Success', 'Updated', 'success');
				setTimeout(function(){
					window.location.reload();
					$.unblockUI();
				}, 2000);
			}else if(res.code == '400'){
				Swal.fire('Oops...', 'error 400 '+ res.err, 'error');
			}else if(res.code == '500'){
				Swal.fire('Oops...', 'error 500', 'error');
			}
		});

	}

	function setTempPhoto(input)
	{
		if (input.files && input.files[0]) {
			var reader = new FileReader();

			reader.onload = function(e) {
				$('#temp_logo').attr('src', e.target.result);
			}

			reader.readAsDataURL(input.files[0]);
		}

	}
</script>
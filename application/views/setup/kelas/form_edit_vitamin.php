<script>
	$(document).ready(function(){

		$('#form-create').validate({
			debug: true,
			errorElement: 'span',
			errorClass: 'help-block help-block-error text-danger',
			focusInvalid: true,
			ignore: "",
			rules: { name: { required: true }, holiday_date: { required: true } },
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
					url: '<?=site_url();?>setup/update_holiday',
					method: 'put',
					data: $('#form-create').serialize(),
					dataType: 'json',
					beforeSend: function(){
						$.blockUI({message: '<i class="fa fa-spinner fa-spin"></i> Proses Edit Data Hari Libur'});
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
						Swal.fire('Success', 'Data Hari Libur Di Update.', 'success');
						setTimeout(function(){
							window.location.replace('<?=site_url();?>setup/holiday');
							$.unblockUI();
						}, 2000);
					}else if(res.code == '400'){
						Swal.fire('Oops...', 'error 400', 'error');
					}else if(res.code == '500'){
						Swal.fire('Oops...', 'error 500', 'error');
					}
				});
			}

		});
	});
</script>
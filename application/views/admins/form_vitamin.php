<script>
	$(document).ready(function(){
		let usernameForm = $('#usernamex');
		$('button[type=submit]').attr('disabled', true);
		usernameForm.on('keydown', function(event){
			if(event.keyCode == 9 || event.keyCode == 13){
				let username = $(this).val();
				checkUsername(username);
			}
		});

		$('#form-create').validate({
			errorElement: 'span',
			errorClass: 'help-block help-block-error text-danger',
			focusInvalid: true,
			ignore: "",
			rules: {
				usernamex: {
					required: true
				},
				password1: {
					required: true,
				},
				password2: {
					required: true,
					equalTo: '#password1'
				},
			},

			errorPlacement: function (error, element) {
				var icon = $(element).parent('.input-icon').children('i');
				icon.removeClass('fa-check').addClass("fa-warning");
				icon.attr("data-original-title", error.text()).tooltip({'container': 'body'});
			},

			highlight: function (element) {
				$(element).closest('.form-group').removeClass("has-success").addClass('has-error');
			},

			unhighlight: function (element) {

			},

			success: function (label, element) {
				var icon = $(element).parent('.input-icon').children('i');
				$(element).closest('.form-group').removeClass('has-error').addClass('has-success');
				icon.removeClass("fa-warning").addClass("fa-check");
			},

			submitHandler: function (form) {
				console.log(form);
				$.ajax({
					url: '<?=site_url();?>store_admin',
					method: 'post',
					dataType: 'json',
					data: $('#form-create').serialize(),
					beforeSend: function(){
						$.blockUI({message: '<i class="fa fa-spinner fa-spin"></i> Proses Check Username'});
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
					if(res.code == 200){
						swal.fire('Success', 'Proses Buat Admin Baru Berhasil', 'success');
						setTimeout(function(){
							window.location.replace('<?=site_url();?>admin');
							$.unblockUI();
						}, 2000);
					}else{
						swal.fire('Oops...', 'Error 500', 'error');
					}
				});
			}

		});
	});

	function checkUsername(username)
	{
		$.ajax({
			url: `<?=site_url();?>chk_username/${username}`,
			method: 'get',
			beforeSend: function(){
				$.blockUI({message: '<i class="fa fa-spinner fa-spin"></i> Proses Check Username'});
			},
			statusCode: {
				200: function(){
					console.log(200);
					$('button[type=submit]').attr('disabled', false);
					$('#password1').focus();
					$.unblockUI();
				},
				400: function(){
					console.log(400);
					const pesanError = 'Username telah digunakan, silahkan gunakan username lain';
					$('#usernamex').closest('.form-group').removeClass("has-success").addClass('has-error');
					$('#usernamex').parent('.input-icon').children('i').removeClass('fa-check').addClass("fa-warning").attr("data-original-title", pesanError).tooltip({'container': 'body'});
					$('button[type=submit]').attr('disabled', true);
					toastr.warning(pesanError, 'Oops...');
					$('#usernamex').focus();
					$.unblockUI();
				},
				404: function(){
					console.log(404);
					$.unblockUI();
				},
				500: function(){
					console.log(500);
					$.unblockUI();
				}
			}
		});
	}
</script>
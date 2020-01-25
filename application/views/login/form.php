<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title><?=$nama_sekolah;?> | SPPM <?=VESION_APP;?></title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1" name="viewport" />
	<meta content="Aplikasi Sistem Presensi KSPPS Baytul Ikhtiar" name="description" />
	<meta content="<?=CREATOR;?>" name="author" />
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
	<link href="<?=base_url();?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
	<link href="<?=base_url();?>assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
	<link href="<?=base_url();?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="<?=base_url();?>assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
	<link href="<?=base_url();?>assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
	<link href="<?=base_url();?>assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="<?=base_url();?>assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
	<link href="<?=base_url();?>assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
	<link href="<?=base_url();?>assets/pages/css/login-2.min.css" rel="stylesheet" type="text/css" />
	<link href="<?=base_url();?>assets/global/plugins/ladda/ladda-themeless.min.css" rel="stylesheet" type="text/css" />
	<link href="<?=base_url();?>assets/global/plugins/pace/themes/pace-theme-flash.css" rel="stylesheet" type="text/css" />
	<link href="<?=base_url();?>assets/global/plugins/bootstrap-toastr/toastr.min.css" rel="stylesheet" type="text/css" />
	<link rel="shortcut icon" href="favicon.png" />
</head>

<body class="login">
	<div class="logo">
		<a href="<?=base_url();?>">
			<img src="<?=base_url('assets/global/img/');?><?=$logo;?>" style="height: 100px;" alt="LOGO" />
		</a>
	</div>
	<div class="content">
		<form class="login-form" id="formlogin">
			<input type="password" id="x" name="x" class="sr-only">
			<div class="form-title text-center" style="margin-top:-50px;">
				<span class="form-title"><?=$nama_sekolah;?><br><small><?=$motto;?></small></span>
			</div>
			<?php
			if($this->session->flashdata('logout') === TRUE){
				?>
				<div class="alert alert-success">
					<button class="close" data-close="alert"></button>
					<span> Logout Berhasil </span>
				</div>
			<?php } ?>
			<div class="form-group">
				<label class="control-label visible-ie8 visible-ie9">NIK</label>
				<input class="form-control" type="text" autocomplete="off" placeholder="NIK" id="nik" name="nik" autofocus>
				<span class="help-block" style="color:#fff; font-style:italic;"></span>
			</div>
			<div class="form-group has-error">
				<label class="control-label visible-ie8 visible-ie9">Password</label>
				<input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" id="password" name="password">
				<span class="help-block" style="color:#fff; font-style:italic;"></span>
			</div>
			<div class="form-actions">
				<button type="submit" class="btn red btn-block uppercase mt-ladda-btn ladda-button" data-style="slide-right" data-spinner-color="#fff"><span class="ladda-label">Login</span></button>
			</div>
			<div class="form-actions">
				<div class="pull-right forget-password-block">
					<a id="lupa" href='#'>Lupa Password?</a>
				</div>
			</div>
		</form>
	</div>
	<div class="copyright"> <?=YEAR_APP;?> © <?=NAMA_APP;?> <?=VESION_APP;?> | Tribute to <?=$nama_sekolah;?></div>
	<script src="<?=base_url();?>assets/global/plugins/jquery-1.12.4.min.js" type="text/javascript"></script>
	<script src="<?=base_url();?>assets/global/plugins/ladda/spin.min.js" type="text/javascript"></script>
	<script src="<?=base_url();?>assets/global/plugins/ladda/ladda.min.js" type="text/javascript"></script>
	<script src="<?=base_url();?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="<?=base_url();?>assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
	<script src="<?=base_url();?>assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
	<script src="<?=base_url();?>assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
	<script src="<?=base_url();?>assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
	<script src="<?=base_url();?>assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
	<script src="<?=base_url();?>assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
	<script src="<?=base_url();?>assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
	<script src="<?=base_url();?>assets/global/scripts/app.min.js" type="text/javascript"></script>
	<!--script src="<?=base_url();?>assets/pages/scripts/login.min.js" type="text/javascript"></script-->
	<script src="<?=base_url();?>assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
	<script src="<?=base_url();?>assets/global/plugins/pace/pace.min.js" type="text/javascript"></script>
	<script src="<?=base_url();?>assets/global/plugins/bootstrap-toastr/toastr.min.js" type="text/javascript"></script>

	<div class="modal fade" id="modal-id">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Lupa Password</h4>
				</div>
				<div class="modal-body">
					Silahkan hubungi team Admin <?=$nama_sekolah;?>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" data-dismiss="modal" style="color:#fff;">Close</button>
				</div>
			</div>
		</div>
	</div>

</body>
</html>

<script>
	toastr.options = {
		"closeButton": true,
		"debug": false,
		"positionClass": "toast-top-right",
		"onclick": null,
		"showDuration": "1000",
		"hideDuration": "1000",
		"timeOut": "5000",
		"extendedTimeOut": "1000",
		"showEasing": "swing",
		"hideEasing": "linear",
		"showMethod": "fadeIn",
		"hideMethod": "fadeOut"
	}

	$(document).ready(function(){
		let nik = $('#nik');
		let password = $('#password');

		nik.on('keypress', function(e){
			if(e.which === 13){
				if(nik.val().length < 4){
					e.preventDefault();
				}else{
					e.preventDefault();
					password.focus();
				}
			}
		});

		password.on('keypress', function(e){
			if(e.which === 13){
				e.preventDefault();
				$('#formlogin').submit();
			}
		});

		$("#formlogin").submit(function(e){
			e.preventDefault();
			laddaMe('start');

			setTimeout(function(){

				const nikMinLength = 4;
				const nikMinLengthError = '*Kolom NIK minimal '+ nikMinLength +' karakter';
				const nikMaxLength = 13;
				const nikMaxLengthError = '*Kolom NIK maksimal '+ nikMaxLength +' karakter';

				const passwordMinLength = 4;
				const passwordMinLengthError = '*Kolom Password minimal '+ passwordMinLength +' karakter';
				const passwordMaxLength = 13;
				const passwordMaxLengthError = '*Kolom Password maksimal '+ passwordMaxLength +' karakter';

				let nik = $('#nik');
				let password = $('#password');

          // initiate
          nik.next().addClass('hide');
          password.next().addClass('hide');
          // end initiate

          if(nik.val().length < 1){
          	console.log('required');
          	nik.next().removeClass('hide').text('*Kolom NIK harus Di isi').prev().focus();
          	laddaMe('stop');
          }else if(nik.val().length < nikMinLength){
          	console.log('min length');
          	nik.next().removeClass('hide').text(nikMinLengthError).prev().focus();
          	laddaMe('stop');
          }else if(nik.val().length > nikMaxLength){
          	console.log('max length');
          	nik.next().removeClass('hide').text(nikMaxLengthError);
          	laddaMe('stop');
          }else if(password.val().length < 1){
          	console.log('required');
          	password.next().removeClass('hide').text('*Kolom Password harus Di isi').prev().focus();
          	laddaMe('stop');
          }else if(password.val().length < passwordMinLength){
          	console.log('min length');
          	password.next().removeClass('hide').text(passwordMinLengthError).prev().focus();
          	laddaMe('stop');
          }else if(password.val().length > passwordMaxLength){
          	console.log('min length');
          	password.next().removeClass('hide').text(passwordMaxLengthError).prev().focus();
          	laddaMe('stop');
          }else{
          	console.log('next step');
          	nik.next().addClass('hide');
          	password.next().addClass('hide');

          	$.ajax({
          		url: '<?=site_url();?>auth',
          		data: {
          			nik: nik.val(),
          			password: password.val()
          		},
          		dataType: 'json',
          		method: 'post',
          		beforeSend: function(){
          			nik.attr('disabled', true);
          			password.attr('disabled', true);
          		},
          		statusCode: {
          			200: function(result){
          				console.log(result);
          				laddaMe('stop');
          				nik.attr('disabled', false);
          				password.attr('disabled', false);
          			},
          			400: function(){
          				nik.attr('disabled', false);
          				password.attr('disabled', false);
          				laddaMe('stop');
          			},
          			404: function(){
          				nik.attr('disabled', false);
          				password.attr('disabled', false);
          				laddaMe('stop');
          			},
          			500: function(){
          				nik.attr('disabled', false);
          				password.attr('disabled', false);
          				laddaMe('stop');
          			},
          		}
          	})
          	.done(function(result){
          		let code = result.code;
          		if(code == 500){
          			toastr.warning('Periksa Kembali Kolom NIK & Password', 'Data Tidak Di Temukan');
          			laddaMe('stop');
          			$('#nik').focus();
          		}else{
          			toastr.success('Authentication Success', 'Data Match!');
          			$.blockUI();
          			setTimeout(function(){
          				window.location.replace('<?=site_url();?>dashboard');
          			}, 2000);
          		}

          	});
          }

        }, 1500);

		});

		$('#lupa').on('click', function(e){
			e.preventDefault();
			$('#modal-id').modal('show');
		})
	});

function blockAll()
{
	$.blockUI({
		css: {
			border: 'none',
			padding: '0px',
			backgroundColor: '#000',
			'-webkit-border-radius': '10px', 
			'-moz-border-radius': '10px',
			opacity: .5, 
			color: '#fff',
			animate: true
		},
		message: '<i class="fa fa-spinner fa-spin"></i> Silahkan Tunggu'
	});
}

function laddaMe(tipe)
{
	submit = document.getElementsByClassName("btn")[0];
	var l = Ladda.create(submit);

	if(tipe == 'start'){
		l.start();
	}else{
		l.stop();
	}
}
</script>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<title><?=$title;?> | <?=$sekolah->row()->nama_sekolah;?></title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1" name="viewport" />
	<meta content="Aplikasi SPPM" name="description" />
	<meta content="AA Web Dev" name="author" />
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
	<link href="<?=base_url();?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
	<link href="<?=base_url();?>assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
	<link href="<?=base_url();?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="<?=base_url();?>assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
	<link href="<?=base_url();?>assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
	<link href="<?=base_url();?>assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
	<link href="<?=base_url();?>assets/layouts/layout/css/layout.min.css" rel="stylesheet" type="text/css" />
	<link href="<?=base_url();?>assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />
	<link href="<?=base_url();?>assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />
	<link href="<?=base_url();?>assets/global/plugins/bootstrap-toastr/toastr.min.css" rel="stylesheet" type="text/css" />
	<link href="<?=base_url();?>assets/global/plugins/pace/themes/pace-theme-flash.css" rel="stylesheet" type="text/css" />
	<link href="<?=base_url();?>assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
	<link href="<?=base_url();?>assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
	<link href="<?=base_url();?>assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="<?=base_url();?>vendor/datatables/datatables.min.css" rel="stylesheet" type="text/css"/>
	<link href="<?=base_url();?>assets/global/css/style.css" rel="stylesheet" type="text/css"/>
	<link rel="shortcut icon" href="<?=base_url();?>favicon.png" />
</head>

<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
	<div class="page-wrapper">
		<?php $this->load->view('partials/topbar'); ?>
		<div class="clearfix"> </div>

		<!-- BEGIN CONTAINER -->
		<div class="page-container">
			<!-- BEGIN SIDEBAR -->
			<?php $this->load->view('partials/sidebar'); ?>
			<!-- END SIDEBAR -->

			<!-- BEGIN CONTENT -->
			<div class="page-content-wrapper">
				<!-- BEGIN CONTENT BODY -->
				<?php $this->load->view($content); ?>
				<!-- END CONTENT BODY -->
			</div>
			<!-- END CONTENT -->

		</div>
		<!-- END CONTAINER -->

		<!-- BEGIN FOOTER -->
		<?php $this->load->view('partials/footer'); ?>
		<!-- END FOOTER -->
	</div>
	<!-- BEGIN CORE PLUGINS -->
	<script src="<?=base_url();?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
	<script src="<?=base_url();?>assets/global/plugins/pace/pace.min.js" type="text/javascript"></script>
	<script src="<?=base_url();?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="<?=base_url();?>assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
	<script src="<?=base_url();?>assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
	<script src="<?=base_url();?>assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
	<script src="<?=base_url();?>assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
	<!-- END CORE PLUGINS -->
	<!-- BEGIN THEME GLOBAL SCRIPTS -->
	<script src="<?=base_url();?>assets/global/scripts/app.min.js" type="text/javascript"></script>
	<!-- END THEME GLOBAL SCRIPTS -->
	<!-- BEGIN THEME LAYOUT SCRIPTS -->
	<script src="<?=base_url();?>assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
	<script src="<?=base_url();?>assets/layouts/layout/scripts/demo.min.js" type="text/javascript"></script>
	<script src="<?=base_url();?>assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
	<script src="<?=base_url();?>vendor/sweetalert/sweetalert2.all.min.js" type="text/javascript"></script>
	<script src="<?=base_url();?>assets/layouts/layout/scripts/jqueryvalidation/jquery.validate.min.js" type="text/javascript"></script>
	<script src="<?=base_url();?>assets/layouts/layout/scripts/jqueryvalidation/additional-methods.min.js" type="text/javascript"></script>
	<script src="<?=base_url();?>assets/global/plugins/bootstrap-toastr/toastr.min.js" type="text/javascript"></script>
	<script src="<?=base_url();?>assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
	<script src="<?=base_url();?>assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
	<script src="<?=base_url();?>assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>

	<script type="text/javascript" src="<?=base_url();?>vendor/datatables/datatables.min.js"></script>
	<script type="text/javascript" src="<?=base_url();?>vendor/datatables/dataTables.fixedColumns.min.js"></script>
	<script type="text/javascript" src="<?=base_url();?>vendor/datatables/Buttons-1.6.1/js/dataTables.buttons.min.js"></script>
	<script type="text/javascript" src="<?=base_url();?>vendor/datatables/JSZip-2.5.0/jszip.min.js"></script>
	<script type="text/javascript" src="<?=base_url();?>vendor/datatables/pdfmake-0.1.36/pdfmake.min.js"></script>
	<script type="text/javascript" src="<?=base_url();?>vendor/datatables/pdfmake-0.1.36/vfs_fonts.js"></script>
	<script type="text/javascript" src="<?=base_url();?>vendor/datatables/Buttons-1.6.1/js/buttons.html5.min.js"></script>

	<script>
		$('.date-picker').datepicker({ format: 'dd-mm-yyyy', autoclose: true });
		$('.year-picker').datepicker({ 
			changeMonth: true,
			changeYear: true,
			format: 'yyyy', 
			autoclose: true,
			viewMode: 'years',
    	minViewMode: 'years'
		});

		$(".year-picker").focus(function () { $(".ui-datepicker-month").hide(); });

    // Make select2 after close (select the data), back focus to self, so users can do TAB cycle
    $(document).on("select2:close", '.select2-hidden-accessible', function () { $(this).focus(); });
    $('.select2').select2({ selectOnClose: true });
    // End Make select2 after close (select the data), back focus to self, so users can do TAB cycle
    
    // TOASTER INIT
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
    // END TOASTER INIT
  </script>
  <?php $this->load->view($vitamin); ?>
  <!-- END THEME LAYOUT SCRIPTS -->
</body>
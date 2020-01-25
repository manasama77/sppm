<div class="page-content">

	<!-- BEGIN PAGE TITLE-->
	<h1 class="page-title"> List Guru</h1>
	<!-- END PAGE TITLE-->

	<!-- END PAGE HEADER-->
	<div class="row">
		<div class="col-md-12 ">

			<!-- BEGIN Portlet DATA KARYAWAN -->
			<div class="portlet box box green-jungle">
				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-table"></i> Data Guru
					</div>
					<div class="tools">
						<a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
						<a href="" class="fullscreen" data-original-title="" title=""> </a>
						<a href="javascript:;" class="reload"></a>
					</div>
					<div class="actions" style="margin-right:10px;">
						<a href="<?=site_url();?>guru/create" class="btn btn-sm grey-mint">
							<i class="fa fa-plus"></i> Buat Guru Baru
						</a>
					</div>
				</div>
				<div class="portlet-body" style="display: block;">
					<div class="table-responsive" id="vresult">
					</div>
				</div>
			</div>
			<!-- END Portlet DATA KARYAWAN -->

		</div>
	</div>
</div>

<div class="modal fade" id="modal-reset">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" >&times;</button>
				<h4 class="modal-title">Reset Password <span id="name_reset"></span></h4>
			</div>
			<form id="form-reset">
				<div class="modal-body">
					<div clas="form-group">
						<label for="new_password">New Password</label>
						<input type="text" class="form-control" id="new_password" name="new_password">
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" id="nik" name="nik">
					<button type="submit" class="btn btn-primary">Save changes</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="modal-resign">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" >&times;</button>
				<h4 class="modal-title">Guru Resign <span id="name_resign"></span></h4>
			</div>
			<form id="form-resign">
				<div class="modal-body">
					<div clas="form-group">
						<label for="tanggal_keluar">Tanggal Resign</label>
						<input type="text" class="form-control date-picker" id="tanggal_keluar" name="tanggal_keluar" placeholder="Tanggal Resign">
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" id="nik_resign" name="nik_resign">
					<button type="submit" class="btn btn-primary">Save changes</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</form>
		</div>
	</div>
</div>
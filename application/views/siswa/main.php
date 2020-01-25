<div class="page-content">

	<!-- BEGIN PAGE TITLE-->
	<h1 class="page-title"> List Siswa Aktif</h1>
	<!-- END PAGE TITLE-->

	<!-- END PAGE HEADER-->
	<div class="row">
		<div class="col-md-12 ">

			<!-- BEGIN Portlet DATA KARYAWAN -->
			<div class="portlet box box green-jungle">
				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-table"></i> Data Siswa
					</div>
					<div class="tools">
						<a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
						<a href="" class="fullscreen" data-original-title="" title=""> </a>
						<a href="javascript:;" class="reload"></a>
					</div>
					<div class="actions" style="margin-right:10px;">
						<a href="<?=site_url();?>siswa/create" class="btn btn-sm grey-mint">
							<i class="fa fa-plus"></i> Buat Siswa Baru
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

<div class="modal fade" id="modal-berhenti">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" >&times;</button>
				<h4 class="modal-title">Siswa Berhenti <span id="name_berhenti"></span></h4>
			</div>
			<form id="form-berhenti">
				<div class="modal-body">
					<div clas="form-group">
						<label for="tanggal_keluar">Tanggal Berhenti</label>
						<input type="text" class="form-control date-picker" id="tanggal_keluar" name="tanggal_keluar" placeholder="Tanggal Berhenti">
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" id="nis_berhenti" name="nis_berhenti">
					<button type="submit" class="btn btn-primary">Save changes</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="modal-spp">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" >&times;</button>
				<h4 class="modal-title">Data SPP <span id="name_spp"></span></h4>
			</div>
			<div class="modal-body">
				<table class="table">
					<thead>
						<tr>
							<th class="text-center">#</th>
							<th class="text-center">Bulan / Tahun</th>
							<th class="text-center">Status</th>
						</tr>
					</thead>
					<tbody id="data-spp">
						<tr>
							<td class="text-center">1</td>
							<td class="text-center">Jul 2019</td>
							<td class="text-center"><i class="fa fa-times"></i></td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
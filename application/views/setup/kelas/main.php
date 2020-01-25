<div class="page-content">

	<!-- BEGIN PAGE TITLE-->
	<h1 class="page-title"> Setup Kelas</h1>
	<!-- END PAGE TITLE-->

	<!-- END PAGE HEADER-->
	<div class="row">

		<div class="col-sm-8">
			<div class="portlet box box green-jungle">
				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-table"></i> List Kelas
					</div>
					<div class="tools">
						<a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
						<a href="" class="fullscreen" data-original-title="" title=""> </a>
						<a href="javascript:;" class="reload"></a>
					</div>
					<div class="actions" style="margin-right:10px;">
            
          </div>
				</div>
				<div class="portlet-body" style="display: block;">
					<div class="table-responsive" id="vresult">
					</div>
				</div>
			</div>
		</div>

		<div class="col-sm-4">
			<div class="portlet box box green-jungle">
				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-plus"></i> Tambah Kelas
					</div>
				</div>
				<div class="portlet-body" style="display: block;">
					<form id="form-create">
						<div class="form-group">
							<label for="nama_kelas">Nama Kelas</label>
							<input type="text" class="form-control" id="nama_kelas" name="nama_kelas" placeholder="Nama Kelas">
						</div>
						<div class="form-group">
							<label for="wali_kelas">Wali Kelas</label>
							<select class="form-control select2" id="wali_kelas" name="wali_kelas" data-placeholder="Wali Kelas">
								<option value=""></option>
								<?php
								foreach ($gurus->result() as $guru) {
									echo '<option value="'.$guru->nik.'">'.$guru->nama.'</option>';
								}
								?>
							</select>
						</div>
						<div class="form-group">
							<label for="spp">SPP</label>
							<input type="number" class="form-control" id="spp" name="spp" placeholder="SPP">
						</div>
						<button type="submit" class="btn btn-primary btn-block">Submit</button>
					</form>
				</div>
			</div>
		</div>

	</div>
</div>

<div class="modal fade" id="modal-edit">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" >&times;</button>
				<h4 class="modal-title">Edit Kelas <span id="name_kelas"></span></h4>
			</div>
			<form id="form-edit">
				<div class="modal-body">
					<div clas="form-group">
						<label for="nama_kelas_e">Nama Kelas</label>
						<input type="text" class="form-control" id="nama_kelas_e" name="nama_kelas_e">
					</div>
					<div class="form-group margin-top-10">
						<label for="wali_kelas_e">Wali Kelas</label>
						<select class="select2" id="wali_kelas_e" name="wali_kelas_e" data-placeholder="Wali Kelas">
							<option value=""></option>
							<?php
							foreach ($gurus->result() as $guru) {
								echo '<option value="'.$guru->nik.'">'.$guru->nama.'</option>';
							}
							?>
						</select>
					</div>
					<div class="form-group">
						<label for="spp_e">SPP</label>
						<input type="number" class="form-control" id="spp_e" name="spp_e" placeholder="SPP">
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" id="id" name="id">
					<button type="submit" class="btn btn-primary">Save changes</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</form>
		</div>
	</div>
</div>
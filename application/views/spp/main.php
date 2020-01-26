<div class="page-content">

	<!-- BEGIN PAGE TITLE-->
	<h1 class="page-title"> Data SPP</h1>
	<!-- END PAGE TITLE-->

	<!-- END PAGE HEADER-->
	<div class="row">
		<div class="col-md-12 ">

			<div class="portlet box box blue-oleo">
				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-table"></i> Filter
					</div>
				</div>
				<div class="portlet-body">

					<form id="form-filter" class="form-horizontal" role="form">
						<div class="form-body">
							<div class="form-group">
								<label class="col-md-3 control-label" for="id_kelas">Kelas</label>
								<div class="col-md-2">
									<select class="form-control" id="id_kelas" name="id_kelas" required>
										<option value=""></option>
										<?php foreach ($kelass->result() as $kelas) { ?>
											<option value="<?=$kelas->id;?>"><?=$kelas->nama_kelas;?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label" for="nis">Siswa</label>
								<div class="col-md-6">
									<select class="form-control select2" id="nis" name="nis" disabled required>
									</select>
								</div>
							</div>

						</div>
						<div class="form-actions">
							<div class="row">
								<div class="col-md-offset-3 col-md-9">
									<button type="submit" class="btn btn-primary" id="submit"><i class="fa fa-filter fa-fw"></i> Filter Data</button>
								</div>
							</div>
						</div>
					</form>

				</div>
			</div>

		</div>
	</div>

	<div class="row">
		<div class="col-md-12 ">

			<div class="portlet box box dark">
				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-table"></i> Data SPP
					</div>
					<div class="tools">
						<a href="javascript:;" class="portlet1 expand" data-original-title="" title=""> </a>
						<a href="" class="fullscreen" data-original-title="" title=""> </a>
						<a href="javascript:;" class="portlet1 reload" style="display: none;"></a>
					</div>
					<div class="actions">
						<button type="button" class="btn btn-outline sbold uppercase green-jungle btn-sm expxls" style="display: none;" disabled><i class="fa fa-file-excel-o fa-fw"></i> Export Excel</button>
					</div>
				</div>
				<div class="portlet-body portlet-collapsed">
					<div class="table-responsive" id="vresult"></div>
				</div>
			</div>

		</div>
	</div>

</div>
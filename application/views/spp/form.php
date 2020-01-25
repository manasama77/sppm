<div class="page-content">

	<!-- BEGIN PAGE TITLE-->
	<h1 class="page-title"> Bayar SPP</h1>
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

			<div class="portlet box box green">
				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-table"></i> Data SPP
					</div>
					<div class="tools">
						<a href="javascript:;" class="portlet1 expand" data-original-title="" title=""> </a>
						<a href="" class="fullscreen" data-original-title="" title=""> </a>
						<a href="javascript:;" class="portlet1 reload" style="display: none;"></a>
					</div>
				</div>
				<div class="portlet-body portlet-collapsed">
					<div class="table-responsive" id="vresult"></div>
				</div>
			</div>

		</div>
	</div>

	<div class="row">
		<div class="col-md-6 ">

			<div class="portlet box box green-meadow">
				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-table"></i> Pembayaran SPP
					</div>
					<div class="tools">
						<a href="javascript:;" class="expand portlet2" data-original-title="" title=""> </a>
						<a href="" class="fullscreen" data-original-title="" title=""> </a>
					</div>
				</div>
				<div class="portlet-body portlet-collapsed">
					<form id="form_bayar">
						<div class="form-group">
							<label for="tanggal_bayar">Tanggal Bayar</label>
							<input type="text" class="form-control date-picker" id="tanggal_bayar" name="tanggal_bayar" required>
						</div>
						<div class="form-group">
							<label for="id_bayar_spp">Bulan</label>
							<select class="form-control" id="id_bayar_spp" name="id_bayar_spp" required>
								<option value=""></option>
							</select>
						</div>
						<div class="form-group">
							<label for="nominal">Nominal SPP</label>
							<div id="nominal_text" style="font-weight: bold;">0</div>
							<input type="hidden" class="form-control" id="nominal" name="nominal" readonly required>
						</div>
						<button id="submit" type="submit" class="btn btn-primary"><i class="fa fa-money"></i> Bayar SPP</button>
					</form>
				</div>
			</div>

		</div>
	</div>

</div>
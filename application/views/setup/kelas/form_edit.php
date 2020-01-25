<div class="page-content">

	<!-- BEGIN PAGE TITLE-->
	<h1 class="page-title"> Edit Hari Libur</h1>
	<!-- END PAGE TITLE-->

	<!-- END PAGE HEADER-->
	<form id="form-create" class="form-horizontal">
		<div class="row">

			<div class="col-md-6">
				<div class="portlet box blue-hoki">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-table"></i> Form Edit Hari Libur
						</div>
					</div>
					<div class="portlet-body">
						<div class="form-group  margin-top-20">
							<label class="control-label col-md-4" for="holiday_name">Nama Hari Libur
								<span class="required"> * </span>
							</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="holiday_name" name="holiday_name" placeholder="Nama Cabang" autofocus value="<?=$data->row()->holiday_name;?>" />
							</div>
						</div>
						<div class="form-group  margin-top-20">
							<label class="control-label col-md-4" for="holiday_date">Tanggal
								<span class="required"> * </span>
							</label>
							<div class="col-md-8">
								<input type="text" class="form-control date-picker" id="holiday_date" name="holiday_date" placeholder="Tanggal" value="<?=$tgl_obj->createFromFormat('Y-m-d', $data->row()->holiday_date)->format('d-m-Y');?>" />
							</div>
						</div>

						<div class="form-actions">
							<div class="row">
								<div class="col-md-offset-4 col-md-8">
									<input type="hidden" name="id" value="<?=$data->row()->id;?>">
									<button type="submit" class="btn green">Submit</button>
									<a href="<?=site_url();?>admins/index" class="btn default">Cancel</a>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>

		</div>
	</form>
</div>
<div class="page-content">

	<!-- BEGIN PAGE TITLE-->
	<h1 class="page-title"> Setup Aplikasi</h1>
	<!-- END PAGE TITLE-->

	<!-- END PAGE HEADER-->
	<form id="form-create" class="form-horizontal">
		<div class="row">

			<div class="col-md-12">
				<div class="portlet box blue-hoki">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-cog"></i> Data
						</div>
					</div>
					<div class="portlet-body">
						<div class="form-group  margin-top-20">
							<label class="control-label col-md-2" for="nama_sekolah">Aplikasi Key</label>
							<div class="col-md-8">
								<p class="form-control-static"><?=$applications->row()->sn;?></p>
							</div>
						</div>
						<div class="form-group  margin-top-20">
							<label class="control-label col-md-2" for="nama_sekolah">Nama Sekolah
								<span class="required"> * </span>
							</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="nama_sekolah" name="nama_sekolah" placeholder="Nama Sekolah" value="<?=$applications->row()->nama_sekolah;?>" autofocus />
							</div>
						</div>
						<div class="form-group  margin-top-20">
							<label class="control-label col-md-2" for="motto">Motto
								<span class="required"> * </span>
							</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="motto" name="motto" placeholder="Motto" value="<?=$applications->row()->motto;?>" />
							</div>
						</div>
						<div class="form-group  margin-top-20">
							<label class="control-label col-md-2" for="alamat">Alamat
								<span class="required"> * </span>
							</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat" value="<?=$applications->row()->alamat;?>" />
							</div>
						</div>
						<div class="form-group  margin-top-20">
							<label class="control-label col-md-2" for="company_phone">Kepala Sekolah
								<span class="required"> * </span>
							</label>
							<div class="col-md-8">
								<select class="form-control select2" id="kepala_sekolah" name="kepala_sekolah" data-placeholder="Kepala Sekolah">
									<option value=""></option>
									<?php
									foreach ($gurus->result() as $guru) {
										echo '<option value="'.$guru->nik.'">'.$guru->nama.'</option>';
									}
									?>
								</select>
							</div>
						</div>
						<div class="form-group  margin-top-20">
							<label class="control-label col-md-2" for="logo">Logo 
								<span class="required"> * </span>
							</label>
							<div class="col-md-8">
								<input type="file" class="form-control" id="logo" name="logo" placeholder="Pilih Logo">
								<input type="hidden" id="prev_logo" name="prev_logo" value="<?=$applications->row()->logo;?>">
							</div>
							<div class="col-md-8 col-md-offset-2" style="margin-top: 10px;">
								<img id="temp_logo" src="<?=base_url('assets/global/img/'.$applications->row()->logo);?>" class="img-responsive img-thumbnail" alt="Logo" style="max-width: 200px;">
							</div>
						</div>

						<div class="form-actions">
							<div class="row">
								<div class="col-md-offset-2 col-md-8">
									<input type="hidden" id="id" name="id" value="1">
									<button type="submit" class="btn green">Submit</button>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>

		</div>
	</form>
</div>
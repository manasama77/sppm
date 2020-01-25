<div class="page-content">

	<!-- BEGIN PAGE TITLE-->
	<h1 class="page-title"> Buat Guru Baru</h1>
	<!-- END PAGE TITLE-->

	<!-- END PAGE HEADER-->
	<form id="form-create" class="form-horizontal">
		<div class="row">

			<div class="col-md-12 ">
				<div class="portlet box blue-hoki">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-user"></i> Informasi Dasar
						</div>
					</div>
					<div class="portlet-body">

						<div class="form-group  margin-top-10">
							<div class="col-md-9 col-md-offset-3" style="margin-bottom: 10px;">
								<img id="temp_photo" src="" class="img-responsive img-thumbnail" alt="Photo" style="max-width: 200px;">
							</div>
							<label class="control-label col-md-3" for="images">Photo</label>
							<div class="col-md-4">
								<input type="file" class="form-control" id="images" name="images" placeholder="Pilih Photo Guru">
							</div>
						</div>
						<div class="form-group  margin-top-20">
							<label class="control-label col-md-3" for="nik">NIK
								<span class="required"> * </span>
							</label>
							<div class="col-md-2">
								<input type="text" class="form-control" id="nik" name="nik" placeholder="NIK" autofocus />
							</div>
						</div>
						<div class="form-group  margin-top-20">
							<label class="control-label col-md-3" for="nama">Nama
								<span class="required"> * </span>
							</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" />
							</div>
						</div>
						<div class="form-group  margin-top-20">
							<label class="control-label col-md-3" for="alamat">Alamat <span class="required"> * </span></label>
							<div class="col-md-4">
								<textarea class="form-control" id="alamat" name="alamat" rows="5" placeholder="Alamat"></textarea>
							</div>
						</div>
						<div class="form-group  margin-top-20">
							<label class="control-label col-md-3 col-xs-4" for="tempat_lahir">Tempat, Tanggal Lahir <span class="required"> * </span></label>
							<div class="col-md-3">
								<input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" placeholder="Tempat Kelahiran" />
							</div>
							<div class="col-md-2">
								<div class="input-icon">
									<i class="fa fa-calendar"></i>
									<input type="text" class="form-control date-picker" id="tanggal_lahir" name="tanggal_lahir" placeholder="Tanggal Lahir" />
								</div>
							</div>
						</div>
						<div class="form-group  margin-top-20">
							<label class="control-label col-md-3" for="no_telepon">No Telepon</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="no_telepon" name="no_telepon" placeholder="No Telepon" />
							</div>
						</div>
						<div class="form-group  margin-top-20">
							<label class="control-label col-md-3" for="jenis_kelamin">Jenis Kelamin <span class="required"> * </span></label>
							<div class="col-md-2">
								<select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
									<option value="male">Laki-laki</option>
									<option value="female">Perempuan</option>
								</select>
							</div>
						</div>
						<div class="form-group  margin-top-20">
							<label class="control-label col-md-3" for="pendidikan_terakhir">Pendidikan Terakhir
								<span class="required"> * </span>
							</label>
							<div class="col-md-4">
								<select class="form-control select2" id="pendidikan_terakhir" name="pendidikan_terakhir" data-placeholder="Pendidikan Terakhir">
									<option value=""></option>
									<?php
									foreach ($pendidikans->result() as $pendidikan) {
										echo '<option value="'.$pendidikan->kode.'">'.$pendidikan->keterangan.'</option>';
									}
									?>
								</select>
							</div>
						</div>
						<div class="form-group  margin-top-20">
							<label class="control-label col-md-3 col-xs-4" for="tanggal_masuk">Tanggal Masuk<span class="required"> * </span></label>
							<div class="col-md-3">
								<div class="input-icon">
									<i class="fa fa-calendar"></i>
									<input type="text" class="form-control date-picker" id="tanggal_masuk" name="tanggal_masuk" placeholder="Tanggal Masuk" />
								</div>
							</div>
						</div>
						<div class="form-group  margin-top-20">
							<label class="control-label col-md-3" for="flag_admin">Admin ? <span class="required"> * </span></label>
							<div class="col-md-2">
								<select class="form-control" id="flag_admin" name="flag_admin">
									<option value="0">Tidak</option>
									<option value="1">Ya</option>
								</select>
							</div>
						</div>


					</div>
				</div>
			</div>

			<div class="col-md-12" style="display:none;" id="portlet_admin">
				<div class="portlet box blue-hoki">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-user"></i> Admin Account
						</div>
					</div>
					<div class="portlet-body">
						<div class="form-group  margin-top-20">
							<label class="control-label col-md-3" for="password">Password <span class="required"> * </span></label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="password" name="password" placeholder="Password" />
							</div>
						</div>

					</div>
				</div>
			</div>

			<div class="col-md-12">
				<div class="form-actions">
					<div class="row">
						<div class="col-md-offset-3 col-md-9">
							<button type="submit" class="btn green">Submit</button>
							<a href="<?=site_url();?>admins/index" class="btn default">Cancel</a>
						</div>
					</div>
				</div>
			</div>

		</div>
	</form>
</div>
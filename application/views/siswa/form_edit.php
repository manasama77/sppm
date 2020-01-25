<div class="page-content">

	<!-- BEGIN PAGE TITLE-->
	<h1 class="page-title"> Edit Siswa</h1>
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
								<input type="hidden" id="prev_images" name="prev_images" value="<?=$siswas->row()->photo;?>">
								<img id="temp_photo" src="<?=base_url('assets/pages/img/avatars/siswa/'.$siswas->row()->photo);?>" class="img-responsive img-thumbnail" alt="Photo" style="max-width: 200px;">
							</div>
							<label class="control-label col-md-3" for="images">Photo</label>
							<div class="col-md-4">
								<input type="file" class="form-control" id="images" name="images" placeholder="Pilih Photo Guru">
							</div>
						</div>
						<div class="form-group  margin-top-20">
							<label class="control-label col-md-3" for="nis">NIS
								<span class="required"> * </span>
							</label>
							<div class="col-md-2">
								<input type="text" class="form-control" id="nis" name="nis" placeholder="NIS" value="<?=$siswas->row()->nis;?>" readonly />
							</div>
						</div>
						<div class="form-group  margin-top-20">
							<label class="control-label col-md-3" for="nama">Nama
								<span class="required"> * </span>
							</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" value="<?=$siswas->row()->nama;?>" autofocus />
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
							<label class="control-label col-md-3" for="alamat">Alamat <span class="required"> * </span></label>
							<div class="col-md-4">
								<textarea class="form-control" id="alamat" name="alamat" rows="5" placeholder="Alamat"><?=$siswas->row()->alamat;?></textarea>
							</div>
						</div>
						<div class="form-group  margin-top-20">
							<label class="control-label col-md-3" for="kota">Kota / Kabupaten <span class="required"> * </span></label>
							<div class="col-md-4">
								<select class="form-control select2" id="kota" name="kota" data-placeholder="Kota / Kabupaten">
									<option value=""></option>
									<?php
									foreach ($kotas->result() as $kota) {
										echo '<option value="'.$kota->id.'">'.$kota->nama_kota.'</option>';
									}
									?>
								</select>
							</div>
						</div>
						<div class="form-group  margin-top-20">
							<label class="control-label col-md-3" for="kecamatan">Kecamatan <span class="required"> * </span></label>
							<div class="col-md-4">
								<select class="form-control select2" id="kecamatan" name="kecamatan" disabled="true" data-placeholder="Kecamatan">
									<option value=""></option>
								</select>
							</div>
						</div>
						<div class="form-group  margin-top-20">
							<label class="control-label col-md-3" for="desa">Desa <span class="required"> * </span></label>
							<div class="col-md-4">
								<select class="form-control select2" id="desa" name="desa" disabled="true" data-placeholder="Desa">
									<option value=""></option>
								</select>
							</div>
						</div>
						<div class="form-group  margin-top-20">
							<label class="control-label col-md-3 col-xs-4" for="tempat_lahir">Tempat, Tanggal Lahir <span class="required"> * </span></label>
							<div class="col-md-3">
								<input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" placeholder="Tempat Kelahiran" value="<?=$siswas->row()->tempat_lahir;?>" />
							</div>
							<div class="col-md-2">
								<div class="input-icon">
									<i class="fa fa-calendar"></i>
									<input type="text" class="form-control date-picker" id="tanggal_lahir" name="tanggal_lahir" placeholder="Tanggal Lahir" value="<?=$tgl_obj->createFromFormat('Y-m-d', $siswas->row()->tanggal_lahir)->format('d-m-Y');?>" />
								</div>
							</div>
						</div>
						<div class="form-group  margin-top-20">
							<label class="control-label col-md-3" for="nama_wali">Nama Wali</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="nama_wali" name="nama_wali" placeholder="Nama Wali" value="<?=$siswas->row()->nama_wali;?>" />
							</div>
						</div>

					</div>
				</div>
			</div>

			<div class="col-md-12">
				<div class="portlet box blue-hoki">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-building"></i> Informasi Kelas
						</div>
					</div>
					<div class="portlet-body">
						<div class="form-group  margin-top-20">
							<label class="control-label col-md-3" for="tangal_masuk">Tanggal Masuk <span class="required"> * </span></label>
							<div class="col-md-3">
								<div class="input-icon">
									<i class="fa fa-calendar"></i>
									<input type="text" class="form-control date-picker" id="tanggal_masuk" name="tanggal_masuk" placeholder="Tanggal Masuk" value="<?=$tgl_obj->createFromFormat('Y-m-d', $siswas->row()->tanggal_masuk)->format('d-m-Y');?>" />
								</div>
							</div>
						</div>
						<div class="form-group  margin-top-20">
							<label class="control-label col-md-3" for="kelas">Kelas <span class="required"> * </span></label>
							<div class="col-md-4">
								<select class="form-control select2" id="kelas" name="kelas" data-placeholder="Kelas">
									<option value=""></option>
									<?php
									foreach ($kelass->result() as $kelas) {
										echo '<option value="'.$kelas->id.'">'.$kelas->nama_kelas.'</option>';
									}
									?>
								</select>
							</div>
						</div>

					</div>
				</div>
			</div>

			<div class="col-md-12">
				<div class="form-actions">
					<div class="row">
						<div class="col-md-offset-3 col-md-9">
							<button id="submit" type="submit" class="btn green">Submit</button>
							<a href="<?=site_url();?>admins/index" class="btn default">Cancel</a>
						</div>
					</div>
				</div>
			</div>

		</div>
	</form>
</div>
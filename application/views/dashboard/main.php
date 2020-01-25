<div class="page-content">

	<!-- BEGIN PAGE TITLE-->
	<h1 class="page-title"> Dashboard</h1>
	<!-- END PAGE TITLE-->

	<div class="row">

		<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
			<a class="dashboard-stat dashboard-stat-v2 blue" href="<?=site_url();?>admins/index" id="card_admin">
				<div class="visual">
					<i class="fa fa-user-secret"></i>
				</div>
				<div class="details">
					<div class="number">
						<span id="total_admin">0</span>
					</div>
					<div class="desc"> Admin </div>
				</div>
			</a>
		</div>

		<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
			<a class="dashboard-stat dashboard-stat-v2 blue" href="<?=site_url();?>guru/index" id="card_guru">
				<div class="visual">
					<i class="fa fa-users"></i>
				</div>
				<div class="details">
					<div class="number">
						<span id="total_guru">0</span>
					</div>
					<div class="desc"> Guru </div>
				</div>
			</a>
		</div>

		<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
			<a class="dashboard-stat dashboard-stat-v2 blue" href="<?=site_url();?>siswa/index" id="card_siswa">
				<div class="visual">
					<i class="fa fa-users"></i>
				</div>
				<div class="details">
					<div class="number">
						<span id="total_siswa">0</span>
					</div>
					<div class="desc"> Siswa </div>
				</div>
			</a>
		</div>

	</div>

	<div class="row">
		<div class="col-sm-6">
			<div class="portlet box red">
				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-birthday-cake"></i>Guru yang berulang Tahun Hari Ini
						<span style="margin-left:5px;" class="badge bg-dark bg-font-dark" id="counter_bday_guru">0</span>
					</div>
					<div class="tools">
						<a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
						<a href="" class="fullscreen" data-original-title="" title=""> </a>
					</div>
				</div>
				<div class="portlet-body" id="list_bday_guru">
					<div class="table-responsive">
						<table class="table table-borderless table-condensed table-sm" style="width:100%;">
							<thead>
								<tr>
									<th>Nama</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td colspan="2" class="text-center">Tidak ada yang berulang tahun hari ini</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

		<div class="col-sm-6">
			<div class="portlet box red">
				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-birthday-cake"></i>Siswa yang berulang Tahun Hari Ini
						<span style="margin-left:5px;" class="badge bg-dark bg-font-dark" id="counter_bday_siswa">0</span>
					</div>
					<div class="tools">
						<a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
						<a href="" class="fullscreen" data-original-title="" title=""> </a>
					</div>
				</div>
				<div class="portlet-body" id="list_bday_siswa">
					<div class="table-responsive">
						<table class="table table-borderless table-condensed table-sm" style="width:100%;">
							<thead>
								<tr>
									<th>Nama</th>
									<th>Kelas</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td colspan="2" class="text-center">Tidak ada yang berulang tahun hari ini</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>
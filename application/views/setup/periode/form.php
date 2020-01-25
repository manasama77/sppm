<div class="page-content">
	<h1 class="page-title"> Ganti Periode</h1>
	<div class="row">
		<div class="col-md-12">
			<div class="portlet box box red-mint">
				<div class="portlet-title">
					<div class="caption"><i class="fa fa-calendar"></i> Data Periode</div>
				</div>
				<div class="portlet-body" style="display: block;">
					<div class="row">
						<div class="col-md-12">

							<form id="#form-create" method="post" class="form-inline">
								<h4><strong>Dari Periode</strong></h4>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label class="sr-only" for="periode_bulan_awal">Bulan Awal</label>
											<input type="number" class="form-control" style="min-width:80px;" id="periode_bulan_awal" name="periode_bulan_awal" placeholder="Bulan" min="1" max="12" required>
										</div>
										<div class="form-group">
											<label class="sr-only" for="periode_tahun_awal">Tahun Awal</label>
											<input type="number" class="form-control" id="periode_tahun_awal" name="periode_tahun_awal" placeholder="Tahun" min="2000" max="2100" required>
										</div>
									</div>
								</div>
								
								<h4 style="margin-top:20px;"><strong>Sampai Periode</strong></h4>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label class="sr-only" for="periode_bulan_akhir">Bulan Akhir</label>
											<input type="number" class="form-control" style="min-width:80px;" id="periode_bulan_akhir" name="periode_bulan_akhir" placeholder="Bulan" min="1" max="12" required>
										</div>
										<div class="form-group">
											<label class="sr-only" for="periode_tahun_akhir">Tahun Akhir</label>
											<input type="number" class="form-control" id="periode_tahun_akhir" name="periode_tahun_akhir" placeholder="Tahun" min="2000" max="2100" required>
										</div>
									</div>
								</div>
								<hr>
								<button type="submit" id="submit" name="submit" class="btn btn-success">Ganti Periode</button>
							</form>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
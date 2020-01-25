<div class="page-content">

	<!-- BEGIN PAGE TITLE-->
	<h1 class="page-title"> Setup Periode</h1>
	<!-- END PAGE TITLE-->

	<!-- END PAGE HEADER-->
	<div class="row">
		<div class="col-md-6">

			<div class="portlet box box green-jungle">
				<div class="portlet-title">
					<div class="caption"><i class="fa fa-calendar"></i> Data Periode</div>
				</div>
				<div class="portlet-body" style="display: block;">
					<div class="row">
						<div class="col-md-12">
							<table class="table">
								<tbody>
									<tr>
										<th class="col-md-6">Periode Awal</th>
										<td>
											<?=$tgl_obj->createFromFormat('m', $periode->row()->periode_bulan_awal)->format('F');?> <?=$periode->row()->periode_tahun_awal;?>
										</td>
									</tr>
									<tr>
										<th>Periode Akhir</th>
										<td>
											<?=$tgl_obj->createFromFormat('m', $periode->row()->periode_bulan_akhir)->format('F');?> <?=$periode->row()->periode_tahun_akhir;?>
										</td>
									</tr>
									<tr>
										<th>Total Siswa</th>
										<td><?=$periode->row()->total_siswa;?></td>
									</tr>
									<tr>
										<th>Total Siswa Lulus</th>
										<td><?=$periode->row()->total_siswa_lulus;?></td>
									</tr>
									<tr>
										<th>Total Siswa Berhenti</th>
										<td><?=$periode->row()->total_siswa_berhenti;?></td>
									</tr>
								</tbody>
								<tfoot>
									<tr>
										<th colspan="2" class="text-right">
											<a href="<?=site_url();?>setup/periode/ganti" class="btn btn-primary">
												<i class="fa fa-wrench fa-fw"></i> Ganti Periode
											</a>
										</th>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div>
			</div>

		</div>

		<div class="col-md-6">

			<div class="portlet box box blue-chambray">
				<div class="portlet-title">
					<div class="caption"><i class="fa fa-calendar"></i> Log Periode</div>
				</div>
				<div class="portlet-body" style="display: block;">
					<div class="row">
						<div class="col-md-12">
							<table class="table">
								<tbody>
									<?php
									foreach ($log_periodes->result() as $log_periode) {
										$bts = $tgl_obj->createFromFormat('m', $log_periode->periode_bulan_awal)->format('F').'-'.$log_periode->periode_tahun_awal;
										$bte = $tgl_obj->createFromFormat('m', $log_periode->periode_bulan_akhir)->format('F').'-'.$log_periode->periode_tahun_akhir;
									?>
										<tr>
											<th>Periode</th>
											<td><?=$bts.' ~ '.$bte;?></td>
											<td>
												<button type="button" class="btn btn-primary" onclick="showDetailLog('<?=$bts;?>', '<?=$bte;?>', '<?=$log_periode->total_siswa;?>', '<?=$log_periode->total_siswa_lulus;?>', '<?=$log_periode->total_siswa_berhenti;?>');">
													<i class="fa fa-file-archive-o"></i>
												</button>
											</td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>

<div class="modal fade" id="modal-log">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="judul_periode"></h4>
			</div>
			<div class="modal-body" id="vres">
				
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
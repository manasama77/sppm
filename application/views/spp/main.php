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

			<div class="portlet box box green">
				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-table"></i> Data SPP
					</div>
					<div class="tools">
						<a href="javascript:;" class="expand" data-original-title="" title=""> </a>
						<a href="" class="fullscreen" data-original-title="" title=""> </a>
						<a href="javascript:;" class="reload" style="display: none;"></a>
					</div>
				</div>
				<div class="portlet-body portlet-collapsed">
					<div class="table-responsive" id="vresult">
						<!-- <table class="table table-bordered text-center">
							<thead class="bg-blue-chambray bg-font-blue-chambray">
								<tr>
									<td>Jul 2019</td>
									<td>Aug 2019</td>
									<td>Sep 2019</td>
									<td>Oct 2019</td>
									<td>Nov 2019</td>
									<td>Dec 2019</td>
									<td>Jan 2020</td>
									<td>Feb 2020</td>
									<td>Mar 2020</td>
									<td>Apr 2020</td>
									<td>May 2020</td>
									<td>Jun 2020</td>
								</tr>
							</thead>
							<tbody class="bg-blue-hoki bg-font-blue-hoki">
								<tr>
									<td>
										<i class="fa fa-times"></i>
										<p class="small">01-Jul-19</p>
									</td>
									<td>
										<i class="fa fa-times"></i>
										<p class="small">01-Jul-19</p>
									</td>
									<td>
										<i class="fa fa-times"></i>
										<p class="small">01-Jul-19</p>
									</td>
									<td>
										<i class="fa fa-times"></i>
										<p class="small">01-Jul-19</p>
									</td>
									<td>
										<i class="fa fa-times"></i>
										<p class="small">01-Jul-19</p>
									</td>
									<td>
										<i class="fa fa-times"></i>
										<p class="small">01-Jul-19</p>
									</td>
									<td>
										<i class="fa fa-times"></i>
										<p class="small">01-Jul-19</p>
									</td>
									<td>
										<i class="fa fa-times"></i>
										<p class="small">01-Jul-19</p>
									</td>
									<td>
										<i class="fa fa-times"></i>
										<p class="small">01-Jul-19</p>
									</td>
									<td>
										<i class="fa fa-times"></i>
										<p class="small">01-Jul-19</p>
									</td>
									<td>
										<i class="fa fa-times"></i>
										<p class="small">01-Jul-19</p>
									</td>
									<td>
										<i class="fa fa-times"></i>
										<p class="small">01-Jul-19</p>
									</td>
								</tr>
							</tbody>
						</table> -->
					</div>
				</div>
			</div>

		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		showAllDataKaryawan();

		$('.reload').on('click', function(tables){
			showAllDataKaryawan();
		});

	});

	function showAllDataKaryawan()
	{
		let vresult = $('#vresult');
		$.ajax({
			url: '<?=site_url();?>guru/show/resign',
			method: 'get',
			dataType: 'json',
			beforeSend: function(){
				vresult.html('<i class="fa fa-spinner fa-spin"></i>');
				$.blockUI({message: '<i class="fa fa-spinner fa-spin"></i> Try to Get the Data... Please Wait...'});
			},
			statusCode: {
				200: function(){
					console.log(200);
					$.unblockUI();
				},
				400: function(){
					console.log(400);
					toastr.warning('Error 400', 'Oops...');
					$.unblockUI();
				},
				404: function(){
					console.log(404);
					toastr.warning('Error 404', 'Oops...');
					$.unblockUI();
				},
				500: function(){
					console.log(500);
					toastr.warning('Error 500', 'Oops...');
					$.unblockUI();
				}
			}
		})
		.done(function(res){
			console.log(res);
			if(res.code == 200){
				vresult.html('');
				let html = `<table class="table table-bordered" id="vemployees" style="width:100% !importants; min-width:1500px;">`;
				html += `<thead>`;
				html += `<tr>`;
				html += `<th style="width:90px;">Photo</th>`;
				html += `<th>NIK</th>`;
				html += `<th>Nama</th>`;
				html += `<th>Alamat</th>`;
				html += `<th>Tempat, Tanggal Lahir</th>`;
				html += `<th>No Telepon</th>`;
				html += `<th>Jenis Kelamin</th>`;
				html += `<th>Pendidikan Terakhir</th>`;
				html += `<th>Tanggal Masuk</th>`;
				html += `<th class="text-center"><i class="fa fa-cogs"></i></th>`;
				html += `</tr>`;
				html += `</thead>`;
				html += `<tbody>`;

				$gender_badge = '';
				$.each(res.data, function(i, k){
					if(k.images == ''){ 
						images = '<img src="<?=base_url();?>assets/pages/img/avatars/avatar_default.png" width="80px" class="img-thumbnail">'; 
					}else{ 
						images = '<img src="<?=base_url();?>assets/pages/img/avatars/' + k.photo + '" width="80px" class="img-thumbnail">';
					}

					if(k.jenis_kelamin == 'male'){ 
						jenis_kelamin = 'Laki-Laki'; 
						gender_badge = 'bg-blue bg-font-blue'; 
					}else{ 
						jenis_kelamin = 'Perempuan'; 
						gender_badge = 'bg-purple-seance bg-font-purple-seance';
					}
					
					html += `<tr>`;
					html += `<td class="text-center">${images}</td>`;
					html += `<td>${k.nik}</td>`;
					html += `<td>${k.nama}</td>`;
					html += `<td>${k.alamat}</td>`;
					html += `<td>${k.tempat_lahir}, ${k.tanggal_lahir}</td>`;
					html += `<td>${k.no_telepon}</td>`;
					html += `<td class="text-center"><div class="badge ${gender_badge}">${jenis_kelamin}</div></td>`;
					html += `<td>${k.pendidikan_terakhir}</td>`;
					html += `<td>${k.tanggal_masuk}</td>`;
					html += `<td class="text-center" style="width:120px;">`;
					html += `<div class="btn-group">`;
					if(k.flag_admin == 1){
						html += `<button class="btn dark btn-sm" onclick="resetEmployee('${k.nik}', '${k.nama}')" data-toggle="tooltip" data-placement="left" title="Reset Password"><i class="fa fa-key fa-fw"></i></button>`;
					}
					html += `<button class="btn btn-primary btn-sm" onclick="editEmployee('${k.nik}', '${k.nama}')" data-toggle="tooltip" data-placement="left" title="Edit"><i class="fa fa-edit fa-fw"></i></button>`;
					html += `<button class="btn btn-danger btn-sm" onclick="preDeleteEmployee('${k.nik}', '${k.nama}')" data-toggle="tooltip" data-placement="left" title="Delete"><i class="fa fa-trash fa-fw"></i></button>`;
					html += `</div>`;
					html += `</td>`;
					html += `</tr>`;
				})

				html += `</tbody>`;
				html += `</table>`;
				vresult.html(html);

				let tables = $('#vemployees').DataTable({
					dom: 'frtip',
					destroy: true,
					order: [[1,'asc']],
					scrollY: true,
					scrollX: true,
					responsive: true,
					columnDefs : [
					{ targets: [0,9], orderable: false, searchable: false }
					]
				});

				$('[data-toggle="tooltip"]').tooltip();
			}
		});
	}

	function branchLogEmployee(nik)
	{
		$.ajax({
			url: '<?=site_url();?>employees/branch_log_history/'+ nik,
			method: 'get',
			dataType: 'json',
			beforeSend: function(){
				$.blockUI({message: '<i class="fa fa-spinner fa-spin"></i> Please Wait'});
			},
			statusCode: {
				200: function(){
					console.log(200);
					$.unblockUI();
				},
				400: function(){
					console.log(400);
					toastr.warning('Error 400', 'Oops...');
					$.unblockUI();
				},
				404: function(){
					console.log(404);
					toastr.warning('Error 404', 'Oops...');
					$.unblockUI();
				},
				500: function(){
					console.log(500);
					toastr.warning('Error 500', 'Oops...');
					$.unblockUI();
				}
			}
		})
		.done(function(res){
			if(res.code == 200){
				let html = '';
				html += `
				<table class="table table-borderless table-condensed table-sm" style="width:100%;">
				<thead>
				<tr>
				<th>Nama</th>
				<th>Dari Cabang</th>
				<th>Ke Cabang</th>
				<th>Tanggal Mutasi</th>
				</tr>
				</thead>
				<tbody>
				`;

				let from_branch = '';
				let to_branch   = '';
				$.each(res.data, function(i, k){
					if(k.from_branch != null){ from_branch = k.from_branch }else{ from_branch = '' }
						if(k.to_branch != null){ to_branch = k.to_branch }else{ from_branch = '' }
							html +=`
						<tr>
						<td>${k.name}</td>
						<td>${from_branch}</td>
						<td>${to_branch}</td>
						<td>${k.mutation_date}</td>
						</tr>
						`;
					});

				html +=`
				</tbody>
				</table>
				`;

				$('#vbranchlog').html(html)
				$('#modal-branch_log').modal('show');
			}else{
				toastr.warning('Error 400', 'Oops...');
			}
		});

	}

	function contractLogEmployee(nik)
	{
		$.ajax({
			url: '<?=site_url();?>employees/contract_log_history/'+ nik,
			method: 'get',
			dataType: 'json',
			beforeSend: function(){
				$.blockUI({message: '<i class="fa fa-spinner fa-spin"></i> Please Wait'});
			},
			statusCode: {
				200: function(){
					console.log(200);
					$.unblockUI();
				},
				400: function(){
					console.log(400);
					toastr.warning('Error 400', 'Oops...');
					$.unblockUI();
				},
				404: function(){
					console.log(404);
					toastr.warning('Error 404', 'Oops...');
					$.unblockUI();
				},
				500: function(){
					console.log(500);
					toastr.warning('Error 500', 'Oops...');
					$.unblockUI();
				}
			}
		})
		.done(function(res){
			if(res.code == 200){
				let html = '';
				html += `
				<table class="table table-borderless table-condensed table-sm" style="width:100%;">
				<thead>
				<tr>
				<th>Karyawan</th>
				<th>Dari Status</th>
				<th>Menuju Status</th>
				<th>Periode</th>
				<th>Tanggal Mutasi</th>
				</tr>
				</thead>
				<tbody>
				`;

				let from_contract = '';
				let to_contract   = '';
				let from_period   = '';
				let to_period   = '';
				$.each(res.data, function(i, k){
					if(k.from_contract != null){ from_contract = k.from_contract }else{ from_contract = '' }
						if(k.to_contract != null){ to_contract = k.to_contract }else{ to_contract = '' }
							if(k.from_period != null){ from_period = k.from_period }else{ from_period = '' }
								if(k.to_period != null){ to_period = k.to_period }else{ to_period = '' }
									html +=`
								<tr>
								<td>${k.nik} ${k.name}</td>
								<td>${from_contract}</td>
								<td>${to_contract}</td>
								<td>${from_period} ~ ${to_period}</td>
								<td>${k.mutation_date}</td>
								</tr>
								`;
							});

				html +=`
				</tbody>
				</table>
				`;

				$('#vcontractlog').html(html)
				$('#modal-contract_log').modal('show');
			}else{
				toastr.warning('Error 400', 'Oops...');
			}
		});
	}

	function positionLogEmployee(nik)
	{
		$.ajax({
			url: '<?=site_url();?>employees/position_log_history/'+ nik,
			method: 'get',
			dataType: 'json',
			beforeSend: function(){
				$.blockUI({message: '<i class="fa fa-spinner fa-spin"></i> Please Wait'});
			},
			statusCode: {
				200: function(){
					console.log(200);
					$.unblockUI();
				},
				400: function(){
					console.log(400);
					toastr.warning('Error 400', 'Oops...');
					$.unblockUI();
				},
				404: function(){
					console.log(404);
					toastr.warning('Error 404', 'Oops...');
					$.unblockUI();
				},
				500: function(){
					console.log(500);
					toastr.warning('Error 500', 'Oops...');
					$.unblockUI();
				}
			}
		})
		.done(function(res){
			if(res.code == 200){
				let html = '';
				html += `
				<table class="table table-borderless table-condensed table-sm" style="width:100%;">
				<thead>
				<tr>
				<th>Karyawan</th>
				<th>Dari Posisi</th>
				<th>Menuju Posisi</th>
				<th>Tanggal Mutasi</th>
				</tr>
				</thead>
				<tbody>
				`;

				let from_position = '';
				let to_position   = '';
				$.each(res.data, function(i, k){
					if(k.from_position != null){ from_position = k.from_position }else{ from_position = '' }
						if(k.to_position != null){ to_position = k.to_position }else{ to_position = '' }
							html +=`
						<tr>
						<td>${k.nik} ${k.name}</td>
						<td>${from_position}</td>
						<td>${to_position}</td>
						<td>${k.mutation_date}</td>
						</tr>
						`;
					});

				html +=`
				</tbody>
				</table>
				`;

				$('#vpositionlog').html(html)
				$('#modal-position_log').modal('show');
			}else{
				toastr.warning('Error 400', 'Oops...');
			}
		});
	}
</script>
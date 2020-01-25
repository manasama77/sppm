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
			url: '<?=site_url();?>siswa/show/all',
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
				html += `<th>NIS</th>`;
				html += `<th>Nama</th>`;
				html += `<th>Tempat, Tanggal Lahir</th>`;
				html += `<th>Nama Wali</th>`;
				html += `<th>Alamat</th>`;
				html += `<th>Kota</th>`;
				html += `<th>Kecamatan</th>`;
				html += `<th>Desa</th>`;
				html += `<th>Kelas</th>`;
				html += `<th>Tanggal Masuk</th>`;
				html += `<th>Jenis Kelamin</th>`;
				html += `<th class="text-center"><i class="fa fa-cogs"></i></th>`;
				html += `</tr>`;
				html += `</thead>`;
				html += `<tbody>`;

				$gender_badge = '';
				$.each(res.data, function(i, k){
					if(k.photo == '' || k.photo == null){ 
						images = '<img src="<?=base_url();?>assets/pages/img/avatars/avatar_default.png" width="80px" class="img-thumbnail">'; 
					}else{ 
						images = '<img src="<?=base_url();?>assets/pages/img/avatars/siswa/' + k.photo + '" width="80px" class="img-thumbnail">';
					}

					if(k.jenis_kelamin == 'male'){ 
						jenis_kelamin = 'Laki-Laki'; 
						gender_badge  = 'bg-blue bg-font-blue'; 
					}else{ 
						jenis_kelamin = 'Perempuan'; 
						gender_badge  = 'bg-purple-seance bg-font-purple-seance';
					}
					
					html += `<tr>`;
					html += `<td class="text-center">${images}</td>`;
					html += `<td>${k.nis}</td>`;
					html += `<td>${k.nama}</td>`;
					html += `<td>${k.tempat_lahir}, ${k.tanggal_lahir}</td>`;
					html += `<td>${k.nama_wali}</td>`;
					html += `<td>${k.alamat}</td>`;
					html += `<td>${k.kota}</td>`;
					html += `<td>${k.kecamatan}</td>`;
					html += `<td>${k.desa}</td>`;
					html += `<td>${k.kelas}</td>`;
					html += `<td>${k.tanggal_masuk}</td>`;
					html += `<td class="text-center"><div class="badge ${gender_badge}">${jenis_kelamin}</div></td>`;
					html += `<td class="text-center" style="width:150px;">`;
					html += `<div class="btn-group">`;
					html += `<button class="btn btn-outline blue-ebonyclay btn-sm" onclick="showSPP('${k.nis}', '${k.nama}')" data-toggle="tooltip" data-placement="left" title="Data SPP"><i class="fa fa-file-text fa-fw"></i></button>`;
					html += `<button class="btn btn-primary btn-sm" onclick="editSiswa('${k.nis}', '${k.nama}')" data-toggle="tooltip" data-placement="left" title="Edit"><i class="fa fa-edit fa-fw"></i></button>`;
					html += `<button class="btn btn-danger btn-sm" onclick="berhentiSiswa('${k.nis}', '${k.nama}')" data-toggle="tooltip" data-placement="left" title="Berhenti"><i class="fa fa-user-times fa-fw"></i></button>`;
					html += `<button class="btn red-thunderbird btn-sm" onclick="deleteSiswa('${k.nis}', '${k.nama}')" data-toggle="tooltip" data-placement="left" title="Delete"><i class="fa fa-trash fa-fw"></i></button>`;
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
					{ targets: [0,12], orderable: false, searchable: false }
					]
				});

				$('[data-toggle="tooltip"]').tooltip();
			}
		});
	}

	function editSiswa(nis, nama)
	{
		Swal.fire({
			title: '<strong>Edit Data Siswa ?</strong>',
			html: `<strong>Kamu akan melakukan edit data siswa <u>${nama}</u></strong>`,
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, edit it!'
		})
		.then((result) => {
			if (result.value) {
				window.location.replace('<?=site_url();?>siswa/edit/'+nis);
			}
		});
	}

	function berhentiSiswa(nis, nama)
	{
		$('#name_berhenti').text(nama);
		$('#nis_berhenti').val(nis);
		$('#modal-berhenti').modal('show');
		$('#form-berhenti').validate({
			debug: true,
			errorClass: 'help-inline text-danger',
			rules:{
				tanggal_keluar:{ required:true, minlength:4 }
			},
			submitHandler: function( form ) {

				swal.fire({
					icon: "question",
					title: "Konfirmasi Siswa Berhenti",
					html: "Kamu akan memberhentikan untuk Siswa "+ $('#name_berhenti').text() +" ?",
					focusConfirm: false,
					showConfirmButton: true,
					showCancelButton: true,
					allowOutsideClick: false,
					confirmButtonText: '<i class="fa fa-thumbs-up"></i> Ya',
					customClass: { confirmButton: 'btn blue-madison' },
					cancelButtonText: '<i class="fa fa-times"></i> Batalkan'
				})
				.then((result) => {
					if (result.value) {
						$.ajax({
							url         : '<?=site_url('siswa/berhentis');?>',
							method      : 'PUT',
							dataType		: 'json',
							data        : { nis:$('#nis_berhenti').val(), tanggal_keluar:$('#tanggal_keluar').val() },
							beforeSend  : function(){
								$('#form-berhenti').block({ message: '<i class="fa fa-spinner fa-spin"></i> Silahkan Tunggu...' });
							},
							statusCode  : {
								200: function() {
									$('#form-berhenti').unblock();
								},
								404: function() {
									$('#form-berhenti').unblock();
									toastr.error('Page Not Found.', 'Error 404');
								},
								405: function() {
									$('#form-berhenti').unblock();
									toastr.error('Method not Allowed.', 'Error 405');
								},
								500: function() {
									$('#form-berhenti').unblock();
									toastr.error('Not connect with database.', 'Error 500');
								}
							}
						})
						.done(function(res){
							if(res.code == 200){
								swal.fire('Success', 'Berhentikan Siswa Berhasil', 'success');
								setTimeout(function(){
									$('#modal-berhenti').modal('hide');
									$('#form-berhenti').modal('hide');
									$('.reload').trigger('click');
									$('#tanggal_keluar').val('');
								}, 2000);
							}else{
								swal.fire('Oops...', 'Not connect with database.', 'error');
							}

						});

					} 
				});

			}
		});

	}

	function deleteSiswa(nis, nama)
	{
		swal.fire({
			icon: "question",
			title: "Konfirmasi Delete Siswa",
			html: `Kamu akan melakukan Delete untuk Siswa ${nama} ?`,
			focusConfirm: false,
			showConfirmButton: true,
			showCancelButton: true,
			allowOutsideClick: false,
			confirmButtonText: '<i class="fa fa-thumbs-up"></i> Ya',
			customClass: { confirmButton: 'btn blue-madison' },
			cancelButtonText: '<i class="fa fa-times"></i> Batalkan'
		})
		.then((result) => {
			if (result.value) {
				$.ajax({
					url         : '<?=site_url('siswa/delete');?>/'+nis,
					method      : 'DELETE',
					dataType		: 'json',
					beforeSend  : function(){
						$.blockUI({ message: '<i class="fa fa-spinner fa-spin"></i> Silahkan Tunggu...' });
					},
					statusCode  : {
						200: function() {
							$.unblockUI();
						},
						404: function() {
							$.unblockUI();
							toastr.error('Page Not Found.', 'Error 404');
						},
						405: function() {
							$.unblockUI();
							toastr.error('Method not Allowed.', 'Error 405');
						},
						500: function() {
							$.unblockUI();
							toastr.error('Not connect with database.', 'Error 500');
						}
					}
				})
				.done(function(res){
					if(res.code == 200){
						swal.fire('Success', 'Delete Siswa Berhasil', 'success');
						setTimeout(function(){
							$('.reload').trigger('click');
						}, 2000);
					}else{
						swal.fire('Oops...', 'Not connect with database.', 'error');
					}

				});

			} 
		});

	}

	function resetEmployee(nik, name)
	{
		$('#name_reset').text(name);
		$('#nik').val(nik);
		$('#modal-reset').modal('show');

		$('#form-reset').validate({
			debug: true,
			errorClass: 'help-inline text-danger',
			rules:{
				new_password:{ required:true, minlength:4 }
			},
			submitHandler: function( form ) {

				swal.fire({
					icon: "question",
					title: "Konfirmasi Reset Password ",
					html: "Kamu akan melakukan Reset Password untuk Guru "+ $('#name_reset').text() +" ?",
					focusConfirm: false,
					showConfirmButton: true,
					showCancelButton: true,
					allowOutsideClick: false,
					confirmButtonText: '<i class="fa fa-thumbs-up"></i> Ya',
					customClass: {
						confirmButton: 'btn blue-madison'
					},
					cancelButtonText: '<i class="fa fa-times"></i> Batalkan'
				})
				.then((result) => {
					if (result.value) {
						$.ajax({
							url         : '<?=site_url('guru/reset');?>',
							method      : 'PUT',
							dataType		: 'json',
							data        : { nik:$('#nik').val(), new_password:$('#new_password').val() },
							beforeSend  : function(){
								$('#form-reset').block({ message: '<i class="fa fa-spinner fa-spin"></i> Silahkan Tunggu...' });
							},
							statusCode  : {
								200: function() {
									$('#form-reset').unblock();
								},
								404: function() {
									$('#form-reset').unblock();
									toastr.error('Page Not Found.', 'Error 404');
								},
								405: function() {
									$('#form-reset').unblock();
									toastr.error('Method not Allowed.', 'Error 405');
								},
								500: function() {
									$('#form-reset').unblock();
									toastr.error('Not connect with database.', 'Error 500');
								}
							}
						})
						.done(function(res){
							if(res.code == 200){
								swal.fire('Success', 'Reset Pasword Berhasil', 'success');
								setTimeout(function(){
									$('#modal-reset').modal('hide');
									$('.reload').trigger('click');
									$('#new_password').val('');
								}, 2000);
							}else{
								swal.fire('Oops...', 'Not connect with database.', 'error');
							}

						});

					} 
				});

			}
		});
	}

	function showSPP(nis, nama)
	{
		$('#name_spp').text(nama);
		$('#modal-spp').modal('show');
		$.ajax({
			url         : '<?=site_url();?>spp/show/'+nis,
			method      : 'GET',
			dataType		: 'json',
			beforeSend  : function(){
				$('#data-spp').html('');
				$('#data-spp').block({ message: '<i class="fa fa-spinner fa-spin"></i> Silahkan Tunggu...' });
			},
			statusCode  : {
				200: function() {
					$('#data-spp').unblock();
				},
				404: function() {
					$('#data-spp').unblock();
					toastr.error('Page Not Found.', 'Error 404');
				},
				405: function() {
					$('#data-spp').unblock();
					toastr.error('Method not Allowed.', 'Error 405');
				},
				500: function() {
					$('#data-spp').unblock();
					toastr.error('Not connect with database.', 'Error 500');
				}
			}
		})
		.done(function(res){
			console.log(res);
			let html       = '';
			let flag_bayar = '';
			let no         = 1;
			$.each(res, function(i, k){
				if(k.flag_bayar == 0){
					flag_bayar = '<i class="fa fa-times"></i>';
				}else if(k.flag_bayar == 1){
					let flag_bayar = '<i class="fa fa-check"></i>';
				}
				html += `
				<tr>
				<td class="text-center">${no}</td>
				<td class="text-center">${k.bulan} ${k.tahun}</td>
				<td class="text-center">${flag_bayar}</td>
				</tr>
				`;
				no++;
			});

			$('#data-spp').html(html);
		});
	}
</script>
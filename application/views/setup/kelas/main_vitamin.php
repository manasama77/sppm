<script>
	$(document).ready(function(){
		showAllData();

		$('.reload').on('click', function(tables){
			showAllData();
		});

		$('#form-create').validate({
			debug: true,
			errorElement: 'span',
			errorClass: 'help-block help-block-error text-danger',
			focusInvalid: true,
			ignore: "",
			rules: { nama_kelas: { required: true }, wali_kelas: { required: true }, spp: { required: true } },
			errorPlacement: function (error, element) {
				$(error[0]).insertAfter(element[0]);
			},
			highlight: function (element) {
				$(element).closest('.form-group').removeClass("has-success").addClass('has-error');   
			},
			unhighlight: function (element) { },
			success: function (label, element) {
				var icon = $(element).parent('.input-icon').children('i');
				$(element).closest('.form-group').removeClass('has-error').addClass('has-success');
				icon.removeClass("fa-warning").addClass("fa-check");
			},
			submitHandler: function (form) {
				processInsert();
			}

		});
	});

	function showAllData()
	{
		let vresult = $('#vresult');
		$.ajax({
			url: '<?=site_url();?>get_kelas',
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
					Swal.fire('Oops...', 'Error 400', 'error');
					$.unblockUI();
				},
				404: function(){
					console.log(404);
					Swal.fire('Oops...', 'Error 404', 'error');
					$.unblockUI();
				},
				500: function(){
					console.log(500);
					Swal.fire('Oops...', 'Error 500', 'error');
					$.unblockUI();
				}
			}
		})
		.done(function(res){
			console.log(res);
			if(res.code == 200){
				vresult.html('');
				let address = '';
				let contact = '';
				let html = `<table class="table table-bordered" id="vemployees" style="width:100% !importants; min-width:500px;">`;
				html += `<thead>`;
				html += `<tr>`;
				html += `<th>Nama Kelas</th>`;
				html += `<th>Wali Kelas</th>`;
				html += `<th>SPP</th>`;
				html += `<th class="text-center" style="width:80px;"><i class="fa fa-cogs"></i></th>`;
				html += `</tr>`;
				html += `</thead>`;
				html += `<tbody>`;

				$.each(res.data, function(i, k){
					html += `<tr>`;
					html += `<td>${k.nama_kelas}</td>`;
					html += `<td>${k.wali_kelas}</td>`;
					html += `<td>${k.spp}</td>`;
					html += `<td class="text-center">`;
					html += `<div class="btn-group">`;
					html += `<button class="btn btn-primary btn-sm" onclick="editKelas('${k.id}', '${k.nama_kelas}')" title="Edit"><i class="fa fa-edit fa-fw"></i></button>`;
					html += `<button class="btn btn-danger btn-sm" onclick="deleteKelas('${k.id}', '${k.nama_kelas}')" title="Delete"><i class="fa fa-trash fa-fw"></i></button>`;
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
					order: [[0,'asc']],
					responsive: true,
					columnDefs : [
					{ targets: [3], orderable: false, searchable: false }
					]
				});
			}
		});
	}

	function editKelas(id, name)
	{
		Swal.fire({
			title: '<strong>Edit Data Kelas ?</strong>',
			html: `<strong>Kamu akan melakukan edit data Kelas <u>${name}</u></strong>`,
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, edit it!'
		})
		.then((result) => {
			if (result.value) {
				$.ajax({
					url: `<?=site_url();?>show_kelas/${id}`,
					method: 'get',
					dataType: 'json',
					beforeSend: function(){
						$('#nama_kelas_e').val('');
						$('#wali_kelas_e').val('').trigger('change');
						$('#spp_e').val('');
						$('#id').val('');
						$('#modal-edit').modal('show');
						setTimeout(function(){
							$('#form-edit').block({message: '<i class="fa fa-spinner fa-spin"></i> Please Wait...'});
						}, 800);
					},
					statusCode: {
						200: function(){
							console.log(200);
							$('#form-edit').unblock();
						},
						400: function(){
							console.log(400);
							Swal.fire('Oops...', 'Error 400', 'error');
							$('#form-edit').unblock();
						},
						404: function(){
							console.log(404);
							Swal.fire('Oops...', 'Error 404', 'error');
							$('#form-edit').unblock();
						},
						500: function(){
							console.log(500);
							Swal.fire('Oops...', 'Error 500', 'error');
							$('#form-edit').unblock();
						}
					}
				})
				.done(function(res){
					console.log(res);
					if(res.code == 200){

						$.each(res.data, function(i, k){
							let id         = k.id;
							let nama_kelas = k.nama_kelas;
							let wali_kelas = k.wali_kelas;
							let spp        = k.spp;

							$('#nama_kelas_e').val(nama_kelas);
							$('#wali_kelas_e').val(wali_kelas).trigger('change');
							$('#spp_e').val(spp);
							$('#id').val(id);
						});

					}
				});

				$('#form-edit').validate({
					debug: true,
					errorElement: 'span',
					errorClass: 'help-block help-block-error text-danger',
					focusInvalid: true,
					ignore: "",
					rules: { nama_kelas_e: { required: true }, wali_kelas_e: { required: true }, spp_e: { required: true } },
					errorPlacement: function (error, element) {
						$(error[0]).insertAfter(element[0]);
					},
					highlight: function (element) {
						$(element).closest('.form-group').removeClass("has-success").addClass('has-error');   
					},
					unhighlight: function (element) { },
					success: function (label, element) {
						var icon = $(element).parent('.input-icon').children('i');
						$(element).closest('.form-group').removeClass('has-error').addClass('has-success');
						icon.removeClass("fa-warning").addClass("fa-check");
					},
					submitHandler: function (form) {
						processUpdate();
					}

				});

			}
		});
	}

	function deleteKelas(id, name)
	{
		Swal.fire({
			title: `<strong>Delete Data Kelas<br><u>${name}</u> ?</strong>`,
			html: `<strong>Data yang sudah di delete tidak dapat di kembalikan!<br>Pastikan juga tidak ada siswa yang masih terhubung dengan Kelas <u>${name}</u></strong>`,
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, delete it!'
		})
		.then((result) => {
			if (result.value) {
				$.ajax({
					url: '<?=site_url();?>delete_kelas/'+ id,
					method: 'delete',
					dataType: 'json',
					beforeSend: function(){
						$.blockUI({message: '<i class="fa fa-spinner fa-spin"></i> Proses Delete Data'});
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
						Swal.fire('Deleted!', 'Proses Delete Data Berhasil.', 'success');
						$('.reload').trigger('click');
					}else if(res.code == 400){
						Swal.fire('Oops...', 'Ada siswa yang terhubung, Proses Delete Dibatalkan', 'warning');
					}else{
						toastr.warning('Error 500', 'Oops...');
					}
				});
			}
		})
	}

	function processInsert()
	{
		$.ajax({
			url: '<?=site_url();?>store_kelas',
			method: 'post',
			data: $('#form-create').serialize(),
			dataType: 'json',
			beforeSend: function(){
				$.blockUI({message: '<i class="fa fa-spinner fa-spin"></i> Proses Tambah Kelas Baru'});
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
			if(res.code == '200'){
				Swal.fire('Success', 'Data Kelas Baru Selesai Di Buat.', 'success');
				setTimeout(function(){
					$('#nama_kelas').val('');
					$('#wali_kelas').val('').trigger('change');
					$('#spp').val('');
					$('.reload').trigger('click');
				}, 2000);
			}else if(res.code == '400'){
				Swal.fire('Oops...', 'error 400', 'error');
			}else if(res.code == '500'){
				Swal.fire('Oops...', 'error 500', 'error');
			}
		});

	}

	function processUpdate()
	{
		$.ajax({
			url: '<?=site_url();?>update_kelas',
			method: 'put',
			data: $('#form-edit').serialize(),
			dataType: 'json',
			beforeSend: function(){
				$('#form-edit').block({message: '<i class="fa fa-spinner fa-spin"></i> Proses Update Kelas'});
			},
			statusCode: {
				200: function(){
					console.log(200);
					$('#form-edit').unblock();
				},
				400: function(){
					console.log(400);
					toastr.warning('Error 400', 'Oops...');
					$('#form-edit').unblock();
				},
				404: function(){
					console.log(404);
					toastr.warning('Error 404', 'Oops...');
					$('#form-edit').unblock();
				},
				500: function(){
					console.log(500);
					toastr.warning('Error 500', 'Oops...');
					$('#form-edit').unblock();
				}
			}
		})
		.done(function(res){
			if(res.code == '200'){
				Swal.fire('Success', 'Data Kelas Selesai Di Update.', 'success');
				setTimeout(function(){
					$('#modal-edit').modal('hide');
					$('.reload').trigger('click');
				}, 2000);
			}else if(res.code == '400'){
				Swal.fire('Oops...', 'error 400', 'error');
			}else if(res.code == '500'){
				Swal.fire('Oops...', 'error 500', 'error');
			}
		});

	}
</script>
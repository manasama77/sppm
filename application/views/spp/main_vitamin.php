<script>
	$(document).ready(function(){
		$('#form-filter').validate({
			debug: true,
			errorElement: 'span',
			errorClass: 'help-block help-block-error text-danger',
			focusInvalid: true,
			ignore: "",
			rules: {
				id_kelas: { required: true },
				nis: { required: true }
			},
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
				prosesFilter();
			}

		});

		$('.reload').on('click', function(){
			prosesFilter();
		});

		$('#id_kelas').on('change', function(){
			let id_kelas = $(this).val();
			if(id_kelas == ''){
				$('#submit').attr('disabled', true);
			}else{
				showSiswa(id_kelas);
			}
		});
	});
</script>

<script>
	function showSiswa(id_kelas)
	{
		$.ajax({
			url: '<?=site_url();?>get_siswa/by_kelas/' + id_kelas,
			method: 'get',
			dataType: 'json',
			beforeSend: function(){
				$('#nis').html('<option value=""></option>');
				$.blockUI({message: '<i class="fa fa-spinner fa-spin"></i> Try to Get the Data... Please Wait...'});
				$('#submit').attr('disabled', true);
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
			let html = '';

			console.log(res.data.length)

			if(res.data.length == 0){
				html += `<option value="">Siswa Tidak Ditemukan</option>`;
				$('#submit').attr('disabled', true);
			}else{
				html += `<option value=""></option>`;
				html += `<option value="all">Semua Siswa</option>`;
				$.each(res.data, function(i, k){
					html += `<option value="${k.nis}">${k.nama}</option>`;
				});
				$('#submit').attr('disabled', false);
			}

			$('#nis').attr('disabled', false).html(html);


		});
	}

	function prosesFilter()
	{
		let id_kelas = $('#id_kelas').val();
		let nis      = $('#nis').val();
		$.ajax({
			url: `<?=site_url();?>spp/show/${id_kelas}/${nis}`,
			method: 'get',
			dataType: 'json',
			beforeSend: function(){
				$.blockUI({message: '<i class="fa fa-spinner fa-spin"></i> Try to Get the Data... Please Wait...'});
				$('.portlet1.collapse').trigger('click');
				$('.portlet1.expand').trigger('click');
				$('.portlet1.reload').hide();
				$('.expxls').hide();
				$('#vresult').html('<div class="text-center"><i class="fa fa-spinner fa-spin"></i></div>');
			},
			statusCode: {
				200: function(){
					console.log(200);
					$.unblockUI();
					$('.portlet1.reload').show();
					$('.expxls').show();
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
			let flag_bayar = '';
			let html       = ``;
			let tipe       = $('#tipe').val();

			if(res.total_siswa == 0){
				html += `
				<table class="table table-bordered text-center">
				<thead class="bg-blue-chambray bg-font-blue-chambray">
				<tr>
				<th>Data tidak ditemukan</th>
				</tr>
				</thead>
				</table>
				`;
			}else{

				let i = 0;
				$.each(res.siswa, function(isiswa, ksiswa){
					let nis                  = ksiswa.nis;
					let nama                 = ksiswa.nama;
					let nama_kelas           = ksiswa.nama_kelas;
					let total_data_all       = ksiswa.total_data_all;
					let total_data_lunas     = ksiswa.total_data_lunas;
					let total_data_tunggakan = ksiswa.total_data_tunggakan;

					html += `
					<table class="table table-bordered text-center">
					<thead class="bg-blue-chambray bg-font-blue-chambray">
					`;

					html += `
					<tr>
					<th width="150px">NIS - NAMA</th>
					<th>${nis} - ${nama}</th>
					</tr>
					<tr>
					<th>Kelas</th>
					<th>${nama_kelas}</th>
					</tr>
					<tr>
					<th>SPP Lunas</th>
					<th>${total_data_lunas} Lunas</th>
					</tr>
					<tr>
					<th>SPP Tertunggak</th>
					<th>${total_data_tunggakan} Tunggakan</th>
					</tr>
					`;

					html += `</thead></table>`;

					html += `
					<table class="table table-bordered text-center">
					<thead class="bg-blue-chambray bg-font-blue-chambray">
					<tr>
					`;

					$.each(res.siswa[i].data, function(ispp, kspp){
						let bulan      = kspp.bulan;
						let tahun      = kspp.tahun;
						let flag_bayar = kspp.flag_bayar;

						if(tipe == '1'){
							if(flag_bayar == '1'){
								html += `<td>${bulan} ${tahun}</td>`;
							}
						}else if(tipe == '0'){
							if(flag_bayar == '0'){
								html += `<td>${bulan} ${tahun}</td>`;
							}
						}else{
							html += `<td>${bulan} ${tahun}</td>`;
						}
					})

					html += `</tr></thead><tbody><tr>`

					$.each(res.siswa[i].data, function(ispp, kspp){
						let tanggal_bayar = kspp.tanggal_bayar;
						let flag_bayar    = kspp.flag_bayar;

						if(tipe == '1'){
							if(flag_bayar == '1'){
								html += `
								<td class="bg-green-jungle bg-font-green-jungle">
								<i class="fa fa-check"></i>
								<p class="small">${tanggal_bayar}</p>
								</td>`;
							}
						}else if(tipe == '0'){
							if(flag_bayar == '0'){
								html += `<td class="bg-red-thunderbird bg-font-red-thunderbird"><i class="fa fa-times"></i></td>`;
							}
						}else{
							if(flag_bayar == '1'){
								html += `
								<td class="bg-green-jungle bg-font-green-jungle">
								<i class="fa fa-check"></i>
								<p class="small">${tanggal_bayar}</p>
								</td>`;
							}else{
								html += `<td class="bg-red-thunderbird bg-font-red-thunderbird"><i class="fa fa-times"></i></td>`;
							}
						}

					});

					html += `</tr></tbody></table>`

					html += `<hr>`;

					i++;
				});

			}

			$('#vresult').html(html);
		});

	}
</script>
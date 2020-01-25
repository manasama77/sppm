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
		let nis   = $('#nis').val();
		$.ajax({
			url: '<?=site_url();?>spp/show/' + nis,
			method: 'get',
			dataType: 'json',
			beforeSend: function(){
				$.blockUI({message: '<i class="fa fa-spinner fa-spin"></i> Try to Get the Data... Please Wait...'});
				$('.collapse').trigger('click');
				$('.expand').trigger('click');
				$('.reload').hide();
				$('#vresult').html('<div class="text-center"><i class="fa fa-spinner fa-spin"></i></div>');
			},
			statusCode: {
				200: function(){
					console.log(200);
					$.unblockUI();
					$('.reload').show();
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
			let html = `
			<table class="table table-bordered text-center">
			<thead class="bg-blue-chambray bg-font-blue-chambray">
			<tr>
			`;

			$.each(res, function(i, k){
				html += `
				<th>${k.bulan} ${k.tahun}</th>
				`;
			});

			html += `
			</tr>
			</thead>
			<tbody>
			<tr>
			`;

			$.each(res, function(i, k){
				if(k.flag_bayar == '1'){
					html += `
					<td class="bg-green-jungle bg-font-green-jungle">
					<i class="fa fa-check"></i>
					<p class="small">${k.tanggal_bayar}</p>
					</td>`;
				}else{
					html += `<td class="bg-red-thunderbird bg-font-red-thunderbird" onclick="ModalBayar('${k.nis}', '${k.nama}');"><i class="fa fa-times"></i></td>`;
				}
			});

			html += `
			</tr>
			</tbody>
			</table>
			`;

			$('#vresult').html(html);
		});

	}

	function
</script>
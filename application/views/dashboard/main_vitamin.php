<script>
	$(document).ready(function(){
		inisiasi();
	});

	function inisiasi()
	{
		totalAdmins();
		totalGuru();
		totalSiswa();
		dataBdayGuru();
		dataBdaySiswa();
	}

	function totalAdmins()
	{
		$.ajax({
			url: '<?=site_url();?>dashboard/total_admins',
			method: 'get',
			dataType: 'json',
			beforeSend: function(){
				$('#card_admin').block({ 
					message: '<i class="fa fa-spinner fa-spin"></i>', 
					fadeIn: 1000,  
					css: {
						border: 'none',
						background: '#000',
						color: '#fff'
					}
				});
			},
			statusCode: {
				200: function() {
					$('#card_admin').unblock();
				},
				404: function() {
					console.log('404');
					Swal.fire('Oops!', 'Error 500', 'error');
				},
				500: function() {
					console.log('500');
					Swal.fire('Oops!', 'Error 500', 'error');
				}
			}
		})
		.done(function(res){
			console.log(res);
			if(res.code == 200){
				$('#total_admin').text(res.total);
			}else{
				Swal.fire('Oops!', 'Error 500', 'error');
			}
		});
	}

	function totalGuru()
	{
		$.ajax({
			url: '<?=site_url();?>dashboard/total_guru',
			method: 'get',
			dataType: 'json',
			beforeSend: function(){
				$('#card_guru').block({ 
					message: '<i class="fa fa-spinner fa-spin"></i>', 
					fadeIn: 1000,  
					css: {
						border: 'none',
						background: '#000',
						color: '#fff'
					}
				});
			},
			statusCode: {
				200: function() {
					$('#card_guru').unblock();
				},
				404: function() {
					console.log('404');
					Swal.fire('Oops!', 'Error 404', 'error');
				},
				500: function() {
					console.log('500');
					Swal.fire('Oops!', 'Error 500', 'error');
				}
			}
		})
		.done(function(res){
			console.log(res);
			if(res.code == 200){
				$('#total_guru').text(res.total);
			}else{
				Swal.fire('Oops!', 'Error 500', 'error');
			}
		});
	}

	function totalSiswa()
	{
		$.ajax({
			url: '<?=site_url();?>dashboard/total_siswa',
			method: 'get',
			dataType: 'json',
			beforeSend: function(){
				$('#card_siswa').block({ 
					message: '<i class="fa fa-spinner fa-spin"></i>', 
					fadeIn: 1000,  
					css: {
						border: 'none',
						background: '#000',
						color: '#fff'
					}
				});
			},
			statusCode: {
				200: function() {
					$('#card_siswa').unblock();
				},
				404: function() {
					console.log('404');
					Swal.fire('Oops!', 'Error 404', 'error');
				},
				500: function() {
					console.log('500');
					Swal.fire('Oops!', 'Error 500', 'error');
				}
			}
		})
		.done(function(res){
			console.log(res);
			if(res.code == 200){
				$('#total_siswa').text(res.total);
			}else{
				Swal.fire('Oops!', 'Error 500', 'error');
			}
		});
	}

	function dataBdayGuru()
	{
		$.ajax({
			url: '<?=site_url();?>dashboard/data_bday_guru',
			method: 'get',
			dataType: 'json',
			beforeSend: function(){
				$('#counter_bday_guru').block({ 
					message: '<i class="fa fa-spinner fa-spin"></i>', 
					fadeIn: 1000,  
					css: {
						border: 'none',
						background: '#000',
						color: '#fff'
					}
				});

				$('#list_bday_guru').block({ 
					message: '<i class="fa fa-spinner fa-spin"></i>', 
					fadeIn: 1000,  
					css: {
						border: 'none',
						background: '#000',
						color: '#fff'
					}
				});
			},
			statusCode: {
				200: function() {
					$('#counter_bday_guru').unblock();
					$('#list_bday_guru').unblock();
				},
				404: function() {
					console.log('404');
					Swal.fire('Oops!', 'Error 404', 'error');
				},
				500: function() {
					console.log('500');
					Swal.fire('Oops!', 'Error 500', 'error');
				}
			}
		})
		.done(function(res){
			console.log(res);
			if(res.code == 200){
				$('#counter_bday_guru').html(res.total);

				let html = `
				<table class="table table-borderless table-condensed table-sm" style="width:100%;">
					<thead>
						<tr>
							<th>Nama</th>
						</tr>
					</thead>
					<tbody>`;

				if(res.total == 0){
					html += `<td class="text-center">Tidak ada yang berulang tahun hari ini</td>`;
				}else{
					$.each(res.data, function(i, k){
						html += `
						<tr>
							<td>${k.nama}</td>
						</tr>
						`;
					});
				}

				html += `
					</tbody>
				</table>
				`;
				$('#list_bday_guru').html(html);
			}else{

			}
		});
	}

	function dataBdaySiswa()
	{
		$.ajax({
			url: '<?=site_url();?>dashboard/data_bday_siswa',
			method: 'get',
			dataType: 'json',
			beforeSend: function(){
				$('#counter_bday_siswa').block({ 
					message: '<i class="fa fa-spinner fa-spin"></i>', 
					fadeIn: 1000,  
					css: {
						border: 'none',
						background: '#000',
						color: '#fff'
					}
				});

				$('#list_bday_siswa').block({ 
					message: '<i class="fa fa-spinner fa-spin"></i>', 
					fadeIn: 1000,  
					css: {
						border: 'none',
						background: '#000',
						color: '#fff'
					}
				});
			},
			statusCode: {
				200: function() {
					$('#counter_bday_siswa').unblock();
					$('#list_bday_siswa').unblock();
				},
				404: function() {
					console.log('404');
					Swal.fire('Oops!', 'Error 404', 'error');
				},
				500: function() {
					console.log('500');
					Swal.fire('Oops!', 'Error 500', 'error');
				}
			}
		})
		.done(function(res){
			console.log(res);
			if(res.code == 200){
				$('#counter_bday_siswa').html(res.total);

				let html = `
				<table class="table table-borderless table-condensed table-sm" style="width:100%;">
					<thead>
						<tr>
							<th>Nama</th>
							<th>Kelas</th>
						</tr>
					</thead>
					<tbody>`;

				if(res.total == 0){
					html += `<td class="text-center" colspan="2">Tidak ada yang berulang tahun hari ini</td>`;
				}else{
					$.each(res.data, function(i, k){
						html += `
						<tr>
							<td>${k.nama}</td>
							<td>${k.nama_kelas}</td>
						</tr>
						`;
					});
				}

				html += `
					</tbody>
				</table>
				`;
				$('#list_bday_siswa').html(html);
			}else{

			}
		});
	}
</script>
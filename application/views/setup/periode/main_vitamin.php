<script>
	$(document).ready(function(){
		
	});
</script>

<script>
	function showDetailLog(bts, bte, total_siswa, total_siswa_lulus, total_siswa_berhenti)
	{
		html = `
		<table class="table">
			<thead>
				<tr>
					<th>Total Siswa</th>
					<th>Total Siswa Lulus</th>
					<th>Total Siswa Berhenti</th>
			</thead>
			<tbody>
				<tr>
					<td>${total_siswa}</td>
					<td>${total_siswa_lulus}</td>
					<td>${total_siswa_berhenti}</td>
				</tr>
			</tbody>
		</table>
		`;

		$('#vres').html(html);
		$('#judul_periode').html('<strong>' + bts + ' ~ ' + bte + '</strong>');
		$('#modal-log').modal('show');
	}
</script>
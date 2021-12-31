<div class="row">
	<div class="col-md-12 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
                <h4 class="card-title"><?php echo $title ?> Tanggal <?php echo $_GET['date_range'] ?></h4>
				<a role="button" href="javascript:history.go(-1)" class="btn btn-secondary"><i class="fa fa-arrow-left"></i></a>
				<br /><br />
				<div class="table-responsive" style="overflow-y: hidden">
					<table id="dataTable_report" class="table table-hover w-100 highlight">
						<thead>
							<tr>
								<th style="width: 10px">No</th>
								<th>Petugas</th>
								<th>Acara</th>
								<th>Nama Barang</th>
								<th>Jumlah</th>
								<th>Update Terakhir</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$no = 1;
							foreach ($barang as $data) {
								
							?>
								<tr>
									<td><?php echo $no++ ?></td>
									<td><?php echo $data->nama_user ?></td>
									<td><?php echo $data->nama_acara.'<br> '.date('d/m/Y', strtotime($data->tanggal)) ?></td>
									<td><?php echo $data->nama ?></td>
									<?php 
									if($condition=='hilang'){
										echo '<td>'.$data->hilang.' '.$data->satuan.'</td>';
									}else if($condition=='rusak'){
										echo '<td>'.$data->rusak.' '.$data->satuan.'</td>';
									}else if($condition=='pinjam'){
										echo '<td>'.$data->pinjam.' '.$data->satuan.'</td>';
									}
									?>
									<td><?php echo date('d/m/Y H:i', strtotime($data->updated_at)); ?></td>
								</tr>
								
							<?php
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
$(document).ready(function() {
    $('#dataTable_report').DataTable( {
        dom: 'Bfrtip',
        buttons: [
        {
            extend: 'pdf',
            footer: true,
            title: '<?php echo $title ?> Tanggal <?php echo $_GET['date_range'] ?>\n',
            exportOptions: {
                    columns: [0,1,2,3,4,5]
                }
        },
        {
            extend: 'excel',
            footer: false,
            title: '<?php echo $title ?> Tanggal <?php echo $_GET['date_range'] ?>\n',
            exportOptions: {
                    columns: [0,1,2,3,4,5]
            }
        }         
        ]  
    });
});
</script>
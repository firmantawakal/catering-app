<div class="row">
	<div class="col-md-12 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
				<a role="button" data-toggle="modal" data-target="#modal-add" href="#" class="btn btn-success">Tambah Barang Keluar</a>
				<br /><br />
				<div class="table-responsive" style="overflow-y: hidden">
					<table id="dataTable1" class="table table-hover w-100">
						<thead>
							<tr>
								<th style="width: 10px">No</th>
								<th>Action</th>
								<th>Status</th>
								<th>Nama / Tgl Acara</th>
								<th>Alamat</th>
								<th>Tanggal Input</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$no = 1;
							foreach ($barang_keluar as $data) {
							?>
								<tr>
									<td><?php echo $no++ ?></td>
									<td>
										<?php 
											if ($data->status == 0) {
										?>
										<a href="<?php echo site_url('barang_keluar/list_product/'.$data->id_barang_keluar) ?>" type="button" class="btn btn-info" data-tooltip="tooltip" title="List Barang Keluar">
											<i class="fa fa-list"></i>
										</a>
										<a href="<?php echo site_url('barang_keluar/add_product/'.$data->id_barang_keluar) ?>" type="button" class="btn btn-warning" data-tooltip="tooltip" title="Tambah Barang Keluar">
											<i class="fa fa-plus"></i>
										</a>
										
										<?php
											}else{
										?>
										<a href="<?php echo site_url('barang_keluar/list_product/'.$data->id_barang_keluar) ?>" type="button" class="btn btn-info" data-tooltip="tooltip" title="List Barang Keluar">
											<i class="fa fa-list"></i>
										</a>
										<?php	
											}
										?>
									</td>
										
									<td><?php echo ($data->status==0) ? '<h5><span class="badge badge-danger">Ongoing</span></h5>' : '<h5><span class="badge badge-success">Selesai</span></h5>' ; ?></td>
									<td><?php echo $data->nama_acara.'<br>'.$this->string_->dbdate_to_indo($data->tanggal) ?></td>
									<td><?php echo $data->alamat_acara ?></td>
									<td><?php echo $this->string_->dbdate_to_indo($data->tanggal_input) ?></td>
								</tr>

								<div id="modal-fade<?php echo $data->id_barang_keluar; ?>" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
													&times;
												</button>
												<h5 class="modal-title" id="exampleModalLabel">
													Konfirmasi
												</h5>
											</div>
											<div class="modal-body">
												Anda yakin ingin menghapus data?
											</div>
											<div class="modal-footer">
												<a href="<?php echo site_url('barang_keluar/delete/' . $data->id_barang_keluar) ?>" class="btn btn-effect-ripple btn-danger">Ya</a>
												<button type="button" class="btn btn-effect-ripple btn-default" data-dismiss="modal">
													Tidak
												</button>
											</div>
										</div>
									</div>
								</div>
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

<div class="modal fade" id="modal-add">
	<div class="modal-dialog">
		<div class="modal-content">
		<div class="modal-header">
			<h4 class="modal-title">Pilih Acara</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="modal-body">
			<form action="<?php echo site_url('barang_keluar/create_action') ?>" method="post">
			<div class="form-group">
				<label for="username">Nama Acara</label><br>
				<select style="width: 100%;" name="id_acara" class="form-control select2form" id="nama_acara" required>
					<option value="">Pilih Acara</option>
					<?php 
					foreach ($acara as $acr) {
						echo '<option 
						data-namacust="'.$acr->nama.'" 
						data-namaacara="'.$acr->nama_acara.'" 
						data-tanggal="'.$this->string_->dbdate_to_indo($acr->tanggal).'" 
						data-alamat="'.$acr->alamat_acara.'"
						 value="'.$acr->id_acara.'">'.$acr->nama_acara.'</option>';
					}
					?>
				</select>
			</div>
			<div class="form-group">
				<label for="name">Nama Customer</label>
				<input type="text" class="form-control" id="nama_customer" readonly>
			</div>
			<div class="form-group">
				<label for="name">Nama Acara</label>
				<input type="text" class="form-control" id="nama_acara2" readonly>
			</div>
			<div class="form-group">
				<label for="email">Tanggal Acara</label>
				<input type="text" class="form-control" id="tanggal" readonly>
			</div>
			<div class="form-group">
				<label for="role">Alamat</label>
				<input type="text" class="form-control" id="alamat" readonly>
			</div>
			<!-- /.card-body -->
			<br>
			<button type="submit" class="btn btn-primary">Submit</button>
			</form>

		</div>
		<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->
	</div>
<script type="text/javascript">
$('#nama_acara').change(function(){
	document.getElementById("nama_customer").value = $(this).children('option:selected').data('namacust');
	document.getElementById("nama_acara2").value = $(this).children('option:selected').data('namaacara');
	document.getElementById("tanggal").value = $(this).children('option:selected').data('tanggal');
	document.getElementById("alamat").value = $(this).children('option:selected').data('alamat');
});
</script>
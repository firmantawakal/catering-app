<div>
	<h4 class="mb-3">List Barang Masuk</h4>
</div>
<div class="row">
	<div class="col-md-12 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
				<a href="<?php echo site_url('barang_masuk/create/') ?>" type="button" class="btn btn-success">
					Tambah Barang Masuk
				</a>
				<br><br>
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
							foreach ($barang_masuk as $data) {
							?>
								<tr>
									<td><?php echo $no++ ?></td>
									<td>
										<a href="<?php echo site_url('barang_masuk/detail/'.$data->id_barang_masuk) ?>" type="button" class="btn btn-info" data-tooltip="tooltip" title="List Barang masuk">
											<i class="fa fa-list"></i>
										</a>
									</td>
									<td><?php echo ($data->status==0) ? '<h5><span class="badge badge-danger">Ongoing</span></h5>' : '<h5><span class="badge badge-success">Selesai</span></h5>' ; ?></td>
									<td><?php echo $data->nama_acara.'<br>'.$this->string_->dbdate_to_indo($data->tanggal) ?></td>
									<td><?php echo $data->alamat_acara ?></td>
									<td><?php echo $this->string_->dbdate_to_indo($data->tanggal_input) ?></td>
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
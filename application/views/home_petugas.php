<!-- ACARA DITUGASKAN -->
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Acara Ditugaskan</h4>
                <div class="table-responsive" style="overflow-y: hidden">
                <table id="dataTable1" class="table table-hover w-100">
						<thead>
							<tr>
								<th style="width: 10px">No</th>
								<th>Nama Petugas</th>
								<th>Nama Customer</th>
								<th>Nama Acara</th>
								<th>Tanggal</th>
								<th>Alamat</th>
								<th>Jumlah Pax</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$no = 1;
							foreach ($acara as $data) {
							?>
								<tr>
									<td><?php echo $no++ ?></td>
									<td><?php echo $data->nama_user ?></td>
									<td><?php echo $data->nama ?></td>
									<td><?php echo $data->nama_acara ?></td>
									<td><?php echo $this->string_->dbdate_to_indo($data->tanggal) ?></td>
									<td><?php echo $data->alamat_acara ?></td>
									<td><?php echo $data->jumlah_pax ?></td>
								</tr>

								<div id="modal-fade<?php echo $data->id_acara; ?>" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
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
												<a href="<?php echo site_url('acara/delete/' . $data->id_acara) ?>" class="btn btn-effect-ripple btn-danger">Ya</a>
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

<!-- PINJAM -->
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Barang Dipinjam</h4>
                <div class="table-responsive" style="overflow-y: hidden">
					<table class="table table-hover w-100">
						<thead>
							<tr>
								<th style="width: 10px">No</th>
								<th>Petugas</th>
								<th>Customer</th>
								<th>Acara</th>
								<th>Waktu</th>
								<th>Nama Barang</th>
								<th>Jumlah Pinjam</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$no = 0;
							foreach ($dt_pinjam as $data) {
								$no++;
							?>
								<tr>
									<td><?php echo $no ?></td>
                                    <td><?php echo $data->nama_user ?></td>
									<td><?php echo $data->nama_customer ?></td>
									<td><?php echo $data->nama_acara ?></td>
									<td><?php echo $this->string_->dbdate_to_indo($data->tanggal) ?></td>
									<td><?php echo $data->nama_barang ?></td>
									<td style="background-color: #FFFF8F;"><?php echo $data->pinjam . ' ' . $data->satuan ?></td>
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
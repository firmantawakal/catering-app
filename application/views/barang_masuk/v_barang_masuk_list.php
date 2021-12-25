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
				<a role="button" data-toggle="modal" data-target="#modal-print" href="#" class="btn btn-warning" <?php echo ($this->session->userdata('level')=='petugas') ? 'style="display: none;"' : ''; ?>>Laporan</a>
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

<div id="modal-print" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h5 class="modal-title" id="exampleModalLabel">
                    Laporan
                </h5>
            </div>
            <div class="modal-body">
                <form autocomplete="off" action="<?php echo site_url('barang_masuk/report') ?>" method="get" enctype="multipart/form-data" class="forms-sample">
                    <div class="form-group">
                        <label for="reportrange" class="form-label">Range Tanggal</label>
                        <input type="text" name="date_range" id="reportrange" class="form-control">
                    </div>
            </div>
            <div class="modal-footer">
                    <button type="submit" class="btn btn-effect-ripple btn-primary">Lihat Data</button>
                    <button type="button" class="btn btn-effect-ripple btn-default" data-dismiss="modal">
                        Kembali
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
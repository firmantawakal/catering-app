<div class="row">
	<div class="col-md-12 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
				<a role="button" href="<?php echo site_url('satuan/create') ?>" class="btn btn-success">Tambah satuan</a>
				<br /><br />
				<div class="table-responsive" style="overflow-y: hidden">
					<table id="dataTable1" class="table table-hover w-100">
						<thead>
							<tr>
								<th>Action</th>
								<th style="width: 10px">No</th>
								<th>Nama satuan</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$no = 1;
							foreach ($satuan as $data) {
							?>
								<tr>
									<td>
										<a role="button" data-tooltip="tooltip" href="<?php echo site_url('satuan/update/' . $data->id_satuan) ?>" title="Edit" class="btn btn-primary"><i class="fa fa-pencil"></i>
										</a>

										<button type="button" data-target="#modal-fade<?php echo $data->id_satuan; ?>" data-toggle="modal" class="btn btn-danger" data-tooltip="tooltip" title="Hapus">
											<i class="fa fa-trash"></i>
										</button>
									</td>
									<td><?php echo $no++ ?></td>
									<td><?php echo $data->nama_satuan ?></td>
								</tr>

								<div id="modal-fade<?php echo $data->id_satuan; ?>" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
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
												<a href="<?php echo site_url('satuan/delete/' . $data->id_satuan) ?>" class="btn btn-effect-ripple btn-danger">Ya</a>
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
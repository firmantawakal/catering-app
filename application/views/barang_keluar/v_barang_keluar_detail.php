<div>
	<h4 class="mb-3"><?php echo $barang_keluar->nama_acara.' - '.$this->string_->dbdate_to_indo($barang_keluar->tanggal) ?></h4>
</div>
<div class="row">
	<div class="col-md-12 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
				<a role="button" href="javascript:history.go(-1)" class="btn btn-secondary"><i class="fa fa-arrow-left"></i></a>
				<br /><br />
				<div class="table-responsive" style="overflow-y: hidden">
					<table class="table table-hover w-100 highlight">
						<thead>
							<tr>
								<?php echo ($barang_keluar->status==0) ? '<th>Action</th>' : '' ;?>
								<th style="width: 10px">No</th>
								<th>Nama Barang</th>
								<th>Jenis / Fungsi</th>
								<th>Jumlah</th>
								<th>Update Terakhir</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$no = 1;
							foreach ($barang_keluar_detail as $data) {
								
							?>
								<tr>
									<?php 
									if($barang_keluar->status==0){
									?>
									<td>
										<button data-tooltip="tooltip" data-target="#modal-edit<?php echo $data->id_barang_keluar_detail; ?>" data-toggle="modal" title="Edit" class="btn btn-primary"><i class="fa fa-pencil"></i>
										</button>

										<button type="button" data-target="#modal-fade<?php echo $data->id_barang_keluar_detail; ?>" data-toggle="modal" class="btn btn-danger" data-tooltip="tooltip" title="Hapus">
											<i class="fa fa-trash"></i>
										</button>
									</td>
									<?php } ?>
									<td><?php echo $no++ ?></td>
									<td><?php echo $data->nama ?></td>
									<td><?php echo $data->jenis.' / '.$data->fungsi ?></td>
									<td><?php echo $data->qty.' '.$data->satuan ?></td>
									<td><?php echo date('d/m/Y H:i', strtotime($data->updated_at)); ?></td>
								</tr>
								<div id="modal-edit<?php echo $data->id_barang_keluar_detail; ?>" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
													&times;
												</button>
												<h5 class="modal-title" id="exampleModalLabel">
													Edit Jumlah Barang
												</h5>
											</div>
											<div class="modal-body">
												<form autocomplete="off" action="<?php echo site_url('barang_keluar/edit_product_action') ?>" method="post" enctype="multipart/form-data" class="forms-sample">
													<div class="form-group">
														<label for="exampleInputEmail2" class="form-label">Nama Barang</label>
														<input type="text" class="form-control" value="<?php echo $data->nama ?>" readonly>
														<input type="hidden" name="id_barang_keluar_det" class="form-control" value="<?php echo $data->id_barang_keluar_detail ?>">
														<input type="hidden" name="id_barang" class="form-control" value="<?php echo $data->id_barang ?>">
														<input type="hidden" name="id_barang_keluar" class="form-control" value="<?php echo $data->id_barang_keluar ?>">
													</div>
													<div class="form-group">
														<label for="exampleInputEmail2" class="form-label">Fungsi</label>
														<input type="text" class="form-control" value="<?php echo $data->fungsi ?>" readonly>
													</div>
													
													<div class="form-group">
														<label for="exampleInputEmail2" class="form-label">Kebutuhan</label>
														<input type="number" name="qty" class="form-control" value="<?php echo $data->qty ?>" required>
														<input type="hidden" name="qty_old" class="form-control" value="<?php echo $data->qty ?>">
													</div>
											</div>
											<div class="modal-footer">
													<button type="submit" class="btn btn-effect-ripple btn-danger">Edit</button>
													<button type="button" class="btn btn-effect-ripple btn-default" data-dismiss="modal">
														Kembali
													</button>
												</form>
											</div>
										</div>
									</div>
								</div>
								<div id="modal-fade<?php echo $data->id_barang_keluar_detail; ?>" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
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
												<a href="<?php echo site_url('barang_keluar/remove_list_product/' . $data->id_barang_keluar_detail) ?>" class="btn btn-effect-ripple btn-danger">Ya</a>
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
						data-namacust='.$acr->nama.' 
						data-namaacara='.$acr->nama_acara.' 
						data-tanggal='.$this->string_->dbdate_to_indo($acr->tanggal).' 
						data-alamat='.$acr->alamat_acara.'
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
$(document).ready(function () {
    $('.highlight tr').click(function (event) {
		if ($(this).hasClass("bg-warning")) {
			$(this).removeClass("bg-warning");
		} else {
			$(this).addClass("bg-warning");
			// $(this).siblings().removeClass('bg-warning');
		}
    });
});
</script>
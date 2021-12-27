<div>
	<h4 class="mb-3"><?php echo $barang_masuk->nama_acara ?></h4>
</div>
<div class="row">
	<div class="col-md-12 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
				<a role="button" href="<?php echo site_url('barang_masuk') ?>" class="btn btn-secondary"><i class="fa fa-arrow-left"></i></a>
				<?php echo ($barang_masuk->status==0 && $this->session->userdata('level')!='petugas' ) ? '<button onclick="warning()" style="margin-left:10px" class="btn btn-success">Simpan Laporan</button>' : '' ; ?>
				<br /><br />
				<div class="table-responsive" style="overflow-y: hidden">
					<table class="table table-hover w-100 highlight">
						<thead>
							<tr>
								<?php echo ($barang_masuk->status==0) ? '<th>Action</th>' : '' ; ?>
								<th style="width: 10px">No</th>
								<th>Nama Barang</th>
								<th>Jumlah</th>
								<th>Masuk</th>
								<th>Pinjam</th>
								<th>Hilang</th>
								<th>Rusak</th>
								<th>Update Terakhir</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$no = 1;
							foreach ($barang_masuk_detail as $data) {
								
							?>
								<tr>
									<?php echo ($barang_masuk->status==0) ? '<td><button data-tooltip="tooltip" data-target="#modal-edit'.$data->id_barang_masuk_detail.'" data-toggle="modal" title="Edit" class="btn btn-primary"><i class="fa fa-pencil"></i></button></td>' : '' ; ?>
									<td><?php echo $no++ ?></td>
									<td><?php echo $data->nama ?></td>
									<td><?php echo $data->qty.' '.$data->satuan ?></td>
									<td><?php echo $data->masuk ?></td>
									<td><?php echo $data->pinjam ?></td>
									<td><?php echo $data->hilang ?></td>
									<td><?php echo $data->rusak ?></td>
									<td><?php echo date('d/m/Y H:i', strtotime($data->updated_at)); ?></td>
								</tr>
								<div id="modal-edit<?php echo $data->id_barang_masuk_detail; ?>" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
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
												<form autocomplete="off" action="<?php echo site_url('barang_masuk/edit_product_action') ?>" method="post" enctype="multipart/form-data" class="forms-sample">
													<div class="row">
														<div class="col-md-6">
															<div class="form-group">
																<label for="exampleInputEmail2" class="form-label">Nama Barang</label>
																<input type="text" class="form-control" value="<?php echo $data->nama ?>" readonly>
																<input type="hidden" name="id_barang_masuk_det" class="form-control" value="<?php echo $data->id_barang_masuk_detail ?>">
																<input type="hidden" name="id_barang" class="form-control" value="<?php echo $data->id_barang ?>">
																<input type="hidden" name="id_barang_masuk" class="form-control" value="<?php echo $data->id_barang_masuk ?>">
															</div>
															<div class="form-group">
																<label for="exampleInputEmail2" class="form-label">Jumlah</label>
																<input type="number" name="qty" class="form-control" value="<?php echo $data->qty ?>" readonly>
															</div>
															
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label for="exampleInputEmail2" class="form-label">Masuk</label>
																<input type="number" name="masuk" class="form-control" value="<?php echo $data->masuk ?>" required>
																<input type="hidden" name="masuk_old" class="form-control" value="<?php echo $data->masuk ?>">
															</div>
															<div class="form-group">
																<label for="exampleInputEmail2" class="form-label">Pinjam</label>
																<input type="number" name="pinjam" class="form-control" value="<?php echo $data->pinjam ?>" required>
															</div>
															<div class="form-group">
																<label for="exampleInputEmail2" class="form-label">Hilang</label>
																<input type="number" name="hilang" class="form-control" value="<?php echo $data->hilang ?>" required>
															</div>
															<div class="form-group">
																<label for="exampleInputEmail2" class="form-label">Rusak</label>
																<input type="number" name="rusak" class="form-control" value="<?php echo $data->rusak ?>" required>
															</div>
														</div>
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
			<form action="<?php echo site_url('barang_masuk/create_action') ?>" method="post">
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

function warning(){
	swal({
		icon: "warning",
		title: 'Yakin ingin simpan laporan barang masuk?',
		text: 'Aksi ini akan merubah status barang masuk pada acara menjadi "Selesai". Pastikan laporan sudah benar',
		type: 'warning',
		buttons: [
			'Kembali',
			'Simpan'
		],
		dangerMode: true,
	}).then(function(isConfirm) {
		if (isConfirm) {
			window.location.href = "<?php echo site_url('barang_masuk/save/'.$barang_masuk->id_barang_masuk) ?>";
		} else {
			return false;
		}
	})
}
</script>
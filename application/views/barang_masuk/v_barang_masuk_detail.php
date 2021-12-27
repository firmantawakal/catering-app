<style>
input {
    width: 100%;
    padding: 3px;
    margin: 0px;
    box-sizing: border-box;
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
}
</style>
<div class="row">
	<div class="col-md-12 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
				<form action="<?php echo site_url('barang_masuk/create_action') ?>" method="POST">
				<a role="button" href="<?php echo site_url('barang_masuk') ?>" class="btn btn-secondary"><i class="fa fa-arrow-left"></i></a>
				<button class="btn btn-primary" type="submit">Simpan</button>
				<br /><br />
				<div class="table-responsive" style="overflow-y: hidden">
					<table class="table table-hover w-100 highlight">
						<thead>
							<tr>
								<th style="width: 10px">No</th>
								<th>Nama Barang</th>
								<th>Fungsi</th>
								<th>Jumlah</th>
								<th>Masuk</th>
								<th>Pinjam</th>
								<th>Hilang</th>
								<th>Rusak</th>
							</tr>
						</thead>
						<tbody>
							<input type="hidden" name="id_acara" value="<?php echo $barang_keluar->id_acara ?>">
							<?php
							$no = 1;
							foreach ($barang_keluar_detail as $data) {
								
							?>
								<tr>
									<td><?php echo $no++ ?></td>
									<td><?php echo $data->nama ?></td>
									<td><?php echo $data->fungsi ?></td>
									<td><?php echo $data->qty.' '.$data->satuan ?></td>
									<td><input type="hidden" name="qty[]" value="<?php echo $data->qty ?>">
										<input type="hidden" name="id_barang[]" value="<?php echo $data->id_barang ?>">
										<input type="number" value="0" name="masuk[]"></td>
									<td><input type="number" value="0" name="pinjam[]"></td>
									<td><input type="number" value="0" name="hilang[]"></td>
									<td><input type="number" value="0" name="rusak[]"></td>
								</tr>
							<?php
							}
							?>
						</tbody>
						</form>
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

</script>
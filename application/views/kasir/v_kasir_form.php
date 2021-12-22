<style>
	.price {
		text-align: right;
	}

	.icon-column {
		text-align: right;
		width: 20px;
	}

	.card-summary {
		background-color: #1877f2;
		color: #fff;
	}

	.table-tiket {
		cursor: pointer;
	}

	.col-form-label {
		font-size: 15px !important;
	}

	.ui-autocomplete {
		position: absolute;
		z-index: 99999 !important;
		cursor: default;
		padding: 0;
		margin-top: 2px;
		list-style: none;
		background-color: #ffffff;
		border: 1px solid #ccc -webkit-border-radius: 5px;
		-moz-border-radius: 5px;
		border-radius: 5px;
		-webkit-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
		-moz-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
		box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
	}

	.ui-autocomplete>li {
		padding: 3px 20px;
	}

	.ui-autocomplete>li.ui-state-focus {
		background-color: #DDD;
	}

	.ui-helper-hidden-accessible {
		display: none;
	}

	a.disabled {
		pointer-events: none;
		cursor: default;
	}

	.input-bayar{
  		font-size: 20px;
	}

</style>
<div class="row">
    <div class="col-md-4 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
				<center><h4 class="card-title">Pilih Tiket</h4></center>
					<div class="table-responsive" style="max-height:300px;">
						<table class="table table-hover table-tiket">
							<tbody>
								<?php 
									$no=1;
									foreach($tiket as $data){
								?>
								<tr>
									<td class="add-tiket" data_id="<?php echo $data->id_tiket ?>" dt_harga="<?php echo $data->harga_tiket ?>">
										<div style="float: left">
											<?php echo $no++.'. '.$data->nama_tiket ?>
										</div>
										<div style="float: right">
											<?php echo $this->string_->rupiah($data->harga_tiket) ?>
										</div>
									</td>
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
	<div class="col-md-8 grid-margin stretch-card">
		<div class="card">
			<div class="tampildata">
				<?php $this->load->view('kasir/list_tiket_kasir'); ?>
			</div>
		</div>
	</div>
</div>
<div id="modal-submit" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
	<form autocomplete="off" action="<?php echo $action ?>" method="post" enctype="multipart/form-data" class="forms-sample needs-validation" novalidate>
       <div class="modal-header">
			<button type="button" class="btn btn-light btn-lg" data-dismiss="modal">Cancel</button>
			<h4 class="modal-title" id="exampleModalLabel"><div class="textTotal"></div></h4>
			<button type="submit" class="btn btn-primary btn-lg">Charge</button>
		</div>
      <div class="modal-body">
			<div class="form-group row">
				<div class="col-sm-12">
					<div class="row">
						<div class="col-8">
							<input name="total_hid" class="form-control total-hid" type="hidden">
							<input name="diskon_hid" class="form-control diskon-hid" type="hidden">
							<div class="form-group">
								<label>Bayar</label>
								<div class="form-group">
									<input name="f_bayar" class="form-control input-bayar text-bayar" onkeypress="return isNumber(event)" type="text" required>
								</div>
							</div>
							<button type="button" nilai="100000" class="btn btn-outline-secondary bayar">100.000</button>
							<button type="button" nilai="50000" class="btn btn-outline-secondary bayar">50.000</button>
							<button type="button" nilai="20000" class="btn btn-outline-secondary bayar">20.000</button>
							<button type="button" nilai="10000" class="btn btn-outline-secondary bayar">10.000</button>
						</div>
						<div class="col-4">
							<div class="form-group">
								<label>Kembali</label>
								<div class="form-group">
									<input name="f_kembali" class="form-control input-bayar text-kembali" type="text" readonly>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<hr>
			<div class="form-group row">
				<label for="exampleInputEmail2" class="col-sm-3 col-form-label">Asal</label>
				<div class="col-sm-9">
					<div class="form-check form-check-inline">
						<label class="form-check-label">
							<input type="radio" class="form-check-input country" name="asalRadio" id="optionsRadios5" value="indonesia" checked>
							Indonesia
						</label>
					</div>
					<div class="form-check form-check-inline">
						<label class="form-check-label">
							<input type="radio" class="form-check-input country" name="asalRadio" id="optionsRadios6" value="internasional">
							Internasional
						</label>
					</div>
					<input type="text" class='form-control autocomplete nama box indonesia' id="autocomplete1" name="f_asal1" placeholder="ketik nama kabupaten / kota">
					<input type="text" class='form-control autocomplete2 nama box internasional' id="autocomplete2" name="f_asal2" placeholder="ketik nama negara">
				</div>
			</div>

			<div class="form-group row">
				<label for="exampleInputEmail2" class="col-sm-3 col-form-label">Metode Pembayaran</label>
				<div class="col-sm-9">
				<?php 
					$b=1;
					foreach($payment as $py){
				?>
					<input class="checkbox-budget" type="radio" value="<?php echo $py->id_payment ?>" name="payment" id="<?php echo 'payment'.$py->id_payment ?>" <?php echo $b == 1 ? 'checked' : '' ; ?>>
					<label class="for-checkbox-budget" for="<?php echo 'payment'.$py->id_payment ?>">
						<span data-hover="<?php echo $py->nama_payment ?>"><?php echo $py->nama_payment ?></span>
					</label>
				<?php 
					$b++;
					}
				?>
				</div>
			</div>

			<div class="form-group row">
				<label for="exampleInputEmail2" class="col-sm-3 col-form-label">Referensi</label>
				<div class="col-sm-9">
				<?php 
					$b=1;
					foreach($referensi as $ref){
				?>
					<input class="checkbox-budget" type="radio" value="<?php echo $ref->id_referensi ?>" name="referensi" id="<?php echo 'referensi'.$ref->id_referensi ?>" <?php echo $b == 1 ? 'checked' : '' ; ?>>
					<label class="for-checkbox-budget" for="<?php echo 'referensi'.$ref->id_referensi ?>">
						<span data-hover="<?php echo $ref->nama_referensi ?>"><?php echo $ref->nama_referensi ?></span>
					</label>
				<?php 
					$b++;
					}
				?>
				</div>
			</div>

			<div class="form-group row">
				<label for="exampleInputEmail2" class="col-sm-3 col-form-label">Group</label>
				<div class="col-sm-9">
				<?php 
					$c=1;
					foreach($group as $gr){
				?>
					<input class="checkbox-budget" type="radio" value="<?php echo $gr->id_group ?>" name="group" id="<?php echo 'group'.$gr->id_group ?>" <?php echo $c == 1 ? 'checked' : '' ; ?>>
					<label class="for-checkbox-budget" for="<?php echo 'group'.$gr->id_group ?>">
						<span data-hover="<?php echo $gr->nama_group ?>"><?php echo $gr->nama_group ?></span>
					</label>
				<?php 
					$c++;
					}
				?>
				</div>
			</div>

			<div class="form-group row">
				<label for="exampleInputEmail2" class="col-sm-3 col-form-label">Noted</label>
				<div class="col-sm-9">
					<textarea class="form-control" name="noted" rows="5" placeholder="Catatan..."></textarea>
				</div>
			</div>
		 </form>
		</div>
    </div>
  </div>
</div>
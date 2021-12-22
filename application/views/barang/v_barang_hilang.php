<div class="row">
	<div class="col-md-12 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
			<br />
<h4>Barang Hilang</h4>
    <br /><br />
    <div class="table-responsive" style="overflow-y: hidden">
        <table id="dataTable1" class="table table-hover w-100">
            <thead>
                <tr>
                    <!-- <th>Action</th> -->
                    <th style="width: 10px">No</th>
                    <th>Customer</th>
                    <th>Acara</th>
                    <th>Waktu</th>
                    <th>Nama Barang</th>
                    <th>Jumlah Hilang</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($condition as $data) {
                ?>
                    <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo $data->nama_customer ?></td>
                        <td><?php echo $data->nama_acara ?></td>
                        <td><?php echo $this->string_->dbdate_to_indo($data->tanggal) ?></td>
                        <td><?php echo $data->nama_barang ?></td>
                        <td style="background-color: #FFFF8F;"><?php echo $data->hilang.' '.$data->satuan ?></td>
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
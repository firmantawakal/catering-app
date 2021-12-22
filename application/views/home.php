
<!-- PINJAM -->
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Barang Pinjam</h4>
                <div class="table-responsive" style="overflow-y: hidden">
                    <table class="table table-hover w-100">
                        <thead>
                            <tr>
                                <th style="width: 10px">No</th>
                                <th>Customer</th>
                                <th>Acara</th>
                                <th>Waktu</th>
                                <th>Nama Barang</th>
                                <th>Jumlah Pinjam</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($dt_pinjam as $pinjam) {
                            ?>
                                <tr>
                                    <td><?php echo $no++ ?></td>
                                    <td><?php echo $pinjam->nama_customer ?></td>
                                    <td><?php echo $pinjam->nama_acara ?></td>
                                    <td><?php echo $this->string_->dbdate_to_indo($pinjam->tanggal) ?></td>
                                    <td><?php echo $pinjam->nama_barang ?></td>
                                    <td><?php echo $pinjam->pinjam.' '.$pinjam->satuan ?></td>
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

<!-- RUSAK -->
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Barang Rusak</h4>
                <div class="table-responsive" style="overflow-y: hidden">
                    <table class="table table-hover w-100">
                        <thead>
                            <tr>
                                <th style="width: 10px">No</th>
                                <th>Customer</th>
                                <th>Acara</th>
                                <th>Waktu</th>
                                <th>Nama Barang</th>
                                <th>Jumlah Rusak</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($dt_rusak as $rusak) {
                            ?>
                                <tr>
                                    <td><?php echo $no++ ?></td>
                                    <td><?php echo $rusak->nama_customer ?></td>
                                    <td><?php echo $rusak->nama_acara ?></td>
                                    <td><?php echo $this->string_->dbdate_to_indo($rusak->tanggal) ?></td>
                                    <td><?php echo $rusak->nama_barang ?></td>
                                    <td><?php echo $rusak->rusak.' '.$rusak->satuan ?></td>
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

<!-- HILANG -->
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Barang Hilang</h4>
                <div class="table-responsive" style="overflow-y: hidden">
                    <table class="table table-hover w-100">
                        <thead>
                            <tr>
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
                            foreach ($dt_hilang as $hilang) {
                            ?>
                                <tr>
                                    <td><?php echo $no++ ?></td>
                                    <td><?php echo $hilang->nama_customer ?></td>
                                    <td><?php echo $hilang->nama_acara ?></td>
                                    <td><?php echo $this->string_->dbdate_to_indo($hilang->tanggal) ?></td>
                                    <td><?php echo $hilang->nama_barang ?></td>
                                    <td><?php echo $hilang->hilang.' '.$hilang->satuan ?></td>
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
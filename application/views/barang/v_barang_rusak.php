<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            <h4 class="card-title">Barang Rusak</h4>
				<a role="button" data-toggle="modal" data-target="#modal-print" href="#" class="btn btn-warning" <?php echo ($this->session->userdata('level')=='petugas') ? 'style="display: none;"' : ''; ?>>Laporan</a>
				<br /><br />
                <div class="table-responsive" style="overflow-y: hidden">
                    <table id="dataTable1" class="table table-hover w-100">
                        <thead>
                            <tr>
                                <th style="width: 10px">No</th>
                                <th>Petugas</th>
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
                            foreach ($condition as $data) {
                            ?>
                                <tr>
                                    <td><?php echo $no++ ?></td>
                                    <td><?php echo $data->nama_user ?></td>
                                    <td><?php echo $data->nama_customer ?></td>
                                    <td><?php echo $data->nama_acara ?></td>
                                    <td><?php echo $this->string_->dbdate_to_indo($data->tanggal) ?></td>
                                    <td><?php echo $data->nama_barang ?></td>
                                    <td style="background-color: #FFFF8F;"><?php echo $data->rusak.' '.$data->satuan ?></td>
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
                <form autocomplete="off" action="<?php echo site_url('barang/report/rusak') ?>" method="get" enctype="multipart/form-data" class="forms-sample">
                    <div class="form-group">
                        <label for="reportrange" class="form-label">Petugas</label><br>
                        <select name="id_user" class="select2form" style="width: 100%;">
                            <?php 
                                foreach ($petugas as $dt_ptg) {
                                   echo '<option value="'.$dt_ptg->id_user.'">'.$dt_ptg->nama_user.'</option>';
                                }
                            ?>
                        </select>
                    </div>
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
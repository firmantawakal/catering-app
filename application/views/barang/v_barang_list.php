<div class="row">
	<div class="col-md-12 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
			<br />
<a role="button" href="<?php echo site_url('barang/create') ?>" class="btn btn-success">Tambah barang</a>
    <br /><br />
    <div class="table-responsive" style="overflow-y: hidden">
        <table id="dataTable1" class="table table-hover w-100">
            <thead>
                <tr>
                    <th>Action</th>
                    <th style="width: 10px">No</th>
                    <th>Nama</th>
                    <th>Jenis</th>
                    <th>Fungsi</th>
                    <th>Data</th>
                    <th>Satuan</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($barang as $data) {
                ?>
                    <tr>
                        <td>
                            <a role="button" data-tooltip="tooltip" href="<?php echo site_url('barang/update/' . $data->id_barang) ?>" title="Edit" class="btn btn-primary"><i class="fa fa-pencil"></i>
                            </a>

                            <button type="button" data-target="#modal-fade<?php echo $data->id_barang; ?>" data-toggle="modal" class="btn btn-danger" data-tooltip="tooltip" title="Hapus">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo $data->nama ?></td>
                        <td><?php echo $data->jenis ?></td>
                        <td><?php echo $data->fungsi ?></td>
                        <td><?php echo $data->data ?></td>
                        <td><?php echo $data->satuan ?></td>
                    </tr>

                    <div id="modal-fade<?php echo $data->id_barang; ?>" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
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
                                    <a href="<?php echo site_url('barang/delete/' . $data->id_barang) ?>" class="btn btn-effect-ripple btn-danger">Ya</a>
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
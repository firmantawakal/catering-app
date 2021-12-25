<div class="row">
	<div class="col-md-12 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
			<h4 class="card-title">Laporan Barang</h4>
        <a role="button" href="<?php echo site_url('barang/create') ?>" class="btn btn-success">Tambah barang</a>
    <br /><br />
    <div class="table-responsive" style="overflow-y: hidden">
        <table id="dataTable_report" class="table table-hover w-100">
            <thead>
                <tr>
                    <th>Action</th>
                    <th style="width: 10px">No</th>
                    <th>Nama</th>
                    <th>Data</th>
                    <th>Satuan</th>
                    <th>Update Terakhir</th>
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
                        <td><?php echo $data->data ?></td>
                        <td><?php echo $data->satuan ?></td>
                        <td><?php echo date('d/m/Y H:i',strtotime($data->updated_at)) ?></td>
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

<div id="modal-print" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h5 class="modal-title" id="exampleModalLabel">
                    Print Laporan
                </h5>
            </div>
            <div class="modal-body">
                <form autocomplete="off" action="<?php echo site_url('barang_keluar/edit_product_action') ?>" method="post" enctype="multipart/form-data" class="forms-sample">
                    <div class="form-group">
                        <label for="exampleInputEmail2" class="form-label">Tanggal</label>
                        <input type="text" class="form-control">
                    </div>
                    
                    <div class="form-group">
                        <label for="exampleInputEmail2" class="form-label">Kebutuhan</label>
                        <input type="number" name="qty" class="form-control" value="<?php echo $data->qty ?>" required>
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

<script>
$(document).ready(function() {
    $('#dataTable_report').DataTable( {
        dom: 'Bfrtip',
        buttons: [
        {
            extend: 'pdf',
            footer: true,
            title: 'Laporan Stok Barang\n',
            exportOptions: {
                    columns: [1,2,3,4,5,6,7]
                }
        },
        {
            extend: 'excel',
            footer: false,
            title: 'Laporan Stok Barang',
            exportOptions: {
                    columns: [1,2,3,4,5,6,7]
            }
        }         
        ]  
    });
});
</script>
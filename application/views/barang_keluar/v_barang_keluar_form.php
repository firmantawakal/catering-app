<div class="row">
    <div class="col-md-3 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Tambah Barang</h6>
                <form autocomplete="off" action="<?php echo site_url('barang_keluar/add_product_action') ?>" method="post" enctype="multipart/form-data" class="forms-sample">
                    <div class="form-group">
                        <label for="exampleInputEmail2" class="form-label">Nama Barang</label>
                        <select class="form-control select2form" id="nama_barang" name="id_barang" required>
                            <option value="">-- Pilih --</option>
                            <?php
                            foreach ($barang as $brg) {
                                echo '<option data-satuan="' . $brg->satuan . '" 
                                data-stok="' . $brg->data . '" 
                                data-fungsi="' . $brg->fungsi . '" 
                                value="' . $brg->id_barang . '">' . $brg->nama . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail2" class="form-label">Fungsi</label>
                        <input type="hidden" name="id_barang_keluar" class="form-control" value="<?php echo $id_barang_keluar ?>">
                        <select name="fungsi" class="select2form w-100">
                            <?php 
                                $sel = '';
                                foreach ($list_fungsi as $dt_fgs) {
                                    if ($fungsi == $dt_fgs->nama_fungsi) {
                                        $sel = 'selected';
                                    }else{
                                        $sel = '';
                                    }

                                    echo '<option value="'.$dt_fgs->nama_fungsi.'" '.$sel.'>'.$dt_fgs->nama_fungsi.'</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <!-- <label for="exampleInputEmail2" class="form-label">Jenis</label> -->
                        <input type="hidden" class="form-control" name="jenis" id="jenis">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail2" class="form-label">Stok Tersedia</label>
                        <input type="text" class="form-control" id="stok" readonly>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail2" class="form-label">Kebutuhan</label>
                        <input type="number" name="qty" class="form-control" id="qty" required>
                    </div>
                    <button type="submit" id="submit" class="btn btn-success mr-2">Tambah</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-9 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">List Barang</h6>
                <div class="col-6">
                    <table>
                        <tr>
                            <td>Acara</td>
                            <td style="padding-left:15px;padding-right:5px">:</td>
                            <td><?php echo $nama_acara ?></td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td style="padding-left:15px;padding-right:5px">:</td>
                            <td><?php echo $alamat_acara ?></td>
                        </tr>
                        <tr>
                            <td>Tanggal Acara</td>
                            <td style="padding-left:15px;padding-right:5px">:</td>
                            <td><?php echo $this->string_->dbdate_to_indo($tanggal) ?></td>
                        </tr>
                    </table>
                </div>
                <br>
                <div class="col-12">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th style="width: 10px">No</th>
                                <th>Nama Barang</th>
                                <th>Kebutuhan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $no=0;
                                foreach ($barang_temp as $brtemp) {
                                    ++$no;
                                    echo '<tr>
                                            <td><button type="button" data-target="#modal-fade'.$no.'" data-toggle="modal" class="btn btn-danger" data-tooltip="tooltip" title="Hapus">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </td>
                                            <td>'.$no.'</td>
                                            <td>'.$brtemp->nama.'</td>
                                            <td>'.$brtemp->qty.' '.$brtemp->satuan.'</td>
                                        </tr>';
                            ?>
                            <div id="modal-fade<?php echo $no; ?>" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
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
												<a href="<?php echo site_url('barang_keluar/remove_product/' . $brtemp->id_barang_keluar_detail) ?>" class="btn btn-effect-ripple btn-danger">Ya</a>
                                                <a href="javascript:history.go(-1)" class="btn btn-default">Kembali</a>
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
                <br>
                <div class="row">
                    <div class="col-6">
                        <button onclick="warning()" style="<?php echo ($no==0) ? 'pointer-events: none;cursor: default;' : '' ; ?>" class="btn btn-info btn-block">Simpan</button>
                    </div>
                    
                    <div class="col-6">
                        <a role="button" href="javascript:history.go(-1)" class="btn btn-block btn-secondary">Kembali</a>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    document.getElementById("nama_barang").onchange = function(event) {
        var stok = event.target.options[event.target.selectedIndex].dataset.stok;
        var satuan = event.target.options[event.target.selectedIndex].dataset.satuan;
        document.getElementById("stok").value = stok+' '+satuan;
    }

    function warning(){
        swal({
          icon: "warning",
          title: 'Yakin ingin simpan barang keluar?',
          text: 'Aksi ini akan mengurangi stok barang. Pastikan barang dan kebutuhan sudah benar',
          type: 'warning',
          buttons: [
                'Kembali',
                'Simpan'
            ],
            dangerMode: true,
        }).then(function(isConfirm) {
            if (isConfirm) {
                window.location.href = "<?php echo site_url('barang_keluar/save/'.$id_barang_keluar) ?>";
            } else {
                return false;
            }
        })

        // }).then(function() {
        //     
        // })
    }
</script>
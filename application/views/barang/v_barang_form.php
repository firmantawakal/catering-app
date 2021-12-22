<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h6 class="card-title"><?php echo $title ?></h6>
            <form autocomplete="off" action="<?php echo $action ?>" method="post" enctype="multipart/form-data" class="forms-sample">
                <input type="hidden" name="f_id_barang" value="<?php echo $id_barang ?>" class="form-control">
                <div class="form-group row">
                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Nama Barang</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="f_nama" value="<?php echo $nama ?>" placeholder="Nama Barang" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Satuan</label>
                    <div class="col-sm-9">
                        <select name="f_satuan" class="select2form w-100">
                            <?php 
                                    $sel = '';
                                    foreach ($list_satuan as $dt_stn) {
                                    if ($satuan == $dt_stn->nama_satuan) {
                                        $sel = 'selected';
                                    }else{
                                        $sel = '';
                                    }

                                   echo '<option value="'.$dt_stn->nama_satuan.'" '.$sel.'>'.$dt_stn->nama_satuan.'</option>';
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Jenis</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="f_jenis" value="<?php echo $jenis ?>" placeholder="Jenis">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Stok Tersedia</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" name="f_data" value="<?php echo $data ?>" placeholder="Stok Tersedia">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Fungsi</label>
                    <div class="col-sm-9">
                        <select name="f_fungsi" class="select2form w-100">
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
                <button type="submit" class="btn btn-primary mr-2">Simpan</button>
                <a href="javascript:history.go(-1)" class="btn btn-light">Kembali</a>
            </form>
        </div>
    </div>
</div>
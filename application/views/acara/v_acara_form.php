<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h6 class="card-title"><?php echo $title ?></h6>
            <form autocomplete="off" action="<?php echo $action ?>" method="post" enctype="multipart/form-data" class="forms-sample">
                <input type="hidden" name="f_id_acara" value="<?php echo $id_acara ?>" class="form-control">
                <div class="form-group row">
                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Customer</label>
                    <div class="col-sm-9">
                        <select name="f_id_customer" class="select2form w-100">
                            <?php 
                                foreach ($customer as $dt_cust) {
                                   echo '<option value="'.$dt_cust->id_customer.'">'.$dt_cust->nama.'</option>';
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Petugas</label>
                    <div class="col-sm-9">
                        <select name="f_id_user" class="select2form w-100">
                            <?php 
                                foreach ($petugas as $dt_ptg) {
                                   echo '<option value="'.$dt_ptg->id_user.'">'.$dt_ptg->nama_user.'</option>';
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Nama Acara</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="f_nama_acara" value="<?php echo $nama_acara ?>" placeholder="Nama Acara" required>
                    </div>
                </div>
                
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Tanggal</label>
                    <div class="col-sm-9">
                        <div class="input-group date datepicker" id="datePickerExample">
                            <input type="text" value="<?php echo $tanggal ?>" class="form-control" name="f_tanggal"><span class="input-group-addon"><i data-feather="calendar"></i></span>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Alamat</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" name="f_alamat" placeholder="Alamat"><?php echo $alamat ?></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Jumlah Pax</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" name="f_jumlah_pax" value="<?php echo $jumlah_pax ?>" placeholder="Jumlah Pax">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mr-2">Simpan</button>
                <a href="javascript:history.go(-1)" class="btn btn-light">Kembali</a>
            </form>
        </div>
    </div>
</div>
<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h6 class="card-title"><?php echo $title ?></h6>
            <form autocomplete="off" action="<?php echo $action ?>" method="post" enctype="multipart/form-data" class="forms-sample">
                <input type="hidden" name="f_id_customer" value="<?php echo $id_customer ?>" class="form-control">
                <div class="form-group row">
                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Nama customer</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="f_nama" value="<?php echo $nama ?>" placeholder="Nama customer" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">No. HP</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="f_telp" value="<?php echo $telp ?>" placeholder="No. HP">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Email</label>
                    <div class="col-sm-9">
                        <input type="email" class="form-control" name="f_email" value="<?php echo $email ?>" placeholder="Email">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Alamat</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" name="f_alamat" placeholder="Alamat"><?php echo $alamat ?></textarea>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary mr-2">Simpan</button>
                <a href="javascript:history.go(-1)" class="btn btn-light">Kembali</a>
            </form>
        </div>
    </div>
</div>
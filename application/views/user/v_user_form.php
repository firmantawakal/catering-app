<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h6 class="card-title"><?php echo $title ?></h6>
            <form autocomplete="off" action="<?php echo $action ?>" method="post" enctype="multipart/form-data" class="forms-sample">
                <input type="hidden" name="f_id_user" value="<?php echo $id_user ?>" class="form-control">
                <div class="form-group row">
                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Nama User</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="f_nama_user" value="<?php echo $nama_user ?>" placeholder="Nama User" required>
                    </div>
                </div>
                <input type="hidden" class="form-control" name="f_level" value="admin">
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">No. HP</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="f_no_hp" value="<?php echo $no_hp ?>" placeholder="No. HP">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Level</label>
                    <div class="col-sm-9">
                        <select name="f_level" class="form-control">
                            <option value="">-- Pilih --</option>
                            <option value="admin" <?php echo ($level=='admin') ? 'selected' : '' ; ?>>Admin</option>
                            <option value="peralatan" <?php echo ($level=='peralatan') ? 'selected' : '' ; ?>>Peralatan</option>
                            <option value="petugas" <?php echo ($level=='petugas') ? 'selected' : '' ; ?>>Petugas</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Username</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="f_username" value="<?php echo $username ?>" placeholder="Username">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password" class="col-sm-3 col-form-label">Password</label>
                    <div class="col-sm-4">
                        <div class="input-group date datepicker">
                            <input id="password" type="password" class="form-control pwd" name="f_password" required><span class="input-group-addon reveal"><i data-feather="sun"></i></span>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <span id="password-strength-status"></span>
                    </div>
                </div>
                <button id="submitBtn" type="submit" class="btn btn-primary mr-2" disabled>Simpan</button>
                <a href="javascript:history.go(-1)" class="btn btn-light">Kembali</a>
            </form>
        </div>
    </div>
</div>

<script>
$(document).ready(function () {
  $("#password").on('keyup', function(){
    var number = /([0-9])/;
    var alphabets_normal = /([a-z])/;
    var alphabets_upper = /([A-Z])/;
    var special_characters = /([~,!,@,#,$,%,^,&,*,-,_,+,=,?,>,<])/;
    if ($('#password').val().length < 8) {
        $("#submitBtn").attr("disabled", true);
        $('#password-strength-status').removeClass();
        $('#password-strength-status').addClass('weak-password');
        $('#password-strength-status').html("Weak (Password yang Anda buat belum memenuhi 5 kriteria strong password)");
    } else {
        if ($('#password').val().match(number) && $('#password').val().match(alphabets_normal) && $('#password').val().match(alphabets_upper) && $('#password').val().match(special_characters)) {
            $('#password-strength-status').removeClass();
            $('#password-strength-status').addClass('strong-password');
            $('#password-strength-status').html("Strong (Password yang Anda buat sudah memenuhi 5 kriteria strong password)");
        } else {
            $('#password-strength-status').removeClass();
            $('#password-strength-status').addClass('medium-password');
            $('#password-strength-status').html("Medium (minimal 1 huruf kapital, non kapital, angka, dan karakter spesial)");
        }
        $("#submitBtn").attr("disabled", false);
    }
  });
}); 
</script>
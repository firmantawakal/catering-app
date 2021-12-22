<script type="text/javascript">
//tambah tiket
$(".add-tiket").click(function(){
    var id_tiket = $(this).attr("data_id");
    var harga = $(this).attr("dt_harga");
    
    $.ajax({
    type: 'POST',
    url: "<?php echo site_url('ksr/tambah_tiket')?>",
    data: {"id_tiket" : id_tiket, "harga" : harga},

    success: function(data) {
        $( '.form-kasir' ).each(function(){
            this.reset();
        });
        $('.tampildata').load('<?php echo site_url('ksr/viewtiket')?>');
    }
    });
});

//plus
$(document).on("click",".plus",function(){
    var id_tiket = $(this).attr("id");
    var harga   = parseInt($(this).attr("dt_harga"));
    var jumlah  = parseInt($(this).attr("dt_jlh"));
    var subtotal = harga*(jumlah+1);

    $.ajax({
    type: 'POST',
    url: "<?php echo site_url('ksr/plus')?>",
    data: {"id_tiket" : id_tiket, "subtotal" : subtotal, },

    success: function(data) {
        $( '.form-kasir' ).each(function(){
            this.reset();
        });
        $('.tampildata').load('<?php echo site_url('ksr/viewtiket')?>');
    }
    });
});

//min
$(document).on("click",".min",function(){
    var id_temp = $(this).attr("id");
    var harga   = $(this).attr("dt_harga");
    var jumlah  = $(this).attr("dt_jlh");
    var subtotal = harga*(jumlah-1);

    var jumlah  = $('.jumlah').attr("dt_jlh");
    if (jumlah == '1') {
        $('.min').attr("disabled","");
    }

    $.ajax({
    type: 'POST',
    url: "<?php echo site_url('ksr/min')?>",
    data: {"id_temp" : id_temp, "subtotal" : subtotal, },

    success: function(data) {
        $( '.form-kasir' ).each(function(){
            this.reset();
        });
        $('.tampildata').load('<?php echo site_url('ksr/viewtiket')?>');
    }
    });
});

// qty number only
function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
};

// qty typing action
$(document).on("focusout",".qty",function(){
    var jumlah = $(this).val();
    var id_temp = $(this).attr("id");
    var harga   = $(this).attr("dt_harga");
    var subtotal = harga*jumlah;

    if (jumlah == '1') {
        $('.min').attr("disabled","");
    }

    $.ajax({
    type: 'POST',
    url: "<?php echo site_url('ksr/qty')?>",
    data: {"id_temp" : id_temp, "subtotal" : subtotal, "jumlah" : jumlah},

    success: function(data) {
        $( '.form-kasir' ).each(function(){
            this.reset();
        });
        $('.tampildata').load('<?php echo site_url('ksr/viewtiket')?>');
    }
    });
});

//aksi hapus tiket
$(document).on("click",".delbutton",function(){
    //Save the link in a variable called element
    var element = $(this);
    //Find the id of the link that was clicked
    var del_id = element.attr("id");
    //Built a url to send
    var info = {"id_tiket" : del_id};

    $.ajax({
    type: "POST",
    url : "<?php echo site_url('ksr/delete_tiket')?>",
    data: info,
    success: function(){
        $('.tampildata').load("<?php echo site_url('ksr/viewtiket')?>"); // 
    }
    });
});

$(document).ready(function() {
    var jumlah = 0;
    jumlah  = $('.min').attr("dt_jlh");
    if (jumlah == 1) {
        $('.min').attr("disabled","");
    }
    
    var dt2 = <?php echo file_get_contents(site_url().'autocomplete/search') ?>;
    $('#modal-submit').on('shown.bs.modal', function() {
        $(function(){
            $('.autocomplete').autocomplete({
                source: dt2
            });
        });
    });

    var dt3 = <?php echo file_get_contents(site_url().'autocomplete/search_nation') ?>;
    $('#modal-submit').on('shown.bs.modal', function() {
        $(function(){
            $('.autocomplete2').autocomplete({
                source: dt3
            });
        });
    });

    $(".indonesia").show();
    $(".internasional").hide();
    $(".indonesia").attr("required", "");

    $('.country').click(function(){
        var inputValue = $(this).attr("value");
        var targetBox = $("." + inputValue);
        $(targetBox).attr("required", "");
        $(".box").not(targetBox).hide();
        $(".box").not(targetBox).removeAttr('required');
        $(targetBox).show();
    });

    //set total in modal
    function addCommas(nStr) {
        nStr += '';
        var x = nStr.split('.');
        var x1 = x[0];
        var x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
                x1 = x1.replace(rgx, '$1' + '.' + '$2');
        }
        return x1 + x2;
    }

    var totalOrder = 0;

    $(document).on("click",".card-summary",function(){
        totalOrder = $(this).attr("total");
        diskon = $(this).attr("diskon");
        $(".textTotal").text('Rp. '+addCommas(totalOrder));
        $(".total-hid").val(totalOrder);
        $(".diskon-hid").val(diskon);
        $(".text-bayar").val('');
        $(".text-kembali").val('');
    });

    var tot=0;
    var nil1=0;
    var nil2=0;
    //set bayar and kembali
    $('.bayar').click(function(){
        tot = Number($(this).attr("nilai"));
        console.log(tot);
        nil1 = $(".text-bayar").val();
        $(".text-bayar").val(Number(nil1)+Number(tot));
        nil2 = $(".text-bayar").val();
        $(".text-kembali").val(Number(nil2)-Number(totalOrder));
    });

    // action input total
    $('.text-bayar').on('input', function() {
        tot = Number($(this).val());
        $(".text-kembali").val(Number(tot)-Number(totalOrder));
    });
});
</script>
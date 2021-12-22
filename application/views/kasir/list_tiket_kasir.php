<style>
    input.qty{
        max-width: 35px;
        max-height: 32px;
        display:inline-block;
        padding:1px;
    }

</style>
<div class="card">
<div class="card-body">
        <div class="table-responsive p-1" style="max-height:300px;">
            <table class="table table-hover table-border">
                <tbody>
                    <?php 
                        $no=1;
                        $total=null;
                        $n=0;
                        foreach($tiket_temp as $data_tt){
                            // if ($promo[0]->jenis=='rupiah' && $promo[0]->is_kelipatan=='yes') {

                            // }
                        $n++;
                        $total+=$data_tt->subtotal;
                    ?>
                    <tr>
                        <td><?php echo $no++.'. '.$data_tt->nama_tiket ?><br><i class="ml-3"><?php echo $this->string_->rupiah($data_tt->harga_tiket) ?></i></td>
                        <td class="price-column">
                            <div ></div>
                            <?php echo $this->string_->rupiah($data_tt->subtotal) ?>
                        </td>
                        <td class="icon-column" style="width:30%;">
                            <div class="btn-group mr-2" role="group" aria-label="Basic example">
                                <button type="button" class="btn btn-light btn-icon min min<?php echo $data_tt->id_tiket ?>" id="<?php echo $data_tt->id_tiket ?>" dt_harga="<?php echo $data_tt->harga_tiket ?>" dt_jlh="<?php echo $data_tt->jumlah ?>"><i class="fa fa-minus"></i>
                                </button>
                                
                                <input type="text" id="<?php echo $data_tt->id_tiket ?>" dt_harga="<?php echo $data_tt->harga_tiket ?>" value="<?php echo $data_tt->jumlah ?>" class="qty form-control" onkeypress="return isNumber(event)" autocomplete="off" style="text-align:center;">
                                
                                <button type="button" class="btn btn-light btn-icon plus" id="<?php echo $data_tt->id_tiket ?>" dt_harga="<?php echo $data_tt->harga_tiket ?>" dt_jlh="<?php echo $data_tt->jumlah ?>"><i class="fa fa-plus"></i></button>
                            </div>
                            <button type="button" class="btn btn-danger btn-sm btn-icon delbutton" id="<?php echo $data_tt->id_tiket ?>">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <script type="text/javascript">
                        
                        $(document).ready(function() {

                            var jumlah  = $('.min<?php echo $data_tt->id_tiket ?>').attr("dt_jlh");
                            if (jumlah <= 1) {
                                $('.min<?php echo $data_tt->id_tiket ?>').attr("disabled","");
                            };
                        });
                        
                    </script>
                    <?php 
                        }
                   
                        $ttl=0;
                        $diskon=0;
                        if ($isActive==1) {
                            
                            if ($promo[0]->jenis=='rupiah' && $promo[0]->is_kelipatan=='no') {
                                $ttl = $total - $promo[0]->jumlah;
                                $diskon = $promo[0]->jumlah;
                            }
                            elseif($promo[0]->jenis=='persen'){
                                $ttl = $total - ($total*($promo[0]->jumlah/100));
                                $diskon = $total*($promo[0]->jumlah/100);
                                $dis_persen='('.$promo[0]->jumlah.'%)';
                            }
                            elseif ($promo[0]->jenis=='rupiah' && $promo[0]->is_kelipatan=='yes') {
                                $diskon = $total_qty->jumlah*$promo[0]->jumlah;
                                $ttl = $total-$diskon;
                            }
                            
                            if ($ttl<0) {
                                $ttl=0;
                            }
                             ?>
                        <tr class="table-info">
                        <td class="pull-right">Total</td>
                        <td colspan="2" class="price-column"><?php echo $this->string_->rupiah($total) ?></td>
                    </tr>
                        <tr class="table-warning">
                            <td class="pull-right">Diskon <?php echo @$dis_persen ?></td>
                            <td colspan="2" class="price-column"><?php echo $this->string_->rupiah(@$diskon) ?></td>
                        </tr>
                    <?php 
                        }else{
                            $ttl=$total;
                        }
                    ?>
                    <tr class="table-success">
                        <td class="pull-right">Total Pembayaran</td>
                            <div class="totalOrder" nilai="<?php echo $ttl ?>"></div>
                        <td colspan="2" class="price-column"><?php echo $this->string_->rupiah($ttl) ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    
    <a data-toggle="modal" data-target="#modal-submit" class="btn btn-primary card-summary <?php echo $ttl == (0) ? 'disabled' : '' ; ?>" href="#" role="button" total="<?php echo $ttl ?>" diskon="<?php echo @$diskon ?>">
        <center class="m-3"><h3>Charge <?php echo $this->string_->rupiah($ttl) ?></h3></center>
    </a>
</div>



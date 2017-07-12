<div id="wrapper">      
    <div id="page-wrapper">
        <div class="container-fluid">
        <div class="row">
        <div id="page-wrapper">

        </div>
        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                <?php foreach ($peminjaman_terdaftar as $key) {
                ?>
                    <h3 class="panel-title">Pengembalian Buku <b><?php echo $key->judul?></b> oleh saudara/i <b><?php echo $key->nama ?></b></h3>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered table-hover">
                                <div  class="form-group">
                                    <tr>
                                        <td>Nomor Identitas</td>
                                        <td><label><?php echo $key->no_identitas ?></label></td>
                                    </tr>
                                </div>
                                <div class="form-group">
                                    <tr>
                                        <td>Nama Lengkap</td>
                                        <td><label><?php echo $key->nama ?></label></td>
                                    </tr>
                                </div>
                                <div class="form-group">
                                    <tr>
                                        <td>Kode Buku</td>
                                        <td><label><?php echo $key->id_buku ?></label></td>
                                    </tr>
                                </div>
                                <div  class="form-group">
                                    <tr>
                                        <td>Judul Buku</td>
                                        <td><label><?php echo $key->judul ?></label></td>
                                    </tr>
                                </div>
                                <div class="form-group">
                                    <tr>
                                        <td>Tanggal Pinjam</td>
                                        <td><label><?php $date=date('d/m/Y', strtotime($key->tanggal_pinjam)); echo $date;?></label></td>
                                    </tr>
                                </div>
                                <div class="form-group">
                                    <tr>
                                        <td>Tanggal Harus Dikembalikan</td>
                                        <td><label><?php $date=date('d/m/Y', strtotime($key->tanggal_kembali)); echo $date;?></label></td>
                                    </tr>
                                    
                                </div> <?php } ?>
                                 <?php echo form_open_multipart('pengembalian/create/'.$this->uri->segment(3)); ?>
                                <div class="form-group">
                                    <tr>
                                    <input hidden name="id_pinjam" value="<?php echo $key->id_pinjam ?>">
                                    <input hidden name="id_user" value="<?php echo $key->id_user ?>">
                                    <input hidden name="id_buku" value="<?php echo $key->id_buku ?>">

                                        <td>Terlambat (Hari)</td>
                                        <td><input type="number" class="form-control" value="<?php 
                                        $datetime1 = strtotime($key->tanggal_kembali);
                                        $datetime2 = strtotime(date('Y-m-d'));
                                        $datediff = $datetime2 - $datetime1;
                                        $jatuh_tempo = floor($datediff / (60*60*24));
                                        if ($jatuh_tempo <= 0) {
                                            echo "0";
                                        } else {
                                            echo $jatuh_tempo;
                                        }?>" disabled></td>
                                        <input hidden name="jatuh_tempo" value="<?php 
                                        if ($jatuh_tempo <= 0) {
                                            echo "0";
                                        } else {
                                            echo $jatuh_tempo;
                                        } ?>">
                                    </tr>
                                </div>
                                <div class="form-group">
                                    <tr>
                                        <td>Denda (Rp)</td>
                                        <td><input type="text" class="form-control" value="<?php 
                                        $denda = ($jatuh_tempo * $dendadinamis)-($toleransi * $dendadinamis);
                                        if ($denda <= 0) {
                                            echo "Rp. 0";
                                        } else {
                                            echo "Rp. ".$denda;
                                        }
                                        
                                         ?>" disabled></td>
                                         <input hidden name="denda" value="<?php 
                                         if ($denda <= 0) {
                                            echo "0";
                                        } else {
                                            echo $denda;
                                        } ?>">
                                    </tr>
                                </div>
                                
                            </div>
                    </table>
                     </div>
                </div>
            </div> 
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="margin-top: -40px">
                    <h1 class="page-header">
                        <span class="label label-primary">Pengembalian Buku</span>
                    </h1>
                    <?php if (validation_errors()) {
                                       ?><div class="alert alert-danger">
                                        <strong><?php echo validation_errors();?></strong></div>
                                    <?php 
                                   } ?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Tanggal Dikembalikan</h3>
                        </div>
                        <div class="panel-body">
                            <input type="date" name="tanggal_dikembalikan" class="form-control" value="<?php echo date('Y-m-d') ?>">
                        </div>
                    </div>
                    <hr style="border-width: 1px; border-color: grey">
                    <input style="width: 300px" type="submit" class="btn btn-lg btn-success" value="Proses">
                    <br>
                   <hr style="border-width: 1px; border-color: grey">
                    <a style="margin-left: 110px" type="button" href="<?php echo site_url('peminjaman') ?>" class="btn btn-danger">Kembali</a>
                    <br>
                    <hr style="border-width: 1px; border-color: grey">

                     <?php form_close(); ?>
                </div>
            </div>
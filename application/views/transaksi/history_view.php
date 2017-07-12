<div id="wrapper">
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12" align="center">
                <br>
                </div>
            </div>
       
    <div class="panel panel-default">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                <?php if ($status=="admin"): ?>
                    <a class="btn btn-default" href="<?php echo site_url('history/cetakpdf') ?>" role="button"><img width="30px" height="30px" src="<?php echo base_url() ?>assets/img/print.ico"> PDF</a>
                    <a class="btn btn-default" href="<?php echo site_url('history/cetakxls') ?>" role="button"><img width="30px" height="30px" src="<?php echo base_url() ?>assets/img/print2.ico"> XLS</a>
                <?php else: ?>
                    <a class="btn btn-default" href="<?php echo site_url('history/cetakpdfForYou') ?>" role="button"><img width="30px" height="30px" src="<?php echo base_url() ?>assets/img/print.ico"> PDF</a>
                    <a class="btn btn-default" href="<?php echo site_url('history/cetakxlsForYou') ?>" role="button"><img width="30px" height="30px" src="<?php echo base_url() ?>assets/img/print2.ico"> XLS</a>
                <?php endif ?>
                <span style="float: right;font-size: 30px" class="label label-success">History Transaksi Peminjaman</span> </h3>
            </div>
        
    <div class="panel-body">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                        <div class="table-responsive">
                          <?php if ($this->session->flashdata('terhapus')) {
                                   ?><div class="alert alert-success">
                                    <strong><?php echo $this->session->flashdata('terhapus');?></strong></div>
                                <?php } ?>

                            <table class="table table-striped table-bordered table-hover" id="example" style="width: 1200px">
                                <thead>
                                    <tr>
                                        <?php if ($status=="admin"): ?>
                                            <th>Nomor Identitas</th>
                                            <th>Nama Peminjam</th>
                                        <?php endif ?>
                                        <th>ID Buku</th>
                                        <th>Judul Buku</th>
                                        <th>Tanggal Pinjam</th>
                                        <th>Tanggal Kembali</th>
                                        <th>Jatuh Tempo</th>
                                        <th>Denda</th>
                                        <th>Tanggal dikembalikan</th>
                                        <?php if ($status=="admin"): ?>
                                            <th>Action</th>
                                        <?php endif ?>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($history_list as $key) { ?>
                                    <tr>
                                        <?php if ($status=="admin"): ?>
                                            <td><?php echo $key->no_identitas ?></td>
                                            <td><?php echo $key->nama ?></td>
                                        <?php endif ?>
                                        <td><?php echo $key->id_buku ?></td>
                                        <td><?php echo $key->judul ?></td>
                                        <td><?php $Pinjam = date('d/m/Y', strtotime($key->tanggal_pinjam)); echo $Pinjam ?></td>
                                        <td><?php $kembali = date('d/m/Y', strtotime($key->tanggal_kembali)); echo $kembali ?></td>
                                        <td><?php echo $key->jatuh_tempo ?></td>
                                        <td><?php echo $key->denda ?></td>
                                        <td><?php $dikembalikan = date('d/m/Y', strtotime($key->tanggal_dikembalikan)); echo $dikembalikan ?></td>
                                        <?php if ($status=="admin"): ?>
                                            <td>
                                                <a href="<?php echo site_url('pengembalian/delete/').$key->id_kembali ?>" type="button" class="btn btn-danger" onClick="JavaScript: return confirm('Anda yakin Hapus data ini ?')"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                                        </td> 
                                        <?php endif ?>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<div id="wrapper">
    <div id="page-wrapper">
        <div class="container-fluid">
        <div class="row">
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            <span class="label label-primary">Pengembalian Buku</span> 
                        </h1>
                        <ol class="breadcrumb">

                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="<?php echo site_url('dashboard') ?>">Dashboard</a>
                            </li>
                            <li class="">
                                <i class="fa fa-dashboard"></i>  <a href="<?php echo site_url('pengembalian') ?>">Pengembalian Buku</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-edit"></i> Pengembalian Buku
                            </li>
                        </ol>
                    </div>
                </div>

               
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="table-responsive">
                          <?php if ($this->session->flashdata('terhapus')) {
                                   ?><div class="alert alert-success">
                                    <strong><?php echo $this->session->flashdata('terhapus');?></strong></div>
                                <?php } ?>

                            <?php if ($status=="admin"): ?>
                                <input style="margin-top: -0px;" id="myInput" onkeyup="myFunction()" type="text" placeholder="Pencarian Berdasarkan Nama Peminjam"  class="form-control" ><br>
                            <?php else: ?>
                                <input style="margin-top: -0px;" id="myInput" onkeyup="myFunction()" type="text" placeholder="Pencarian Berdasarkan Judul Buku"  class="form-control" ><br>
                            <?php endif ?>

                            <table class="table table-striped table-bordered table-hover" id="myTable" style="">
                                <thead>
                                    <tr>
                                        <?php if ($status=="admin"): ?>
                                            <th>Nomor Identitas</th>
                                            <th>Nama Peminjam</th>
                                        <?php endif ?>
                                        <th>ID Buku</th>
                                        <th>Judul Buku</th>
                                        <th>Jatuh Tempo</th>
                                        <th>Denda</th>
                                        <th>Tanggal dikembalikan</th>
                                        <?php if ($status=="admin"): ?>
                                            <th>Action</th>
                                        <?php endif ?>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($pengembalian_list as $key) { ?>
                                    <tr>
                                        <?php if ($status=="admin"): ?>
                                            <td><?php echo $key->no_identitas ?></td>
                                            <td><?php echo $key->nama ?></td>
                                        <?php endif ?>
                                        <td><?php echo $key->id_buku ?></td>
                                        <td><?php echo $key->judul ?></td>
                                        <td><?php echo $key->jatuh_tempo ?></td>
                                        <td><?php echo $key->denda ?></td>
                                        <td><?php $kembali = date('d/m/Y', strtotime($key->tanggal_dikembalikan));echo $kembali ?></td>
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
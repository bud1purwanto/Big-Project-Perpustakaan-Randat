<div id="wrapper">
    <div id="page-wrapper">
        <div class="container-fluid">
        <div class="row">
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            <span class="label label-primary">Peminjaman Buku</span>
                        </h1>
                        <ol class="breadcrumb">

                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="<?php echo site_url('dashboard') ?>">Dashboard</a>
                            </li>
                            <li class="">
                                <i class="fa fa-desktop"></i> Peminjaman
                            </li>
                        </ol>
                    </div>
                </div>

            <?php if ($status=="admin"): ?>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <?php echo form_open_multipart('peminjaman'); ?>
                                                
            </div>
                <div class="panel panel-default" id="content">
                    <div class="panel-heading">Tambah Peminjaman</div>
                    <div class="panel-body">
                                        <?php if (validation_errors()) {
                                                   ?><div style="margin-top: px" class="alert alert-danger">
                                                    <strong><?php echo validation_errors(); ?></strong></div><?php } ?>
                                        <?php if ($this->session->flashdata('berhasil')) {
                                               ?><div style="margin-top: px" class="alert alert-success">
                                                <strong><?php echo $this->session->flashdata('berhasil');?></strong></div>
                                                <?php } 
                                                elseif ($this->session->flashdata('overload')) {
                                                    ?><div style="margin-top: px" class="alert alert-danger">
                                                <strong><?php echo $this->session->flashdata('overload');?></strong></div>
                                                <?php
                                                }?> 
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-lg-4 control-label">Nama</label>
                    <div class="col-lg-7">
                        <input type="search" class='form-control autocomplete_user' id="autocomplete1" name="nama" value="<?php echo set_value('nama'); ?>">
                    </div>
                </div>
                
                
                <div class="form-group">
                    <label class="col-lg-4 control-label">NIM</label>
                    <div class="col-lg-7">
                        <b><input type="text" class='form-control' id="v_no_identitas" name="no_identitas" value="<?php echo set_value('no_identitas'); ?>" disabled>
                        </b>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-4 control-label">Tanggal Pinjam</label>
                    <div class="col-lg-7">
                        <input type="date" name="tanggal_pinjam" id="tanggal_pinjam" class="form-control" value="<?php echo date('Y-m-d') ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-4 control-label">Tanggal Kembali</label>
                    <div class="col-lg-7">
                        <?php foreach ($setting as $key) { ?>
                        <input type="date" name="tanggal_kembali" id="tanggal_kembali" class="form-control" value="<?php 
                        $rentan = $key->rentan;
                        $now = date('Y-m-d'); 
                        $jatuhtempo = date('Y-m-d', strtotime($now. ' + '.$rentan.' weeks')); 
                        echo $jatuhtempo;
                        ?>">
                        <?php } ?>
                    </div>
                    
                </div>
                <div hidden class="form-group">
                    <label class="col-lg-4 control-label">ID Peminjam</label>
                    <div class="col-lg-7">
                        <input type="number" name="id_user" id="v_id_user" class="form-control" value="<?php echo set_value('id_user'); ?>">
                    </div>
                </div>
                
            </div>
            
            <div class="col-md-6">
                 <div class="form-group">
                    <label class="col-lg-4 control-label">Judul Buku</label>
                    <div class="col-lg-7">
                        <input type="search" class='form-control autocomplete_buku' id="autocomplete1" name="judul" class="form-control" value="<?php echo set_value('judul'); ?>" d>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-4 control-label">ID Buku</label>
                    <div class="col-lg-7">
                        <b>
                         <input type="text" class='form-control' id="v_id_buku_tampil" value="<?php echo set_value('id_buku'); ?>" disabled>
                        <input hidden name="id_buku" type="text" id="v_id_buku" value="<?php echo set_value('id_buku'); ?>">
                        </b>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-4 control-label">Stok Buku</label>
                    <div class="col-lg-7">
                        <input type="number" id="v_stok" name="stok" class="form-control autocomplete" value="<?php echo set_value('stok'); ?>" disabled>
                    </div>
                </div>
                <button style="margin-top: 20px; margin-left: 150px" type="submit" id="simpan" class="btn btn-success"><i class="glyphicon glyphicon-hdd"></i> Simpan</button>
                
                    <?php form_close(); ?>
                </div>
            </div>
        </div>
        <?php endif ?>

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                        <div class="table-responsive">
                          <?php if ($this->session->flashdata('terhapus')) {
                                   ?><div class="alert alert-success">
                                    <strong><?php echo $this->session->flashdata('terhapus');?></strong></div>
                                <?php } ?>

                            <?php if ($status=="admin"): ?>
                                <input style="margin-top: -0px; width: 900px;" id="myInput" onkeyup="myFunction()" type="text" placeholder="Pencarian Berdasarkan Nama Peminjam"  class="form-control" ><br>
                            <?php else: ?>
                                <input style="margin-top: -0px; width: 900px;" id="myInput" onkeyup="myFunction()" type="text" placeholder="Pencarian Berdasarkan Judul Buku"  class="form-control" ><br>
                            <?php endif ?>

                            <table class="table table-striped table-bordered table-hover" id="myTable" style="width: 900px;">
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
                                        <th>Status</th>
                                        <?php if ($status=="admin"): ?>
                                            <th width="10%">Action</th>
                                        <?php endif ?>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($peminjaman_list as $key) { ?>
                                    <tr>
                                        <?php if ($status=="admin"): ?>
                                            <td><?php echo $key->no_identitas ?></td>
                                            <td><?php echo $key->nama ?></td>
                                        <?php endif ?>
                                        <td><?php echo $key->id_buku ?></td>
                                        <td><?php echo $key->judul ?></td>
                                        <td><?php $pinjam = date('d/m/Y', strtotime($key->tanggal_pinjam));echo $pinjam ?></td>
                                        <td><?php $kembali = date('d/m/Y', strtotime($key->tanggal_kembali));echo $kembali ?></td>
                                        <td><?php if ($key->status=="Belum Kembali"): ?>
                                            <span class="label label-warning">Belum Kembali</span>
                                        <?php else: ?>
                                            <span class="label label-success">Kembali</span>
                                        <?php endif ?></td>
                                        <?php if ($status=="admin"): ?>
                                            <td>
                                            <?php if ($key->status=="Belum Kembali"): ?>
                                                <a href="<?php echo site_url('pengembalian/create/').$key->id_pinjam ?>" type="button" class="btn btn-primary"></span> Kembalikan</a>
                                            <?php endif ?>
                                            <?php if ($key->status=="Kembali"): ?>
                                                <a href="<?php echo site_url('peminjaman/edit/').$key->id_pinjam ?>" type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil " aria-hidden="true"></span></a>
                                                <a href="<?php echo site_url('peminjaman/delete/').$key->id_pinjam ?>" type="button" class="btn btn-danger" onClick="JavaScript: return confirm('Anda yakin Hapus data ini ?')"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                                            <?php endif ?>
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
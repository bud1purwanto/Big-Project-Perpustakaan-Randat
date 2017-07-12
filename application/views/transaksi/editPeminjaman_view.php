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
            
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <!-- The Modal -->

                                <div  id="myModal" class="modal" style="display: block;">
                                
                                <?php foreach ($data_pinjam as $key) { ?>
                                  <!-- Modal content -->
                                  <div style="margin-top: 100px; margin-left: 300px; width: 70%" class="modal-content">
                                    <div class="modal-header" style="background-color: #1abc9c">
                                      <span class="close">&times;</span>
                                      <h2>Edit Peminjaman <i class="glyphicon glyphicon-pencil"></i></h2>
                                    </div>
                                    <div class="modal-body">
                                      <div style="margin-top: 10px" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <div class="table-responsive">
                                        <?php echo form_open_multipart('peminjaman/edit/'.$this->uri->segment(3)); ?>
                                        <?php if (validation_errors()) {
                                                   ?><div style="margin-top: 20px" class="alert alert-danger">
                                                    <strong><?php echo validation_errors(); ?></strong></div>
                                        <?php } ?>


                                        
                                        <div style="margin-top: " class="form-group">
                                            <label>Nama Peminjam</label>
                                            <input class="form-control" id="nama_pengarang" type="text" name="nama_pengarang" value="<?php echo $key->nama ?>" placeholder="Nama Pengarang" disabled>
                                        </div>
                                        <div style="margin-top: " class="form-group">
                                            <label>NIM Peminjam</label>
                                            <input class="form-control" id="nama_pengarang" type="text" name="nama_pengarang" value="<?php echo $key->no_identitas ?>" placeholder="Nama Pengarang" disabled>
                                        </div>
                                        <div style="margin-top: " class="form-group">
                                            <label>Judul Buku</label>
                                            <input class="form-control" id="nama_pengarang" type="text" name="nama_pengarang" value="<?php echo $key->judul ?>" placeholder="Nama Pengarang" disabled>
                                            <input hidden id="id_buku" type="text" name="id_buku" value="<?php echo $key->id_buku ?>">
                                        </div>
                                        <div style="margin-top: " class="form-group">
                                            <label>Tanggal Pinjam</label>
                                            <input class="form-control" id="nama_pengarang" type="date" name="nama_pengarang" value="<?php echo $key->tanggal_pinjam ?>" placeholder="Nama Pengarang" disabled>
                                        </div>
                                        <div style="margin-top: " class="form-group">
                                            <label>Tanggal Kembali</label>
                                            <input class="form-control" id="tanggal_kembali" type="date" name="tanggal_kembali" value="<?php echo $key->tanggal_kembali ?>">
                                        </div>
                                        <div style="margin-top: " class="form-group">
                                            <label>Status Peminjaman</label>
                                            <input class="form-control" id="ff" type="text" name="ff" value="Belum Kembali" disabled="">
                                            <input hidden id="status" type="text" name="status" value="Belum Kembali">
                                        </div>
                                        
                                        <button style="height: 40px; width: 160px; margin-left: 310px;margin-top: 0px; background-color: #1abc9c" type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-edit"></i> Input Pengarang</button>
                                        <?php echo form_close(); ?>
                                       
                                        </div>
                                 
                                    </div>
                                    </div>
                                    <div class="modal-footer">
                            
                                    </div>
                                  </div>
                                <?php } ?>
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
                        <input type="text" id="kode" class='form-control' name="nama" value="<?php echo set_value('nama'); ?>">
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-lg-4 control-label">NIM</label>
                    <div class="col-lg-7">
                        <b><input type="number" id="no_identitas" class='form-control' name="no_identitas" value="<?php echo set_value('no_identitas'); ?>"></b>
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
    
                <div hidden="" class="form-group">
                    <label class="col-lg-4 control-label">ID Peminjam</label>
                    <div class="col-lg-7">
                        <input type="number" name="id_user" id="id_user" class="form-control" value="<?php echo set_value('id_user'); ?>">
                    </div>
                </div>
                
            </div>
            <div class="col-md-6">
                 <div class="form-group">
                    <label class="col-lg-4 control-label">Judul Buku</label>
                    <div class="col-lg-7">
                        <input type="text" id="kodee" name="judul" class="form-control" value="<?php echo set_value('judul'); ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-4 control-label">ID Buku</label>
                    <div class="col-lg-7">
                        <b><input type="text" id="id_bukutampil" class="form-control" value="<?php echo set_value('id_buku'); ?>" disabled>
                        <input hidden type="text" id="id_buku" name="id_buku" value="<?php echo set_value('id_buku'); ?>"></b>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-4 control-label">Stok Buku</label>
                    <div class="col-lg-7">
                        <input type="number" id="stok" name="stok" class="form-control" value="<?php echo set_value('stok'); ?>">
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
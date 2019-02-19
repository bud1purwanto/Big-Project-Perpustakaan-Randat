<div id="wrapper">
    <div id="page-wrapper">
        <div class="container-fluid">
        <div class="row">
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            <span class="label label-primary" style="background-color: #1abc9c">Daftar Pengarang</span> <?php if ($status=="admin"): ?>
                                
                            <a id="myBtn" class="btn btn-success" role="button"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Tambah <?php endif ?></a>
            
                        </h1>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <!-- The Modal -->

                                 <?php if (validation_errors() || $this->session->flashdata('gagal')) {
                                   ?><div  id="myModal" class="modal" style="display: block;"><?php 
                                }else if($this->session->flashdata('error')){
                                    ?><div  id="myModal" class="modal" style="display: block;"><?php
                                }else{
                                    ?><div  id="myModal" class="modal"><?php
                                }?>
                                

                                  <!-- Modal content -->
                                  <div style="margin-top: 100px; margin-left: 300px; width: 70%" class="modal-content">
                                    <div class="modal-header" style="background-color: #1abc9c">
                                      <span class="close">&times;</span>
                                      <h2>Pengarang <i class="glyphicon glyphicon-pencil"></i></h2>
                                    </div>
                                    <div class="modal-body">
                                      <div style="margin-top: 10px" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <div class="table-responsive">
                                        <?php echo form_open_multipart('pengarang/create'); ?>
                                        <?php if (validation_errors()) {
                                                   ?><div style="margin-top: 20px" class="alert alert-danger">
                                                    <strong><?php echo validation_errors(); ?></strong></div><?php } 
                                                else if ($this->session->flashdata('gagal')) {
                                                   ?><div style="margin-top: 20px" class="alert alert-danger">
                                                    <strong><?php echo $this->session->flashdata('gagal');; ?></strong></div><?php }?>


                                        
                                        <div style="margin-top: " class="form-group">
                                            <label>Nama Pengarang</label>
                                            <input class="form-control" id="nama_pengarang" type="text" name="nama_pengarang" value="<?php echo set_value('nama_pengarang') ?>" placeholder="Nama Pengarang">
                                        </div>
                                        <div style="margin-top: " class="form-group">
                                            <label>Alamat</label>
                                            <input class="form-control" id="alamat" type="text" name="alamat" value="<?php echo set_value('alamat') ?>" placeholder="Alamat Pengarang">
                                        </div>
                                        <div style="margin-top: " class="form-group">
                                            <label>Nomor HP</label>
                                            <input class="form-control" id="no_hp" type="number" name="no_hp" value="<?php echo set_value('no_hp') ?>" placeholder="Nomor HP">
                                        </div>
                                        <button style="height: 40px; width: 160px; margin-left: 310px;margin-top: 0px; background-color: #1abc9c" type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-edit"></i> Input Pengarang</button>
                                        <?php echo form_close(); ?>
                                       
                                        </div>
                                 
                                    </div>
                                    </div>
                                    <div class="modal-footer">
                            
                                    </div>
                                  </div>

                                </div>
                        </div>
                        <ol class="breadcrumb">

                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="<?php echo site_url('dashboard') ?>">Dashboard</a>
                            </li>
                            <li class="">
                                <i class="fa fa-pencil"></i> Pengarang
                            </li>
                        </ol>
                    </div>
                </div>
           
                
               <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                        <div class="table-responsive">
                          <?php if ($this->session->flashdata('sudah_input')) {
                                   ?><div class="alert alert-success">
                                    <strong><?php echo $this->session->flashdata('sudah_input');?></strong></div>
                                <?php 
                               } else if ($this->session->flashdata('fail')) {
                                   ?><div class="alert alert-danger">
                                    <strong><?php echo $this->session->flashdata('fail');?></strong></div>
                                <?php 
                               } else if ($this->session->flashdata('terhapus')) {
                                   ?><div class="alert alert-success">
                                    <strong><?php echo $this->session->flashdata('terhapus');?></strong></div>
                                <?php } ?>

                            <table class="table table-striped table-bordered table-hover" id="example">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Pengarang</th>
                                        <th>Alamat</th>
                                        <th>Nomor HP</th>
                                        <?php if ($status=="admin"): ?>
                                            <th width="13%">Action</th>
                                        <?php endif ?>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $no=0; foreach ($pengarang_list as $key) { 
                                    $no++; ?>
                                    <tr>
                                        <td><?php echo $no; ?></td>
                                        <td><?php echo $key->nama_pengarang ?></td>
                                        <td><?php echo $key->alamat ?></td>
                                        <td><?php echo $key->no_hp ?></td>
                                        <?php if ($status=="admin"): ?>
                                            <td>
                                            <a href="<?php echo site_url('pengarang/edit/').$key->id_pengarang ?>" type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil " aria-hidden="true"></span></a>
                                            <a href="<?php echo site_url('pengarang/delete/').$key->id_pengarang ?>" type="button" class="btn btn-danger" onClick="JavaScript: return confirm('Anda yakin Hapus data ini ?')"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
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

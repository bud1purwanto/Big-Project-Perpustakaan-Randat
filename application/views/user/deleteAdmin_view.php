<div id="wrapper">
    <div id="page-wrapper" style="background-color: #222222">
            <div class="container-fluid">
              <div class="row">
                 <div id="page-wrapper">    
                    <div class="container-fluid">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            
                                <div  id="myModal" class="modal" style="display: block;">
                                
                                <div style="margin-top: 100px; margin-left: 300px; width: 70%" class="modal-content">
                                    <div class="modal-header" style="background-color: #d9534f">
                                      <h2>Hapus Admin <i class="glyphicon glyphicon-lock"></i></h2>
                                    </div>
                                    <div class="modal-body">
                                        <div style="margin-top: 10px" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <div class="table-responsive">
                                        <?php echo form_open_multipart('user/deleteAdmin/'.$this->uri->segment(3)); ?><br>
                                        <?php if ($this->session->flashdata('terhapus')) {
                                                ?><div class="alert alert-danger">
                                                <strong><?php echo $this->session->flashdata('terhapus');?></strong></div>
                                        <?php }
                                            else if (validation_errors()) {
                                               ?><div class="alert alert-danger">
                                                <strong><?php echo validation_errors();?></strong></div>
                                            <?php
                                             } ?>

                                        
                                        <div style="margin-top: " class="form-group">
                                            <label>Password Admin yang Bersangkutan</label>
                                            <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan Password Admin yang Ingin Dihapus">
                                        </div>
                                       
                                        <button style="height: 40px; width: 160px; margin-left: 310px;margin-top: 0px; background-color: #d9534f" type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-edit"></i> Hapus Admin</button>
                                        <?php echo form_close(); ?>
                                        <br>
                                        </div>
                                 
                                    </div>
                                    </div>
                                    <div class="modal-footer">
                            
                                    </div>
                                  </div>

                                </div>
                        </div>

                <div class="row" style="opacity: 0.5">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            <span class="label label-default">Daftar Admin</span> <a class="btn btn-success" href="<?php echo site_url('user/createAdmin') ?>" role="button"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Tambah</a>
                        </h1>
                        <ol class="breadcrumb">

                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="<?php echo site_url('dashboard') ?>">Dashboard</a>
                            </li>
                            <li class="">
                                <i class="fa fa-edit"></i> User
                            </li>
                            <li class="active">
                                <i class="fa fa-edit"></i> Daftar Admin
                            </li>
                        </ol>
                    </div>
                </div>
                

                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="opacity: 0.5">
                        <div class="table-responsive">
                        <?php if ($this->session->flashdata('sudah_input')) {
                                   ?><div class="alert alert-success">
                                    <strong><?php echo $this->session->flashdata('sudah_input');?></strong></div>
                                <?php 

                               } ?>

                            <table class="table table-bordered table-hover" id="example">
                                <thead>
                                    <tr>
                                        <th>Nama Lengkap</th>
                                        <th>Foto Profil</th>
                                        <th>Nomor Identitas</th>
                                        <th>Username</th>
                                        <th>Jenis Kelamin</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($admin_list as $key) { ?>
                                    <tr>
                                        <td><?php echo $key->nama ?></td>
                                        <td><img width="80" height="80" src="<?=base_url()?>assets/uploads/Profil/<?=$key->foto?>"></td>
                                        <td><?php echo $key->no_identitas ?></td>
                                        <td><?php echo $key->username ?></td>
                                        <td><?php echo $key->jenis_kelamin ?></td>
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

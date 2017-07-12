<div id="wrapper">
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
            <div id="page-wrapper" >
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        

                                <div  id="myModal" class="modal" style="display: block;">
                                
                                <div style="margin-top: 100px; margin-left: 300px; width: 70%" class="modal-content">
                                    <div class="modal-header" style="background-color: #1abc9c">
                                    <h2>Ganti Password <i class="glyphicon glyphicon-lock"></i></h2>
                                    </div>
                                    <div class="modal-body">
                                        <div style="margin-top: 10px" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <div class="table-responsive">
                                        <?php echo form_open_multipart('dashboard/gantiPassword'); ?>
                                        <?php   if (validation_errors()) {
                                                   ?><div style="margin-top: 20px" class="alert alert-danger">
                                                    <strong><?php echo validation_errors(); ?></strong></div><?php 
                                                } 
                                                if ($this->session->flashdata('password')) {
                                                    ?><div class="alert alert-danger">
                                                    <strong><?php echo $this->session->flashdata('password'); ?></div><?php
                                                }?>

                                        
                                        <div style="margin-top: " class="form-group">
                                            <label>Password Lama</label>
                                            <input class="form-control" id="password_lama" type="password" name="password_lama" value="<?php echo set_value('password_lama') ?>" placeholder="Masukkan Password Lama">
                                        </div>
                                        <div style="margin-top: " class="form-group">
                                            <label>Password Baru</label>
                                            <input class="form-control" id="password_baru" type="password" name="password_baru" value="<?php echo set_value('password_baru') ?>" placeholder="Masukkan Password Baru">
                                        </div>
                                        <div style="margin-top: " class="form-group">
                                            <label>Konformasi Password Baru</label>
                                            <input class="form-control" id="conf_password_baru" type="password" name="conf_password_baru" value="<?php echo set_value('conf_password_baru') ?>" placeholder="Masukkan Konfirmasi Password Baru">
                                        </div>
                                        <button style="height: 40px; width: 160px; margin-left: 310px;margin-top: 0px; background-color: #1abc9c" type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-edit"></i> Ganti Password</button>
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
            <div class="container-fluid">

                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header" style="opacity: 0.5">
                            Profil Anda
                        </h1>
                        <ol class="breadcrumb">

                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="<?php echo site_url('dashboard') ?>">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-edit"></i> Edit Profil
                            </li>
                        </ol>
                    </div>
                </div>
                
                <div class="row" style="opacity: 0.5">
                    <div class="col-lg-6">
                        <?php foreach ($data_login as $key) {?>
                        
                            </li>
                            <?php if (!$key->foto && $key->status=="admin") {
                                ?><img style="margin-top: 1px" src="<?=base_url('assets/uploads/admin.png')?>"" width="150px" height="165px" ><?php
                            } elseif (!$key->foto && $key->status=="user") {
                                ?><img style="margin-top: 1px" src="<?=base_url('assets/uploads/user.png')?>"" width="150px" height="165px" ><?php
                            }else {
                               ?>
                               <img style="margin-top: 1px" src="<?=base_url()?>assets/uploads/Profil/<?=$key->foto?>"" width="150px" height="165px" >
                               <?php
                            } ?>
                            

                            <li class="dropdown">

                            <div class="form-group" style="margin-top: -150px; margin-left: 170px">
                                <label>Edit Foto</label>
                                <input style="width:283px" class="form-control" type="file" name="userfile" id="userfile" value="<?php echo $key->foto; ?>">
                                <p class="help-block">** Maksimal File 1 MB</p>
                            </div>
                            <div style="margin-top: 60px" class="form-group">
                                <label>Nama Lengkap</label>
                                <input class="form-control" id="nama" type="text" name="nama" value="<?php echo $key->nama; ?>" placeholder="Nama">
                            </div>

                            <div style="margin-top: 0px" class="form-group">
                                <label>Nomor Identitas</label>
                                <input class="form-control" id="disabledInput" type="text" placeholder="<?php echo $key->no_identitas; ?>"" disabled>
                            </div>

                            <div style="margin-top: 0px" class="form-group">
                                <label>Email</label>
                                <input class="form-control" id="email" type="text" name="email" value="<?php echo $key->email; ?>" placeholder="Email">
                            </div>

                            

                    </div>
                    <div class="col-lg-6" style="margin-top: -70px">
                            
                            <div style="margin-top: 70px" class="form-group">
                                <label>Nomor Hp</label>
                                <input class="form-control" id="no_hp" type="text" name="no_hp" value="<?php echo $key->no_hp; ?>" placeholder="Nomor HP">
                            </div>

                            <div style="margin-top: 0px" class="form-group">
                                <label>Username</label>
                                <input class="form-control" id="username" type="text" name="username" value="<?php echo $key->username; ?>" placeholder="Username">
                            </div>

                            <div style="margin-top: 0px" class="form-group">
                                <label>Jenis Kelamin</label>
                                <select id="jenis_kelamin" type="text" class="form-control" name="jenis_kelamin" placeholder="jenis_kelamin">
                                                     <option value="Laki-laki">Laki-laki</option>
                                                     <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>

                            <div style="margin-top: 0px" class="form-group">
                                <label>Alamat</label>
                                <input class="form-control" id="alamat" type="text" name="alamat" value="<?php echo $key->alamat; ?>" placeholder="Alamat">
                            </div>

                            <div style="margin-top: 0px" class="form-group">
                                <label>Status</label>
                                <input style="text-transform: capitalize;" class="form-control" id="disabledInput" type="text"  placeholder="<?php echo $key->status; ?>"" disabled>
                            
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-pencil"></i>  Edit</button>
                                
                            </div>
                            <?php } ?>
                   </div>
                </div>
            </div>
        </div>
    </div>
<div id="wrapper">
    <div id="page-wrapper">
        <div class="container-fluid">
        <div class="row">
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Profil Anda
                        </h1><?php echo form_open_multipart('dashboard/editProfil/'.$this->uri->segment(3)); ?>
                                <?php if (validation_errors()) {
                                   ?><div class="alert alert-danger">
                                    <strong><?php echo validation_errors(); ?></div><?php } 
                                    if ($this->session->flashdata('password')) {
                                        ?><div class="alert alert-success">
                                    <strong><?php echo $this->session->flashdata('password'); ?></div><?php
                                    }?>
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
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-6">
                        <?php foreach ($data_login as $key) {?>
                        
                            </li>
                            <?php if (!$key->foto && $key->status=="admin") {
                                ?><img style="margin-top: 1px" src="<?=base_url('assets/uploads/admin.png')?>"" width="150px" height="165px" ><?php
                            } elseif (!$key->foto && $key->status=="user") {
                                ?><img style="margin-top: 1px" src="<?=base_url('assets/uploads/user.png')?>"" width="150px" height="165px" ><?php
                            }else {
                               ?>
                               <img style="margin-top: 1px" src="<?=base_url()?>assets/uploads/Profil/<?=$key->foto?>" width="150px" height="165px" >
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
                                <input class="form-control" id="email" type="text" name="email" value="<?php echo $key->email; ?>" placeholder="Email" disabled>
                            </div>
                    </div>
                    <div class="col-lg-6" style="margin-top: -70px">
                            
                            <div style="margin-top: 70px" class="form-group">
                                <label>Nomor Hp</label>
                                <input class="form-control" id="no_hp" type="text" name="no_hp" value="<?php echo $key->no_hp; ?>" placeholder="Nomor HP">
                            </div>

                            <div style="margin-top: 0px" class="form-group">
                                <label>Username</label>
                                <input class="form-control" id="username" type="text" name="username" value="<?php echo $key->username; ?>" placeholder="Username" disabled>
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
                            <?php echo form_close(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="wrapper">
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
            <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Tambah User
                        </h1><?php echo form_open_multipart('user/createUser'); ?>
                                <?php if (validation_errors()) {
                                   ?><div class="alert alert-danger">
                                    <strong><?php echo validation_errors(); ?></strong></div><?php } 
                                    else if ($this->session->flashdata('eror')) {
                                        ?><div class="alert alert-danger">
                                    <strong><?php echo $this->session->flashdata('eror'); ?></strong></div><?php }
                                    ?>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="<?php echo site_url('dashboard') ?>">Dashboard</a>
                            </li>
                            <li class="">
                                <i class="fa fa-edit"></i> User
                            </li>
                            <li class="active">
                                <i class="fa fa-edit"></i> <a href="<?php echo site_url('user') ?>">Daftar User</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-edit"></i> Tambah User
                            </li>

                        </ol>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <?php foreach ($data_login as $key) {?>  
                            </li>
                               <img style="margin-top: 1px" src="<?=base_url()?>assets/uploads/user.png" width="150px" height="165px" >
                            <li class="dropdown">

                            <div class="form-group" style="margin-top: -150px; margin-left: 170px">
                                <label>Foto Profil</label>
                                <input style="width:283px" class="form-control" type="file" name="userfile" id="userfile" value="<?php echo $key->foto; ?>">
                                <p class="help-block">** Maksimal File 1 MB</p>
                            </div>
                            <div style="margin-top: 60px" class="form-group">
                                <label>Nama Lengkap</label>
                                <input class="form-control" id="nama" type="text" name="nama" value="<?php echo set_value('nama'); ?>" placeholder="Nama">
                            </div>

                            <div style="margin-top: 0px" class="form-group">
                                <label>Nomor Identitas</label>
                                <input class="form-control" id="no_identitas" type="number" name="no_identitas" placeholder="Nomor Identitas" value="<?php echo set_value('no_identitas'); ?>">
                            </div>

                            <div style="margin-top: 0px" class="form-group">
                                <label>Email</label>
                                <input class="form-control" id="email" type="text" name="email" value="<?php echo set_value('email'); ?>" placeholder="Email">
                            </div>
                            <div style="margin-top: 0px" class="form-group">
                                <label>Nomor Hp</label>
                                <input class="form-control" id="no_hp" type="number" name="no_hp" value="<?php echo set_value('no_hp'); ?>" placeholder="Nomor HP">
                            </div>
                            

                    </div>
                    <div class="col-lg-6" style="margin-top: -70px">
        
                            <div style="margin-top: 70px" class="form-group">
                                <label>Username</label>
                                <input class="form-control" id="username" type="text" name="username" value="<?php echo set_value('username'); ?>" placeholder="Username">
                            </div>

                            <div style="margin-top: 0px" class="form-group">
                                <label>Password</label>
                    
                                <input class="form-control" id="password" type="password" placeholder="Password" name="password" value="<?php echo set_value('password'); ?>">
                                <span class="input-group-addon"><input style="margin-top:00px" type="checkbox" onchange="document.getElementById('password').type = this.checked ? 'text' : 'password'" > Show Password</span>
                            </div>

                            <div style="margin-top: 0px" class="form-group">
                                <label>Jenis Kelamin</label>
                                <select id="jenis_kelamin" type="text" class="form-control" name="jenis_kelamin" placeholder="jenis_kelamin">
                                                    <option disabled selected style='display:none; color:lightgray;'>Jenis Kelamin</option>
                                                     <option value="Laki-laki">Laki-laki</option>
                                                     <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>

                            <div style="margin-top: 0px" class="form-group">
                                <label>Alamat</label>
                                <input class="form-control" id="alamat" type="text" name="alamat" value="<?php echo set_value('alamat'); ?>" placeholder="Alamat">
                            </div>

                            <div style="margin-top: 0px" class="form-group">
                                <label>Status</label>
                                <input style="text-transform: capitalize;" class="form-control" id="disabledInput" type="text"  placeholder="User" disabled>
                            
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-adjust"></i>  Tambah User</button>
                                
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
</div>
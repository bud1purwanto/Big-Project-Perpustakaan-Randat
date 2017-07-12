<!doctype html>
    <html>
        <head>
            <title><?=$title?></title>
            <link href="<?php echo base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet">
            <link href="<?php echo base_url('assets/font-awesome/css/font-awesome.css');?>" rel="stylesheet"><script src="<?php echo base_url('assets/js/jquery.js');?>"></script>
            <script src="<?php echo base_url('assets/js/bootstrap.js');?>"></script>
            <script src="<?php echo base_url('assets/js/tinymce/tinymce.min.js');?>"></script>
            <script>
                    tinymce.init({selector:'textarea'});
            </script>
        </head>
        <body>

            <div class="container">
            <img src="<?php echo base_url('assets/img/mystical library3.jpg');?>" height="500px" width="100%">
            <div style="margin-top: -500px">
                <nav class="navbar navbar-inverse">
                <div style="margin-left: 390px" class="container-fluid">
                    <a class="navbar-brand" href="<?php echo site_url('login') ?>">Selamat Datang di Perpustakaan JTI</a>
                    <ul class="nav navbar-nav" style="margin-left: 500px">
                    </ul>
                </div>
            </nav>
            </div>
                <div style="margin-top: 0px" id="loginbox"  class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
                    <div class="panel panel-info" >
                            <div class="panel-heading">
                                <div class="panel-title">Registrasi USER</div>
                               
                            </div>     
                            <div style="padding-top:30px" class="panel-body" >
                                <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                                    
                                <?php echo form_open_multipart('registrasi/createUser'); ?>
                                <?php if (validation_errors()) {
                                   ?><div class="alert alert-danger">
                                    <strong><?php echo validation_errors(); ?></div><?php } ?>
                                <?php if ($this->session->flashdata('error')) {
                                   ?><div class="alert alert-warning">
                                    <strong><?php echo $this->session->flashdata('error');?></div><?php } ?>
       
                                   <div style="margin-bottom: 25px" class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-plus-sign"></i></span>
                                                <input id="nama" type="text" class="form-control" name="nama" value="<?php echo set_value('nama'); ?>" placeholder="Nama">                                        
                                            </div>
                                   <div style="margin-bottom: 25px" class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-flag"></i></span>
                                                <input id="no_identitas" type="number" class="form-control" name="no_identitas" value="<?php echo set_value('no_identitas'); ?>" placeholder="NIM">                                        
                                            </div> 
                                    <div style="margin-bottom: 25px" class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-folder-open"></i></span>
                                                <input id="email" type="text" class="form-control" name="email" value="<?php echo set_value('email'); ?>" placeholder="Email">                                        
                                            </div>       
                                    <div style="margin-bottom: 25px" class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
                                                <input id="no_hp" type="number" class="form-control" name="no_hp" value="<?php echo set_value('no_hp'); ?>" placeholder="Nomor HP">                                        
                                            </div>
                                   <div style="margin-bottom: 25px" class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                                <input id="username" type="text" class="form-control" name="username" value="<?php echo set_value('username'); ?>" placeholder="Username">                                        
                                            </div>
                                        
                                   <div style="margin-bottom: 25px" class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                                <input id="password" type="password" class="form-control" name="password" placeholder="Password" value="<?php echo set_value('password'); ?>"><span class="input-group-addon"><input style="margin-top:00px" type="checkbox" onchange="document.getElementById('password').type = this.checked ? 'text' : 'password'"> Show Password</span>

                                            </div>
                                           
                                    <div style="margin-bottom: 25px" class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-heart-empty"></i></span>

                                                <select id="jenis_kelamin" type="text" class="form-control" name="jenis_kelamin" placeholder="jenis_kelamin">
                                                <option disabled selected style='display:none; color:lightgray;'>Jenis Kelamin</option>
                                                     <option value="Laki-laki">Laki-laki</option>
                                                     <option value="Perempuan">Perempuan</option>
                                                </select>
                                                                                     
                                            </div>

                                    <div style="margin-bottom: 25px" class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-tent"></i></span>
                                                <input id="alamat" type="text" class="form-control" name="alamat" value="<?php echo set_value('alamat'); ?>" placeholder="Alamat">                                        
                                            </div>

                                     <div style="margin-bottom: 25px" class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-camera"></i></span>
                                                <input id="userfile" type="file" class="form-control" name="userfile" value="<?php echo set_value('userfile'); ?>" placeholder="Foto">                                        
                                            </div> 

                                        <div style="margin-bottom: 25px" class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-tags"></i></span>
                                                <span id="status" type="text" class="form-control" name="status" value="<?php echo set_value('user'); ?>" placeholder="Alamat">Status: <b>User</b></span>                                    
                                            </div>
                                
                                        <div style="margin-top:10px" class="form-group">
                                            <!-- Button -->
        
                                            <div class="col-sm-12 controls" style="margin-top: ">
                                              <button type="submit" class="btn btn-primary">Registrasi</button>
                                              <a class="btn btn-danger" href="<?php echo site_url('login'); ?>" role="button">Kembali</a>

                                            </div>

                                            <?php echo form_close(); ?>
                                        </div>
                                    </div>                     
                                </div>  
                            </div>
                        </div>
         
            
       
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
                <div>
                    <nav class="navbar navbar-inverse">
                    <img src="<?php echo base_url('assets/img/wew.jpg');?>" height="200px" width="100%">
                    <div class="container-fluid">
                        <a class="navbar-brand" style="margin-left: 350px" href="<?php echo site_url('login'); ?>">Selamat Datang Di Perpustakaan Online JTI</a>
                    </nav>
                </div>
            <div>
                 <img width="400px" height="400px" src="<?php echo base_url('assets//img/admin.png');?>" class="img-responsive" alt="Image">          </div>

                <div id="loginbox" style="margin-top:-370px; margin-left: 500px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
                    <div class="panel panel-info" >
                            <div class="panel-heading">
                                <div class="panel-title">Sign In</div>
                                <div style="float:right; font-size: 12px; position: relative; top:-20px"><a href="<?php echo site_url('Lupa_password') ?>">Forgot password?</a></div>
                            </div>     
        
                            <div style="padding-top:30px" class="panel-body" >
        
                                <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                                    
                               
                                <?php echo form_open_multipart('login/cekLogin'); ?>

                               <?php if ($this->session->flashdata('sudah_input')) {
                                   ?><div class="alert alert-success">
                                    <strong><?php echo $this->session->flashdata('sudah_input');?></strong></div>
                                <?php
                                }else if($this->session->flashdata('sukses')) {   
                                 
                                 ?><div class="alert alert-success">
                                    <strong><?php echo $this->session->flashdata('sukses');?></strong></div>
                                    <?php
                                }else if($this->session->flashdata('cekemail')) {    
                                 ?><div class="alert alert-success">
                                    <strong><?php echo $this->session->flashdata('cekemail');?></strong></div>
                                    <?php
                                }else if (validation_errors()) {
                                   ?><div class="alert alert-danger">
                                    <strong><?php echo validation_errors(); ?></div></strong><?php
                                }else if ($this->session->flashdata('login_lagi')) {
                                   ?><div class="alert alert-danger">
                                    <strong><?php echo $this->session->flashdata('login_lagi'); ?></strong></div><?php
                                } ?>
                                
                               
                                    <div style="margin-bottom: 25px" class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                                <input id="username" type="text" class="form-control" name="username" value="<?php echo set_value('username') ?>" placeholder="Username">                                        
                                            </div>
                                        
                                    <div style="margin-bottom: 25px" class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                                <input id="password" type="password" class="form-control" name="password" value="<?php echo set_value('password') ?>" placeholder="Password">
                                            </div>

                                        <div style="margin-top:10px" class="form-group">
                                            <!-- Button -->
        
                                            <div class="col-sm-12 controls">
                                             <button type="submit" class="btn btn-success">Sign In</button>
                                            </div>
                                            <?php echo form_close(); ?>
                                        </div> 
        
                                                                                <div class="form-group">
                                            <div class="col-md-12 control">
                                                <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%; margin-top: 20px" >
                                                    Belum menjadi member? 
                                                    <a style="margin-left: 20px" class="btn btn-primary" href="<?php echo site_url('registrasi') ?>" role="button">Daftar Sekarang</a>
    
                                                </div>
                                            </div>
                                        </div>  
                                    </div>
                                </div>
                            </div>   
                        </div>                     
                    </div>  
                </div>
            </div>
    
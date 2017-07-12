<div class="container" style="margin-top: -50px" >
    <div>
        <nav class="navbar navbar-inverse">
            <img src="<?php echo base_url('assets/img/wew.jpg');?>" height="200px" width="100%">
            <div class="container-fluid">
            <a class="navbar-brand" style="margin-left: 350px" href="<?php echo site_url('login'); ?>">Selamat Datang Di Perpustakaan Online JTI</a>
        </nav>
    </div>
            
        <div>
            <img width="400px" height="400px" src="<?php echo base_url('assets//img/admin.png');?>" class="img-responsive" alt="Image">          
        </div>
        <div id="loginbox" style="margin-top:-370px; margin-left: 500px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
            <div class="panel panel-success" >
                            <div class="panel-heading">
                                <div style="text-indent: 90px  " class="panel-title" style="margin-left: 20px; margin-top: 10px"><i class="glyphicon glyphicon-lock"></i> Lupa Password</div></div>
                                <div style="text-indent: 20px" class="alert alert-info">Untuk melakukan reset password, silakan masukkan alamat email anda.</div>
                            <div style="padding-top:30px" class="panel-body" >

        
                                <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                                <?php echo form_open('lupa_password');?>   
                               
                                <?php 
                               if($this->session->flashdata('sukses')) {   
                                 
                                 ?><div style="margin-top: -30px" class="alert alert-danger">
                                    <strong><?php echo $this->session->flashdata('sukses');?></div>
                                    <?php
                               }  
                               ?>


                               <?php if (validation_errors()) {
                                   ?><div style="margin-top: -30px" class="alert alert-danger">
                                    <strong><?php echo validation_errors(); ?></div><?php
                               } ?>
                                
                                    
                                    <div style="margin-bottom: 25px;margin-top: -0px" class="input-group">
                                                <span class="input-group-addon"><i>@</i></span>
                                                <input id="email" type="text" class="form-control" name="email" value="<?php echo set_value('email') ?>" placeholder="Masukkan Email">
                                            </div>
                                        
                                        <div style="margin-top:10px" class="form-group">
                                            <!-- Button -->
        
                                            <div class="col-sm-12 controls">
                                             <button style="width: 200px; margin-left: 130px" type="submit" class="btn btn-success">Kirim</button>
                                            </div>
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
    
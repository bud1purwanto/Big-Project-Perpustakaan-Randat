<div id="wrapper">
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 style="background-color: #222222; border-radius: 5px;" align="left" class="page-header">
                            <span class="label label-default" style="background-color: #222222;"> Dashboard <?php $this->session->flashdata('sukses'); ?></span>
                            <?php if ($status=="admin"): ?>
                                <a id="myBtn" style="float: right;font-size: 24.5px; font-family: Arial" class="btn btn-default" role="button">
                            <i class="fa fa-camera"></i> </a>
                            <?php endif ?>
                        </h1>
                        
                        <!-- <ol class="breadcrumb" style="background-color: white">
                            <li >
                                <button class="slideshowButton" onclick="plusDivs(-1)">&#10094;</button>
                                <font style="margin-left: 210px; font-family: Comic; font-size: 20px">
                                <i class="fa fa-camera"></i> Galeri</font>
                                <button style="margin-left: 200px;" class="slideshowButton" onclick="plusDivs(+1)">&#10095;</button>
                            </li>
                            <li style="font-size: 20px">
                                <i style="margin-left: 120px;" class="fa fa-dashboard"></i> Visitor 
                            </li>
                        </ol> -->
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <?php if ($this->session->flashdata('gagal')) {
                                   ?><div  id="myModal" class="modal" style="display: block;"><?php 
                                }else{
                                    ?><div  id="myModal" class="modal"><?php
                                }?>
                        
                                  <div style="margin-top: 100px; margin-left: 300px; width: 70%" class="modal-content">
                                    <div class="modal-header" style="background-color: #1abc9c">
                                      <span class="close">&times;</span>
                                      <h2>Add Galeri Foto <i class="glyphicon glyphicon-camera"></i></h2>
                                    </div>
                                    <div class="modal-body">
                                      <div style="margin-top: 10px" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <div class="table-responsive">
                                        <?php echo form_open_multipart('dashboard/galeri'); ?>
                                        <?php if ($this->session->flashdata('gagal')) {
                                                   ?><div style="margin-top: 10px" class="alert alert-danger">
                                                    <strong><?php echo $this->session->flashdata('gagal');; ?></strong></div><?php 
                                        } ?>

                                        
                                        <div style="margin-top: " class="form-group">
                                            <label>Pilih Foto</label>
                                            <input class="form-control" id="userfile" type="file" name="userfile">
                                        </div>
                                        <button style="height: 40px; width: 160px; margin-left: 310px;margin-top: 0px; background-color: #1abc9c" type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i> Add</button>
                                        <?php echo form_close(); ?>
                                       
                                        </div>
                                        <br>
                                 
                                    </div>
                                    </div>
                                    <div class="modal-footer">
                            
                                    </div>
                                  </div>

                                </div>
                        </div>

                <div class="row">
                    <div class="col-lg-6">
                    
                    
                     <?php foreach ($galeri as $key) { ?>
                        <?php if ($status=="admin"): ?>
                        <a href="<?php echo site_url('dashboard/listGaleri') ?>">
                        <?php endif ?>
                        
                        <img style="margin-left: 10px; border-radius: 10px; " width="600px" height="400px" class="mySlides" src="<?=base_url()?>assets/uploads/Galeri/<?=$key->foto?>">
                        </a>
                    <?php } ?>

                    </div>
                    </div>  
                    </div>


                    <div class="col-lg-4" style="margin-top: -390px; margin-left: 650px">
                            
                        <div align="center">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="text-center">
                                        <div class="huge"><?php echo $hariIni ?></div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                    <span align="center">Pengunjung Hari Ini</span>
                                </div>
                            </a>
                    </div>
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="text-center">
                                        <div class="huge"><?php echo $totalPengunjung ?></div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                    <span align="center">Total Pengunjung</span>
                                </div>
                            </a>
                    </div>
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="text-center">
                                        <div class="huge"><?php echo $onLine ?></div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                    <span align="center">Pengunjung Online</span>
                                </div>
                            </a>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
  
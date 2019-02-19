<div id="wrapper">
    <div id="page-wrapper">
        <div class="container-fluid">
        <div class="row">
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            <span class="label label-primary" style="background-color: #1abc9c">Daftar Kategori</span> <?php if ($status=="admin"):?> <a id="myBtn" class="btn btn-success" role="button"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Tambah <?php endif ?></a>
                        </h1>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                                <?php if (validation_errors() || $this->session->flashdata('gagal')) {
                                   ?><div  id="myModal" class="modal" style="display: block;"><?php 
                                }else if($this->session->flashdata('error')){
                                    ?><div  id="myModal" class="modal" style="display: block;"><?php
                                }else{
                                    ?><div  id="myModal" class="modal"><?php
                                }?>
                            
                                <div style="margin-top: 100px; margin-left: 300px; width: 70%" class="modal-content">
                                    <div class="modal-header" style="background-color: #1abc9c">
                                        <span class="close">&times;</span>
                                        <h2>Kategori <i class="glyphicon glyphicon-tasks"></i></h2>
                                    </div>
                                    <div class="modal-body">
                                        <div style="margin-top: 10px" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <div class="table-responsive">
                                        <?php echo form_open_multipart('kategori/create'); ?>
                                        <?php if (validation_errors()) {
                                                   ?><div style="margin-top: 20px" class="alert alert-danger">
                                                    <strong><?php echo validation_errors(); ?></strong></div><?php } 
                                                else if ($this->session->flashdata('gagal')) {
                                                   ?><div style="margin-top: 20px" class="alert alert-danger">
                                                    <strong><?php echo $this->session->flashdata('gagal');; ?></strong></div><?php }?>

                                        
                                        <div style="margin-top: " class="form-group">
                                            <label>Nama Kategori</label>
                                            <input class="form-control" id="nama_kategori" type="text" name="nama_kategori" value="<?php echo set_value('nama_kategori') ?>" placeholder="Nama Kategori">
                                        </div>
                                        <button style="height: 40px; width: 160px; margin-left: 310px;margin-top: 0px; background-color: #1abc9c" type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-edit"></i> Input Kategori</button>
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
                                <i class="fa fa-tags"></i> Kategori
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

                           <!--  <input style="margin-top: -0px; width: 915px;" id="myInput" onkeyup="myFunction()" type="text" placeholder="Pencarian Berdasarkan Nama Kategori"  class="form-control" required="required" ><br>
 -->
                            <table class="table table-striped table-bordered table-hover" id="example">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Kategori</th>
                                        <?php if ($status=="admin") {
                                            ?>
                                            <th width="13%">Action</th>
                                            <?php
                                        } else {
                                            ?>
                                            <th width="5%">Buku</th>
                                            <?php
                                        }   
                                         ?>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $no=0; foreach ($kategori_list as $key) { 
                                    $no++; ?>
                                    <tr>
                                        <td><?php echo $no ?></td>
                                        <td><?php echo $key->nama_kategori ?></td>
                                        <?php if ($status=="admin"): ?>
                                            <td>
                                            <a href="<?php echo site_url('kategori/edit/').$key->id_kategori ?>" type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil " aria-hidden="true"></span></a>
                                            <a href="<?php echo site_url('kategori/delete/').$key->id_kategori ?>" type="button" class="btn btn-danger" onClick="JavaScript: return confirm('Anda yakin Hapus data ini ?')"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                                        </td> 
                                        <?php else: ?>
                                            <td>
                                            <a href="<?php echo site_url('buku/daftarBuku/').$key->id_kategori ?>" type="button" class="btn btn-primary"><span class="glyphicon glyphicon-book " aria-hidden="true"></span></a>
                                            
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
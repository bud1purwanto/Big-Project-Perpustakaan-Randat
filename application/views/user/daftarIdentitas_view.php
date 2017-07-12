<div id="wrapper">
    <div id="page-wrapper">
        <div class="container-fluid">
        <div class="row">
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            <span class="label label-success">Nomor Identitas</span> <a id="myBtn" class="btn btn-primary" role="button"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Tambah</a>
                        </h1> 

                        <ol class="breadcrumb">

                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="<?php echo site_url('dashboard') ?>">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-github"></i> Nomor Identitas
                            </li>
                        </ol>
                    </div>
                </div>
                 <?php if ($this->session->flashdata('terdaftar')) {
                                   ?><div class="alert alert-danger">
                                    <strong><?php echo $this->session->flashdata('terdaftar');?></strong></div>
                                <?php 
                               } ?>
                                <?php if ($this->session->flashdata('terhapus')) {
                                   ?><div class="alert alert-success">
                                    <strong><?php echo $this->session->flashdata('terhapus');?></strong></div>
                                <?php 
                               } ?>
                <div class="row">
                    <div class="col-lg-6">

                        <?php if (validation_errors()) {
                                   ?><div  id="myModal" class="modal" style="display: block;"><?php 
                                }else if($this->session->flashdata('error')){
                                    ?><div  id="myModal" class="modal" style="display: block;"><?php
                                }else{
                                    ?><div  id="myModal" class="modal"><?php
                                }?>
                                

                                  <!-- Modal content -->
                                  <div style="margin-top: 100px; margin-left: 300px; width: 70%" class="modal-content">
                                    <div class="modal-header" style="background-color: #5cb85c">
                                      <span class="close">&times;</span>
                                      <h2>Tambah Nomor Identitas <i class="glyphicon glyphicon-flag"></i></h2>
                                    </div>
                                    <div class="modal-body">
                                      <div style="margin-top: 10px" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <div class="table-responsive">
                                        <?php echo form_open_multipart('user/addNoIdentitas'); ?>
                                        <?php if (validation_errors()) {
                                                   ?><div style="margin-top: 20px" class="alert alert-danger">
                                                    <strong><?php echo validation_errors(); ?></div></strong><?php } ?>
                                        <?php if ($this->session->flashdata('error')) {
                                               ?><div style="margin-top: 20px" class="alert alert-warning">
                                                <strong><?php echo $this->session->flashdata('error');?></strong></div>
                                                <?php } ?>       
                                  
                                        <div style="margin-top: " class="form-group">
                                            <label>Nomor Identitas</label>
                                            <input class="form-control" id="no_identitas" type="number" name="no_identitas" value="<?php echo set_value('no_identitas') ?>" placeholder="Nomor Identitas (NIP/NIM)">
                                        </div>

                                        <div style="margin-top: " class="form-group">
                                            <label>Jenis Identitas</label>
                                            <select id="jenis" type="text" class="form-control" name="jenis" >
                                                <option disabled selected style='display:none; color:lightgray;'>Pilih Identitas</option>
                                                     <option value="nip">NIP</option>
                                                     <option value="nim">NIM</option>
                                                </select>
                                        </div>
                                        <button style="height: 40px; width: 160px; margin-left: 330px;margin-top: -0px" type="submit" class="btn btn-success" style="background-color: red"><i class="glyphicon glyphicon-edit"></i> Tambah</button>
                                        <hr>
                                        <?php echo form_close(); ?>
                                       
                                        </div>
                                    </div>
                                    </div>
                                
                                    <div class="modal-footer">
                            
                                    </div>
                                  </div>

                                </div>
         

                      <span class="label label-default" style="font-size: 30px">NIP</span><input style="margin-top: -30px; width: 367px; margin-left: 93px" id="myInput" onkeyup="myFunction()" type="number" placeholder="Pencarian NIP"  class="form-control" required="required" >
     
                    
                     <div class="table-responsive" style="margin-top: 20px">
                            <table class="table table-bordered table-hover" id="myTable">
                                <thead>
                                    <tr>
                                        <th >Status</th>
                                        <th >NIP</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($nip_list as $key) { ?>
                                    <tr>
                                        <?php if (!$key->nama) {
                                        ?><td width="430px">Belum Daftar</td><?php
                                    } else {
                                         ?><td width="430px"><?php echo $key->nama ?> (Terdaftar)</td><?php
                                    }
                                     ?>
                                        
                                        <td width="430px"><?php echo $key->no_identitas ?></td>
                                        <td>
                                            <a href="<?php echo site_url('user/deleteNOID/').$key->no_identitas ?>" type="button" class="btn btn-danger" onClick="JavaScript: return confirm('Anda yakin Hapus data ini ?')"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <div class="col-lg-6">
                        <span class="label label-default" style="font-size: 30px">NIM</span><input style="margin-top: -30px; width: 360px; margin-left: 100px" id="myInput2" onkeyup="myFunction2()" type="number" placeholder="Pencarian NIM"  class="form-control" required="required" >
                       <div class="table-responsive" style="margin-top: 20px">
                            <table class="table table-bordered table-hover" id="myTable2">
                                <thead>
                                    <tr>
                                        <th >Status</th>
                                        <th >NIM</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($nim_list as $key) { ?>
                                    <tr>
                                    <?php if (!$key->nama) {
                                        ?><td width="430px">Belum Daftar</td><?php
                                    } else {
                                         ?><td width="430px"><?php echo $key->nama ?> (Terdaftar)</td><?php
                                    }
                                     ?>
                                        
                                        <td width="430px"><?php echo $key->no_identitas ?></td>
                                        <td>
                                            <a href="<?php echo site_url('user/deleteNOID/').$key->no_identitas ?>" type="button" class="btn btn-danger" onClick="JavaScript: return confirm('Anda yakin Hapus data ini ?')"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                                        </td>
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
</div>
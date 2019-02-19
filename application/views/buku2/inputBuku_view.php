<div id="wrapper">
    <div id="page-wrapper">
        <div class="container-fluid">
        <div class="row">
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            <span class="label label-primary">Daftar Buku</span> <?php if ($status=="admin"): ?><a href="<?php echo site_url('buku/create'); ?>" class="btn btn-success" role="button"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> 
                                Tambah
                            <?php endif ?></a>
                             </h1>
                            
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <!-- The Modal -->

                                <?php if (validation_errors()) {
                                   ?><div  id="myModal" class="modal" style="display: block;"><?php 
                                }else if($this->session->flashdata('error')){
                                    ?><div  id="myModal" class="modal" style="display: block;"><?php
                                }else{
                                    ?><div  id="myModal" class="modal" style="display: block;"><?php
                                }?>
                                

                                  <!-- Modal content -->
                                  <div style="margin-top: 80px; margin-left: 300px; width: 70%" class="modal-content">
                                    <div class="modal-header" style="background-color: #337ab7">
                                      <h2>Input Buku <i class="glyphicon glyphicon-book"></i></h2>
                                    </div>
                                    <div class="modal-body">
                                      <div style="margin-top: 10px" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <div class="table-responsive">
                                        <?php echo form_open_multipart('buku/create'); ?>
                                        <?php if (validation_errors()) {
                                                   ?><div style="margin-top: 20px" class="alert alert-danger">
                                                    <strong><?php echo validation_errors(); ?></strong></div><?php } ?>
                                        <?php if ($this->session->flashdata('error')) {
                                               ?><div style="margin-top: 20px" class="alert alert-warning">
                                                <strong><?php echo $this->session->flashdata('error');?></strong></div>
                                                <?php } ?>       
                                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                        <div style="margin-top: " class="form-group">
                                                <label>ID Buku</label>
                                                <input class="form-control" id="id_buku" type="text" name="id_buku" value="<?php echo set_value('id_buku') ?>" placeholder="ID Buku">
                                            </div>
                                            <div class="form-group" style="margin-top: -0px; margin-left: ">
                                                <label>Cover Buku</label>
                                                <input style="width:" class="form-control" type="file" name="userfile" id="files">
                                            </div>
                                            <div style="margin-top: " class="form-group">
                                                <label>Judul Buku</label>
                                                <input class="form-control" id="judul" type="text" name="judul" value="<?php echo set_value('judul') ?>" placeholder="Judul Buku">
                                             </div>  
                                            <div style="margin-top: " class="form-group">
                                              
                                            <label>Nama Pengarang</label>
                                            <select id="required" multiple="true" name='id_pengarang[]' data-placeholder="Pilih Pengarang">
                                            <?php foreach ($pengarang_list as $key) { ?>
                                                 <?php echo "<option value='".$key->id_pengarang."'>".$key->nama_pengarang."</option>" ?>
                                            <?php } ?>
                                            </select>
                                            </div>
                                        </div>

                                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                        <div style="margin-top: " class="form-group">
                                                <label>Nama Penerbit</label>
                                                <?php 
                                                echo "<select class='form-control' name='id_penerbit' id='optional' data-placeholder='Pilih Penerbit'>";
                                                 ?><option disabled selected style='display:none; color:lightgray;'>Nama Penerbit</option><?php
                                                 foreach ($penerbit_list as $key) {
                                                    echo "<option value='".$key->id_penerbit."'>".$key->nama_penerbit."</option>";
                                                 }
                                                echo "</select>"; 
                                                ?>
                                            </div>
                                            <div style="margin-top: " class="form-group">
                                            <label>Tahun Terbit</label>
                                            <select class="form-control" id="tahun_terbit" type="text" name="tahun_terbit">
                                                <?php for ($i=1990; $i <= date("Y") ; $i++) { 
                                                    ?>
                                                    <option><?php echo $i ?></option>
                                                <?php } ?>
                                                
                                            </select>
                                        </div>
                                        <div style="margin-top: " class="form-group">
                                            <label>Pilih Kategori</label>
                                            <?php 
                                                echo "<select class='form-control' name='id_kategori' id='optional2' data-placeholder='Pilih Kategori'>";
                                                 ?><option disabled selected style='display:none; color:lightgray;'>Nama Kategori</option><<?php
                                                 foreach ($kategori_list as $key) {
                                                    echo "<option value='".$key->id_kategori."'>".$key->nama_kategori."</option>";
                                                 }
                                                echo "</select>"; 

                                                ?>
                                        
                                       </div> 
                                         <label>Stok Buku</label>
                                        <div style="margin-top: " class="form-group">
                                            <input class="form-control" id="stok" type="number" name="stok" value="<?php echo set_value('stok') ?>" placeholder="Stok Buku">
                                        </div>
                                        </div>
                                       
                                            <button style="height: 40px; width: 160px; margin-left: 20px;margin-top: 10px" type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-edit"></i> Input Buku</button><br><hr>
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
                        
                        <div style="float: right;">
                                <label>Kategori :</label>
                                <select class="" name="hari" onChange="window.location.href=this.value">
                                    <option disabled selected style='display:none; color:lightgray;'>Pilih Kategori</option>
                                    <option value="<?php echo site_url('buku'); ?>">Semua Kategori</option>
                                    <?php foreach ($kategori_list as $key) { ?>
                                        <option value="<?php echo site_url('buku/daftarBuku/').$key->id_kategori ?>"><?php echo $key->nama_kategori ?></option>
                                    <?php } ?>
                            </select>
                            </div>
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="<?php echo site_url('dashboard') ?>">Dashboard</a>
                            </li>
                            <li class="">
                                <i class="fa fa-book"></i> Buku
                            </li>
                            <li class="active">
                                <i class="fa fa-tags"></i> Semua Kategori
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

                               } else if ($this->session->flashdata('terhapus')) {
                                   ?><div class="alert alert-success">
                                    <strong><?php echo $this->session->flashdata('terhapus');?></strong></div>
                                <?php 
                               } 
                               else if ($this->session->flashdata('gagal')) {
                                   ?><div class="alert alert-danger">
                                    <strong><?php echo $this->session->flashdata('gagal');?></strong></div>
                                <?php 
                               }?>

                            <table class="table table-bordered table-hover" id="example">
                                <thead>
                                    <tr>
                                    <?php if ($status=="admin"): ?>
                                        <th>Action</th>
                                    <?php endif ?>
                                        <th>ID</th>
                                        <th>Cover</th>
                                        <th>Judul</th>
                                        <th>Nama Pengarang</th>
                                        <th>Nama Penerbit</th>
                                        <th>Terbit</th>
                                        <th>Nama Kategori</th>
                                        <th>Stok</th>                                       
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($buku_list as $key) { ?>
                                    <tr>
                                    <?php if ($status=="admin"): ?>
                                        <td>
                                            <div class="btn-group">
                                            <a class="btn btn-default" data-toggle="dropdown"><i class="fa fa-book"></i></a>
                                            <a class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                            <span class="fa fa-caret-down" title="Toggle dropdown menu"></span>
                                            </a>
                                                <ul class="dropdown-menu">
                                                    <li><a href="<?php echo site_url('buku/edit/').$key->id_buku ?>"><i class="fa fa-pencil fa-fw"></i> Edit</a></li>
                                                    <li><a href="<?php echo site_url('buku/delete/').$key->id_buku ?>" onClick="JavaScript: return confirm('Anda yakin Hapus data ini ?')" ><i class="fa fa-trash-o fa-fw"></i> Delete</a></li>
                                                </ul>
                                            </div> 
                                        </td> <?php endif ?>
                                        <td><?php echo $key->id_buku ?></td>
                                        <td><img width="80" height="80" src="<?=base_url()?>assets/uploads/Buku/<?=$key->cover?>"></td>
                                        <td><?php echo $key->judul ?></td>
                                        <td><?php echo $key->nama_pengarang ?></td>
                                        <td><?php echo $key->nama_penerbit ?></td>
                                        <td><?php echo $key->tahun_terbit ?></td>
                                        <td><?php echo $key->nama_kategori ?></td>
                                        <td><?php echo $key->stok; ?></td> <?php } 
                                         ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                 </div>
            </div>
        </div>
    </div>
                                
<div id="wrapper">
    <div id="page-wrapper">
        <div class="container-fluid">
        <div class="row">
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header"><?php foreach ($buku_list as $key) {
                        ?>
                           <span class="label label-primary" style="background-color: #1abc9c">Edit Buku</span> <b> <span class="label label-primary"><?php echo $key->judul; ?></span></b>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="<?php echo site_url('dashboard') ?>">Dashboard</a>
                            </li>
                            <li>
                                <i class="fa fa-book"></i> <a href="<?php echo site_url('buku') ?>"> Buku</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-edit"></i> Edit Buku
                            </li>
                        </ol>
                    </div>
                </div>
           
               <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
               <div class="panel panel-default">
                        <div class="panel-heading">
                            Data Buku
                        </div>
                        <div class="panel-body">
                <?php echo form_open_multipart('buku/edit/'.$this->uri->segment(3)); ?>
                    <?php if (validation_errors()) {
                        ?><div style="margin-top: 0px" class="alert alert-danger">
                              <strong><?php echo validation_errors(); ?></strong></div><?php } ?>
                        <div class="table-responsive">
                  
                            <div class="row">
                    <div class="col-lg-6">
                            </li>
                            <img style="margin-top: 1px" src="<?=base_url()?>assets/uploads/Buku/<?=$key->cover?>"" width="150px" height="165px" >
                            <li class="dropdown">
                            <div class="form-group" style="margin-top: -150px; margin-left: 170px">
                                <label>Edit Cover</label>
                                <input style="width:253px" class="form-control" type="file" name="userfile" id="userfile" value="<?php echo $key->cover; ?>">
                                <p class="help-block">** Maksimal File 1 MB</p>
                            </div>
                            
                            <div style="margin-top: 60px" class="form-group">
                                <label>ID Buku</label>
                                <input class="form-control" id="id_buku" type="text" name="id_buku" value="<?php echo $key->id_buku; ?>" placeholder="ID Buku">
                            </div>
                            <div style="margin-top: 0px" class="form-group">
                                <label>Judul Buku</label>
                                <input class="form-control" id="judul" type="text" name="judul" value="<?php echo $key->judul; ?>" placeholder="Judul Buku">
                            </div>
                            <div style="margin-top: " class="form-group">
                                    <label>Nama Pengarang</label>
                                            <select id="required" multiple="true" name='id_pengarang[]' data-placeholder="Pilih Pengarang" disabled>
                                                 <?php echo "<option selected value='".$key->id_pengarang."'>".$key->nama_pengarang."</option>" ?>
                                            </select>
                                    </div>

                            </div>
                            <div class="col-lg-6" style="margin-top: -0px">
                            
                            <div style="margin-top: " class="form-group">
                                        <label>Nama Penerbit</label>
                                        <?php 
                                        echo "<select class='form-control' name='id_penerbit' id='optional' data-placeholder='Pilih Penerbit'>";
                                         ?>
                                         <?php
                                        foreach ($buku_list as $key) {
                                            echo "<option selected style='display:none' value='".$key->id_penerbit."'>".$key->nama_penerbit."</option>";
                                                 }
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
                                            <?php foreach ($buku_list as $key) {
                                            echo "<option selected style='display:none'>".$key->tahun_terbit."</option>";
                                                 } ?>
                                            <option><?php echo $i ?></option>
                                            <?php } ?>                                
                                        </select>
                                        </div>
                                        <div style="margin-top: " class="form-group">
                                            <label>Pilih Kategori</label>
                                            <?php 
                                                echo "<select class='form-control' name='id_kategori' id='optional2' data-placeholder='Pilih Kategori'>";
                                                 ?>
                                                
                                                <?php
                                                foreach ($buku_list as $key) {
                                                    echo "<option selected style='display:none' value='".$key->id_kategori."'>".$key->nama_kategori."</option>";
                                                 }
                                                foreach ($kategori_list as $key) {
                                                    echo "<option value='".$key->id_kategori."'>".$key->nama_kategori."</option>";
                                                 }
                                                echo "</select>"; 
                                                ?>
                                        </div>
                                        <div style="margin-top: 0px" class="form-group">
                                        <label>Stok Buku</label>
                                        <input class="form-control" id="stok" type="text" name="stok" value="<?php foreach ($buku_list as $key) {
                                            echo $key->stok;
                                        } ?>" placeholder="ID Buku">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button style="margin-left: 190px" type="submit" class="btn btn-success"><i class="glyphicon glyphicon-pencil"></i>  Edit Buku</button>
                                    
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

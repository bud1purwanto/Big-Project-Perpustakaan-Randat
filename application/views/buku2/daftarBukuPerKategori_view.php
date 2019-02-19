<div id="wrapper">
    <div id="page-wrapper">
        <div class="container-fluid">
        <div class="row">
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            <span class="label label-primary">Daftar Buku <?php foreach ($get_kategori as $key) {
                                echo $key->nama_kategori;
                            } ?></span> <?php if ($status=="admin"): ?> <a id="myBtn" class="btn btn-success" role="button"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Tambah <?php endif ?></a>
                             </h1>
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
                                <i class="fa fa-tags"></i> <?php foreach ($get_kategori as $key) {
                                echo $key->nama_kategori;
                            } ?> 
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
                               } ?>
                            <table class="table table-bordered table-hover" id="example">
                                <thead>
                                    <tr>
                                        <?php if ($status=="admin"): ?>
                                        <th width="11%">Action</th>
                                    <?php endif ?>
                                        <th>ID</th>
                                        <th>Cover</th>
                                        <th width="20%">Judul</th>
                                        <th>Pengarang</th>
                                        <th>Penerbit</th>
                                        <th>Terbit</th>
                                        <th>Kategori</th>
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
                                        <td><?php echo $key->stok;?></td> <?php } ?>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

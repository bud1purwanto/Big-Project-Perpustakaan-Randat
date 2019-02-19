<div id="wrapper">
    <div id="page-wrapper">
        <div class="container-fluid">
        <div class="row">
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            <span class="label label-primary" style="background-color: #1abc9c">Daftar Pengarang Buku</span> 
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="<?php echo site_url('dashboard') ?>">Dashboard</a>
                            </li>
                            <li class="">
                                <i class="fa fa-laptop"></i> Pengarang Buku
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
                            <table class="table table-striped table-bordered table-hover" id="example">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Judul Buku</th>
                                        <th>Nama Pengarang</th>
                                         <th width="7%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $no=0; foreach ($buku_pengarang as $key) { 
                                    $no++; ?>
                                    <tr>
                                        <td><?php echo $no ?></td>
                                        <td><?php echo $key->judul ?></td>
                                        <td><?php echo $key->nama_pengarang ?></td>
                                        <td>
                                        <a href="<?php echo site_url('Buku_Pengarang/delete/').$key->id ?>" type="button" class="btn btn-danger" onClick="JavaScript: return confirm('Anda yakin Hapus data ini ?')"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
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

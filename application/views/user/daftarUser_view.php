<div id="wrapper">
    <div id="page-wrapper">
        <div class="container-fluid">
        <div class="row">
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            <span class="label label-default">Daftar Member</span> <a class="btn btn-success" href="<?php echo site_url('user/createUser') ?>" role="button"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Tambah</a>
                        </h1>
                        <ol class="breadcrumb">

                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="<?php echo site_url('dashboard') ?>">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-fw fa-user"></i> User
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
                               } else if ($this->session->flashdata('gagal')) {
                                   ?><div class="alert alert-danger">
                                    <strong><?php echo $this->session->flashdata('gagal');?></strong></div>
                                <?php 
                               } ?>

                            <table class="table table-bordered table-hover" id="example">
                                <thead>
                                    <tr>
                                        <th>Nama Lengkap</th>
                                        <th>Foto Profil</th>
                                        <th>Nomor Identitas</th>
                                        <th>Username</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($user_list as $key) { ?>
                                    <tr>
                                        <td><?php echo $key->nama ?></td>
                                        <td><img width="80" height="80" src="<?=base_url()?>assets/uploads/Profil/<?=$key->foto?>"></td>
                                        <td><?php echo $key->no_identitas ?></td>
                                        <td><?php echo $key->username ?></td>
                                        <td><?php echo $key->jenis_kelamin ?></td>
                               
                                        <td style="width: 130px">
                                            <a href="<?php echo site_url('user/userDetail/').$key->id_user ?>" type="button" class="btn btn-info"><span class="glyphicon glyphicon-folder-open    " aria-hidden="true"></span></a>
                                            <a href="<?php echo site_url('user/editUser/').$key->id_user ?>" type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil" ></span></a>
                                            <a href="<?php echo site_url('user/deleteUser/').$key->id_user ?>" type="button" class="btn btn-danger" onClick="JavaScript: return confirm('Anda yakin Hapus data ini ?')"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
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
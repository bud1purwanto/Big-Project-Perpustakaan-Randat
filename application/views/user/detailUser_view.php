<div id="wrapper">
    <div id="page-wrapper">
        <div class="container-fluid">
        <div class="row">
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header"><?php foreach ($user_detail as $key) {
                        ?>
                            <span class="label label-primary">Detail Member</span> <b><span class="glyphicon glyphicon-knight"></span> <span class="label label-primary"><?php echo $key->nama; ?></span></b>
                        </h1>
                        <ol class="breadcrumb">

                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="<?php echo site_url('dashboard') ?>">Dashboard</a>
                            </li>
                            <li>
                                <i class="fa fa-fw fa-user"></i> <a href="<?php echo site_url('user/user') ?>">User</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-edit"></i> Detail User
                            </li>
                        </ol>
                    </div>
                </div>
           
                   <?php } ?>
               <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="table-responsive">
                            <div class="panel panel-primary">
                                <div class="panel-heading" style="text-align: center">Data Lengkap Member</div>
                                <table class="table" style="text-indent: 10px;">
                                    <tbody><?php foreach ($user_detail as $key) { ?>
                                        <tr>
                                            <td>ID Member</td>
                                            <th><?php echo $key->id_user ?></th>
                                        </tr>
                                        <tr>
                                            <td>Foto Profil</td>
                                            <th><img width="180" height="180" src="<?=base_url()?>assets/uploads/Profil/<?=$key->foto?>"></th>
                                        </tr>
                                        <tr>
                                            <td>Nama Lengkap</td>
                                            <th><?php echo $key->nama ?></th>
                                        </tr>
                                        <tr>
                                            <td>Nomor Induk Mahasiswa</td>
                                            <th><?php echo $key->no_identitas ?></th>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <th><?php echo $key->email ?></th>
                                        </tr>
                                        <tr>
                                            <td>Nomor HP</td>
                                            <th><?php echo $key->no_hp ?></th>
                                        </tr>
                                        <tr>
                                            <td>Username</td>
                                            <th><?php echo $key->username ?></th>
                                        </tr>
                                        <tr>
                                            <td>Jenis Kelamin</td>
                                            <th><?php echo $key->jenis_kelamin ?></th>
                                        </tr>
                                        <tr>
                                            <td>Alamat</td>
                                            <th><?php echo $key->alamat ?></th>
                                        </tr>
                                        <tr>
                                            <td>Status</td>
                                            <th style="text-transform: capitalize;"><?php echo $key->status ?></th>
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
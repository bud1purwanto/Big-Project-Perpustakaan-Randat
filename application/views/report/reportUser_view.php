<div id="wrapper">
    <div id="page-wrapper">
        <div class="container-fluid">
        <div class="row">
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                           <span class="label label-success">Daftar Keluhan <?php if ($status=="admin"): ?>
                               User
                           <?php else: ?>
                               Anda
                           <?php endif ?></span>
                        </h1>
                        <ol class="breadcrumb">

                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="<?php echo site_url('dashboard') ?>">Dashboard</a>
                            </li>
                            <li class="">
                                <i class="fa fa-bullhorn"></i> Report
                            </li>
                        </ol>
                    </div>
                </div>

               
        <div class="panel-body">
        <?php if ($status=="user"): ?>
            <img style="float: right;margin-top: -50px;" width="250" height="250" src="<?php echo base_url('') ?>assets/img/report.png" alt="report" class="img-rounded">
        <?php endif ?>
        <?php if ($status=="admin"): ?>
            <div class="col-md-12">
        <?php else: ?>
            <div class="col-md-8">
        <?php endif ?>
        <?php if ($this->session->flashdata('report')): ?>
            <div class="alert alert-success"><strong><?php echo $this->session->flashdata('report');; ?></strong></div>
        <?php endif ?>
        <table class="table table-bordered table-hover" style="float: right;" id="example">
            <thead>
                <tr>
                <?php if ($status=="admin"): ?>
                    <th width="15%">No Identitas</th>
                    <th>Nama</th>
                <?php endif ?>
                    <th width="10%">Tema</th>
                    <th width="70%">Isi</th>
                    <th width="30%">Tanggal</th>
                    <th width="8%">Action</th>
                </tr>
            </thead>
            <tbody><?php foreach ($report_list as $key) { ?>
                <tr>
                    <?php if ($status=="admin"): ?>
                        <td><?php echo $key->no_identitas; ?></td>
                        <td><?php echo $key->nama; ?></td>
                    <?php endif ?>
                    <td><?php echo $key->subjek ?></td>
                    <td><?php echo $key->isi ?></td>
                    <td><?php $newDate = date("d/m/Y", strtotime($key->tanggal)); echo $newDate  ?></td>
                    <td><a href="<?php echo site_url('report/deleteUserReport/').$key->id_report ?>" type="button" class="btn btn-danger" onClick="JavaScript: return confirm('Anda yakin Hapus data ini ?')"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a></td>
                
                </tr>
            </tbody>    
            <?php } ?>
        </table>
    </div>
</div>
</div>
</div>

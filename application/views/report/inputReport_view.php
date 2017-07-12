<div id="wrapper">
    <div id="page-wrapper">
        <div class="container-fluid">
        <div class="row">
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            <span class="label label-success">Silahkan Tinggalkan Saran / Kritik</span>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="<?php echo site_url('dashboard') ?>">Dashboard</a>
                            </li>
                            <li>
                                <i class="fa fa-bullhorn"></i> Add Report
                            </li>
                        </ol>
                    </div>
                </div>

               
        <div class="panel-body">
                <img style="float: right;margin-top: -50px" width="400" height="350" src="<?php echo base_url('') ?>assets/img/report.png" alt="report" class="img-rounded">
                <div class="col-md-6">
                <?php echo form_open('report/create'); ?>
                <?php if (validation_errors()): ?>
                    <div class="alert alert-danger"><strong><?php echo validation_errors(); ?></strong></div>
                <?php endif ?>
                    <div class="form-group">
                        <label>Tema</label>
                        <select name="subjek" id="subjek" class="form-control">
                            <option disabled selected style='display:none;'>Pilih Tema</option>
                            <option value="Fasilitas">Fasilitas</option>
                            <option value="Buku">Buku</option>
                            <option value="Petugas">Pelayanan</option>
                            <option value="Pelayanan">Aplikasi</option>
                            <option value="Pegawai">Lain-lain</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Isi</label>
                        <textarea class="form-control" rows="3" name="isi" id="isi"></textarea>
                    </div>
                    <div class="panel-footer">
                <button type="submit" id="simpan" class="btn btn-danger"><i class="glyphicon glyphicon-saved"></i> Simpan</button>
                </div><?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
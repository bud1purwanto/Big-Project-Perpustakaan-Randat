<div id="wrapper">
    <div id="page-wrapper">
        <div class="container-fluid">
        <div class="row">
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header"><?php foreach ($get_penerbit as $key) {
                        ?>
                           <span class="label label-primary" style="background-color: #1abc9c">Edit Penerbit</span> <b> <span class="label label-primary"><?php echo $key->nama_penerbit; ?></span></b>
                        </h1>
                     
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="<?php echo site_url('dashboard') ?>">Dashboard</a>
                            </li>
                            <li >
                                <i class="fa fa-list"></i> <a href="<?php echo site_url('penerbit') ?>">Penerbit</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-edit"></i> Edit Penerbit
                            </li>
                        </ol>
                    </div>
                </div>
               
               <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
               <div class="panel panel-default">
                        <div class="panel-heading">
                            Data Penerbit
                        </div>
                        <div class="panel-body">
                <?php echo form_open_multipart('penerbit/edit/'.$this->uri->segment(3)); ?>
                    <?php if (validation_errors()) {
                        ?><div style="margin-top: 0px" class="alert alert-danger">
                              <strong><?php echo validation_errors(); ?></strong></div><?php } ?>
                        <div class="table-responsive">
                  
                            <div style="margin-top: 0px" class="form-group">
                                <label>Nama Penerbit</label>
                                <input class="form-control" id="nama_penerbit" name="nama_penerbit" type="text" placeholder="Nama Lengkap" value="<?php echo $key->nama_penerbit; ?>">
                            </div>
                            <div style="margin-top: 0px" class="form-group">
                                <label>Alamat</label>
                                <input class="form-control" id="alamat" name="alamat" type="text" placeholder="Alamat" value="<?php echo $key->alamat; ?>">
                            </div>
                            <div style="margin-top: 0px" class="form-group">
                                <label>Nomor HP</label>
                                <input class="form-control" id="no_hp" name="no_hp" type="number" placeholder="Nomor HP" value="<?php echo $key->no_hp; ?>">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-pencil"></i>  Edit</button>
                                
                            </div><?php } ?>
                          <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>        
    </div>
</div>

<?php $this->load->view('template/assets-footer'); ?>
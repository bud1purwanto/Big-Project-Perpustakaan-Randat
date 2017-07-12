<div id="wrapper">
    <div id="page-wrapper">
        <div class="container-fluid">
        <div class="row">
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            <span class="label label-default">Daftar Admin</span> <a class="btn btn-success" href="<?php echo site_url('user/createAdmin') ?>" role="button"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Tambah</a>
                        </h1>
                        <ol class="breadcrumb">

                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="<?php echo site_url('dashboard') ?>">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-fw fa-user"></i> Admin
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

                            <table class="table table-bordered table-hover" id="examplee">
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
                                
                                </tbody>
                            </table>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
            $(document).ready(function() {
                $('#examplee').DataTable( {
                    "processing": true,
                    "serverSide": true,
                    "ajax": {
                        url: "<?php echo site_url('User/Server_Admin') ?>",
                        type: "POST"
                    },
                    "columnDefs": [ 
                        {
                            "targets": 0,
                            "data": "nama",
                        }, 

                        {
                            "targets": 1,
                            "data": null,
                            "render": function ( data, type, full, meta ) {
                              return '<img width="100" height="100" src=<?php echo base_url()?>assets/uploads/Profil/'+data["foto"]+'>';
                            }
                        }, 

                        {
                            "targets": 2,
                            "data": "no_identitas",
                        }, 

                        {
                            "targets": 3,
                            "data": "username",
                        }, 
                        {
                            "targets": 4,
                            "data": "jenis_kelamin",
                        }, 

                        {
                            "targets": 5,
                            "data": null,
                            "render": function ( data, type, full, meta ) {
                              return '<a href=<?php echo site_url('user/adminDetail/')?>'+data["id_user"]+' type="button" class="btn btn-info"><span class="glyphicon glyphicon-folder-open    " aria-hidden="true"></span></a> <a href=<?php echo site_url('user/deleteAdmin/')?>'+data["id_user"]+' type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>';
                            }
                        }, 
                    ]

                } );
            } );    
</script>

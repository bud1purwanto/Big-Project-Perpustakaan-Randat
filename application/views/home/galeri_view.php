<div id="wrapper">
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">

                <?php foreach ($galeri as $key) { ?>
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th><img style="margin-left: 10px; border-radius: 10px; " width="400px" height="200px" src="<?=base_url()?>assets/uploads/Galeri/<?=$key->foto?>"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr align="center">
                                    <td><a class="btn btn-danger" href="<?php echo site_url('dashboard/deleteGaleri/').$key->id_galeri ?>" onClick="JavaScript: return confirm('Anda yakin Hapus data ini ?')" role="button"><i class="
                                    glyphicon glyphicon-trash"></i> Delete</a></td>
                                </tr>
                            </tbody>
                        </table>
                        
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
  
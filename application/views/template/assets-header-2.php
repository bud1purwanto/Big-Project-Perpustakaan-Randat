<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?=$title?></title>
		<link rel="icon" href="<?php echo base_url('') ?>assets/img/book.png">
		<link rel="stylesheet" href="<?php echo base_url('') ?>assets/css/bootstrap.min.css">
	    <link href="<?php echo base_url('') ?>assets/css/sb-admin.css" rel="stylesheet">
	    <link href="<?php echo base_url('') ?>assets/css/plugins/morris.css" rel="stylesheet">
	    <link href="<?php echo base_url('') ?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    	<link href="<?=base_url()?>assets/jquery/jquery-ui.css" rel="stylesheet">
		<script src="<?=base_url()?>assets/jquery/jquery.min.js" type="text/javascript"></script>
		<script src="<?=base_url()?>assets/jquery/jquery-ui.js" type="text/javascript"></script>
		<script src="<?=base_url()?>assets/js/select2.min.js" type="text/javascript"></script> 

		<script type='text/javascript' src='<?php echo base_url();?>assets/autocomplete/jquery.autocomplete.js'></script>
		<link href='<?php echo base_url();?>assets/autocomplete/jquery.autocomplete.css' rel='stylesheet' />
		<link rel="stylesheet" href="<?=base_url()?>assets/multiselect/kendo.common-material.min.css" />
		<link rel="stylesheet" href="<?=base_url()?>assets/multiselect/kendo.material.min.css" />
		<link rel="stylesheet" href="<?=base_url()?>assets/multiselect/kendo.material.mobile.min.css" />
		<script src="<?=base_url()?>assets/multiselect/kendo.all.min.js"></script>

		    <style type="text/css">
		    	.slideshowButton {
				    padding: 16px; 
				    background-color: white;
				    border-radius: 5px;
				}			
				.slideshowButton:hover {
				    padding: 16px; 
				    background-color: black;
				    color: white; 
				    opacity: 0.7; 
				    border-radius: 5px;
				}	

			</style>
		   	<script>
		     	$(function () {
		        $("#kode").autocomplete({    
		            minLength:0,
		            delay:0,
		            source:'<?php echo site_url('user/get_alldata'); ?>', 
		            select:function(event, ui){
		                $('#nama').val(ui.item.nama);
		                $('#no_identitas').val(ui.item.no_identitas);
		                $('#id_user').val(ui.item.id_user);
		                }
		            });
		        });
		    </script>
		    <script>
		     	$(function () {
		        $("#kodee").autocomplete({    
		            minLength:0,
		            delay:0,
		            source:'<?php echo site_url('buku/get_alldata'); ?>',  
		            select:function(event, ui){
		                $('#judul').val(ui.item.judul);
		                $('#id_buku').val(ui.item.id_buku);
		                $('#id_bukutampil').val(ui.item.id_bukutampil);
		                $('#stok').val(ui.item.stok);
		                }
		            });
		        });
		    </script>
	</head>
	<body>
<!DOCTYPE html>
<html>
<head>
    <title><?=$title?></title>
    <style>
    table{
        border-collapse: collapse;
        width: 100%;
        margin: 0 auto;
    }
    table th{
        border:1px solid #000;
        padding: 3px;
        font-weight: bold;
        text-align: center;
    }
    table td{
        border:1px solid #000;
        padding: 3px;
        vertical-align: top;
    }
    </style>
</head>
<body>

<h2 style="text-align: center">History Peminjaman</h2>
<div class="row">
    <br>  
</div>
<table>
    <tr>
        <th style="width: 3%">No</th>
        <th style="width: 9%">No Identitas</th>
        <th style="width: 19%">Nama</th>
        <th style="width: 8%">ID Buku</th>
        <th style="width: 19%">Judul</th>
        <th>Tanggal Pinjam</th>
        <th>Tanggal Kembali</th>
        <th>Jatuh Tempo</th>
        <th>Denda</th>
        <th>Tanggal Dikembalikan</th>
    </tr>
    <?php $no=0; foreach($history as $key){
    $no++;
    ?>
    <tr align="center">
        <td><?php echo $no;?></td>
        <td><?php echo $key->no_identitas;?></td>
        <td align="left" style="text-indent: 10px"><?php echo $key->nama;?></td>
        <td><?php echo $key->id_buku;?></td>
        <td align="left" style="text-indent: 10px"><?php echo $key->judul;?></td>
        <td><?php echo date('d/m/Y', strtotime($key->tanggal_pinjam));?></td>
        <td><?php echo date('d/m/Y', strtotime($key->tanggal_kembali));?></td>
        <td><?php echo $key->jatuh_tempo;?></td>
        <td><?php echo $key->denda;?></td>
        <td><?php echo date('d/m/Y', strtotime($key->tanggal_dikembalikan));?></td>
    </tr>
    <? }?>
</table>
</body>
</html>
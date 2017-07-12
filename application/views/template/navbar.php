<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="navbar-header">
        <?php foreach ($data_login as $key) { ?>
        <a style="width: 500px" class="navbar-brand" href=""><?=$title?></a>
        <a class="navbar-brand" href="<?php echo site_url('dashboard') ?>">Selamat Datang <?php echo $key->nama; ?></a>
  
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
    </div>
    <ul class="nav navbar-right top-nav">   
    <?php if ($key->status=="user"): ?>
        
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-bell"></i>  <b class="caret"></b></a>
            <ul class="dropdown-menu alert-dropdown" style="width: 400px">
            <?php $no=0; 
                foreach ($notif as $key) { ?>
                <li>
                <a href="<?php echo site_url('peminjaman/list') ?>">
                    <table>
                    <li class="divider"></li>
                        <tr>
                        <?php 
                        $no++;
                        $datetime1 = strtotime($key->tanggal_pinjam);
                        $datetime2 = strtotime($key->tanggal_kembali);
                        $datediff = $datetime2 - $datetime1;
                        $total = floor($datediff / (60*60*24));
                        
                        $tanggal_pinjam = strtotime($key->tanggal_pinjam);
                        $hariini = strtotime(date('Y-m-d'));
                        $rentan = $hariini - $tanggal_pinjam;
                        $proses = floor($rentan / (60*60*24));
                        
                        $hasil=($proses/$total)*100;
                        $result = round($hasil);
                        ?>
                        <p>
                            <strong><?php echo "Peminjaman ".$no ?></strong>
                            <span class="pull-right text-muted"><?php if ($result <= 100) {
                                echo $result." %";
                            } else {
                                echo "100 %"; 
                            }
                             ?></span>
                        </p>
                        <div class="progress progress-striped active">
                            <div <?php if ($result <= 15) { ?>
                                class="progress-bar progress-bar-info"
                            <?php } else if($result <= 50) { ?>
                                class="progress-bar progress-bar-success"
                            <?php } else if($result <= 75) { ?>
                                class="progress-bar progress-bar-warning"
                            <?php } else { ?>
                                class="progress-bar progress-bar-danger"
                            <?php } ?> role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $result?>%">
                                    <span class="sr-only"></span>
                                </div>
                            </div>
                                <td width="20px"><i class="glyphicon glyphicon-book"> </i></td>
                                <td width="35%"><b><?php echo $key->judul ?></b></td>
                                <td width="25%" style="text-indent: 10px"><span class="glyphicon glyphicon-log-in"></span> <b><?php echo date('d/m/Y', strtotime($key->tanggal_pinjam)) ?></b></td>
                                <td width="25%" style="text-indent: 10px"><span class="glyphicon glyphicon-log-out"></span> <b><?php echo date('d/m/Y', strtotime($key->tanggal_kembali)) ?></b></td>
                        </tr>
                    </table>                    
                </a>
                </li>
                <?php } ?> <li class="divider"></li>
            </ul>
        </li>
        <?php endif ?>

                <?php foreach ($data_login as $key ) {
                      ?>
                <img style="border-radius: 5px;" style="margin-top: 1px" src="<?=base_url()?>assets/uploads/Profil/<?=$key->foto?>" width="50px" height="50px" >
               
                <li class="dropdown" >
                        
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $key->nama; ?><b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a style="font-size: 12px" href="<?php echo site_url('dashboard/editProfil') ?>"><i class="glyphicon glyphicon-heart"></i> Profile</a>
                        </li>
                        <li>
                            <a style="font-size: 12px" href="<?php echo site_url('dashboard/gantiPassword') ?>"><i class="glyphicon glyphicon-lock"></i> Ganti Password</a>
                        </li>
                        <?php if ($key->status=="admin") {
                            ?>
                            <li>
                            <a style="font-size: 12px" href="<?php echo site_url('dashboard/setting') ?>"><i class="fa fa-wrench fa-fw"></i> Setting</b></a>
                            </li>
                            <li>
                            <a style="text-transform: capitalize;font-size: 12px" href=""><i class="glyphicon glyphicon-king"></i> Status: <b><?php echo $key->status ?></b></a>
                            </li>
                            <?php
                        } else {
                           ?>
                            <li>
                            <a style="text-transform: capitalize;font-size: 12px" href=""><i class="glyphicon glyphicon-knight"></i> Status: <b><?php echo $key->status ?></b></a>
                            </li>
                            <?php
                        }
                         ?>
                        <li class="divider"></li>
                        <li>
                            <div>
                                <center>
                                <script>
                                    var bln=['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
                                    var myDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum&#39;at', 'Sabtu'];
                                    var tgl= new Date();
                                    var hari=tgl.getDate();
                                    var bulan=tgl.getMonth();
                                    var hariini=tgl.getDay();
                                    hariini=myDays[hariini];
                                    var yy=tgl.getYear();
                                    var tahun=(yy<1000)?yy+1900:yy;
                                    document.write(hariini+', '+hari+" "+bln[bulan]+" "+tahun)
                                </script>
                                </center>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a style="font-size: 12px" href="<?php echo site_url('login/logout') ?>"><i class="glyphicon glyphicon-off"></i>  Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
           
           <div class="collapse navbar-collapse navbar-ex1-collapse" >
                <ul class="nav navbar-nav side-nav" >

                    <li class="">
                        <a href="<?php echo site_url('dashboard') ?>"> <i class="glyphicon glyphicon-home"></i></i> Dashboard</a>
                    </li>
                    <?php if ($key->status=="admin") {
                        ?>

                        <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo"> <i class="glyphicon glyphicon-user"></i></i> User <i class="caret"></i></i></a>
                        <ul id="demo" class="collapse">
                            <li>
                                <a href="<?php echo site_url('user') ?>"> <i class="glyphicon glyphicon-king"></i> Admin</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('user/user') ?>"> <i class="glyphicon glyphicon-knight"></i> Member</a>
                            </li>
                        </ul>
                    </li>

                        <?php
                    } ?>
                    <?php if ($key->status=="admin") {
                        ?>
                    <li>
                        <a href="<?php echo site_url('user/identitas') ?>"> <i class="glyphicon glyphicon-tag"></i> Nomor Identitas</a>
                    </li>
                    <?php
                    } ?>
                    <li>
                        <a href="<?php echo site_url('buku') ?>"> <i class="glyphicon glyphicon-book"></i> Buku</a>
                    </li>
                    

                        <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo2"> <i class="glyphicon glyphicon-paperclip"></i></i> Komponen <i class="caret"></i></i></a>
                        <ul id="demo2" class="collapse">
                            <li>
                                <a href="<?php echo site_url('pengarang') ?>"> <i class="glyphicon glyphicon-pencil"></i> Pengarang</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('penerbit') ?>"> <i class="glyphicon glyphicon-tasks"></i> Penerbit</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('kategori') ?>"> <i class="glyphicon glyphicon-tag"></i> Kategori</a>
                            </li>
                            <?php if ($key->status=="admin") { ?>
                            <li>
                                <a href="<?php echo site_url('Buku_Pengarang') ?>"> <i class="glyphicon glyphicon-thumbs-up"></i> Pengarang Buku</a>
                            </li>
                             <?php } ?>
                        </ul>
                    </li>
                

                 

                        <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo3"> <i class="glyphicon glyphicon-transfer"></i></i> Transaksi <i class="caret"></i></i></a>
                        <ul id="demo3" class="collapse">
                            <?php if ($key->status=="admin") { ?>
                            <li>
                                <a href="<?php echo site_url('peminjaman') ?>"> <i class="glyphicon glyphicon-hand-up"></i> Peminjaman</a>
                            </li>
                             <?php 
                            } else if ($key->status=="user") { ?>
                            <li>
                                <a href="<?php echo site_url('peminjaman/list') ?>"> <i class="glyphicon glyphicon-hand-up"></i> Peminjaman</a>
                            </li>
                             <?php } ?>
                            
                            <!-- <?php if ($key->status=="admin") { ?>
                            <li>
                                <a href="<?php echo site_url('pengembalian') ?>"> <i class="glyphicon glyphicon-hand-down "></i> Pengembalian</a>
                            </li>
                            <?php 
                            } else if ($key->status=="user") { ?>
                            <li>
                                <a href="<?php echo site_url('pengembalian/list') ?>"> <i class="glyphicon glyphicon-hand-down "></i> Pengembalian</a>
                            </li>
                            <?php } ?> -->
                            <?php if ($key->status=="admin") { ?>
                            <li>
                                <a href="<?php echo site_url('history') ?>"> <i class="glyphicon glyphicon-list-alt "></i> History</a>
                            </li>
                            <?php 
                            } else if ($key->status=="user") { ?>
                            <li>
                                <a href="<?php echo site_url('history/list') ?>"> <i class="glyphicon glyphicon-list-alt "></i> History</a>
                            </li>
                            <?php } ?>
                        </ul>
                    </li>
                   
                    <li> <?php if ($key->status=="admin") { ?>
                        <li>
                        <a href="<?php echo site_url('report') ?>"> <i class="glyphicon glyphicon-bullhorn"></i> Report</a>
                    </li>
                    <?php } else if ($key->status=="user") { ?>
                    <a href="javascript:;" data-toggle="collapse" data-target="#demo4"> <i class="glyphicon glyphicon-bullhorn"></i></i> Report <i class="caret"></i></i></a>
                        <ul id="demo4" class="collapse">
                             
                             <li>
                                <a href="<?php echo site_url('report/create') ?>"> <i class="glyphicon glyphicon-pencil"></i> Laporkan</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('report/listUser') ?>"> <i class="glyphicon glyphicon-list"></i> Report Anda</a>
                            </li>
                             
                        </ul><?php } ?>
                    </li>
                    <li>
                        <a href="<?php echo site_url('login/logout') ?>"> <i class="glyphicon glyphicon-log-out"></i> Log Out</a>
                    </li>
                    
                    
                    <li>

                        <div class="panel panel-primary" style="width: 210px; background-color: #222222; border-color: #222222">
                          <div class="panel-body">
                            <!--Conten-->
                            
                            <h2 style="color: white"><center><div id="clock"></div></center></h2>
                            <script>
                                function showTime() {
                                    var a_p = "";
                                    var today = new Date();
                                    var curr_hour = today.getHours();
                                    var curr_minute = today.getMinutes();
                                    var curr_second = today.getSeconds();
                                    if (curr_hour < 12) {
                                        a_p = "AM";
                                    } else {
                                        a_p = "PM";
                                    }
                                    if (curr_hour == 0) {
                                        curr_hour = 12;
                                    }
                                    if (curr_hour > 12) {
                                        curr_hour = curr_hour - 12;
                                    }
                                    curr_hour = checkTime(curr_hour);
                                    curr_minute = checkTime(curr_minute);
                                    curr_second = checkTime(curr_second);
                                 document.getElementById('clock').innerHTML=curr_hour + ":" + curr_minute + ":" + curr_second + " " + a_p;
                                    }

                                function checkTime(i) {
                                    if (i < 10) {
                                        i = "0" + i;
                                    }
                                    return i;
                                }
                                setInterval(showTime, 500);
                            </script>
                          </div>
          
                     </div>
                    </li><?php } ?>
                </ul>
            </div>
            <?php } ?>
        </nav>
        
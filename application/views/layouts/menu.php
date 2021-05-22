<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SIM Koperasi</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="icon" type="image/png" href="<?php echo base_url()."assets/"; ?>image/logo-koperasi.png">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url()."assets/"; ?>bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url()."assets/"; ?>bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url()."assets/"; ?>bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url()."assets/"; ?>dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url()."assets/"; ?>dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="<?php echo base_url()."assets/"; ?>bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php echo base_url()."assets/"; ?>bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?php echo base_url()."assets/"; ?>bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url()."assets/"; ?>bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?php echo base_url()."assets/"; ?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url()."assets/"; ?>bower_components/select2/dist/css/select2.min.css">
  <link rel="stylesheet" href="<?php echo base_url()."assets/"; ?>bower_components/select2/dist/css/select2.css">
  <!--<link rel="stylesheet" href="<?php echo base_url()."assets/"; ?>css/jquery.dataTables.min.css">-->

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="<?//php echo base_url()."assets/"; ?>https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="<?//php echo base_url()."assets/"; ?>https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <!-- <link rel="stylesheet" href="<?//php echo base_url()."assets/"; ?>https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"> -->
  
  <!-- jQuery 3 -->
<script src="<?php echo base_url()."assets/"; ?>bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url()."assets/"; ?>bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script src="<?php echo base_url()."assets/"; ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="<?php echo base_url()."assets/"; ?>bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url()."assets/"; ?>bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url()."assets/"; ?>bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url()."assets/"; ?>bower_components/fastclick/lib/fastclick.js"></script>
<!-- Select2 -->
<script src="<?php echo base_url()."assets/"; ?>bower_components/select2/dist/js/select2.full.min.js"></script>
</head>
<body class="hold-transition skin-red fixed sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="<?php echo base_url(''); ?>index.php/homecon/index" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b></b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="<?php echo base_url(); ?>" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
		<span class="logo-lg"><b>&nbsp;SIM Koperasi</b></span>
      </a>
	  <div class="navbar-custom-menu">
		<ul class="nav navbar-nav">
			<li class="dropdown user user-menu">
				<a class="dropdown-toggle" data-toggle="dropdown">
				  <span class="hidden-xs">Hello, <?php echo $username." [".$status."]"?></span>
				</a>
			</li>
		</ul>
	  </div>
	</nav>
      
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENU</li>
        <?php
        if($status == 'Administrator') {
        ?>
        <li>
          <a href="<?php echo base_url(); ?>index.php/nasabahcon">
            <i class="fa fa-users"></i> <span>Anggota</span>
          </a>
        </li>
        <li class="treeview">
          <a href="<?php echo base_url()."assets/"; ?>#">
            <i class="fa fa-usd"></i> <span>Transaksi</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url(); ?>index.php/transaksianggotacon"><i class="fa fa-money"></i>Anggota</a></li>
            <li><a href="<?php echo base_url(); ?>index.php/simpananpihakketigacon"><i class="fa fa-money"></i>Pihak Ketiga</a></li>
          </ul>
        </li>
        <li>
          <a href="<?php echo base_url(); ?>index.php/simpanan3thmastercon">
            <i class="fa fa-credit-card"></i> <span>Simpanan 3 TH</span>
          </a>
        </li>
        <!--<li class="treeview">
          <a href="<?php echo base_url()."assets/"; ?>#">
            <i class="fa fa-usd"></i> <span>Simpanan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url(); ?>index.php/simpananpokokcon"><i class="fa fa-money"></i>Simpanan Pokok</a></li>
            <li><a href="<?php echo base_url(); ?>index.php/simpananwajibcon"><i class="fa fa-money"></i>Simpanan Wajib</a></li>
            <li><a href="<?php echo base_url(); ?>index.php/simpanankhususcon"><i class="fa fa-money"></i>Simpanan Khusus</a></li>
            <li><a href="<?php echo base_url(); ?>index.php/simpanan3thcon"><i class="fa fa-money"></i>Simpanan 3 Tahunan</a></li>
            <li><a href="<?php echo base_url(); ?>index.php/simpanandanasosialcon"><i class="fa fa-money"></i>Simpanan Dana Sosial</a></li>
            <li><a href="<?php echo base_url(); ?>index.php/simpanankanzuncon"><i class="fa fa-money"></i>Simpanan Kanzun</a></li>
            <li><a href="<?php echo base_url(); ?>index.php/simpananpihakketigacon"><i class="fa fa-money"></i>Simpanan Pihak Ketiga</a></li>
          </ul>
        </li>-->
        <!--<li class="treeview">
          <a href="<?php echo base_url()."assets/"; ?>#">
            <i class="fa fa-credit-card"></i> <span>Transaksi</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url(); ?>index.php/pinjamancon"><i class="fa fa-money"></i>Pinjaman</a></li>
            <li><a href="#"><i class="fa fa-money"></i>Pembayaran</a></li>
            <li><a href="#"><i class="fa fa-money"></i>Menabung</a></li>
          </ul>
        </li>-->
        <!--<li>
          <a href="<?php echo base_url(); ?>index.php/pinjamancon">
            <i class="fa fa-credit-card"></i> <span>Pinjaman</span>
          </a>
        </li>-->
        <!--<li class="treeview">
          <a href="<?php echo base_url()."assets/"; ?>#">
            <i class="fa fa-book"></i> <span>Laporan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-balance-scale"></i>Neraca</a></li>
            <li><a href="#"><i class="fa fa-dollar"></i>Laba Rugi</a></li>
          </ul>
        </li>-->
        <li>
          <a href="<?php echo base_url(); ?>index.php/transaksicon">
            <i class="fa fa-usd"></i> <span>Transaksi Lain-lain</span>
          </a>
        </li>
        <li class="treeview">
          <a href="<?php echo base_url()."assets/"; ?>#">
            <i class="fa fa-book"></i> <span>Akuntansi</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url(); ?>index.php/kodeakuncon"><i class="fa fa-book"></i>Kode Akun</a></li>
            <li><a href="<?php echo base_url(); ?>index.php/mappingkodeakuncon"><i class="fa fa-book"></i>Mapping Kode Akun</a></li>
            <li><a href="<?php echo base_url(); ?>index.php/transaksiakuntansicon"><i class="fa fa-book"></i>Transaksi</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="<?php echo base_url()."assets/"; ?>#">
            <i class="fa fa-book"></i> <span>Laporan Akuntansi</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url(); ?>index.php/laporanneracacon/index"><i class="fa fa-balance-scale"></i>Neraca</a></li>
            <li><a href="<?php echo base_url(); ?>index.php/laporanrugilabacon/index"><i class="fa fa-book"></i>Rugi Laba</a></li>
            <li><a href="<?php echo base_url(); ?>index.php/laporankeuangancon/index"><i class="fa fa-money"></i>Keuangan</a></li>
            <li><a href="<?php echo base_url(); ?>index.php/laporanaruskascon/index"><i class="fa fa-money"></i>Arus Kas</a></li>
            <li><a href="<?php echo base_url(); ?>index.php/laporanarusbankcon/index"><i class="fa fa-money"></i>Arus Bank</a></li>
            <li><a href="<?php echo base_url(); ?>index.php/laporanrincianakuncon/index"><i class="fa fa-money"></i>Histori Riwayat Akun</a></li>
            <!--<li><a href="<?php echo base_url(); ?>index.php/saldoawaltahuncon/index"><i class="fa fa-upload"></i>Post Saldo Awal Tahun</a></li>-->
          </ul>
        </li>
        <li class="treeview">
          <a href="<?php echo base_url()."assets/"; ?>#">
            <i class="fa fa-book"></i> <span>Laporan Penunjang</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url(); ?>index.php/laporanpiutangcon/index"><i class="fa fa-list-ul"></i>Piutang Anggota</a></li>
            <li><a href="<?php echo base_url(); ?>index.php/laporanrincianpiutangcon/index"><i class="fa fa-list-ul"></i>Rincian Piutang</a>
            <li><a href="<?php echo base_url(); ?>index.php/laporanrincianjasacon/index"><i class="fa fa-list-ul"></i>Rincian Jasa</a></li>
            <!--<li><a href="<?php echo base_url(); ?>index.php/laporansimpanancon/index"><i class="fa fa-book"></i>Simpanan</a></li>-->
            <li><a href="<?php echo base_url(); ?>index.php/laporansimpananpokokcon/index"><i class="fa fa-list-ul"></i>Simpanan Pokok</a></li>
            <li><a href="<?php echo base_url(); ?>index.php/laporansimpananpokokistimewacon/index"><i class="fa fa-list-ul"></i>Simpanan Pokok Istimewa</a></li>
            <li><a href="<?php echo base_url(); ?>index.php/laporansimpananwajibcon/index"><i class="fa fa-list-ul"></i>Simpanan Wajib</a></li>
            <li><a href="<?php echo base_url(); ?>index.php/laporansimpanankhususcon/index"><i class="fa fa-list-ul"></i>Simpanan Khusus</a></li>
            <li><a href="<?php echo base_url(); ?>index.php/laporansimpanandanasosialcon/index"><i class="fa fa-list-ul"></i>Simpanan Dansos Anggota</a></li>
            <li><a href="<?php echo base_url(); ?>index.php/laporansimpanandanasosialistimewacon/index"><i class="fa fa-list-ul"></i>Simpanan Dansos Anggota Istimewa</a></li>
            <li><a href="<?php echo base_url(); ?>index.php/laporansimpanankanzuncon/index"><i class="fa fa-list-ul"></i>Simpanan Kanzun</a></li>
            <li><a href="<?php echo base_url(); ?>index.php/laporansimpananpihakketigacon/index"><i class="fa fa-list-ul"></i>Simpanan Pihak Ketiga</a></li>
            <li><a href="<?php echo base_url(); ?>index.php/laporansimpanan3thcon/index"><i class="fa fa-list-ul"></i>Simpanan 3Th</a></li>
            <li><a href="<?php echo base_url(); ?>index.php/laporanhariancon/index"><i class="fa fa-list-ul"></i>Harian</a></li>
          </ul>
        </li>
        <!--<li>
          <a href="<?php echo base_url(); ?>index.php/surattagihancon">
            <i class="fa fa-envelope"></i> <span>Surat Tagihan</span>
          </a>
        </li>-->
        <li>
          <a href="<?php echo base_url(); ?>index.php/usercon">
            <i class="fa fa-user-circle-o"></i> <span>User</span>
          </a>
        </li>
        <?php
        } else if($status == 'Operator') {
        ?>
        <li class="treeview">
          <a href="<?php echo base_url()."assets/"; ?>#">
            <i class="fa fa-usd"></i> <span>Transaksi</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url(); ?>index.php/transaksianggotacon"><i class="fa fa-money"></i>Anggota</a></li>
          </ul>
        </li>
        <?php
        }
        ?>
        <li>
          <a href="<?php echo base_url(''); ?>index.php/usercon/logout">
            <i class="fa fa-sign-out"></i> <span>Logout</span>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  
  

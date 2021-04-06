<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo (isset($title)) ? $title : ucfirst($this->uri->segment(2)) ?> - Shabbychic Korden</title>
  <link rel="shortcut icon" href="<?php echo site_url() ?>uploads/fav.png">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/jquery-fat-zoom/css/zoom.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/summernote-0.8.18/summernote.min.css">
   <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/datatables/css/dataTables.bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/dist/css/skins/skin-blue.min.css">

  <!-- jQuery 3 -->
  <script src="<?php echo base_url() ?>assets/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url() ?>assets/summernote-0.8.18/summernote.min.js"></script>
  <script src="<?php echo base_url() ?>assets/jquery-fat-zoom/js/zoom.js"></script>

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>S</b>BC</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Shabbychic</b></span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li>
            <a href="<?php echo site_url() ?>admin/login/logout"><i class="fa fa-power-off"></i> Logout</a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url() ?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $_SESSION["admin"]["nama"] ?></p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- search form (Optional) -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
        </div>
      </form>
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">HEADER</li>
        <!-- Optionally, you can add icons to the links -->
        <li class="<?php echo $this->uri->segment(2) =="dashboard" ? "active" : ""?>">
          <a href="<?php echo site_url() ?>admin/dashboard"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
        </li>
        <li class="treeview <?php echo $this->uri->segment(2) =="order" ? "active":"" ?>">
          <a href="#"><i class="fa fa-shopping-bag"></i> <span>Transaksi</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php echo $this->uri->segment(2) =="order" && empty($this->uri->segment(3))  ? "active":"" ?>">
              <a href="<?php echo site_url() ?>admin/order"><i class="fa fa-circle-o"></i> Order Semua</a>
            </li>
            <li class="<?php echo $this->uri->segment(2) =="order" && $this->uri->segment(3)=="pending"  ? "active":"" ?>">
              <a href="<?php echo site_url() ?>admin/order/pending"><i class="fa fa-circle-o"></i> Order Pending</a>
            </li>
            <li class="<?php echo $this->uri->segment(2) =="order" && $this->uri->segment(3)=="terkirim"  ? "active":"" ?>">
              <a href="<?php echo site_url() ?>admin/order/terkirim"><i class="fa fa-circle-o"></i> Order Terkirim</a>
            </li>
            <li class="<?php echo $this->uri->segment(2) =="order" && $this->uri->segment(3)=="selesai"  ? "active":"" ?>">
              <a href="<?php echo site_url() ?>admin/order/selesai"><i class="fa fa-circle-o"></i> Order Selesai</a>
            </li>
            <li class="<?php echo $this->uri->segment(2) =="order" && $this->uri->segment(3)=="laporan"  ? "active":"" ?>">
              <a href="<?php echo site_url() ?>admin/order/laporan"><i class="fa fa-circle-o"></i> Print Laporan</a>
            </li>
          </ul>
        </li>
        <li class="<?php echo $this->uri->segment(2) =="konfirmasi" ? "active" : ""?>">
          <a href="<?php echo site_url() ?>admin/konfirmasi"><i class="fa fa-book"></i> <span>Konfirmasi</span></a>
        </li>
        <li class="treeview <?php echo $this->uri->segment(2) =="produk" || $this->uri->segment(2) =="kategori" ? "active":"" ?>">
          <a href="#"><i class="fa fa-rocket"></i> <span>Produk</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php echo $this->uri->segment(2) =="kategori" ? "active":"" ?>">
              <a href="<?php echo site_url() ?>admin/kategori"><i class="fa fa-circle-o"></i> Data Kategori</a>
            </li>
            <li class="<?php echo $this->uri->segment(2) =="produk" ? "active":"" ?>">
              <a href="<?php echo site_url() ?>admin/produk"><i class="fa fa-circle-o"></i> Data Produk</a>
            </li>
          </ul>
        </li>
        <li class="treeview <?php echo $this->uri->segment(2) =="karyawan" || $this->uri->segment(2) =="member" ? "active":"" ?>">
          <a href="#"><i class="fa fa-sitemap"></i> <span>Master Data</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php echo $this->uri->segment(2) =="karyawan" ? "active":"" ?>">
              <a href="<?php echo site_url() ?>admin/karyawan"><i class="fa fa-circle-o"></i> Data Karyawan</a>
            </li>
            <li class="<?php echo $this->uri->segment(2) =="member" ? "active":"" ?>">
              <a href="<?php echo site_url() ?>admin/member"><i class="fa fa-circle-o"></i> Data Member</a>
            </li>
          </ul>
        </li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo (isset($title)) ? $title : "Page Header" ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url() ?>admin"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <?php  
        if (isset($breadcrumb)) {
          foreach ($breadcrumb as $row) {
            echo "<li class='active'>{$row}</li>";
          }
        }
        ?>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
      
      <?php  
      # PERINGATAN / ALERT SUKSES
      if ($this->session->flashdata('sukses')) : ?>
        <div class="alert alert-success alert-dismissible">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Success!</strong> <?php echo $this->session->flashdata('sukses'); ?>
        </div>
      <?php endif; ?>

      <?php  
      # PERINGATAN / ALERT GAGAL
      if ($this->session->flashdata('gagal')) : ?>
        <div class="alert alert-danger alert-dismissible">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Gagal!</strong> <?php echo $this->session->flashdata('gagal'); ?>
        </div>
      <?php endif; ?>


      <?php $this->load->view($konten); ?>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      Universitas AMIKOM Yogyakarta
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2020 <a href="#">Shabbychic Korden</a>.</strong> All rights reserved.
  </footer>

  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url() ?>assets/bootstrap/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="<?php echo base_url() ?>assets/datatables/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>assets/datatables/js/dataTables.bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url() ?>assets/dist/js/adminlte.min.js"></script>
<script>
  $(document).ready( function () {
    $('#myTable').DataTable();
    $('#summernote').summernote({
      height: 200, 
    });
  } );
</script>
</body>
</html>
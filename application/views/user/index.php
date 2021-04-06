
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo isset($title) ? $title : "Bernda"; ?> - Shabbychic Korden</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/font-awesome/css/font-awesome.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/jquery-fat-zoom/css/zoom.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/datatables/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/hover/hover-min.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/dist/css/skins/_all-skins.min.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bxslider/4.2.15/jquery.bxslider.min.css" rel="stylesheet" />

  <!-- jQuery 3 -->
  <script src="<?php echo base_url() ?>assets/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url() ?>assets/jquery-fat-zoom/js/zoom.js"></script>
  <script src="<?php echo base_url() ?>assets/loadingoverlay.min.js"></script>

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <a href="./" class="navbar-brand"><b>Shabbychic</b></a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="<?php echo (empty($this->uri->segment(1)) ? "active" : "") ?>">
              <a href="<?php echo site_url() ?>">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="<?php echo ($this->uri->segment(1) == "produk" ? "active" : "") ?>">
              <a href="<?php echo site_url() ?>produk">Produk</a>
            </li>
            <li class="<?php echo ($this->uri->segment(1) == "cara_beli" ? "active" : "") ?>">
              <a href="<?php echo site_url() ?>cara_beli">Cara Membeli</a>
            </li>
            <li class="<?php echo ($this->uri->segment(1) == "tentang" ? "active" : "") ?>">
              <a href="<?php echo site_url() ?>tentang">Tentang Kami</a>
            </li>
          </ul>
        </div>
        <!-- /.navbar-collapse -->
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <form class="navbar-form navbar-left hidden-xs" role="search" action="<?php echo site_url() ?>produk/pencarian">
            <div class="form-group">
              <input type="text" class="form-control" name="q" id="navbar-search-input" placeholder="Cari produk" value="<?php echo $this->input->get('q', TRUE) ? $this->input->get('q', TRUE) : "" ?>">
            </div>
          </form>
          <ul class="nav navbar-nav">

            <!-- Notifications Menu -->
            <li class="dropdown notifications-menu">
              <!-- Menu toggle button -->
              <a href="<?php echo site_url('cart') ?>">
                <i class="fa fa-shopping-bag"></i> 
                <span class="label label-warning"><?php echo isset($_SESSION["order"]) ? count($_SESSION["order"]) : 0 ?></span>
              </a>
            </li>
            <?php if (!isset($_SESSION["user"])): ?>
              <li><a data-toggle="modal" data-target="#modalDaftar">Daftar</a></li>
              <li><a data-toggle="modal" data-target="#modalLogin">Login</a></li>

              <?php else: ?>

              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user-circle"></i> <?php echo $_SESSION["user"]["nama"] ?> <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="<?php echo site_url("profil") ?>">Profil</a></li>
                  <li><a href="<?php echo site_url("riwayat") ?>">Riwayat Belanja</a></li>
                  <li><a href="<?php echo site_url("konfirmasi") ?>">Konfirmasi Pembayaran</a></li>
                  <li class="divider"></li>
                  <li><a href="<?php echo site_url("login/logout") ?>">Logout</a></li>
                </ul>
              </li>
            <?php endif ?>
          </ul>
        </div>
        <!-- /.navbar-custom-menu -->
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>
  <!-- Full Width Column -->
  <div class="content-wrapper">
    <div class="container">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          <?php echo  (isset($title)) ? $title : "Title" ?>
        </h1>
        <ol class="breadcrumb">
        <li><a href="<?php echo site_url() ?>"><i class="fa fa-home"></i> Beranda</a></li>
        <?php  
        if (isset($breadcrumb)) {
          foreach ($breadcrumb as $row) {
            echo "<li>{$row}</li>";
          }
        }
        ?>
      </ol>
      </section>

      <!-- Main content -->
      <section class="content">

        <!-- start alert peringatan -->
        <?php if ($this->session->flashdata('sukses')): ?>
          <div class="alert alert-success alert-dismissible fade in">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Success!</strong> <?php echo $this->session->flashdata('sukses'); ?>
          </div>
        <?php endif ?>

        <?php if ($this->session->flashdata('gagal')): ?>
          <div class="alert alert-danger alert-dismissible fade in">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Gagal!</strong> <?php echo $this->session->flashdata('gagal'); ?>
          </div>
        <?php endif ?>
        <!-- end alert peringatan -->

        <?php $this->load->view($konten); ?>

      </section>
      <!-- /.content -->
    </div>
    <!-- /.container -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="container">
      <div class="pull-right hidden-xs">
        <b>All rights reserved.</b>
      </div>
      <strong>Copyright &copy; <?php echo date("Y") ?> <a href="<?php echo site_url() ?>">Shabbychic Korden</a>.</strong> 
    </div>
    <!-- /.container -->
  </footer>
</div>
<!-- ./wrapper -->

<?php $this->load->view("user/view-login-dan-daftar"); ?>


<!-- slider home -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bxslider/4.2.15/jquery.bxslider.min.js"></script>

<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url() ?>assets/bootstrap/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="<?php echo base_url() ?>assets/datatables/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>assets/datatables/js/dataTables.bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url() ?>assets/dist/js/adminlte.min.js"></script>

<script type="text/javascript">
  $(document).ready(function(){
    $('.bxslider').bxSlider({
      pager : false, // indikator pagination
      auto : true, // slider otomatis
      speed : 500 // delay slider dalam satuan milisecond
    });
    $('#myTable').DataTable();
  });
</script>

</body>
</html>

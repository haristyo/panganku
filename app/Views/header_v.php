<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title><?= $title?></title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Favicons -->
  <link href="<?php echo base_url('img/favicon.png');?>" rel="icon">
  <link href="<?php echo base_url('img/apple-touch-icon.png');?>" rel="apple-touch-icon"> <!--sabeb dipake atau ga ge-->

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Roboto:100,300,400,500,700|Philosopher:400,400i,700,700i" rel="stylesheet">

  <!-- Bootstrap css -->
  <!-- <link rel="stylesheet" href="css/bootstrap.css"> -->
  <link href="<?php echo base_url('lib/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="<?php echo base_url('lib/owlcarousel/assets/owl.carousel.min.css'); ?>" rel="stylesheet">
  <link href="<?php echo base_url('lib/owlcarousel/assets/owl.theme.default.min.css'); ?>" rel="stylesheet">
  <link href="<?php echo base_url('lib/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet">
  <link href="<?php echo base_url('lib/animate/animate.min.css'); ?>" rel="stylesheet">
  <link href="<?php echo base_url('lib/modal-video/css/modal-video.min.css'); ?>" rel="stylesheet">

  <!-- Main Stylesheet File -->
  <link href="<?php echo base_url('css/style.css'); ?>" rel="stylesheet">
  <link href="<?php echo base_url('css/simple-sidebar.css'); ?>" rel="stylesheet">
  <script type="text/javascript" src="js/Chart.js"></script>
</head>

<body>

  <header id="header" class="header header-hide">
    <div class="container">

      <div id="logo" class="pull-left">
        <h1><a href="<?php echo base_url(''); ?>" class="scrollto"><span>Pangan</span>Ku</a></h1>
        <!-- Uncomment kalo gamau pake logo-->
        <!-- <a href="#body"><img src="img/logo.png" alt="" title="" /></a>-->
      </div>

      <nav id="nav-menu-container">
        <ul class="nav-menu">
          <li><a href="<?php echo base_url(); ?>">Beranda</a></li>
          <li><a href="<?php echo base_url('recipe'); ?>">Resep</a></li>
          <li><a href="<?php echo base_url('article'); ?>">Artikel</a></li>
          <li><a href="<?php echo base_url('team'); ?>">Tim</a></li>
          <?php if(session()->get('is_admin')=="Y") {?>
            <li><a href="<?php echo base_url('dashboard'); ?>" class="btn-login">Dasbor</a> </li>
          <?php } ?>
          <?php if(session()->get('logged_in')==FALSE) {?>
            <li><a href="<?php echo base_url('login'); ?>" class="btn-login">Masuk</a> </li>
          <?php } else { ?>
            <li><a href="<?php echo base_url('logout'); ?>" class="btn-danger">Keluar</a> </li>
          <?php }?>
        </ul>
      </nav><!-- #nav-menu-container -->
    </div>
  </header><!-- #header -->
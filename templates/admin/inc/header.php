<?php 
    ob_start();
    session_start(); 
    require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/database.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/session.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/defines.php';
?>
<!DOCTYPE html>
<html>
<head>
  <title>Admin</title>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="/libraries/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/libraries/bootstrap-3.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/libraries/reset.css">
    <link rel="stylesheet" type="text/css" href="/templates/admin/css/style.css">
    <link rel="shortcut icon" href="/templates/admin/images/icon.ico" type="image/x-icon">
    <script type="text/javascript" src="/libraries/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="/libraries/jquery.validate.min.js"></script>
    <script type="text/javascript" src="/libraries/ckeditor/ckeditor.js"></script>
    <script type="text/javascript" src="/templates/admin/js/script.js"></script>
</head>
<body>
  <div class="row">
    <div class="left col-sm-2">
      <h4 class="username"><?php echo $_SESSION['UserAuthenticate']['username'];?></h4>
      <ul class="ul-list-manage">
        <li class="li-list-manage" ><a href="/admin/category/?id=1"><i class="icon-cat fa fa-list-ul" aria-hidden="true"></i>Danh mục<span class="visited"></span></a></li>
        <li class="li-list-manage"><a href="/admin/news/?id=2"><i class="icon-cat fa fa-map" aria-hidden="true"></i>Bài viết<span class="visited"></span></a></li>
        <li class="li-list-manage"><a href="/admin/users/?id=3"><i class="icon-cat fa fa-user" aria-hidden="true"></i>Quản trị viên<span class="visited"></span></a></li>
        <li class="li-list-manage"><a href="/admin/advertisement/?id=4"><i class="icon-cat fa fa-money" aria-hidden="true"></i>Quảng cáo<span class="visited"></span></a></li>
      </ul>
    </div>
    <div class="right col-sm-10">
      <div class="header row">
        <?php
          $trang='QUẢN LÝ';
          if (!empty($_GET['id'])) {
            $id=$_GET['id'];
            switch ($id) {
              case 1:
                $trang="DANH MỤC";
                break;
              case 2:
                $trang="BÀI VIẾT";
                break;
              case 3:
                $trang="BÌNH LUẬN";
                break;
              case 4:
                $trang="QUẢN TRỊ VIÊN";
                break;
              
              default:
                $trang='';
                break;
            }
          }
        ?>
        <h4 class="col-sm-3 title-manage"><a href="#"><?php echo $trang; ?></a></h4>
        <div class="user-log col-sm-3 col-sm-offset-6">
          <ul class="ul-user-log">
            <!-- <li class="li-user-log"><a href="">Thông báo</a></li> -->
            <li class="li-user-log"><a href="/logout.php">Log out</a></li>
          </ul>
        </div>
      </div>
    <!--end header-->
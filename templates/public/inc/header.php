<?php 
    ob_start();
    session_start(); 
    require_once $_SERVER['DOCUMENT_ROOT'].'/functions/database.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/functions/session.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/functions/replace.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Sell & share</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="/libraries/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/libraries/reset.css">
    <link rel="stylesheet" type="text/css" href="/templates/public/css/style.css">
    <link rel="shortcut icon" href="/templates/public/images/icon.ico" type="image/x-icon">
    <script type="text/javascript" src="/libraries/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="/libraries/jquery.validate.min.js"></script>
    <script type="text/javascript" src="/libraries/ckeditor/ckeditor.js"></script>
    <script type="text/javascript" src="/templates/public/js/script.js"></script>
    <script type="text/javascript" src="/libraries/bxslider/bxslider/dist/jquery.bxslider.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/libraries/bxslider/bxslider/dist/jquery.bxslider.min.css">
    <link rel="stylesheet" type="text/css" href="/libraries/animate.css">
    <script type="text/javascript" src="/libraries/wow.min.js"></script>
    
</head>
<body>
    <!--header-->
    <div class="top-header row">
        <div class="left-top-header">
            <ul class="row">
                <li><a href="/abouts" >Giới thiệu</a></li>
                <li><a href="/guide" >Hướng dẫn</a></li>
                <li><a href="/support" >Hỏi - Đáp</a></li>
                <li><a href="/contact" >Liên hệ</a></li>
            </ul>
        </div>
        <div class="right-top-header">
            <div class="fa fa-user-circle-o"></div>
            <div class="user-log">
                <?php if ($session->has('UserAuthenticate')) { ?>
                <a href="<?php echo '/timeline/' . convertUtf8ToLatin($session->get('UserAuthenticate')['username']) . '-' . $session->get('UserAuthenticate')['id'] ?>">
                    <?php echo $session->get('UserAuthenticate')['username'] ?>
                </a> | 
                <a href="#" id="logout-btn">Đăng xuất</a>
                <form action="/functions/auth.php" id="logout-form" method="POST">
                    <input type="hidden" name="logout">
                </form>
                <?php } else { ?>
                    <a href="/login">Đăng kí</a> / <a href="/login">Đăng nhập</a>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="center-header row">
        <div class="left-center-header">
            <a href="/"><img src="/templates/public/images/logo.png" alt=""></a>
        </div>
        <div class="right-center-header">
            <div class="search row">
                <?php
                    if(isset($_POST['tim'])){
                        $idCat = $_POST['danhmuc'];
                        $str = $_POST['timkiem'];
                        $url = "/search/" . $str . '-' . $idCat;
                        header("location:{$url}");
                    }
                ?>
                <form method="POST" action="">
                    <input type="text" name="timkiem" class="timkiem" id="timkiem" placeholder="Nhập từ khóa tìm kiếm..." />
                    <select class="danhmuc-search" name="danhmuc">
                        <option value="0">Tất cả</option>
                        <?php
                            $result = $DB->select("SELECT * FROM category");

                            foreach ($result as $category) { 
                        ?>
                            <option value="<?php echo $category['id']?>">
                                <?php echo $category['name'] ?>
                            </option>
                        <?php }?>
                    </select>
                    <button type="submit" id="tim" class="fa fa-search tim" name="tim"></button>
                </form>
            </div>
        </div>
        <div class="upnew-button">
            <a href="/postnews">Đăng tin mới</a>
        </div>
    </div>
    <div class="tail-header">
        <ul>
            <li><a href="/" class="fa fa-home"></a></li>
            <li><a href="/category/vat-nuoi-1" class="fa fa-user-md"></span> Bác sĩ</a></li>
            <li><a href="/category/xe-co-2" class="fa fa-shopping-cart"> Bán hàng</a></li>
            <li><a href="/category/dien-tu-3" class="fa fa-podcast"> Bảo hiểm</a></li>
            <li><a href="/category/bat-dong-san-4" class="fa fa-home"> Bất động sản</a></li>
            <li><a href="/category/the-thao-5" class="fa fa-users"> Phiên dịch</a></li>
            <li><a href="/category/thoi-trang-6" class="fa fa-ship"> Cơ khí</a></li>
            <li><a href="/category/tuyen-dung-7" class="fa fa-shirtsinbulk"> Dệt may, giày da</a></li>
            <li><a href="/category/thuc-pham-8" class="fa fa-user-circle"> Dược sĩ</a></li>
            <li><a href="/category/noi-ngoai-that-9" class="fa fa-laptop"> Công nghệ thông tin</a></li>
            <li><a href="/category/khac-10" class="fa fa-gift"> Khác</a></li>
        </ul>
    </div>
    <!--end header-->
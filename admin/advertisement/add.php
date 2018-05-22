<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/admin/inc/header.php"; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT']."/functions/checkuser.php"; ?>
    <!--content-->
    <div class="content">
        <h2 class="tit"><i class="icon-cat fa fa-money"></i>  Thêm quảng cáo</h2>
        <br/>
        <form method="post" action="process.php" class="form-addQc" enctype="multipart/form-data">
            <label class="left-login">Công ty quảng cáo : (*)</label>
            <div class="right-login">
                <input class="input-right" type="text" name="company" value="">
                <label for="company" class="error"></label>
            </div>
            <div class="clr"></div>
            <label class="left-login">Website: (*)</label>
            <div class="right-login">
                <input class="input-right" type="text" name="link" value="">
                <label for="link" class="error"></label>
            </div>
            <div class="clr"></div>
            <div class="clr"></div>
            <label class="left-login">Picture: (*)</label>
            <div class="right-login">
                <input class="input-right" type="file" name="picture" >
            </div>
            <div class="clr"></div>
            <br/>
            <input type="submit" class="button" name="add" value="Add">
        </form>
    </div>
    <!--end content-->
    <?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/admin/inc/footer.php"?>
<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/admin/inc/header.php"; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT']."/functions/checkuser.php"; ?>
    <!--content-->
    <div class="content">
        <h2 class="tit"><i class="icon-cat fa fa-money"></i>  Sửa Quảng cáo</h2>
        <br/>
        <?php
            if(!empty($_GET['idQc'])){
                $idQc = $_GET['idQc'];
            }else{
                header("location:index.php");
            }

            $queryQc= "SELECT * FROM advertisement WHERE id = '{$idQc}'";
            $result = $DB->select($queryQc)[0];
            $company = $result['company'];
            $picture = $result['picture'];
            $link = $result['link'];
            $urlPicture = '/files/'  .$picture;
        ?>
        <form method="post" action="process.php" class="form-editQc" enctype="multipart/form-data">
            <input type="hidden" name="advertisement_id" value="<?php echo $idQc ?>">
            <label class="left-login">Công ty quảng cáo : (*)</label>
            <div class="right-login">
                <input class="input-right" type="text" name="company" value="<?php echo $company?>">
                <label for="company" class="error"></label>
            </div>
            <div class="clr"></div>
            <label class="left-login">Website: (*)</label>
            <div class="right-login">
                <input class="input-right" type="text" name="link" value="<?php echo $link?>">
                <label for="link" class="error"></label>
            </div>
            <div class="clr"></div>
            
            <?php if ($picture != '') { ?>
                <div class="clr"></div>
                <label class="left-login">Old picture:</label>
                <div class="right-login">
                    <img src="<?php echo $urlPicture?>" style="height: 50px;">
                </div>
            <?php } ?>
            <div class="clr"></div>
            <label class="left-login">New picture:</label>
            <div class="right-login">
                <input class="input-right" type="file" name="picture" >
            </div>
            <div class="clr"></div>
            <br/>
            <input type="submit" class="button" name="edit" value="Edit">
        </form>
    </div>
    <!--end content-->
    <?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/admin/inc/footer.php"?>
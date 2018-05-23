<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/admin/inc/header.php"; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT']."/functions/checkuser.php"; ?>
    <!--content-->
    <div class="content">
        <h2 class="tit"><i class="fa fa-shopping-cart"></i>  Thêm tin tuyển dụng</h2>
        <form method="post" action="process.php" class="form-addtin" enctype="multipart/form-data">
            <label class="left-login">Name : (*)</label>
            <div class="right-login">
                <input class="input-right" type="text" name="name">
                <label for="name" class="error"></label>
            </div>
            <div class="clr"></div>
            <label class="left-login">Category: (*)</label>
            <div class="right-login">
                <select id="danhmuc" class="input-right" name="category_id">
                    <option value="">--Choice category--</option>
                    <?php
                        $result = $DB->select("SELECT * FROM category");

                        foreach ($result as $category) { 
                    ?>
                        <option value="<?php echo $category['id']?>">
                            <?php echo $category['name'] ?>
                        </option>
                    <?php }?>
                </select>
                <label for="category_id" class="error"></label>
            </div>
            <div class="clr"></div>
            <label class="left-login">Salary: (*)</label>
            <div class="right-login">
                <input class="input-right" type="text" name="salary">
                <label for="gia" class="error"></label>
            </div>
            <div class="clr"></div>
            <label class="left-login">Location: (*)</label>
            <div class="right-login">
                <input class="input-right" type="text" name="location">
                <label for="location" class="error"></label>
            </div>
            <div class="clr"></div>
            <label class="left-login">Phone: (*)</label>
            <div class="right-login">
                <input class="input-right" type="text" name="phone">
                <label for="phone" class="error"></label>
            </div>
            <div class="clr"></div>
            <label class="left-login">Picture: </label>
            <div class="right-login">
                <input class="input-right" type="file" name="picture">
            </div>
            <div class="clr"></div>
            <label class="left-login">Description: (*)</label>
            <div class="right-login">
                <textarea class="mota ckeditor" name="description"></textarea>
                <label for="description" class="error"></label>
            </div>
            <div class="clr"></div>
            <input type="submit" class="button" name="add" value="Add">
        </form>
    </div>
    <!--end content-->
    <?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/admin/inc/footer.php"?>
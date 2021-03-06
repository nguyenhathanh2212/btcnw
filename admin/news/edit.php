<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/admin/inc/header.php"?>
<?php require_once $_SERVER['DOCUMENT_ROOT']."/functions/checkuser.php" ?>
    <!--content-->
    <div class="content">
        <h2 class="tit"><i class="fa fa-shopping-cart"></i>  Sửa tin</h2>
        <?php
            if (!empty($_GET['idTin'])) {
                $idTin=$_GET['idTin'];
            } else {
                header("location: /admin/news/index.php");
            }

            $queryTin= "SELECT recruitment.*, category.name FROM recruitment 
                INNER JOIN category ON recruitment.category_id = category.id 
                WHERE recruitment.id = '{$idTin}'";
            $recruitment = $DB->select($queryTin)[0];
            $title = $recruitment['title'];
            $name = $recruitment['name'];
            $salary = $recruitment['salary'];
            $location = $recruitment['location'];
            $picture = $recruitment['picture'];
            $urlPicture = '/files/' . $picture;
            $description = $recruitment['description'];
            $phone = $recruitment['phone'];
        ?>

        <form method="post" action="process.php" class="form-addtin" enctype="multipart/form-data">
            <input type="hidden" name="idTin" value="<?php echo $idTin ?>">
            <label class="left-login">Name : (*)</label>
            <div class="right-login">
                <input class="input-right" type="text" name="name" value="<?php echo $title ?>">
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
                            $selected='';

                            if($category['name'] == $name){
                                $selected = 'selected';
                            }
                    ?>
                        <option <?php echo $selected ?> value="<?php echo $category['id']?>">
                            <?php echo $category['name'] ?>
                        </option>
                    <?php }?>
                </select>
                <label for="category_id" class="error"></label>
            </div>
            <div class="clr"></div>
            <label class="left-login">Salary: (*)</label>
            <div class="right-login">
                <input class="input-right" type="text" name="salary" value="<?php echo $salary ?>">
                <label for="gia" class="error"></label>
            </div>
            <div class="clr"></div>
            <label class="left-login">Location: (*)</label>
            <div class="right-login">
                <input class="input-right" type="text" name="location" value="<?php echo $location ?>">
                <label for="location" class="error"></label>
            </div>
            <div class="clr"></div>
            <label class="left-login">Phone: (*)</label>
            <div class="right-login">
                <input class="input-right" type="text" name="phone" value="<?php echo $phone ?>">
                <label for="phone" class="error"></label>
            </div>
            <div class="clr"></div>
            <?php if($picture!='') { ?>
                <div class="clr"></div>
                <label class="left-login">Old picture:</label>
                <div class="right-login">
                    <img src="<?php echo $urlPicture ?>" style="height: 50px;">
                </div>
            <?php }?>
            <div class="clr"></div>
            <label class="left-login">New picture: </label>
            <div class="right-login">
                <input class="input-right" type="file" name="picture">
            </div>
            <div class="clr"></div>
            <label class="left-login">Description: (*)</label>
            <div class="right-login">
                <textarea class="mota ckeditor" name="description"><?php echo $description ?></textarea>
                <label for="description" class="error"></label>
            </div>
            <div class="clr"></div>
            <input type="submit" class="button" name="edit" value="Edit">
        </form>
    </div>
    <!--end content-->
    <?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/admin/inc/footer.php"?>
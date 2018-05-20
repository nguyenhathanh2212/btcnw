<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/admin/inc/header.php" ?>
<?php require_once $_SERVER['DOCUMENT_ROOT']."/functions/checkuser.php" ?>
    <!--content-->
        <div class="alert alert-success">
                xxx
            </div>
    <div class="content">
        <?php if ($session->has('successMsg')) { ?>
            <div class="alert alert-success">
                <?php echo $session->get('successMsg') ?> 
            </div>
            <?php $session->remove('successMsg') ?>
        <?php } ?>
        <?php if ($session->has('errorMsg')) { ?>
            <div class="alert alert-danger">
                <?php echo $session->get('errorMsg') ?> 
            </div>
            <?php $session->remove('errorMsg') ?>
        <?php } ?>
        <table class="tb-admin" width="100%">
            <tr>
                <th width="3%">
                    <input type="checkbox" class="checkbox-delete-all" >
                </th>   
                <th width="30%">ID danh mục</th>
                <th width="50%">Tên danh mục</th>
                <th width="20%">Chức năng</th>
            </tr>
            <?php
                $sql = 'SELECT * FROM category ORDER BY id ASC';

                $data = $DB->select($sql);
            ?>
            <?php if (!count($data)) {?>
                <tr>
                    <th colspan="5" class="no-result-search">Không có kết quả nào</th>
                </tr>
            <?php } ?>
            <?php foreach ($data as $key => $value) { ?>
                <tr>
                    <td>
                        <input type="checkbox" class="checkbox-delete" val="<?php echo $value['id'] ?>">
                    </td>
                    <td><?php echo '#' . ($key + 1) ?></td>
                    <td><?php echo $value['name']; ?></td>
                    <td >
                        <a href="edit.php?idCate=<?php echo $value['id'] ?>" class="fa fa-pencil">Sửa</a>
                    </td>
                </tr>   
            <?php   }?>
        </table>
      </div>
	<!--end content-->
<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/admin/inc/footer.php"?>
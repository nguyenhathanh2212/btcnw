<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/admin/inc/header.php" ?>
<?php require_once $_SERVER['DOCUMENT_ROOT']."/functions/checkuser.php" ?>
    
    <?php if ($session->has('msgSuccess')) { ?>
        <div class="alert-message success">
            <?php echo $session->get('msgSuccess'); ?>
            <?php $session->remove('msgSuccess'); ?>
        </div>
    <?php } ?>
    <?php if ($session->has('msgError')) { ?>
        <div class="alert-message error">
            <?php echo $session->get('msgError'); ?>
            <?php $session->remove('msgError'); ?>
        </div>
    <?php } ?>      
    <!--content-->
    <div class="content">
        <table class="tb-admin" width="100%" border="1">
            <tr>
                <th width="20%">STT</th>
                <th width="50%">Tên danh mục</th>
                <th width="40%">Chức năng</th>
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
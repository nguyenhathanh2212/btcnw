<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/admin/inc/header.php" ?>
<?php require_once $_SERVER['DOCUMENT_ROOT']."/functions/checkuser.php" ?>
    <!--content-->
  	<div class="content">
        <?php
            if(!empty($_GET['msg'])){
                echo $_GET['msg'];
            }
        ?>
        <table class="tb-admin" width="100%">
            <tr>
                <th width="30%">ID danh mục</th>
                <th width="50%">Tên danh mục</th>
                <th width="20%">Chức năng</th>
            </tr>
            <?php 
                $queryCate = "SELECT * FROM danhmucsanpham ORDER BY id_danhmuc ASC";
                        $resultCate = $mySQLI->query($queryCate);
                        while ($arCate = mysqli_fetch_assoc($resultCate)) {
                            $idCate = $arCate['id_danhmuc'];
                            $nameCate = $arCate['tendanhmuc'];
            ?>
                <tr>
                    <td><?php echo $idCate;?></td>
                    <td><?php echo $nameCate;?></td>
                    <td >
                        <a href="edit.php?idCate=<?php echo $idCate?>" class="fa fa-pencil">Sửa</a>
                    </td>
                </tr>   
            <?php   }?>
        </table>
      </div>
	<!--end content-->
<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/admin/inc/footer.php"?>
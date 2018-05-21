<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/admin/inc/header.php"; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT']."/functions/checkuser.php"; ?>
<?php
    if (!empty($_GET['idCmt'])) {
        $idCmt = $_GET['idCmt'];
        
        if($DB->delete('comment', "id = {$idCmt}")){
             $session->set('msgSuccess', 'Xóa thành công!');
        } else {
            $session->set('msgError', 'Xóa thất bại!');
        }

        header("location: /admin/news/");
        exit();
    } else {
        header('location: /admin/comment/index.php');
    }
?>
<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/admin/inc/footer.php" ?>
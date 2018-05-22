<?php 
    require_once $_SERVER['DOCUMENT_ROOT'].'/functions/database.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/functions/session.php';

    if(isset($_POST['add'])){
        $company = $_POST['company'];
        $link = $_POST['link'];
        $picture = $_FILES['picture']['name'];
        //xu lý ảnh
        $arPic = explode(".", $picture);
        $endPic = end($arPic);
        $newPicName = 'QC-' . time() . '.' . $endPic;
        $path_upload = $_SERVER['DOCUMENT_ROOT'] . '/files/' . $newPicName;
        $tmp_name = $_FILES['picture']['tmp_name'];
        move_uploaded_file($tmp_name, $path_upload);

        //xử lý lấy ngày tháng hiện tại
        $date = date("Y") . '-' . date("m") . '-' . date("d");

        $result = $DB->create('advertisement', [
            'company' => $company,
            'link' => $link,
            'picture' => $newPicName,
        ]);

        if ($result) {
            $session->set('msgSuccess', 'Thêm quảng cáo thành công!');
        } else {
            $session->set('msgError', 'Đăng quảng cáo thất bại!');
        }

        header("location: /admin/advertisement/");
        exit();
    }

    if(isset($_POST['edit'])) {
        $newCompany = $_POST['company'];
        $newLink = $_POST['link'];
        $newPicture = $_FILES['picture']['name'];
        $advertisementId = $_POST['advertisement_id'];

        $data = [
            'company' => $newCompany,
            'link' => $newLink,
        ];

        if ($newPicture != '') {
            unlink($_SERVER['DOCUMENT_ROOT'].'/files/'.$picture);
            $arPic = explode(".", $newPicture);
            $endPic = end($arPic);
            $newPicName = 'QC-' . time() . '.' . $endPic;
            $path_upload = $_SERVER['DOCUMENT_ROOT'] . '/files/' . $newPicName;
            $tmp_name=$_FILES['picture']['tmp_name'];
            move_uploaded_file($tmp_name,$path_upload);
            $data['picture'] = $newPicName;
        }

        $result = $DB->update('advertisement', $data, "id = {$advertisementId}");

        if ($result) {
            $session->set('msgSuccess', 'Sửa quảng cáo thành công!');
        } else {
            $session->set('msgError', 'Sửa quảng cáo thất bại!');
        }

        header("location: /admin/advertisement/");
        exit();
    }
?>

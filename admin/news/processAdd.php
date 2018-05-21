<?php 
    require_once $_SERVER['DOCUMENT_ROOT'].'/functions/database.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/functions/session.php';

    if (isset($_POST['add'])) {
        $name = $_POST['name'];
        $categoryId = $_POST['category_id'];
        $salary = $_POST['salary'];
        $location = $_POST['location'];
        $phone = $_POST['phone'];
        $picture = $_FILES['picture']['name'];
        $description = $_POST['description'];
        $userId = $session->get('UserAuthenticate')['id'];
        //xu lý ảnh
        if ($picture == '') {
            $newPicName = '';
        } else {
            $arPic = explode('.', $picture);
            $endPic = end($arPic);
            $newPicName = 'CNW-' . time() . '.' . $endPic;
            $path_upload = $_SERVER['DOCUMENT_ROOT'] . '/files/' . $newPicName;
            $tmp_name = $_FILES['picture']['tmp_name'];
            move_uploaded_file($tmp_name,$path_upload);
        }
        //xử lý lấy ngày tháng hiện tại
        $created_at = date("Y") . '-' . date("m") . '-' . date("d");
        
        $result = $DB->create('recruitment', [
            'title' => $name,
            'category_id' => $categoryId,
            'salary' => $salary,
            'location' => $location,
            'phone' => $phone,
            'picture' => $newPicName,
            'created_at' => $created_at,
            'description' => $description,
            'user_id' => $userId,
        ]);

        if ($result) {
            $session->set('msgSuccess', 'Thêm tin thành công!');
        } else {
            $session->set('msgError', 'Đăng tin thất bại!');
        }

        header("location: /admin/news/");
        exit();
    }
?>

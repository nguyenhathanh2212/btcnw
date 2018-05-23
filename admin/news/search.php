<?php

	require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/database.php';
	require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/session.php';
	require_once $_SERVER['DOCUMENT_ROOT']."/functions/replace.php";


	if (isset($_REQUEST['searchData'])) {
		$searchData = isset($_REQUEST['searchData']) ? $_REQUEST['searchData']: '';

		$sql = "SELECT recruitment.*, username, name FROM recruitment 
				INNER JOIN category ON recruitment.category_id = category.id
				INNER JOIN users ON recruitment.user_id = users.id
				WHERE title LIKE '%{$searchData}%'
				OR username LIKE '%{$searchData}%'
				OR name LIKE '%{$searchData}%'";

		$data = $DB->select($sql);

		if (!count($data)) {
            echo '<td colspan="10" class="notice">Không có dữ liệu</td>';
        }

		$result = '';

		foreach ($data as $key => $value) {
			$result .= '<tr><td>';
			$result .= '<input type="checkbox" class="checkbox-delete"  val="' . $value['id'] . '"></td>';
            $result .= '<td>#' . ($key + 1) . '</td>';
			$result .= '<td>' . str_limit($value['title'], 30) . '</td>';
			$result .= '<td>' . $value['name'] . '</td>';
			$result .= '<td>' . $value['username'] . '</td>';
			$result .= '<td>' . $value['created_at'] . '</td>';

			if ($value['picture'] == '') {
				$value['picture'] = 'salemacdinh.png';
			}

			$result .= '<td><img style="height: 50px;"  src="/files/' . $value['picture'] . '" class="hoa" /></td>';
			$result .= '<td><a href="/admin/comment?idTin=' . $value['id'] . '" style="color: #00ff00; font-weight: bold;">Xem</a></td>';


			$result .= '<td><a href="edit.php?idTin=' . $value['id'] . '" class="fa fa-pencil">Sửa</a> | <a href="del.php?idTin=' . $value['id'] . '" onclick="return confirm(\'Bạn có chắc chắn muốn xóa tin ?\');" class="fa fa-trash">Xóa</a></td></tr>';
		}

		echo $result;
	} else {
		header('Location:index.php');
	}

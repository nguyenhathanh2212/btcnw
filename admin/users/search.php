<?php

	require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/database.php';
	require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/session.php';


	if (isset($_REQUEST['searchData'])) {
		$searchData = isset($_REQUEST['searchData']) ? $_REQUEST['searchData']: '';

		$sql = "SELECT * FROM users 
				WHERE username LIKE '%{$searchData}%'
				OR email LIKE '%{$searchData}%'";

		$data = $DB->select($sql);

		if (!count($data)) {
            echo '<td colspan="10" class="notice">Không có dữ liệu</td>';
        }

		$result = '';

		foreach ($data as $key => $value) {
			$result .= '<tr><td>';

			if ($value['active'] == 0) { 
                $result .= '<input type="checkbox" class="checkbox-delete"  val="' . $value['id'] . '" >';
            }

            $result .= '</td>';
            $result .= '<td>#' . ($key + 1) . '</td>';
			$result .= '<td>' . $value['username'] . '</td>';
			$result .= '<td>' . $value['email'] . '</td>';

			if ($value['avatar'] == '') {
				$value['avatar'] = 'avatarmacdinh.png';
			}

			$result .= '<td><img style="height: 50px;"  src="/files/' . $value['avatar'] . '" class="hoa" /></td>';
			$result .= '<td>';
			
			if ($value['active'] == 0) { 
                $result .= '<a href="del.php?idUser=' . $value['id'] . '" onclick="return confirm(\'Bạn có chắc chắn muốn xóa người dùng ?\');" class="fa fa-trash">Xóa</a>';
            } else {
                $result .= '<span class="label-role">Admin</span>';
            }

			$result .= '</td></tr>';
		}

		echo $result;
	} else {
		header('Location:index.php');
	}

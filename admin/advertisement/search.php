<?php

	require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/database.php';
	require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/session.php';


	if (isset($_REQUEST['searchData'])) {
		$searchData = isset($_REQUEST['searchData']) ? $_REQUEST['searchData']: '';

		$sql = "SELECT * FROM advertisement 
				WHERE company LIKE '%{$searchData}%'
				OR link LIKE '%{$searchData}%'";

		$data = $DB->select($sql);

		if (!count($data)) {
            echo '<td colspan="10" class="notice">Không có tin nào nào</td>';
        }

		$result = '';

		foreach ($data as $key => $value) {
			$result .= '<tr><td>';
			$result .= '<input type="checkbox" class="checkbox-delete"  val="' . $value['id'] . '"></td>';
            $result .= '<td>#' . ($key + 1) . '</td>';
			$result .= '<td>' . $value['company'] . '</td>';

			if ($value['picture'] == '') {
				$value['picture'] = 'salemacdinh.png';
			}

			$result .= '<td><img style="height: 50px;"  src="/files/' . $value['picture'] . '" class="hoa" /></td>';
			$result .= '<td><a href="http://' . $value['link'] . '" target="_blank" style="color: #22bf1f;">' . $value['link'] . '</a></td>';
			$result .= '<td ><a href="edit.php?idQc=' . $value['id'] . '" class="fa fa-pencil">Sửa</a> | <a href="del.php?idQc=' . $value['id'] . '" onclick="return confirm(\'Bạn có chắc chắn muốn xóa quảng cáo này ?\');" class="fa fa-trash">Xóa</a></td></tr>';
		}

		echo $result;
	} else {
		header('Location:index.php');
	}

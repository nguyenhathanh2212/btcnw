<?php
	function cutString($str, $limit=100, $dot = null, $strip = false) {
		$str = ($strip == true)?strip_tags($str):$str;
		if (strlen ($str) > $limit) {
			$str = substr ($str, 0, $limit).$dot;
			return $str;
		}
		return trim($str);
	}
?>
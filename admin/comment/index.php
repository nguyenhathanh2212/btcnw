<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/admin/inc/header.php" ?>
<?php require_once $_SERVER['DOCUMENT_ROOT']."/functions/checkuser.php" ?>
	
	<?php
		if(!empty($_GET['idTin'])){
			$idTin = $_GET['idTin'];
		} else {
			header('location:/admin/news');
			die();
		}
	?>

	<!--content-->
	<div class="content ">
		<?php
			if(!empty($_GET['msg'])){
				echo $_GET['msg'];
			}
		?>
		<table width="100%"  class="tb-admin">
			<tr>
				<th width="3%">ID</th>
	            <th width="15%">Tên Người Đăng</th>
	            <th width="15%">Email</th>
	            <th width="40%">Nội dung</th>
	            <th width="15%">Ngày Đăng</th>
	            <th width="12%">Chức năng</th>
			</tr>
			<?php
				$queryCmt= "SELECT * FROM comment WHERE id_tinraovat={$idTin} ORDER BY id_cmt ASC";
				$resultCmt=$mySQLI->query($queryCmt);
				while ($arCmt=mysqli_fetch_assoc($resultCmt)) {
					$idCmt = $arCmt['id_cmt'];
					$username = $arCmt['tennguoicmt'];
					$userMail =  $arCmt['email'];
					$content = $arCmt['noidung'];
					$dateUp = $arCmt['ngaycmt'];
			?>
				<tr>
					<td><?php echo $idCmt;?></td>
					<td><?php echo $username;?></td>
					<td><?php echo $userMail;?></td>
					<td><?php echo $content;?></td>
					<td><?php echo $dateUp;?></td>
					<td >
						<a href="del.php?idCmt=<?php echo $idCmt?>" onclick="return confirm('Bạn có chắc chắn muốn xóa bình luận ?');" class="fa fa-trash">Xóa</a>
					</td>
				</tr>	
			<?php	}?>
		</table>
	</div>
	<!--end content-->
	<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/admin/inc/footer.php"?>
<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/admin/inc/header.php"; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT']."/functions/checkuser.php"; ?>
	
<?php
	if (!empty($_GET['idTin'])) {
		$idTin = $_GET['idTin'];
	} else {
		header('location:/admin/news');
		die();
	}
?>

<!--content-->
<div class="content ">
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
			$queryCmt= "SELECT * FROM comment WHERE recruitment_id = {$idTin} ORDER BY id ASC";
			$results = $DB->select($queryCmt);
			foreach ($results as $result) {
		?>
			<tr>
				<td><?php echo $result['id'] ?></td>
				<td><?php echo $result['username'] ?></td>
				<td><?php echo $result['email'] ?></td>
				<td><?php echo $result['content'] ?></td>
				<td><?php echo $result['created_at'] ?></td>
				<td >
					<a href="del.php?idCmt=<?php echo $result['id'] ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa bình luận ?');" class="fa fa-trash">Xóa</a>
				</td>
			</tr>	
		<?php }?>
	</table>
    <?php 
        if (!$results) {
            echo "<div class='notice'>";
            echo "Không có comment nào";
            echo "</div>";
        }
    ?>
</div>
<!--end content-->
<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/admin/inc/footer.php"?>

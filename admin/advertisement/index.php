<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/admin/inc/header.php"; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT']."/functions/checkuser.php"; ?>
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
	<!--content-->
	<div class="content">
		<div class="header-content">
			<a class="add" href="add.php"><i class="fa fa-plus" aria-hidden="true"></i> Thêm</a>
			<a class="delete-all" href="" id="delete-all-advertisements"><i class="fa fa-trash" aria-hidden="true"></i> Xóa tất cả</a>
			<input type="text" name="search" class="search-box" id="search-advertisements" placeholder="Nhập nội dung tìm kiếm...">
		</div>
		<table width="100%"  class="tb-admin">
			<tr>
				<th width="3%">
                    <input type="checkbox" class="checkbox-delete-all">
                </th>
				<th width="5%">STT</th>
	            <th width="25%">Công ty quảng cáo</th>
	            <th width="25%">Ảnh quảng cáo</th>
	            <th width="25%">Website</th>
	            <th width="12%">Chức năng</th>
			</tr>
			<?php
				$queryQc = "SELECT * FROM advertisement ORDER BY id DESC";
				$results = $DB->select($queryQc);
			?>

			<tbody id="show-advertisements">
				<?php foreach ($results as $key =>  $result) { ?>
					<tr>
						<td>
	                        <input type="checkbox" class="checkbox-delete"  val="<?php echo $result['id'] ?>" >
	                    </td>
						<td>#<?php echo $key + 1 ?></td>
						<td><?php echo $result['company'] ?></td>
						<td>
							<img style="height: 50px;"  src="/files/<?php echo $result['picture']?>" class="hoa" />
						</td>
						<td><a href="http://<?php echo $result['link'] ?>" target="_blank" style="color: #22bf1f;"><?php echo $result['link'] ?></a></td>
						<td >
							<a href="edit.php?idQc=<?php echo $result['id'] ?>" class="fa fa-pencil">Sửa</a> |
							<a href="del.php?idQc=<?php echo $result['id'] ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa quảng cáo này ?');" class="fa fa-trash">Xóa</a>
						</td>
					</tr>	
				<?php }?>
			</tbody>
		</table>
	</div>
	<!--end content-->
	<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/admin/inc/footer.php"?>
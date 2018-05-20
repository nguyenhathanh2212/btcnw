<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/admin/inc/header.php"?>
<?php require_once $_SERVER['DOCUMENT_ROOT']."/functions/checkuser.php" ?>
	<!--content-->
	<div class="content ">
				<a class="add" href="add.php"><i class="fa fa-plus" aria-hidden="true"></i> Thêm</a>
				<?php
					if(!empty($_GET['msg'])){
						echo $_GET['msg'];
					}
				?>
				<table width="100%"  class="tb-admin">
					<tr>
						<th width="3%">ID</th>
			            <th width="25%">Công ty quảng cáo</th>
			            <th width="25%">Ảnh quảng cáo</th>
			            <th width="25%">Website</th>
			            <th width="12%">Chức năng</th>
					</tr>
					<?php
						$queryQc = "SELECT * FROM quangcao ORDER BY id_qc DESC";
						$resultQc = $mySQLI->query($queryQc);
						while ($arQc = mysqli_fetch_assoc($resultQc)) {
							$idQc = $arQc['id_qc'];
							$company = $arQc['congtyquangcao'];
							$picture = $arQc['anhquangcao'];
							$website = $arQc['website'];
					?>
						<tr>
							<td><?php echo $idQc;?></td>
							<td><?php echo $company;?></td>
							<td>
								<img style="height: 50px;"  src="/files/<?php echo $picture?>" class="hoa" />
							</td>
							<td><a href="http://<?php echo $website;?>" style="color: #22bf1f;"><?php echo $website;?></a></td>
							<td >
								<a href="edit.php?idQc=<?php echo $idQc?>" class="fa fa-pencil">Sửa</a> |
								<a href="del.php?idQc=<?php echo $idQc?>" onclick="return confirm('Bạn có chắc chắn muốn xóa quảng cáo này ?');" class="fa fa-trash">Xóa</a>
							</td>
						</tr>	
					<?php	}?>
				</table>
	</div>
	<!--end content-->
	<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/admin/inc/footer.php"?>
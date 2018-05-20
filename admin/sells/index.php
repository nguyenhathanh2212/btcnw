<?php require_once $_SERVER['DOCUMENT_ROOT']."/TTCN/templates/admin/inc/header.php"?>
	<!--content-->
	<div class="content row">
		<?php require_once $_SERVER['DOCUMENT_ROOT']."/TTCN/templates/admin/inc/left-bar.php"?>
		<div class="content-right col-sm-10">
				<div class="header-title">
					<div class="fa fa-shopping-cart"></div>
					<h2 class="tit">Danh sách Tin</h2>
				</div>
				<?php
					if(!empty($_GET['msg'])){
						echo $_GET['msg'];
					}
				?>
				<table width="100%"  class="goods">
					<tr>
						<th>ID</th>
						<th>Tên</th>
						<th>Danh mục</th>
						<th>Hình ảnh</th>
						<th>Người đăng</th>
						<th>Chức năng</th>
					</tr>
					<?php
						$queryTin= "SELECT * FROM tinraovat 
							INNER JOIN danhmucsanpham ON tinraovat.id_danhmucsanpham=danhmucsanpham.id_danhmuc 
							INNER JOIN users ON tinraovat.id_user=users.id_user 
							ORDER BY id_tinraovat DESC";
						$resultTin=$mySQLI->query($queryTin);
						while ($arTin=mysqli_fetch_assoc($resultTin)) {
							$idTin=$arTin['id_tinraovat'];
							$tenTin=$arTin['tentinraovat'];
							$tenDanhmuc=$arTin['tendanhmuc'];
							$hinhAnh=$arTin['picture'];
							$nguoiDang=$arTin['username'];
					?>
						<tr>
							<td><?php echo $idTin;?></td>
							<td><?php echo $tenTin;?></td>
							<td><?php echo $tenDanhmuc;?></td>
							<td><?php 
								if($hinhAnh==''){ ?>
									<img style="height: 50px;" src="/TTCN/files/salemacdinh.png" class="hoa" />
								<?php }else{
							?>
							<img style="height: 50px;"  src="/TTCN/files/<?php echo $hinhAnh?>" class="hoa" />
							<?php }?></td>
							<td><?php echo $nguoiDang;?></td>
							<td >
								<a href="edit.php?idTin=<?php echo $idTin?>" class="fa fa-pencil">Sửa</a> |
								<a href="del.php?idTin=<?php echo $idTin?>" onclick="return confirm('Bạn có chắc chắn muốn xóa tin ?');" class="fa fa-trash">Xóa</a>
							</td>
						</tr>	
					<?php	}?>
				</table>
			</div>
	</div>
	<!--end content-->
	<?php require_once $_SERVER['DOCUMENT_ROOT']."/TTCN/templates/admin/inc/footer.php"?>
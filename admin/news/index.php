<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/admin/inc/header.php" ?>
<?php require_once $_SERVER['DOCUMENT_ROOT']."/functions/checkuser.php" ?>
<?php
    $idUser=$_SESSION['arUser']['id_user'];
    $queryPage="SELECT COUNT(id_tinraovat) AS sotin FROM tinraovat";
	$resultPage=$mySQLI->query($queryPage);
	$arSoTin=mysqli_fetch_assoc($resultPage);
	$rowCount=ROW_COUNT_ADMIN;
	$pageCount=ceil($arSoTin['sotin']/$rowCount);
	$currentPage=1;
	if(!empty($_GET['idpage'])){
		$currentPage=$_GET['idpage'];
	}

	if(!empty($_GET['filter'])){
		$filter=$_GET['filter'];
	}else {
		$filter=1;
	}
?>
	<!--content-->
	<div class="content ">
		<div class="header-content">
			<a class="add" href="add.php"><i class="fa fa-plus" aria-hidden="true"></i> Thêm</a>
			<?php
				if(!empty($_GET['msg'])){
					echo $_GET['msg'];
				}
			?>
			<div class="select-sort-new">
				<ul>
					<li><a href="index.php?idpage=<?php echo $currentPage ?>&filter=1" <?php if($filter==1){echo "class='sort-active'";} ?>>Tin mới</a></li>
					<li><a href="index.php?idpage=<?php echo $currentPage ?>&filter=2" <?php if($filter==2){echo "class='sort-active'";} ?>>Tin cũ</a></li>
					<li><a href="index.php?idpage=<?php echo $currentPage ?>&filter=3" <?php if($filter==3){echo "class='sort-active'";} ?>>Danh mục</a></li>
					<li><a href="index.php?idpage=<?php echo $currentPage ?>&filter=4" <?php if($filter==4){echo "class='sort-active'";} ?>>Người đăng</a></li>
				</ul>
			</div>
		</div>
		<table width="100%"  class="tb-admin">
			<tr>
				<th width="3%">ID</th>
	            <th width="38%">Tên bài viết</th>
	            <th width="9%">Danh mục</th>
	            <th width="9%">User Đăng</th>
	            <th width="10%">Ngày đăng</th>
	            <th width="10%">Hình ảnh</th>
	            <th width="9%">Bình luận</th>
	            <th width="12%">Chức năng</th>
			</tr>
			<?php
				$offset=($currentPage-1)*$rowCount;
				switch ($filter) {
					case 1:
						$queryTin="SELECT * FROM tinraovat  
						INNER JOIN danhmucsanpham ON tinraovat.id_danhmucsanpham=danhmucsanpham.id_danhmuc 
						INNER JOIN users ON tinraovat.id_user=users.id_user 
						ORDER BY id_tinraovat DESC LIMIT {$offset},{$rowCount}";
						break;
					case 2:
						$queryTin="SELECT * FROM tinraovat 
						INNER JOIN danhmucsanpham ON tinraovat.id_danhmucsanpham=danhmucsanpham.id_danhmuc 
						INNER JOIN users ON tinraovat.id_user=users.id_user  
						ORDER BY id_tinraovat ASC LIMIT {$offset},{$rowCount}";
						break;
					case 3:
						$queryTin="SELECT * FROM tinraovat
						INNER JOIN danhmucsanpham ON tinraovat.id_danhmucsanpham=danhmucsanpham.id_danhmuc 
						INNER JOIN users ON tinraovat.id_user=users.id_user   
						ORDER BY id_danhmucsanpham ASC LIMIT {$offset},{$rowCount}";
						break;	
					case 4:
						$queryTin="SELECT * FROM tinraovat
						INNER JOIN danhmucsanpham ON tinraovat.id_danhmucsanpham=danhmucsanpham.id_danhmuc 
						INNER JOIN users ON tinraovat.id_user=users.id_user   
						ORDER BY tinraovat.id_user ASC LIMIT {$offset},{$rowCount}";
						break;	
				}
				$resultTin=$mySQLI->query($queryTin);
				while ($arTin=mysqli_fetch_assoc($resultTin)) {
					$idTin=$arTin['id_tinraovat'];
					$tenTin=$arTin['tentinraovat'];
					$tenDanhmuc=$arTin['tendanhmuc'];
					$ngayDang=$arTin['ngaydang'];
					$hinhAnh=$arTin['picture'];
					$nguoiDang=$arTin['username'];
			?>
				<tr>
					<td><?php echo $idTin;?></td>
					<td><?php echo $tenTin;?></td>
					<td><?php echo $tenDanhmuc;?></td>
					<td><?php echo $nguoiDang;?></td>
					<td><?php echo $ngayDang;?></td>
					<td><?php 
						if($hinhAnh==''){ ?>
							<img style="height: 50px;" src="/files/salemacdinh.png" class="hoa" />
						<?php }else{
					?>
					<img style="height: 50px;"  src="/files/<?php echo $hinhAnh?>" class="hoa" />
					<?php }?></td>
					<td><a href="/admin/comment?idTin=<?php echo $idTin;?>" style="color: #00ff00; font-weight: bold;">Xem</a></td>
					<td >
						<a href="edit.php?idTin=<?php echo $idTin?>" class="fa fa-pencil">Sửa</a> |
						<a href="del.php?idTin=<?php echo $idTin?>" onclick="return confirm('Bạn có chắc chắn muốn xóa tin ?');" class="fa fa-trash">Xóa</a>
					</td>
				</tr>	
			<?php	}?>
		</table>
		<div class="pagination">           
			<div class="numbers">
				<span>Trang:</span> 
				<?php
					for($i=1;$i<=$pageCount;$i++){
						$current="";
						if($i==$currentPage){
							$current='current';
						}
				?>
				<a href="index.php?idpage=<?php echo $i . '&filter=' . $filter  ?>" class="<?php echo $current?>"><?php echo $i?></a> 
				<span>|</span> 
				<?php }?>   
			</div> 
			<div style="clear: both;"></div> 
 		</div>
	</div>
	<!--end content-->
	<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/admin/inc/footer.php"?>
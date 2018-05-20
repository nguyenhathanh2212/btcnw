<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/admin/inc/header.php"?>
<?php require_once $_SERVER['DOCUMENT_ROOT']."/functions/checkuser.php" ?>
	<!--content-->
	<div class="content">
			
			<h2 class="tit"><i class="fa fa-shopping-cart"></i>  Thêm tin</h2>
			<?php 
				if(isset($_POST['add'])){
					$tenTin=$_POST['ten'];
					$idDanhMuc=$_POST['danhmuc'];
					$gia=$_POST['gia'];
					$noiBan=$_POST['noiban'];
					$sDT=$_POST['sodienthoai'];
					$picture=$_FILES['picture']['name'];
					$moTa=$_POST['mota'];
					//xu lý ảnh
					if($picture==""){
						$newPicName='';
					}else {
						$arPic=explode(".", $picture);
						$endPic=end($arPic);
						$newPicName='TDK-'.time().'.'.$endPic;
						$path_upload=$_SERVER['DOCUMENT_ROOT'].'/files/'.$newPicName;
						$tmp_name=$_FILES['picture']['tmp_name'];
						move_uploaded_file($tmp_name,$path_upload);
					}
					//xử lý lấy ngày tháng hiện tại
					$date=date("Y").'-'.date("m").'-'.date("d");
					$query="INSERT INTO tinraovat(tentinraovat,id_danhmucsanpham,ngaydang,gia,noiban,sodienthoai,id_user,mota,picture)
					VALUES ('{$tenTin}','{$idDanhMuc}','{$date}','{$gia}','{$noiBan}','{$sDT}','1','{$moTa}','{$newPicName}')";
					if($mySQLI->query($query)){
						header("location:index.php?msg=Thêm thành công");
					}else{
						header("location:index.php?msg=Thêm thât bại");
					}
				}
			?>
			<form method="post" action="" class="form-addtin" enctype="multipart/form-data">
					<label class="left-login">Tên : (*)</label>
					<div class="right-login">
						<input class="input-right" type="text" name="ten">
						<br/ ><label for="ten" class="error"></label>
					</div>
					<div class="clr"></div>
					<label class="left-login">Danh mục: (*)</label>
					<div class="right-login">
						<select name="danhmuc" id="danhmuc" class="input-right">
							<option value="" >--Chọn danh mục--</option>
							<?php
								$queryDM="SELECT * FROM danhmucsanpham";
								$resuitDM=$mySQLI->query($queryDM);
								while ($arDM=mysqli_fetch_assoc($resuitDM)) {
									$idDM=$arDM['id_danhmuc'];
									$tenDM=$arDM['tendanhmuc'];
								?>
								<option value="<?php echo $idDM?>"><?php echo $tenDM?></option>
								<?php }?>
							?>
						</select>
						<br/ ><label for="danhmuc" class="error"></label>
					</div>
					<div class="clr"></div>
					<label class="left-login">Giá: (*)</label>
					<div class="right-login">
						<input class="input-right" type="text" name="gia">
						<br/ ><label for="gia" class="error"></label>
					</div>
					<div class="clr"></div>
					<label class="left-login">Nơi bán: (*)</label>
					<div class="right-login">
						<input class="input-right" type="text" name="noiban">
						<br/ ><label for="noiban" class="error"></label>
					</div>
					<div class="clr"></div>
					<label class="left-login">Số điện thoại: (*)</label>
					<div class="right-login">
						<input class="input-right" type="text" name="sodienthoai">
						<br/ ><label for="sodienthoai" class="error"></label>
					</div>
					<div class="clr"></div>
					<label class="left-login">Picture: </label>
					<div class="right-login">
						<input class="input-right" type="file" name="picture">
					</div>
					<div class="clr"></div>
					<label class="left-login">Mô tả: (*)</label>
					<div class="right-login">
						<textarea class="mota ckeditor" name="mota"></textarea>
						<br/ ><label for="mota" class="error"></label>
					</div>
					<div class="clr"></div>
					<input type="submit" class="button" name="add" value="Add">
			</form>
	</div>
	<!--end content-->
	<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/admin/inc/footer.php"?>
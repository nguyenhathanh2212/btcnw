<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/admin/inc/header.php"?>
<?php require_once $_SERVER['DOCUMENT_ROOT']."/functions/checkuser.php" ?>
	<!--content-->
	<div class="content">
			
			<h2 class="tit"><i class="fa fa-shopping-cart"></i>  Sửa tin</h2>
			<?php
				if(!empty($_GET['idTin'])){
					$idTin=$_GET['idTin'];
				}else{
					header("location:index.php");
				}
				$queryTin= "SELECT * FROM tinraovat 
							INNER JOIN danhmucsanpham ON tinraovat.id_danhmucsanpham=danhmucsanpham.id_danhmuc 
							WHERE id_tinraovat='{$idTin}'";
							$resultTin=$mySQLI->query($queryTin);
							$arTin=mysqli_fetch_assoc($resultTin);
							$tenTin=$arTin['tentinraovat'];
							$tenDanhmuc=$arTin['tendanhmuc'];
							$gia=$arTin['gia'];
							$noiBan=$arTin['noiban'];
							$hinhAnh=$arTin['picture'];
							$urlHinhAnh='/files/'.$hinhAnh;
							$moTa=$arTin['mota'];
							$soDienThoai=$arTin['sodienthoai'];
			?>
			<?php
				if(isset($_POST['edit'])){
					$tenTin=$_POST['ten'];
					$idDanhMuc=$_POST['danhmuc'];
					$gia=$_POST['gia'];
					$noiBan=$_POST['noiban'];
					$sDT=$_POST['sodienthoai'];
					$picture=$_FILES['picture']['name'];
					$moTa=$_POST['mota'];
					if($picture!=''){
						unlink($_SERVER['DOCUMENT_ROOT'].'/files/'.$hinhAnh);
						$arPic=explode(".", $picture);
						$endPic=end($arPic);
						$newPicName='TDK-'.time().'.'.$endPic;
						$path_upload=$_SERVER['DOCUMENT_ROOT'].'/files/'.$newPicName;
						$tmp_name=$_FILES['picture']['tmp_name'];
						move_uploaded_file($tmp_name,$path_upload);
						$query="UPDATE tinraovat SET tentinraovat='{$tenTin}',id_danhmucsanpham='{$idDanhMuc}',gia='{$gia}',noiban='{$noiBan}',sodienthoai='{$sDT}',mota='{$moTa}',picture='{$newPicName}' WHERE id_tinraovat={$idTin}";
					}else{
						$query="UPDATE tinraovat SET tentinraovat='{$tenTin}',id_danhmucsanpham='{$idDanhMuc}',gia='{$gia}',noiban='{$noiBan}',sodienthoai='{$sDT}',mota='{$moTa}' WHERE id_tinraovat={$idTin}";
					}
					if($mySQLI->query($query)){
						header("location:index.php?msg=Sửa thành công");
					}else{
						header("location:index.php?msg=Sửa thất bại");
					}
				}
			?>
			<form method="post" action="" class="form-addtin" enctype="multipart/form-data">
					<label class="left-login">Tên : (*)</label>
					<div class="right-login">
						<input class="input-right" type="text" name="ten" value="<?php echo $tenTin?>">
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
									$selected="";
									if($tenDanhmuc==$tenDM){
										$selected="selected";
									}
								?>
								<option <?php echo $selected;?> value="<?php echo $idDM?>"><?php echo $tenDM?></option>
								<?php }?>
							?>
						</select>
						<br/ ><label for="danhmuc" class="error"></label>
					</div>
					<div class="clr"></div>
					<label class="left-login">Giá: (*)</label>
					<div class="right-login">
						<input class="input-right" type="text" name="gia" value="<?php echo $gia?>">
						<br/ ><label for="gia" class="error"></label>
					</div>
					<div class="clr"></div>
					<label class="left-login">Nơi bán: (*)</label>
					<div class="right-login">
						<input class="input-right" type="text" name="noiban" value="<?php echo $noiBan?>">
						<br/ ><label for="noiban" class="error"></label>
					</div>
					<div class="clr"></div>
					<label class="left-login">Số điện thoại: (*)</label>
					<div class="right-login">
						<input class="input-right" type="text" name="sodienthoai" value="<?php echo $soDienThoai?>">
						<br/ ><label for="sodienthoai" class="error"></label>
					</div>
					<?php if($hinhAnh!=''){ ?>
					<div class="clr"></div>
					<label class="left-login">Old picture:</label>
					<div class="right-login">
						<img src="<?php echo $urlHinhAnh?>" style="height: 50px;">
					</div>
					<?php }?>
					<div class="clr"></div>
					<label class="left-login">New picture:</label>
					<div class="right-login">
						<input class="input-right" type="file" name="picture" >
					</div>
					<div class="clr"></div>
					<label class="left-login">Mô tả: (*)</label>
					<div class="right-login">
						<textarea class="mota ckeditor" name="mota"><?php echo $moTa?></textarea>
						<br/ ><label for="mota" class="error"></label>
					</div>
					<div class="clr"></div>
					<input type="submit" class="button" name="edit" value="Edit">
			</form>
	</div>
	<!--end content-->
	<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/admin/inc/footer.php"?>
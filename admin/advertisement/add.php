<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/admin/inc/header.php" ?>
<?php require_once $_SERVER['DOCUMENT_ROOT']."/functions/checkuser.php" ?>
	<!--content-->
	<div class="content">
			
			<h2 class="tit"><i class="icon-cat fa fa-money"></i>  Thêm quảng cáo</h2>
			<br/>
			<?php 
				if(isset($_POST['add'])){
					$company=$_POST['congtyquangcao'];
					$website=$_POST['website'];
					$picture=$_FILES['picture']['name'];
					//xu lý ảnh
					
					$arPic=explode(".", $picture);
					$endPic=end($arPic);
					$newPicName='QC-'.time().'.'.$endPic;
					$path_upload=$_SERVER['DOCUMENT_ROOT'].'/files/'.$newPicName;
					$tmp_name=$_FILES['picture']['tmp_name'];
					move_uploaded_file($tmp_name,$path_upload);

					//xử lý lấy ngày tháng hiện tại
					$date=date("Y").'-'.date("m").'-'.date("d");
					$query="INSERT INTO quangcao(congtyquangcao, website, anhquangcao) VALUES ('{$company}', '{$website}', '{$newPicName}')";
					if($mySQLI->query($query)){
						header("location:index.php?msg=Thêm thành công");
					}else{
						header("location:index.php?msg=Thêm thât bại");
					}
				}
			?>
			<form method="post" action="" class="form-addQc" enctype="multipart/form-data">
				<label class="left-login">Công ty quảng cáo : (*)</label>
				<div class="right-login">
					<input class="input-right" type="text" name="congtyquangcao" value="">
					<br/ ><label for="congtyquangcao" class="error"></label>
				</div>
				<div class="clr"></div>
				<label class="left-login">Website: (*)</label>
				<div class="right-login">
					<input class="input-right" type="text" name="website" value="">
					<br/ ><label for="website" class="error"></label>
				</div>
				<div class="clr"></div>
				<div class="clr"></div>
				<label class="left-login">Picture: (*)</label>
				<div class="right-login">
					<input class="input-right" type="file" name="picture" >
				</div>
				<div class="clr"></div>
				<br/>
				<input type="submit" class="button" name="add" value="Add">
			</form>
	</div>
	<!--end content-->
	<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/admin/inc/footer.php"?>
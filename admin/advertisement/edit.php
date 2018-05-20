<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/admin/inc/header.php" ?>
<?php require_once $_SERVER['DOCUMENT_ROOT']."/functions/checkuser.php" ?>
	<!--content-->
	<div class="content">
			
			<h2 class="tit"><i class="icon-cat fa fa-money"></i>  Sửa Quảng cáo</h2>
			<br/>
			<?php
				if(!empty($_GET['idQc'])){
					$idQc=$_GET['idQc'];
				}else{
					header("location:index.php");
				}
				$queryQc= "SELECT * FROM quangcao WHERE id_qc='{$idQc}'";
				$resultQc=$mySQLI->query($queryQc);
				$arQc=mysqli_fetch_assoc($resultQc);
				$company = $arQc['congtyquangcao'];
				$picture = $arQc['anhquangcao'];
				$website = $arQc['website'];
				$urlPicture='/files/'.$picture;
			?>
			<?php
				if(isset($_POST['edit'])){
					$newCompany=$_POST['congtyquangcao'];
					$newWebsite=$_POST['website'];
					$newPicture=$_FILES['picture']['name'];
					if($newPicture!=''){
						unlink($_SERVER['DOCUMENT_ROOT'].'/files/'.$picture);
						$arPic=explode(".", $newPicture);
						$endPic=end($arPic);
						$newPicName='QC-'.time().'.'.$endPic;
						$path_upload=$_SERVER['DOCUMENT_ROOT'].'/files/'.$newPicName;
						$tmp_name=$_FILES['picture']['tmp_name'];
						move_uploaded_file($tmp_name,$path_upload);
						$query="UPDATE quangcao SET congtyquangcao='{$newCompany}',website='{$newWebsite}', anhquangcao='{$newPicName}' WHERE id_qc={$idQc}";
					} else {
						$query="UPDATE quangcao SET congtyquangcao='{$newCompany}',website='{$newWebsite}' WHERE id_qc={$idQc}";
					}

					if($mySQLI->query($query)){
						header("location:index.php?msg=Sửa thành công");
					}else{
						echo $query;
					}
				}
			?>
			<form method="post" action="" class="form-editQc" enctype="multipart/form-data">
				<label class="left-login">Công ty quảng cáo : (*)</label>
				<div class="right-login">
					<input class="input-right" type="text" name="congtyquangcao" value="<?php echo $company?>">
					<br/ ><label for="congtyquangcao" class="error"></label>
				</div>
				<div class="clr"></div>
				<label class="left-login">Website: (*)</label>
				<div class="right-login">
					<input class="input-right" type="text" name="website" value="<?php echo $website?>">
					<br/ ><label for="website" class="error"></label>
				</div>
				<div class="clr"></div>
				
				<?php if($picture!=''){ ?>
				<div class="clr"></div>
				<label class="left-login">Old picture:</label>
				<div class="right-login">
					<img src="<?php echo $urlPicture?>" style="height: 50px;">
				</div>
				<?php }?>
				<div class="clr"></div>
				<label class="left-login">New picture:</label>
				<div class="right-login">
					<input class="input-right" type="file" name="picture" >
				</div>
				<div class="clr"></div>
				<br/>
				<input type="submit" class="button" name="edit" value="Edit">
			</form>
	</div>
	<!--end content-->
	<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/admin/inc/footer.php"?>
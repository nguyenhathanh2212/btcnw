<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/admin/inc/header.php"; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT']."/functions/checkuser.php"; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT']."/functions/replace.php"; ?>

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
<?php
    $idUser = $session->get('UserAuthenticate')['id'];
	$where = '';

    if ($idUser != 1) {
    	$where = "WHERE user_id = {$idUser}";
    }

    $sql = 'SELECT COUNT(id) AS sotin FROM recruitment ' . $where;

    $data = $DB->select($sql)[0];
	$rowCount = ROW_COUNT_ADMIN;
	$pageCount = ceil($data['sotin'] / $rowCount);
	$currentPage = 1;

	if (!empty($_GET['idpage'])){
		$currentPage = $_GET['idpage'];
	}

	if (!empty($_GET['filter'])){
		$filter = $_GET['filter'];
	}else {
		$filter = 1;
	}
?>
	<!--content-->
	<div class="content ">
		<div class="header-content">
			<a class="add" href="add.php"><i class="fa fa-plus" aria-hidden="true"></i> Thêm</a>
			<a class="delete-all" href="" id="delete-all-news"><i class="fa fa-trash" aria-hidden="true"></i> Xóa tất cả</a>
			<input type="text" name="search" class="search-box" id="search-news" placeholder="Nhập nội dung tìm kiếm...">
			<div class="select-sort-new">
				<ul>
					<li>
						<a href="index.php?idpage=<?php echo $currentPage ?>&filter=1" <?php if($filter==1){echo "class='sort-active'";} ?>>
							Tin mới
						</a>
					</li>
					<li>
						<a href="index.php?idpage=<?php echo $currentPage ?>&filter=2" <?php if($filter==2){echo "class='sort-active'";} ?>>
							Tin cũ
						</a>
					</li>
					<li>
						<a href="index.php?idpage=<?php echo $currentPage ?>&filter=3" <?php if($filter==3){echo "class='sort-active'";} ?>>
							Danh mục
						</a>
					</li>
					<li><a href="index.php?idpage=<?php echo $currentPage ?>&filter=4" <?php if($filter==4){echo "class='sort-active'";} ?>>
							Người đăng
						</a>
					</li>
				</ul>
			</div>
		</div>
		<table width="100%"  class="tb-admin">
			<tr>
				<th width="3%">
                    <input type="checkbox" class="checkbox-delete-all">
                </th>
				<th width="5%">STT</th>
	            <th width="27%">Tên bài đăng</th>
	            <th width="17%">Danh mục</th>
	            <th width="10%">Người đăng</th>
	            <th width="10%">Ngày đăng</th>
	            <th width="10%">Hình ảnh</th>
	            <th width="8%">Bình luận</th>
	            <th width="10%">Chức năng</th>
			</tr>
			<?php
				$offset = ($currentPage - 1) * $rowCount;

				switch ($filter) {
					case 1:
						$query = "SELECT recruitment.*, username, name FROM recruitment  
						INNER JOIN category ON recruitment.category_id = category.id 
						INNER JOIN users ON recruitment.user_id = users.id " . $where ." 
						ORDER BY created_at DESC LIMIT {$offset}, {$rowCount}";
						break;
					case 2:
						$query = "SELECT recruitment.*, username, name FROM recruitment 
						INNER JOIN category ON recruitment.category_id = category.id 
						INNER JOIN users ON recruitment.user_id = users.id " . $where ."
						ORDER BY created_at ASC LIMIT {$offset}, {$rowCount}";
						break;
					case 3:
						$query = "SELECT recruitment.*, username, name FROM recruitment
						INNER JOIN category ON recruitment.category_id = category.id 
						INNER JOIN users ON recruitment.user_id = users.id  " . $where ."   
						ORDER BY category_id ASC LIMIT {$offset}, {$rowCount}";
						break;	
					case 4:
						$query = "SELECT recruitment.*, username, name FROM recruitment
						INNER JOIN category ON recruitment.category_id = category.id 
						INNER JOIN users ON recruitment.user_id = users.id " . $where ."  
						ORDER BY recruitment.user_id ASC LIMIT {$offset}, {$rowCount}";
						break;	
				}

				$results = $DB->select($query);
			?>
			<tbody id="show-news">
				<?php foreach ($results as $key => $result) {?>
					<tr>
						<td>
	                        <input type="checkbox" class="checkbox-delete"  val="<?php echo $result['id'] ?>" >
	                    </td>
						<td><?php echo '#' . ($key + 1) ?></td>
						<td><?php echo str_limit($result['title'], 30) ?></td>
						<td><?php echo $result['name'] ?></td>
						<td><?php echo $result['username'] ?></td>
						<td><?php echo $result['created_at'] ?></td>
						<td>
							<?php 
								if ($result['picture'] == ''){ ?>
									<img style="height: 50px;" src="/files/salemacdinh.png" class="hoa" />
							<?php } else { ?>
								<img style="height: 50px;"  src="/files/<?php echo $result['picture'] ?>" class="hoa" />
							<?php }?>
						</td>
						<td>
							<a href="/admin/comment?idTin=<?php echo $result['id'] ?>" style="color: #00ff00; font-weight: bold;">Xem
							</a>
						</td>
						<td>
							<a href="edit.php?idTin=<?php echo $result['id'] ?>" class="fa fa-pencil">Sửa</a> |
							<a href="del.php?idTin=<?php echo $result['id'] ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa tin ?');" class="fa fa-trash">Xóa</a>
						</td>
					</tr>	
				<?php	}?>
			</tbody>
		</table>
		<div class="pagination">           
			<div class="numbers">
				<span>Trang:</span> 
				<?php
					for ($i = 1; $i <= $pageCount; $i ++){
						$current = "";
						if ($i == $currentPage) {
							$current = 'current';
						}
				?>
				<a href="index.php?idpage=<?php echo $i . '&filter=' . $filter  ?>" class="<?php echo $current?>"><?php echo $i ?></a> 
				<span>|</span> 
				<?php }?>   
			</div> 
			<div style="clear: both;"></div> 
 		</div>
	</div>
	<!--end content-->
	<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/templates/admin/inc/footer.php"?>
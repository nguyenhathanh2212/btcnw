<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/public/inc/header.php" ?>
<!--content-->
<?php
	if(!empty($_GET['idCate'])){
		$idCate=$_GET['idCate'];
	}else {
		header("location:/404");
		die();
	}
?>
	<div class="content">
		<div class="category-title">
			<a href="/">Trang chủ</a>
			<span class="fa fa-caret-right"></span>
			<?php
                if($idCate != 11){
                	$queryCate = "SELECT * FROM category WHERE id = {$idCate}";
                	$resultCate = $DB->select($queryCate)[0];

	                $categoryName = $resultCate['name'];
	                $id = $resultCate['id'];
                }else{
                	$categoryName = 'TIN TOÀN QUỐC';
                }
            ?>
			<a href=""><?php echo $categoryName ?></a>
			<?php
				if(!empty($_GET['filter'])) {
					$filter = $_GET['filter'];
				} else {
					$filter = 1;
				}

				if ($idCate == 11) {
					$queryCate = "SELECT COUNT(id) AS sotin FROM recruitment";
				} else {
					$queryCate = "SELECT COUNT(id) AS sotin FROM recruitment 
						WHERE category_id = {$idCate}";
				}

					$resultCate = $DB->select($queryCate);
					$rowCount = 15;
					$pageCount = ceil($resultCate[0]['sotin'] / $rowCount);
					$currentPage = 1;

				if(!empty($_GET['idpage'])){
					$currentPage = $_GET['idpage'];
				}
			?>
			<div class="result-search"><span><?php echo $resultCate[0]['sotin']?></span>kết quả</div>
		</div>
		<div class="all-new">
			<div class="header-title-cat header-title">
				<div class="header-list-a">
					<span class="icon-a fa <?php echo $_SESSION['arIcon'][$idCate]?>"></span>
					<a href="pet.php" title=""><?php echo $categoryName ?></a>	
				</div>	
				<div class="select-sort-new">
					<ul>
						<li><a href="/category.php?idCate=<?php echo $idCate ?>&filter=1" <?php if($filter == 1){echo "class='sort-active'";} ?> >Tin mới</a></li>
						<li><a href="/category.php?idCate=<?php echo $idCate?>&filter=2"  <?php if($filter == 2){echo "class='sort-active'";}?> >Giá Thấp</a></li>
						<li><a href="/category.php?idCate=<?php echo $idCate?>&filter=3"  <?php if($filter == 3){echo "class='sort-active'";}?>>Giá Cao</a></li>
					</ul>
				</div>
			</div>
			<div class="clr"></div>
			<div class="list-all-new">
				<ul>
					<?php
						if ($idCate != 11) {
							$where = " WHERE category_id = {$idCate} ";
						} else {
							$where = '';
						}

						$offset = ($currentPage - 1) * $rowCount; 
						switch ($filter) {
							case 1:
								$queryNews = "SELECT recruitment.*, users.username 
								FROM recruitment
								INNER JOIN users ON recruitment.user_id = users.id "
								. $where . 
								" ORDER BY id DESC LIMIT {$offset}, {$rowCount}";
								break;
							case 2:
								$queryNews = "SELECT recruitment.*,users.username 
								FROM recruitment
								INNER JOIN users ON recruitment.user_id = users.id "
								. $where. 
								" ORDER BY salary ASC LIMIT {$offset}, {$rowCount}";
								break;
							case 3:
								$queryNews = "SELECT recruitment.*, users.username 
								FROM recruitment
								INNER JOIN users ON recruitment.user_id = users.id "
								. $where .
								" ORDER BY salary DESC Limit {$offset}, {$rowCount}";
								break;
						}

						$resultNews = $DB->select($queryNews);

						foreach ($resultNews as $news) {
							$url="/detail/" . convertUtf8ToLatin($news['title']) . '-' . $news['id'] . ".html";
					?>
						<li>
							<a href="<?php echo $url ?>" title="">
								<h2><?php echo $news['title'] ?></h2>
								<span class="place"><?php echo $news['location'] ?></span><br/>
								<img src="/files/<?php echo $news['picture'] ?>" title="Tuyển dụng" alt=""/>
								<br/>
								<span class="price"><?php echo $news['salary'] ?><sup>đ</sup></span>
							</a>
							<br/>
							<h4>
								Đăng bởi 
								<a href="<?php echo '/timeline/' . convertUtf8ToLatin($news['username']) . '-' . $news['user_id'] ?>">
									<?php echo $news['username'] ?>
								</a>
							</h4>
						</li>
					<?php } ?>
				</ul>	
			</div>
			<div class="button-page">
				<?php
					for ($i = 1; $i <= $pageCount; $i ++) {
						$active = '';
						if ($currentPage == $i){
							$active = 'page-active';
						}
						$url = "/category/" . convertUtf8ToLatin($categoryName) . '-' . $idCate . '-' . $i;
				?>
					<a href="<?php echo $url?>" class="<?php echo $active ?>"><?php echo $i?></a>
				<?php }?>
			</div>
		</div>
	</div>
	<!--end content-->
<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/public/inc/footer.php" ?>
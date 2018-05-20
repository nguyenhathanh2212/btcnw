<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/public/inc/header.php"; ?>
<!--content-->
<?php
	if (!empty($_GET['str'])){
		$str = $_GET['str'];
		$idCate = $_GET['idCat'];

		if ($idCate == 0){
			$where = " title LIKE '%{$str}%' ";
		} else {
			$where = " title LIKE '%{$str}%' AND category_id = {$idCate}";
		}
	} else {
		header("location:/");
		die();
	}
?>
	<div class="content">
		<div class="category-title">
			<a href="/">Trang chủ</a>
			<span class="fa fa-caret-right"></span>
			<?php if ($idCate != 0) { ?>
				<?php
	                $queryCate = "SELECT * FROM category WHERE id={$idCate}";
	                $category = $DB->select($queryCate)[0];
	                $link = '/category/' . convertUtf8ToLatin($category['name']) . '-' . $category['id'];
	            ?>
				<a href="<?php echo $link ?>"><?php echo $category['name'] ?></a>
			<?php } else { ?>
				<a href="/category/all-11">Tất cả</a>
			<?php } ?>
			<?php
				if (!empty($_GET['filter'])) {
					$filter = $_GET['filter'];
				} else {
					$filter = 1;
				}

				$queryCate = "SELECT COUNT(id) AS sotin FROM recruitment WHERE{$where}";
				$resultCate = $DB->select($queryCate)[0];
                
				$rowCount = 15;
				$pageCount = ceil($resultCate['sotin'] / $rowCount);
				$currentPage = 1;

				if(!empty($_GET['idpage'])) {
					$currentPage = $_GET['idpage'];
				}
			?>
			<div class="result-search"><span><?php echo $resultCate['sotin'] ?></span>kết quả</div>
		</div>
		<div class="all-new">
			<div class="header-title-cat header-title">
				<div class="header-list-a">
					<span class="icon-a fa fa-search"></span>
					<a href="" title=""><?php echo 'Tìm kiếm' ?></a>	
				</div>
			</div>
			<div class="clr"></div>
			<div class="list-all-new">
				<ul>
				<?php
					$offset = ($currentPage - 1) * $rowCount; 
					switch ($filter) {
						case 1:
							$queryNews = "SELECT recruitment.*, users.username FROM recruitment
							INNER JOIN users ON recruitment.user_id = users.id WHERE{$where}
							ORDER BY id DESC Limit {$offset}, {$rowCount}";
							break;
						case 2:
							$queryNews = "SELECT recruitment.*, users.username FROM recruitment
							INNER JOIN users ON recruitment.user_id = users.id WHERE{$where}
							ORDER BY salary ASC Limit {$offset}, {$rowCount}";
							break;
						case 3:
							$queryNews = "SELECT recruitment.*, users.username FROM recruitment
							INNER JOIN users ON recruitment.user_id = users.id WHERE{$where}
							ORDER BY salary DESC Limit {$offset}, {$rowCount}";
							break;
					}

					$resultNews = $DB->select($queryNews);

					foreach ($resultNews as $news) {
				?>
					<li>
						<a href="/detail.php?id=<?php echo $news['id'] ?>" title="">
							<h2><?php echo $news['title'] ?></h2>
							<span class="place"><?php echo $news['location'] ?></span><br/>
							<img src="/files/<?php echo $news['picture'] ?>" title="Tuyển dụng" alt=""/>
							<br/>
							<span class="price"><?php echo $news['salary'] ?><sup>đ</sup></span>
						</a>
						<br/>
						<h4>
							Đăng bởi 
							<a href="<?php echo '/timeline/'.convertUtf8ToLatin($news['username']) . '-' . $news['user_id'] ?>" class="user">
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

						if ($currentPage == $i) {
							$active='page-active';
						}

						$url="/search/" . $str . '-' . $idCate . '-' . $i;
					?>
					<a href="<?php echo $url ?>" class="<?php echo $active ?>">
						<?php echo $i ?>
					</a>
				<?php } ?>
			</div>
		</div>
	</div>
	<!--end content-->
<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/public/inc/footer.php" ?>
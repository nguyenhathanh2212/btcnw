<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/public/inc/header.php"; ?>
<?php 
	if (!empty($_GET['id'])) {
		$id = $_GET['id'];
	} else {
		header("location:/404");
		die();
	}
?>
	<!--content-->
	<div class="content">
		<?php 
			$querySQL = "SELECT recruitment.*, username, address, email, name
				FROM recruitment 
				INNER JOIN users ON recruitment.user_id = users.id 
				INNER JOIN category ON recruitment.category_id = category.id
				WHERE recruitment.id = {$id}";

			$result = $DB->select($querySQL)[0];

			if (!count($result)) {
				header("location: /404");
			}
			$result['created_at'] = date('d-m-Y',strtotime($result['created_at']));
			$urlCate = "/category/".convertUtf8ToLatin($result['name']) . '-' . $result['id'];
		?>
		<div class="category-title">
			<a href="/">Trang chủ</a>
			<div class="fa fa-caret-right"></div>
			<a href="<?php echo $urlCate?>"><?php echo $result['name']?></a>
		</div>
		<div class="main-content">

			<div class="header-title-det header-title">
				<div class="header-list-a">
					<div class="icon-a fa fa-flag"></div>
					<a href="">
						<?php echo $result['title']?>
					</a>
				</div>
				<div class="info-new">
					<ul>
						<li>Ngày đăng: <?php echo $result['created_at']?></li>
						/
						<li>Mã tin: <?php echo $id?></li>
						/
						<li>Đăng bởi: <a href="<?php echo '/timeline/'.convertUtf8ToLatin($result['username']).'-'.$result['user_id'] ?>" class="user" alt=""><?php echo $result['username']?></a></li>
					</ul>
				</div>
			</div>
			<div class="info-product">
				<div class="left-info">
					<ul class="bxslider">
						<li><img src="<?php echo '/files/' . $result['picture']?>" /></li>
					</ul>
					<div class="contact-info">
						<h2><span class="fa fa-thumb-tack"></span> THÔNG TIN LIÊN HỆ</h2>
						<ul>
							<li>
								<span class="fa fa-caret-right"></span>Trang cá nhân: 
								<a href="<?php echo '/timeline/'.convertUtf8ToLatin($result['username']).'-'.$result['user_id'] ?>" class="user" alt="">
									<?php echo $result['username']?>
								</a>
							</li>
							<li><span class="fa fa-caret-right"></span>Địa chỉ: <span><?php echo $result['address']?></span></li>
							<li><span class="fa fa-caret-right"></span>Số điện thoại: <span><?php echo $result['phone']?></span></li>
							<li><span class="fa fa-caret-right"></span>Email: <span><?php echo $result['email']?></span></li>
							<li><span class="fa fa-caret-right"></span>Facebook: <a href="http://fb.com/tieucuong231" target="_blank">tieucuong231</a></li>
						</ul>
						<div class="contact-button">
							<a href="mailto:<?php echo $result['email']?>" class="fa fa-envelope">
								Gửi mail
							</a>
						</div>
					</div>
				</div>
				<div class="right-info">
					<h1>Lương: <?php echo $result['salary']?><sup>đ</sup></h1>
					<h3><?php echo $result['location']?></h3>
					<p>
						<?php echo $result['description']?>
					</p>
				</div>
			</div>
			<div class="user-comment">
				<div class="comments-tdk">
		            <div class="comment-header">
							<h2><span class="fa fa-comment-o"></span> BÌNH LUẬN</h2>
					</div>
		            <form id="<?php echo $id?>" action="" method="POST" class="form-cmt" >
		                <div class="row infor-cmt">
		                    <div class="col-sm-6">
		                        <input type="text" name="hoten" id="hoten-sub" class="infor" placeholder="Nhập họ tên">
		                    </div>
		                    <div class="col-sm-6">
		                        <input type="email" name="email" id="email-sub" class="infor" placeholder="Nhập email">
		                    </div>
		                </div>
		                <textarea class="content-cmt" name="content" placeholder="Viết nội dung bình luận"></textarea>
		                <input type="submit" name="binhluan" id="binhluan" class="binhluan sub" value="Đăng bình luận"/>
		            </form>
		        </div>
		        <div class="list-cmt">
		            <ul class="ul-list-cmt">
		                <?php
		                    $queryCmt = "SELECT * FROM comment 
			                    WHERE recruitment_id = {$id} 
			                    ORDER BY created_at DESC ";

		                    $resultCmt = $DB->select($queryCmt);

		                    foreach ($resultCmt as $comment) {
		                        $dayCreateCmt=date("d/m/Y", strtotime($comment['created_at']));
		                        $hourCreateCmt=date("H:i:s", strtotime($comment['created_at']));
		                ?>
			                <li class="li-list-cmt">
			                    <h4><?php echo $comment['username'] ?></h4>
			                    <div  class="detail-cmt">
			                        <span><?php echo $hourCreateCmt?></span> | <span><?php echo $dayCreateCmt?></span> | <span><?php echo $comment['email'] ?></span>
			                    </div>
			                    <p><?php echo $comment['content'] ?></p>
			                </li>
		                <?php } ?>
		            </ul>
		        </div>
			</div>
		</div>
		
		<div class="all-new">
			<div class="header-list">
				<div class="fa fa-star"></div>
				<a href="" title="">TIN LIÊN QUAN</a>
			</div>
			<div class="list-all-new">
				<ul>
					<?php 
						$querySQL = "SELECT recruitment.*, username 
							FROM recruitment 
							INNER JOIN users ON recruitment.user_id = users.id 
							WHERE recruitment.id != {$id} 
							AND category_id = {$result['category_id']} LIMIT 0, 5";

						$resultNews = $DB->select($querySQL);

						foreach ($resultNews as $resultNew) {
							$url = "/detail/" . convertUtf8ToLatin($resultNew['title']) . '-' . $resultNew['id'] . ".html";
					?>
						<li>
							<a href="<?php echo $url ?>" title="">
								<h2><?php echo $resultNew['title']?></h2>
								<span class="place"><?php echo $resultNew['location'] ?></span><br/>
								<img src="<?php echo '/files/' . $resultNew['picture'] ?>" title="Tuyển dụng" alt=""/>
								<br/>
								<span class="price"><?php echo $resultNew['salary'] ?><sup>đ</sup></span>
							</a>
							<br/>
							<h4>
								Đăng bởi 
								<a href="<?php echo '/timeline/'.convertUtf8ToLatin($resultNew['username']).'-'.$resultNew['user_id'] ?>" class="user" alt="">
									<?php echo $resultNew['username'] ?>
								</a>

							</h4>
						</li>
					<?php }?>
				</ul>	
			</div>
			<div class="list-all-new">
				<ul>
					<?php 
						$querySQL = "SELECT recruitment.*, username 
							FROM recruitment 
							INNER JOIN users ON recruitment.user_id = users.id
							WHERE recruitment.id != {$id} 
							AND category_id = {$result['category_id']} LIMIT 5, 5";

						$resultNews = $DB->select($querySQL);

						foreach ($resultNews as $resultNew) {
							$url = "/detail/" . convertUtf8ToLatin($resultNew['title']) . '-' . $resultNew['id'] . ".html";	
					?>
						<li>
							<a href="<?php echo $url?>" title="">
								<h2><?php echo $resultNew['title'] ?></h2>
								<span class="place"><?php echo $resultNew['location'] ?></span><br/>
								<img src="<?php echo '/files/' . $resultNew['picture'] ?>" title="Tuyển dụng" alt=""/>
								<br/>
								<span class="price"><?php echo $resultNew['salary'] ?><sup>đ</sup></span>
							</a>
							<br/>
							<h4>
								Đăng bởi 
								<a href="<?php echo '/timeline/'.convertUtf8ToLatin($resultNew['username']).'-'.$resultNew['user_id'] ?>" class="user" alt="">
									<?php echo $resultNew['username'] ?>
								</a>
							</h4>
						</li>
					<?php } ?>
				</ul>					
			</div>
		</div>
	</div>
	<!--end content-->
<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/public/inc/footer.php" ?>
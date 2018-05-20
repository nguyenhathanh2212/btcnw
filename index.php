<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/public/inc/header.php" ?>
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
	<!--content-->
	<div class="content">
		<div class="top-content row">
			<div class="left-top-content col-sm-7">
				<ul class="bxslider">
				<?php
					$resultNews = $DB->select("SELECT * FROM tinraovat ORDER BY id_tinraovat DESC Limit 5");
				?>

				<?php foreach ($resultNews as $news) {
						if($news['picture'] == ''){
							$news['picture'] = "salemacdinh.png";
						}

						$url = "/detail/" . convertUtf8ToLatin($news['tentinraovat']) . '-' . $news['id_tinraovat'].".html";
				?>
				  	<li class="li-slider"><a href="<?php echo $url?>"><img src="/files/<?php echo $news['picture'] ?>" /></a>
				  		<h3 class="h3-slider"><a href="<?php echo $url?>"><?php echo $news['tentinraovat'] ?></a>
				  		<p><?php echo $news['mota'] ?></p></h3>
				  	</li>
				<?php } ?>
				</ul>
			</div>
			<div class="right-top-content col-sm-5">
				<ul class="bxslider2">
					<?php
						$resultQC = $DB->select("SELECT * FROM quangcao ORDER BY id_qc DESC Limit 5");
					?>

					<?php foreach ($resultQC as $qc) { ?>
					  	<li class="li-slider">
					  		<a href="<?php echo $qc['website'] ?>">
					  			<img src="/files/<?php echo $qc['anhquangcao'] ?>" />
					  		</a>
					  	</li>
					<?php } ?>
				</ul>
			</div>
		</div>
		<div class="main-content ">
			<div class="all-new wow fadeInUp">
				<div class="header-list">
					<div class="icon-index fa fa-star"></div>
					<a href="/category/all-11" title="">TIN TOÀN QUỐC</a>
				</div>
				<?php
					
					$arSoTin = $DB->select("SELECT COUNT(id_tinraovat) AS sotin FROM tinraovat");

					$rowCount = 10;
					$pageCount = ceil($arSoTin[0]['sotin'] / $rowCount);

					if($pageCount > 6) {
						$pageCount = 6;
					}

					$currentPage = 1;

					if(!empty($_GET['idpage'])){
						$currentPage=$_GET['idpage'];
					}
				?>
				<div class="list-all-new wow fadeInUp">
					<ul>
						<?php
							$offset = ($currentPage - 1) * $rowCount;
							$queryNews = "SELECT tinraovat.*,users.username 
								FROM tinraovat
								INNER JOIN users ON tinraovat.id_user=users.id_user
								ORDER BY id_tinraovat DESC Limit {$offset}, 5";

							$resultNews = $DB->select($queryNews);
						
							foreach ($resultNews as $news) {
								if($news['picture'] == "") {
									$news['picture'] = "salemacdinh.png";
								}

								$url = "/detail/" . convertUtf8ToLatin($news['tentinraovat']) . '-' . $news['id_tinraovat'] . ".html";
						?>
							<li>
								<a href="<?php echo $url ?>" title="">
									<h2><?php echo $news['tentinraovat'] ?></h2>
									<span class="place"><?php echo $news['noiban'] ?></span><br/>
									<img src="/files/<?php echo $news['picture'] ?>" title="Tuyển dụng" alt=""/>
									<br/>
									<span class="price"><?php echo $news['gia'] ?><sup>đ</sup></span>
								</a>
								<br/>
								<h4>
									Đăng bởi 
									<a href="<?php echo '/timeline/'.convertUtf8ToLatin($news['username']).'-'.$news['id_user'] ?>" class="user">
										<?php echo $news['username'] ?>
									</a>
								</h4>
							</li>
						<?php } ?>
					</ul>	
				</div>
				<div class="list-all-new wow fadeInUp">
					<ul>
						<?php
							$offset += 5;
							$queryNews = "SELECT tinraovat.*,users.username 
								FROM tinraovat
								INNER JOIN users ON tinraovat.id_user=users.id_user 
								ORDER BY id_tinraovat DESC Limit {$offset},5";
							
							$resultNews = $DB->select($queryNews);

							foreach ($resultNews as $news) {
								if($news['picture'] == ""){
									$news['picture'] = "salemacdinh.png";
								}

								$url = "/detail/" .convertUtf8ToLatin($news['tentinraovat']) . '-' . $news['id_tinraovat'] . ".html";
						?>
							<li>
								<a href="<?php echo $url ?>" title="">
									<h2><?php echo $news['tentinraovat'] ?></h2>
									<span class="place"><?php echo $news['noiban'] ?></span><br/>
									<img src="/files/<?php echo $news['picture']?>" title="Tuyển dụng" alt=""/>
									<br/>
									<span class="price"><?php echo $news['gia'] ?><sup>đ</sup></span>
								</a>
								<br/>
								<h4>
									Đăng bởi 
									<a href="<?php echo '/timeline/' . convertUtf8ToLatin($news['username']) . '-' . $news['id_user'] ?>" class="user">
										<?php echo $news['username'] ?>
									</a>
								</h4>
							</li>
						<?php } ?>
						<div class="see-more">
							<a href="/category/all-11" style="margin-top: 15px;">Xem thêm >></a>
						</div>
					</ul>		
				</div>
			</div>
			<div class="sub-new">
				<div class="list-sub-new wow fadeInUp">
					<div class="header-list">
						<div class="icon-index fa fa-paw"></div>
						<a href="/category/thu-nuoi-1" title="">THÚ NUÔI</a>
					</div>
					<ul>
						<?php
							$queryNews = "SELECT tinraovat.*,users.username 
								FROM tinraovat
								INNER JOIN users ON tinraovat.id_user=users.id_user 
								WHERE id_danhmucsanpham=1
								ORDER BY id_tinraovat DESC Limit 5";

							$resultNews = $DB->select($queryNews);

							foreach ($resultNews as $news) {
								if($news['picture'] == ""){
									$news['picture'] = "salemacdinh.png";
								}

								$url = "/detail/" . convertUtf8ToLatin($news['tentinraovat']) . '-' . $news['id_tinraovat'] . ".html";
						?>
							<li class="wow fadeInUp">
								<a href="<?php echo $url?>" title="">
									<img src="/files/<?php echo $news['picture'] ?>" title="" alt=""/>
									<h2><?php echo $news['tentinraovat'] ?></h2>	
									<span class="place"><?php echo $news['noiban'] ?></span><br/>
								</a>	
								<h4>
									Đăng bởi 
									<a href="<?php echo '/timeline/' . convertUtf8ToLatin($news['username']) . '-' . $news['id_user'] ?>" class="user" alt="">
										<?php echo $news['username']?>
									</a>
								</h4>
							</li>
						<?php } ?>
					</ul>
					<div class="see-more">
						<a href="/category/thu-nuoi-1">Xem thêm >></a>
					</div>
				</div>
				<div class="list-sub-new wow fadeInUp" data-wow-delay="0.5s">
					<div class="header-list">
						<div class="icon-index fa fa-car"></div>
						<a href="/category/xe-co-2" title="">XE CỘ</a>
					</div>
					<ul>
						<?php
							$queryNews = "SELECT tinraovat.*,users.username 
								FROM tinraovat
								RIGHT JOIN users ON tinraovat.id_user=users.id_user 
								WHERE id_danhmucsanpham=2
								ORDER BY id_tinraovat DESC Limit 5";

							$resultNews = $DB->select($queryNews);

							foreach ($resultNews as $news) {
								if($news['picture'] == ""){
									$news['picture'] = "salemacdinh.png";
								}

								$url = "/detail/" . convertUtf8ToLatin($news['tentinraovat']) . '-' . $news['id_tinraovat'] . ".html";
						?>
							<li class="wow fadeInUp">
								<a href="<?php echo $url?>" title="">
									<img src="/files/<?php echo $news['picture'] ?>" title="" alt=""/>
									<h2><?php echo $news['tentinraovat'] ?></h2>	
									<span class="place"><?php echo $news['noiban'] ?></span><br/>
								</a>	
								<h4>
									Đăng bởi 
									<a href="<?php echo '/timeline/' . convertUtf8ToLatin($news['username']) . '-' . $news['id_user'] ?>" class="user" alt="">
										<?php echo $news['username']?>
									</a>
								</h4>
							</li>
						<?php } ?>
					</ul>
					<div class="see-more">
						<a href="/category/xe-co-2">Xem thêm >></a>
					</div>
				</div>
				<div class="list-sub-new wow fadeInUp">
					<div class="header-list">
						<div class="icon-index fa fa-laptop"></div>
						<a href="/category/dien-tu-3" title="">ĐIỆN TỬ</a>
					</div>
					<ul>
						<?php
							$queryNews = "SELECT tinraovat.*,users.username 
								FROM tinraovat
								INNER JOIN users ON tinraovat.id_user=users.id_user 
								WHERE id_danhmucsanpham=3
								ORDER BY id_tinraovat DESC Limit 5";

							$resultNews = $DB->select($queryNews);

							foreach ($resultNews as $news) {
								if($news['picture'] == ""){
									$news['picture'] = "salemacdinh.png";
								}

								$url = "/detail/" . convertUtf8ToLatin($news['tentinraovat']) . '-' . $news['id_tinraovat'] . ".html";
						?>
							<li class="wow fadeInUp">
								<a href="<?php echo $url?>" title="">
									<img src="/files/<?php echo $news['picture'] ?>" title="" alt=""/>
									<h2><?php echo $news['tentinraovat'] ?></h2>	
									<span class="place"><?php echo $news['noiban'] ?></span><br/>
								</a>	
								<h4>
									Đăng bởi 
									<a href="<?php echo '/timeline/' . convertUtf8ToLatin($news['username']) . '-' . $news['id_user'] ?>" class="user" alt="">
										<?php echo $news['username']?>
									</a>
								</h4>
							</li>
						<?php } ?>
					</ul>
					<div class="see-more">
						<a href="/category/dien-tu-3">Xem thêm >></a>
					</div>
				</div>
				<div class="list-sub-new wow fadeInUp" data-wow-delay="0.5s">
					<div class="header-list">
						<div class="icon-index fa fa-home"></div>
						<a href="/category/bat-dong-san-4" title="">BẤT ĐỘNG SẢN</a>
					</div>
					<ul>						
						<?php
							$queryNews = "SELECT tinraovat.*,users.username 
								FROM tinraovat
								INNER JOIN users ON tinraovat.id_user=users.id_user 
								WHERE id_danhmucsanpham=4
								ORDER BY id_tinraovat DESC Limit 5";

							$resultNews = $DB->select($queryNews);

							foreach ($resultNews as $news) {
								if($news['picture'] == ""){
									$news['picture'] = "salemacdinh.png";
								}

								$url = "/detail/" . convertUtf8ToLatin($news['tentinraovat']) . '-' . $news['id_tinraovat'] . ".html";
						?>
							<li class="wow fadeInUp">
								<a href="<?php echo $url?>" title="">
									<img src="/files/<?php echo $news['picture'] ?>" title="" alt=""/>
									<h2><?php echo $news['tentinraovat'] ?></h2>	
									<span class="place"><?php echo $news['noiban'] ?></span><br/>
								</a>	
								<h4>
									Đăng bởi 
									<a href="<?php echo '/timeline/' . convertUtf8ToLatin($news['username']) . '-' . $news['id_user'] ?>" class="user" alt="">
										<?php echo $news['username']?>
									</a>
								</h4>
							</li>
						<?php } ?>
					</ul>
					<div class="see-more">
						<a href="/category/bat-dong-san-4">Xem thêm >></a>
					</div>
				</div>
				<div class="list-sub-new wow fadeInUp">
					<div class="header-list">
						<div class="icon-index fa fa-female"></div>
						<a href="/category/the-thao-5" title="">THỂ THAO</a>
					</div>
					<ul>
						<?php
							$queryNews = "SELECT tinraovat.*,users.username 
								FROM tinraovat
								INNER JOIN users ON tinraovat.id_user=users.id_user 
								WHERE id_danhmucsanpham=5
								ORDER BY id_tinraovat DESC Limit 5";

							$resultNews = $DB->select($queryNews);

							foreach ($resultNews as $news) {
								if($news['picture'] == ""){
									$news['picture'] = "salemacdinh.png";
								}

								$url = "/detail/" . convertUtf8ToLatin($news['tentinraovat']) . '-' . $news['id_tinraovat'] . ".html";
						?>
							<li class="wow fadeInUp">
								<a href="<?php echo $url?>" title="">
									<img src="/files/<?php echo $news['picture'] ?>" title="" alt=""/>
									<h2><?php echo $news['tentinraovat'] ?></h2>	
									<span class="place"><?php echo $news['noiban'] ?></span><br/>
								</a>	
								<h4>
									Đăng bởi 
									<a href="<?php echo '/timeline/' . convertUtf8ToLatin($news['username']) . '-' . $news['id_user'] ?>" class="user" alt="">
										<?php echo $news['username']?>
									</a>
								</h4>
							</li>
						<?php } ?>
					</ul>
					<div class="see-more">
						<a href="/category/the-thao-5">Xem thêm >></a>
					</div>
				</div>
				<div class="list-sub-new wow fadeInUp" data-wow-delay="0.5s">
					<div class="header-list">
						<div class="icon-index fa fa-bicycle"></div>
						<a href="/category/thoi-trang-6" title="">THỜI TRANG</a>
					</div>
					<ul>
						<?php
							$queryNews = "SELECT tinraovat.*,users.username 
								FROM tinraovat
								INNER JOIN users ON tinraovat.id_user=users.id_user 
								WHERE id_danhmucsanpham=6
								ORDER BY id_tinraovat DESC Limit 5";

							$resultNews = $DB->select($queryNews);

							foreach ($resultNews as $news) {
								if($news['picture'] == ""){
									$news['picture'] = "salemacdinh.png";
								}

								$url = "/detail/" . convertUtf8ToLatin($news['tentinraovat']) . '-' . $news['id_tinraovat'] . ".html";
						?>
							<li class="wow fadeInUp">
								<a href="<?php echo $url?>" title="">
									<img src="/files/<?php echo $news['picture'] ?>" title="" alt=""/>
									<h2><?php echo $news['tentinraovat'] ?></h2>	
									<span class="place"><?php echo $news['noiban'] ?></span><br/>
								</a>	
								<h4>
									Đăng bởi 
									<a href="<?php echo '/timeline/' . convertUtf8ToLatin($news['username']) . '-' . $news['id_user'] ?>" class="user" alt="">
										<?php echo $news['username']?>
									</a>
								</h4>
							</li>
						<?php } ?>
					</ul>
					<div class="see-more">
						<a href="/category/thoi-trang-6">Xem thêm >></a>
					</div>
				</div>
				<div class="list-sub-new wow fadeInUp">
					<div class="header-list">
						<div class="icon-index fa fa-user"></div>
						<a href="/category/tuyen-dung-7" title="">TUYỂN DỤNG</a>
					</div>
					<ul>
						<?php
							$queryNews = "SELECT tinraovat.*,users.username FROM tinraovat
								INNER JOIN users ON tinraovat.id_user=users.id_user 
								WHERE id_danhmucsanpham=7
								ORDER BY id_tinraovat DESC Limit 5";

							$resultNews = $DB->select($queryNews);

							foreach ($resultNews as $news) {
								if($news['picture'] == ""){
									$news['picture'] = "salemacdinh.png";
								}

								$url = "/detail/" . convertUtf8ToLatin($news['tentinraovat']) . '-' . $news['id_tinraovat'] . ".html";
						?>
							<li class="wow fadeInUp">
								<a href="<?php echo $url?>" title="">
									<img src="/files/<?php echo $news['picture'] ?>" title="" alt=""/>
									<h2><?php echo $news['tentinraovat'] ?></h2>	
									<span class="place"><?php echo $news['noiban'] ?></span><br/>
								</a>	
								<h4>
									Đăng bởi 
									<a href="<?php echo '/timeline/' . convertUtf8ToLatin($news['username']) . '-' . $news['id_user'] ?>" class="user" alt="">
										<?php echo $news['username']?>
									</a>
								</h4>
							</li>
						<?php } ?>
					</ul>
					<div class="see-more">
						<a href="/category/tuyen-dung-7">Xem thêm >></a>
					</div>
				</div>
				<div class="list-sub-new wow fadeInUp" data-wow-delay="0.5s">
					<div class="header-list">
						<div class="icon-index fa fa-cutlery"></div>
						<a href="/category/thuc-pham-8" title="">THỰC PHẨM</a>
					</div>
					<ul>
						<?php
							$queryNews = "SELECT tinraovat.*,users.username FROM tinraovat
								INNER JOIN users ON tinraovat.id_user=users.id_user 
								WHERE id_danhmucsanpham=8
								ORDER BY id_tinraovat DESC Limit 5";

							$resultNews = $DB->select($queryNews);

							foreach ($resultNews as $news) {
								if($news['picture'] == ""){
									$news['picture'] = "salemacdinh.png";
								}

								$url = "/detail/" . convertUtf8ToLatin($news['tentinraovat']) . '-' . $news['id_tinraovat'] . ".html";
						?>
							<li class="wow fadeInUp">
								<a href="<?php echo $url?>" title="">
									<img src="/files/<?php echo $news['picture'] ?>" title="" alt=""/>
									<h2><?php echo $news['tentinraovat'] ?></h2>	
									<span class="place"><?php echo $news['noiban'] ?></span><br/>
								</a>	
								<h4>
									Đăng bởi 
									<a href="<?php echo '/timeline/' . convertUtf8ToLatin($news['username']) . '-' . $news['id_user'] ?>" class="user" alt="">
										<?php echo $news['username']?>
									</a>
								</h4>
							</li>
						<?php } ?>
					</ul>
					<div class="see-more">
						<a href="/category/thuc-pham-8">Xem thêm >></a>
					</div>
				</div>
				<div class="list-sub-new wow fadeInUp">
					<div class="header-list">
						<div class="icon-index fa fa-shower"></div>
						<a href="/category/noi-ngoai-that-9" title="">NỘI NGOẠI THẤT</a>
					</div>
					<ul>
						<?php
							$queryNews = "SELECT tinraovat.*,users.username FROM tinraovat
								INNER JOIN users ON tinraovat.id_user=users.id_user 
								WHERE id_danhmucsanpham=9
								ORDER BY id_tinraovat DESC Limit 5";

							$resultNews = $DB->select($queryNews);

							foreach ($resultNews as $news) {
								if($news['picture'] == ""){
									$news['picture'] = "salemacdinh.png";
								}

								$url = "/detail/" . convertUtf8ToLatin($news['tentinraovat']) . '-' . $news['id_tinraovat'] . ".html";
						?>
							<li class="wow fadeInUp">
								<a href="<?php echo $url?>" title="">
									<img src="/files/<?php echo $news['picture'] ?>" title="" alt=""/>
									<h2><?php echo $news['tentinraovat'] ?></h2>	
									<span class="place"><?php echo $news['noiban'] ?></span><br/>
								</a>	
								<h4>
									Đăng bởi 
									<a href="<?php echo '/timeline/' . convertUtf8ToLatin($news['username']) . '-' . $news['id_user'] ?>" class="user" alt="">
										<?php echo $news['username']?>
									</a>
								</h4>
							</li>
						<?php } ?>
					</ul>
					<div class="see-more">
						<a href="/category/noi-ngoai-that-9">Xem thêm >></a>
					</div>
				</div>
				<div class="list-sub-new wow fadeInUp" data-wow-delay="0.5s">
					<div class="header-list">
						<div class="icon-index fa fa-gift"></div>
						<a href="/category/khac-10" title="">KHÁC</a>
					</div>
					<ul>
						<?php
							$queryNews = "SELECT tinraovat.*,users.username FROM tinraovat
								INNER JOIN users ON tinraovat.id_user=users.id_user 
								WHERE id_danhmucsanpham=10
								ORDER BY id_tinraovat DESC Limit 5";

							$resultNews = $DB->select($queryNews);

							foreach ($resultNews as $news) {
								if($news['picture'] == ""){
									$news['picture'] = "salemacdinh.png";
								}

								$url = "/detail/" . convertUtf8ToLatin($news['tentinraovat']) . '-' . $news['id_tinraovat'] . ".html";
						?>
							<li class="wow fadeInUp">
								<a href="<?php echo $url?>" title="">
									<img src="/files/<?php echo $news['picture'] ?>" title="" alt=""/>
									<h2><?php echo $news['tentinraovat'] ?></h2>	
									<span class="place"><?php echo $news['noiban'] ?></span><br/>
								</a>	
								<h4>
									Đăng bởi 
									<a href="<?php echo '/timeline/' . convertUtf8ToLatin($news['username']) . '-' . $news['id_user'] ?>" class="user" alt="">
										<?php echo $news['username']?>
									</a>
								</h4>
							</li>
						<?php } ?>
					</ul>
					<div class="see-more">
						<a href="/category/khac-10">Xem thêm >></a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--end content -->
<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/public/inc/footer.php" ?>
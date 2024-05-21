<?php require page('includes/header') ?>

<div class="admin-content">
	<section style="margin-left: 5%; margin-right: 5%; ">

		<div id="demo" class="carousel slide" data-bs-ride="carousel">

		 <!-- Indicators/dots -->
		<div class="carousel-indicators">
		<button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
		    <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
		    <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
		</div>
		  
		<!-- The slideshow/carousel -->
		<div class="carousel-inner" style="background-color: #FFA500">
		    <div style="text-align: center; height: 100%;" class="carousel-item active">
			    <img class="hero" src="<?=ROOT?>/assets/images/hero.png" alt="Los Angeles" class="d-block" style="width: 80%; display: block; margin: auto; height: 800px;">
		    </div>
			<div style="text-align: center; height: 100%;" class="carousel-item">
			    <img class="hero" src="<?=ROOT?>/assets/images/hero4.jpg" alt="Chicago" class="d-block" style="width: 80%; display: block; margin: auto; height: 800px;">
			</div>
			<div style="text-align: center; height: 100%;" class="carousel-item">
			    <img class="hero" src="<?=ROOT?>/assets/images/hero2.jpg" alt="New York" class="d-block" style="width: 80%; display: block; margin: auto; height: 800px;">
			</div>	
		</div>
		  
		  <!-- Left and right controls/icons -->
		<button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
		    <span class="carousel-control-prev-icon"></span>
		</button>
		<button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
		    <span class="carousel-control-next-icon"></span>
		</button>
	</section>



	<section class="main_content" style="margin-left: 5%; margin-right: 5%;">		
		<div class="home-left">
			<div class="section-title" style="margin-left: 5%">VŨ TRỤ NHẠC VIỆT</div>

			<section class="content" >
				<?php

					$rows = db_query("select * from songs where category_id = 9 order by views desc limit 8");
				?>
				
				<?php if(!empty($rows)):?>
					<?php foreach($rows as $row):?>
						<?php include page('includes/song')?>
					<?php endforeach;?>
				<?php else:?>
					<div class="m-2">No songs found</div>
				<?php endif;?>

			</section>



			<div class="section-title" style="margin-left: 5%">QUỐC TẾ NỔI BẬT</div>

			<section class="content" >

				<div class="music-card">
					<?php
						$query = "select * from categories where id = 8";
						$row = db_query_one($query);
					?>
					<a href="<?=ROOT?>/category/<?=$row['id']?>" class="link-with-background" style="background-image: url('<?=ROOT?>/assets/images/cpop.jfif');">
					    C-Pop Favourites
					</a>
				</div>

				<div class="music-card">
					<?php
						$query = "select * from categories where id = 10";
						$row = db_query_one($query);
					?>
					<a href="<?=ROOT?>/category/<?=$row['id']?>" class="link-with-background" style="background-image: url('<?=ROOT?>/assets/images/Kpop-2.jpg');">
					    K-POP Today's Hits
					</a>
				</div>


				<div class="music-card">
					<?php
						$query = "select * from categories where id = 1";
						$row = db_query_one($query);
					?>
					<a href="<?=ROOT?>/category/<?=$row['id']?>" class="link-with-background" style="background-image: url('<?=ROOT?>/assets/images/pop_now.jfif');">
					    Pop Now
					</a>				
				</div>

				<div class="music-card">
					<?php
						$query = "select * from categories where id = 7";
						$row = db_query_one($query);
					?>
					<a href="<?=ROOT?>/category/<?=$row['id']?>" class="link-with-background" style="background-image: url('<?=ROOT?>/assets/images/viet_remix.jfif');">
					    Remix Việt
					</a>
				</div>

			</section>


			<div class="section-title" style="margin-left: 5%">MỚI PHÁT HÀNH</div>

			<section class="content" >
				<?php

					$rows = db_query("select * from songs order by date desc limit 8");
				?>
				
				<?php if(!empty($rows)):?>
					<?php foreach($rows as $row):?>
						<?php include page('includes/song')?>
					<?php endforeach;?>
				<?php else:?>
					<div class="m-2">No songs found</div>
				<?php endif;?>

			</section>
 

		</div>

		<div class="home-right">
			<div class="section-title" style="margin-left: 5%">BXH BÀI HÁT</div>

			<section class="content_record" >
				<div class="btn-tab-select bg-secondary" style="justify-content: space-around; border: 2px solid black;">
					<a style="color: white;" id="top10_nhac-viet" href="" title="Việt Nam">Việt Nam</a>
					<span></span>
					<a style="color: white;" id="top10_au-mi" href="" title="Âu Mĩ">Âu Mĩ</a>
					<span></span>
					<a style="color: white;" id="top10_nhac-han" href="" title="Nhạc Hàn">Nhạc Hàn</a>
				</div>

				<div class="list-chart-music" id="content1">
					<?php
						$rows = db_query( "select * from songs inner join categories on songs.category_id = categories.id inner join areas on categories.area_id = areas.id where  areas.id = 3 order by views desc limit 10");
					?>
					
					<ul class="list-group">
						<?php if(!empty($rows)):?>
							<?php $t = 0; ?> 
							<?php foreach($rows as $row):?>
								<?php include page('includes/record')?>
							<?php endforeach;?>
						<?php else:?>
							<div class="m-2">No songs found</div>
						<?php endif;?>
					</ul>
				</div>


				<div class="list-chart-music" id="content2">
					<?php
						$rows = db_query( "select * from songs inner join categories on songs.category_id = categories.id inner join areas on categories.area_id = areas.id where  areas.id = 2 order by views desc limit 10");
					?>
					
					<ul class="list-group">
						<?php if(!empty($rows)):?>
							<?php $t = 0; ?> 
							<?php foreach($rows as $row):?>
								<?php include page('includes/record')?>
							<?php endforeach;?>
						<?php else:?>
							<div class="m-2">No songs found</div>
						<?php endif;?>
					</ul>
				</div>


				<div class="list-chart-music" id="content3">
					<?php
						$rows = db_query( "select * from songs inner join categories on songs.category_id = categories.id inner join areas on categories.area_id = areas.id where  areas.id = 1 and categories.id = 10 order by views desc limit 10");
					?>
					
					<ul class="list-group">
						<?php if(!empty($rows)):?>
							<?php $t = 0; ?> 
							<?php foreach($rows as $row):?>
								<?php include page('includes/record')?>
							<?php endforeach;?>
						<?php else:?>
							<div class="m-2">No songs found</div>
						<?php endif;?>
					</ul>
				</div>


			</section>
		</div>

	</section>



	<!--Popular title-->
	<div style="background-color: #CFD5E6;">
		<div class="container-fluid" style="background-color: #CFD5E6;">
			<div class="container">
			  	<div class="row">
			    	<div class="col-md-12" style="padding-top: 10px;">
			      		<button class="btn btn-primary btn-block" id="nhac-viet">Nhạc Việt</button>
			      		<button class="btn btn-secondary btn-block" id="nhac-au-mi">Nhạc châu Á</button>
			      		<button class="btn btn-success btn-block" id="nhac-chau-a">Nhạc Âu Mĩ</button>
			    	</div>
				</div>
				<div id="part1" class="container mt-5 mb-5">
				    <div class="row">
				        <div class="col custom-column" style="background-color: white; margin-right: 20px;">
							<?php
								$query = "select * from categories where id = 9";
								$row = db_query_one($query);
							?>
						    <a href="<?=ROOT?>/category/<?=$row['id']?>"><img src="<?=ROOT?>/assets/images/pop_now.jfif" class="rounded" > </a>
			            	<span>Trải nghiệm ngay những bài nhạc Pop hay nhất ....</span>	
				        </div>
				        <div class="col-md-7 custom-column">
				            <div class="row">
				                <div class="col custom-column" style="background-color: white;">
				                	<?php
										$query = "select * from categories where id = 7";
										$row = db_query_one($query);
									?>
				                	<a href="<?=ROOT?>/category/<?=$row['id']?>"><img src="<?=ROOT?>/assets/images/remix-viet.jpeg" class="rounded" style="width:100px; height:100px"></a>
				                	<span>Lên là lên với các bản remix V-Pop sôi động ....</span>
				                </div>
				            </div>
				            <div class="row">
				                <div class="col custom-column" style="background-color: white;">
				                	<?php
										$query = "select * from categories where id = 7";
										$row = db_query_one($query);
									?>
				                	<a href="<?=ROOT?>/category/<?=$row['id']?>"><img src="<?=ROOT?>/assets/images/anh-chill-buon.jpg" class="rounded" style="width:100px; height:100px"> </a>
				                	<span>Có những nỗi buồn không biết chia sẻ cùng ai ....</span>
				                </div>
				            </div>
				            <div class="row">
				                <div class="col custom-column" style="background-color: white;">
				                	<?php
										$query = "select * from categories where id = 7";
										$row = db_query_one($query);
									?>
				                	<a href="<?=ROOT?>/category/<?=$row['id']?>"><img src="<?=ROOT?>/assets/images/lofi-chill.png" class="rounded" style="width:100px; height:100px"> </a>
				                	<span>Thả mình vào những giai điệu lofi nghe là nghiện</span>
				                </div>
				            </div>
				            <div class="row">
				                <div class="col custom-column" style="background-color: white;">
				                	<?php
										$query = "select * from categories where id = 7";
										$row = db_query_one($query);
									?>
				                	<a href="<?=ROOT?>/category/<?=$row['id']?>"><img src="<?=ROOT?>/assets/images/acoustic.png" class="rounded" style="width:100px; height:100px"> </a>
				                	<span>Không ồn ã, không vội vàng, cùng thư giãn với âm nhạc Acoustic ngay tại đây.</span>
				                </div>
				            </div>
				        </div>
				    </div>
				</div>
				<div id="part2" class="container mt-5 mb-5">
				    <div class="row">
				        <div class="col custom-column" style="background-color: white; margin-right: 20px;">
							<?php
								$query = "select * from categories where id = 1";
								$row = db_query_one($query);
							?>
						    <a href="<?=ROOT?>/category/<?=$row['id']?>"><img src="<?=ROOT?>/assets/images/kpop.jpg" class="rounded"> </a>
			            	<span>Kpop hôm nay có gì mới.</span>	
				        </div>
				        <div class="col-md-7 custom-column">
				            <div class="row">
				                <div class="col custom-column" style="background-color: white;" style="">
				                	<a href=""><img src="<?=ROOT?>/assets/images/jpop.jfif" class="rounded" style="width:100px; height:100px"> </a>
				                	<span>Hòa mình vào những giai điệu hấp dẫn đến từ xứ sở mặc trời mọc.</span>
				                </div>
				            </div>
				            <div class="row">
				                <div class="col custom-column" style="background-color: white;">
				                	<a href=""><img src="<?=ROOT?>/assets/images/cpop.jpg" class="rounded" style="width:100px; height:100px"> </a>
				                	<span>Cập nhật ngay xu hướng nhạc Trung.</span>
				                </div>
				            </div>
				            <div class="row">
				                <div class="col custom-column" style="background-color: white;">
				                	<a href=""><img src="<?=ROOT?>/assets/images/tpop.png" class="rounded" style="width:100px; height:100px"> </a>
				                	<span>Nhạc Thái Lan cũng đậc sắc lắm nhé,...</span>
				                </div>
				            </div>
				            <div class="row">
				                <div class="col custom-column" style="background-color: white;">
				                	<a href=""><img src="<?=ROOT?>/assets/images/india.jpg" class="rounded" style="width:100px; height:100px"> </a>
				                	<span>Pháp sư Án Độ làm nhạc cũng bánh buốn lắm.</span>
				                </div>
				            </div>
				        </div>
				    </div>
				</div>
				<div id="part3" class="container mt-5 mb-5">
				    <div class="row">
				        <div class="col custom-column" style="background-color: white; margin-right: 20px;">
							<?php
								$query = "select * from categories where id = 1";
								$row = db_query_one($query);
							?>
						    <a href="<?=ROOT?>/category/<?=$row['id']?>"><img src="<?=ROOT?>/assets/images/anh-chill-buon.jpg" class="rounded"> </a>
			            	<span>Có những nỗi buồn không biết chia sẻ cùng ai ....</span>	
				        </div>
				        <div class="col-md-7 custom-column">
				            <div class="row">
				                <div class="col custom-column" style="background-color: white;" style="">
				                	<a href=""><img src="<?=ROOT?>/assets/images/pop_now.jfif" class="rounded" style="width:100px; height:100px"> </a>
				                	<span>Có những nỗi buồn không biết chia sẻ cùng ai ....</span>
				                </div>
				            </div>
				            <div class="row">
				                <div class="col custom-column" style="background-color: white;">
				                	<a href=""><img src="<?=ROOT?>/assets/images/pop_now.jfif" class="rounded" style="width:100px; height:100px"> </a>
				                	<span>Có những nỗi buồn không biết chia sẻ cùng ai ....</span>
				                </div>
				            </div>
				            <div class="row">
				                <div class="col custom-column" style="background-color: white;">
				                	<a href=""><img src="<?=ROOT?>/assets/images/pop_now.jfif" class="rounded" style="width:100px; height:100px"> </a>
				                	<span>Có những nỗi buồn không biết chia sẻ cùng ai ....</span>
				                </div>
				            </div>
				            <div class="row">
				                <div class="col custom-column" style="background-color: white;">
				                	<a href=""><img src="<?=ROOT?>/assets/images/pop_now.jfif" class="rounded" style="width:100px; height:100px"> </a>
				                	<span>Có những nỗi buồn không biết chia sẻ cùng ai ....</span>
				                </div>
				            </div>
				        </div>
				    </div>
				</div>
			</div>
		</div>


		<div class="container-fluid event py-5" style="background-color: #EDEBEB;">
		    <div class="container py-5">
		        <div class="text-center mx-auto mb-5" style="max-width: 800px;">
		            <h5 class="text-uppercase text-primary">Playlist Tổng hợp</h5>
		            <h1 class="mb-0"> Âm nhạc muôn nơiiiiiiiiiiiii!</h1>
		        </div>
		        <div class="event-carousel owl-carousel">
		            <div class="event-item">
						<?php
							$query = "select * from categories where id = 16";
							$row = db_query_one($query);
						?>
		                <img src="<?=ROOT?>/assets/images/mua.png" class="img-fluid w-100" alt="Image">
		                <div class="event-content p-4" style="background-color: #F3E0C6; min-height: 250px;">
		                    <h4 class="mb-4">Mưa</h4>
		                    <p class="mb-4">Vạn hạt mưa rơi, không hạt nào rơi nhầm chỗ. Những người ta gặp, không người nào là ngẫu nhiên.</p>
		                    <a href="<?=ROOT?>/category/<?=$row['id']?>" class="btn-hover-bg btn btn-primary text-white py-2 px-4" href="#">Đến ngay</a>
		                </div>
		            </div>
		            <div class="event-item">
						<?php
							$query = "select * from categories where id = 17";
							$row = db_query_one($query);
						?>
		                <img src="<?=ROOT?>/assets/images/ost-korea.jpg" class="img-fluid w-100" alt="Image">
		                <div class="event-content p-4" style="background-color: #F3E0C6; min-height: 250px;">
		                    <h4 class="mb-4">Tổng hợp nhạc phim Hàn</h4>
		                    <p class="mb-4">Cùng đến với những bản nhạc phim Hàn bất hủ.......</p>
		                    <a href="<?=ROOT?>/category/<?=$row['id']?>" class="btn-hover-bg btn btn-primary text-white py-2 px-4" href="#">Đến ngay</a>
		                </div>
		            </div>
		            <div class="event-item">
						<?php
							$query = "select * from categories where id = 18";
							$row = db_query_one($query);
						?>
		                <img src="<?=ROOT?>/assets/images/ost-china.jpg" class="img-fluid w-100" alt="Image">
		                <div class="event-content p-4" style="background-color: #F3E0C6; min-height: 250px;">
		                    <h4 class="mb-4">Tổng hợp nhạc phim Trung</h4>
		                    <p class="mb-4">Thả hồn vào những giai điệu của những bộ phim Hoa ngữ quen thuộc.</p>
		                    <a href="<?=ROOT?>/category/<?=$row['id']?>" class="btn-hover-bg btn btn-primary text-white py-2 px-4" href="#">Đến ngay</a>
		                </div>
		            </div>
		            <div class="event-item">
						<?php
							$query = "select * from categories where id = 11";
							$row = db_query_one($query);
						?>
		                <img src="<?=ROOT?>/assets/images/au-mi-dac-sac.png" class="img-fluid w-100" alt="Image">
		                <div class="event-content p-4" style="background-color: #F3E0C6; min-height: 250px;">
		                    <h4 class="mb-4">Âu Mĩ đặc sắc</h4>
		                    <p class="mb-4">Âu Mĩ có gì mới.. Khám phá ngay.</p>
		                    <a href="<?=ROOT?>/category/<?=$row['id']?>" class="btn-hover-bg btn btn-primary text-white py-2 px-4" href="#">Đến ngay</a>
		                </div>
		            </div>
		        </div>
		    </div>

		</div>

	</div>
</div>


<div class="artist_suggest container-fluid d-flex justify-content-center mt-5 mb-5">

	<ul class="list-group list-group-horizontal">
	  <li class="list-group-item"><a href=""><img src="<?=ROOT?>/assets/images/pop_now.jfif" class="rounded-circle" style="width:100px; height:100px"> </a></li>
	  <li class="list-group-item"><a href=""><img src="<?=ROOT?>/assets/images/pop_now.jfif" class="rounded-circle" style="width:100px; height:100px"> </a></li>
	  <li class="list-group-item"><a href=""><img src="<?=ROOT?>/assets/images/pop_now.jfif" class="rounded-circle" style="width:100px; height:100px"> </a></li>
	  <li class="list-group-item"><a href=""><img src="<?=ROOT?>/assets/images/pop_now.jfif" class="rounded-circle" style="width:100px; height:100px"> </a></li>
	  <li class="list-group-item"><a href=""><img src="<?=ROOT?>/assets/images/pop_now.jfif" class="rounded-circle" style="width:100px; height:100px"> </a></li>
	</ul>

</div>

<script type="text/javascript">
function showPart(partId) {
	document.getElementById("part1").style.display = "none";
	document.getElementById("part2").style.display = "none";
	document.getElementById("part3").style.display = "none";
	document.getElementById(partId).style.display = "block";
}


document.getElementById("nhac-viet").addEventListener("click", function(event) {
    event.preventDefault();
    showPart("part1");
});

document.getElementById("nhac-au-mi").addEventListener("click", function(event) {
    event.preventDefault();
    showPart("part2");
});

document.getElementById("nhac-chau-a").addEventListener("click", function(event) {
    event.preventDefault();
    showPart("part3");
});

window.onload = function() {
    showPart("part1");
};



function showContent(contentId) {
	document.getElementById("content1").style.display = "none";
	document.getElementById("content2").style.display = "none";
	document.getElementById("content3").style.display = "none";
	document.getElementById(contentId).style.display = "block";
}


document.getElementById("top10_nhac-viet").addEventListener("click", function(event) {
    event.preventDefault();
    showContent("content1");
});

document.getElementById("top10_au-mi").addEventListener("click", function(event) {
    event.preventDefault();
    showContent("content2");
});

document.getElementById("top10_nhac-han").addEventListener("click", function(event) {
    event.preventDefault();
    showContent("content3");
});

window.onload = function() {
    showContent("content1");
};




</script>

<?php require page('includes/footer') ?>

	
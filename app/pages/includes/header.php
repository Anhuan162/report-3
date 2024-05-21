<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?=ucfirst($URL[0])?> - HG</title>
	<link rel="stylesheet" type="text/css" href="<?=ROOT?>/assets/css/style.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>



  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Google Web Fonts -->
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600&family=Roboto&display=swap" rel="stylesheet"> 

  <!-- Icon Font Stylesheet -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Libraries Stylesheet -->
  <link href="<?=ROOT?>/assets/lib/owlcarousel/owl.carousel.min.css" rel="stylesheet">


  <!-- Customized Bootstrap Stylesheet -->
  <link href="<?=ROOT?>/assets/css/bootstrap.min.css" rel="stylesheet">

  <!-- Template Stylesheet -->
  <link href="<?=ROOT?>/assets/css/style_plus.css" rel="stylesheet">

  <!-- Use to style song-full --> 
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>
	<header style="background-color:orange; position: fixed; width: 100%; top: 0px;">
		<div class="logo-holder">
			<a href="<?=ROOT?>" style="height: 100%;"><img style="height: 100%;" class="logo" src="<?=ROOT?>/assets/images/logo.jpg"></a>		
		</div>
		<div class="header-div" >
			<div class="main-title">
				HGMusic
				<div class="socials">
					<a href="https://www.facebook.com/profile.php?id=61558708141906" target="_blank">
					<svg  width="25" height="25" fill="blue" class="bi bi-facebook" viewBox="0 0 16 16">
					  <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951"/>
					</svg>
					</a>
					<svg  width="25" height="25" fill="blue" class="bi bi-tiktok" viewBox="0 0 16 16">
					  <path d="M9 0h1.98c.144.715.54 1.617 1.235 2.512C12.895 3.389 13.797 4 15 4v2c-1.753 0-3.07-.814-4-1.829V11a5 5 0 1 1-5-5v2a3 3 0 1 0 3 3z"/>
					</svg>
					<svg  width="25" height="25" fill="blue" class="bi bi-instagram" viewBox="0 0 16 16">
					  <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334"/>
					</svg>
				</div>
			</div>
			<div class="main-nav" >
				<div class="nav-item "><a href="<?=ROOT?>">Trang chủ</a></div>
				<div class="nav-item"><a href="<?=ROOT?>/music">Bài hảt</a></div>

				<div class="nav-item dropdown">
					<a href="#">Thể loại</a>



					<div class="dropdown-list" style="height: 400px; width: 650px;">
						<div class="category-list">
							<?php
								$query = "SELECT categories.id, categories.category FROM categories INNER JOIN areas ON areas.id = categories.area_id WHERE areas.id = 3";
								$categories = db_query($query);
							?>
							<ul>
							    <h4>Nhạc Việt</h4>
							    <?php if (!empty($categories)): ?>
							        <?php foreach ($categories as $cat): ?>
							            <li class="nav-item"><a href="<?= ROOT ?>/category/<?= $cat['id'] ?>"><?= htmlspecialchars($cat['category'], ENT_QUOTES, 'UTF-8') ?></a></li>
							        <?php endforeach; ?>
							    <?php else: ?>
							        <li class="nav-item">Không có danh mục nào</li>
							    <?php endif; ?>
							</ul>	
							
							<?php
								$query = "SELECT categories.id, categories.category FROM categories INNER JOIN areas ON areas.id = categories.area_id WHERE areas.id = 1";
								$categories = db_query($query);
							?>
							<ul>
							    <h4>Châu Á</h4>
							    <?php if (!empty($categories)): ?>
							        <?php foreach ($categories as $cat): ?>
							            <li class="nav-item"><a href="<?= ROOT ?>/category/<?= $cat['id'] ?>"><?= htmlspecialchars($cat['category'], ENT_QUOTES, 'UTF-8') ?></a></li>
							        <?php endforeach; ?>
							    <?php else: ?>
							        <li class="nav-item">Không có danh mục nào</li>
							    <?php endif; ?>
							</ul>	

							<?php
								$query = "SELECT categories.id, categories.category FROM categories INNER JOIN areas ON areas.id = categories.area_id WHERE areas.id = 2";
								$categories = db_query($query);
							?>
							<ul>
							    <h4>Âu Mĩ</h4>
							    <?php if (!empty($categories)): ?>
							        <?php foreach ($categories as $cat): ?>
							            <li class="nav-item"><a href="<?= ROOT ?>/category/<?= $cat['id'] ?>"><?= htmlspecialchars($cat['category'], ENT_QUOTES, 'UTF-8') ?></a></li>
							        <?php endforeach; ?>
							    <?php else: ?>
							        <li class="nav-item">Không có danh mục nào</li>
							    <?php endif; ?>
							</ul>	

							<?php
								$query = "SELECT categories.id, categories.category FROM categories INNER JOIN areas ON areas.id = categories.area_id WHERE areas.id = 4";
								$categories = db_query($query);
							?>
							<ul>
							    <h4>Khác</h4>
							    <?php if (!empty($categories)): ?>
							        <?php foreach ($categories as $cat): ?>
							            <li class="nav-item"><a href="<?= ROOT ?>/category/<?= $cat['id'] ?>"><?= htmlspecialchars($cat['category'], ENT_QUOTES, 'UTF-8') ?></a></li>
							        <?php endforeach; ?>
							    <?php else: ?>
							        <li class="nav-item">Không có danh mục nào</li>
							    <?php endif; ?>
							</ul>	
						</div>
					</div>
				</div>


				<div class="nav-item"><a href="<?=ROOT?>/artists">Nghệ sĩ</a></div>
				<div class="nav-item"><a href="<?=ROOT?>/about">Khám phá</a></div>
				<div class="nav-item"><a href="<?=ROOT?>/contact">Tương tác</a></div>

				<div class="footer-div" style="min-width: 600px;">
					<form action="<?=ROOT?>/search">
						<div class="form-group">
							<input class="form-control" type="text" placeholder="Tìm kiếm bài hát" name="find">
							<button class="btn btn-secondary">
								<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-search" viewBox="0 0 18 18">
								    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
								</svg>
							</button>
						</div>
					</form>
				</div>

				<?php if(logged_in()):?>
					<div class="nav-item dropdown" style="margin-left: auto; margin-right: 5%;">
						<a href="#">Hi, <?=user('username')?></a>
						<div class="dropdown-list ">
							<div class="nav-item"><a href="<?=ROOT?>/admin/users/edit/<?=user('id')?>">Profile</a></div>
							<div class="nav-item"><a href="<?=ROOT?>/admin">Admin</a></div>
							<div class="nav-item"><a href="<?=ROOT?>/logout">Đăng xuất</a></div>
						</div>
					</div>
				<?php elseif(!logged_in()):?>
					<div class="btn-group" style="margin-left: auto;">
						<button type="button" class="btn btn-dark"><a href="<?=ROOT?>/login">Đăng nhập</a> </button>
  						<button type="button" class="btn btn-dark"><a href="<?=ROOT?>/signup">Đăng ký</a> </button>
					</div>
				<?php endif;?>

			</div>
		</div>
	</header>

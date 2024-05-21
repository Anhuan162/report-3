<?php


	if($_SERVER['REQUEST_METHOD'] == "POST"){

		$errors = [];

		$values = [];
		$values['email'] = trim($_POST['email']);
		$query = "select * from users where email = :email limit 1";
		$row = db_query_one($query, $values);


		if(!empty($row)){
			message($row['password']);
			message($row['email']);
			message($row['role']);
			message($_POST['password']);
			if(password_verify($_POST['password'], $row['password'])){

				authenticate($row);
				message("login successful");
				redirect('admin');
			}

		}
		message("wrong email or password");
		
	}

?>



<?php require page('includes/header')?>

	<section class="content" style="min-height: 85%; align-items: center;">
		
		<div class="login-holder">
			<?php if(message()):?>
				<div class="alert"><?=message('',true)?></div>
			<?php endif;?>

			<form method="post">
				<center><img src="assets/images/logo.jpg" style="width: 150px; border-radius: 50%; border: solid thin $ccc;">  </center>
				<h1>Login</h1>
				<div class="mb-3 mt-3">
					<label for="email">Email:</label>
					<input  value="<?=set_value('email')?>" class="my-1 form-control" type="email" name="email" placeholder="Email">
				</div>

				<div class="mb-3">
					<label for="pwd">Mật khẩu:</label>
					<input  value="<?=set_value('password')?>" class="my-1 form-control" type="password" name="password" placeholder="Nhập mật khẩu">
				</div>

			    <div class="form-check mb-3">
			      <label class="form-check-label">
			        <input class="form-check-input" type="checkbox" name="remember"> Remember me
			      </label>

			    </div>
			    <button class="my-1 btn bg-secondary ">Đăng nhập</button>
			</form>
		</div>
		
	</section>


<?php require page('includes/footer')?>

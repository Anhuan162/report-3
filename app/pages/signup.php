<?php

	if($_SERVER['REQUEST_METHOD'] == "POST"){

		$errors = [];

		// data validation
		if(empty($_POST['username'])){
			$errors['username'] = "a username is required";
		}
		else
		if(!preg_match("/^[a-zA-Z \.\-\p{L}]+$/u", $_POST['username'])){
			$errors['username'] = "a username can only have letters with no spaces";
		}

		if(empty($_POST['email'])){
			$errors['email'] = "a email is required";
		}
		else
		if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
			$errors['email'] = "email not valid";
		}

		if(empty($_POST['password'])){
			$errors['password'] = "a password is required";
		}
		else
		if($_POST['password'] != $_POST['retype_password']){
			$errors['password'] = " passwords do not match";
		}else
		if(strlen($_POST['password']) < 8){
			$errors['password'] = "password must be 8 characters or more";
		} 


		if(empty($errors)){

			$values = [];
			$values['username'] 	= trim($_POST['username']);
			$values['email'] 		= trim($_POST['email']);
			$values['role'] 		= "user";
			$values['password'] 	= password_hash($_POST['password'], PASSWORD_DEFAULT);
			$values['date'] 		= date("Y-m-d H:i:s");
			
			$query = "insert into users (username, email, password, role, date) values (:username, :email, :password, :role, :date)";
			db_query($query,$values);

			message("user created successfully");
			redirect('login');
		}
	
	}

?>



<?php require page('includes/header') ?>

<div class="admin-content"> 
	
	<div class="container" style="margin-top: 70px; margin-bottom: 70px;">
	  	<h3>Đăng ký tài khoản</h3>
	    
	  	<form method="post" enctype="multipart/form-data" class="was-validated">
	    	<div class="mb-3 mt-3">
	      		<label for="uname" class="form-label">Tên người dùng :</label>
	      		<input class="form-control my-1" value="<?=set_value('username')?>"  type="text" name="username" placeholder="Nhập tên người dùng" required>
	     	 	<div class="valid-feedback"></div>
	      		<div class="invalid-feedback">Vui lòng nhập tên người dùng.</div>
	    	</div>
	    	<div class="mb-3">
	      		<label for="pwd" class="form-label">Mật khẩu :</label>
	      		<input class="form-control my-1" value="<?=set_value('password')?>" type="password" name="password" placeholder="Nhập mật khẩu của bạn" required>
	      		<div class="valid-feedback"></div>
	      		<div class="invalid-feedback">Vui lòng nhập mật khẩu của bạn.</div>
	    	</div>

	    	<div class="mb-3">
	      		<label for="pwd" class="form-label">Nhập lại mật khẩu :</label>
	      		<input type="password" class="form-control my-1" id="pwd" placeholder="Nhập lại mật khẩu của bạn" name="retype_password"  required>
	      		<div class="valid-feedback"></div>
	      		<div class="invalid-feedback">Vui lòng nhập lại mật khẩu của bạn.</div>
	    	</div>	    	
	    	<div class="mb-3 mt-3">
	      		<label for="uname" class="form-label">Email :</label>
	      		<input class="form-control my-1" value="<?=set_value('email')?>" type="eamil" name="email" placeholder="Nhập email của bạn">
	     	 	<div class="valid-feedback"></div>
	      		<div class="invalid-feedback">Vui lòng nhập email của bạn.</div>
	    	</div>



	    	<div class="form-check mb-3">
	      		<input class="form-check-input" type="checkbox" id="myCheck"  name="remember" required>
	      		<label class="form-check-label" for="myCheck">Xem điều khoản và chính sách bảo mật.</label>
	      		<div class="valid-feedback">Đồng ý.</div>
	      		<div class="invalid-feedback">Không đồng ý.</div>
	    	</div>

	  		<button type="submit" class="btn btn-primary">Đăng ký</button>
	  	</form>


	</div>
</div>

<?php require page('includes/footer') ?>

	
<?php
	
	if($action == 'add'){

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

			if(empty($_POST['role'])){
				$errors['role'] = "a role is required";
			}

			if(empty($errors)){

				$values = [];
				$values['username'] 	= trim($_POST['username']);
				$values['email'] 		= trim($_POST['email']);
				$values['role'] 		= trim($_POST['role']);
				$values['password'] 	= password_hash($_POST['password'], PASSWORD_DEFAULT);
				$values['date'] 		= date("Y-m-d H:i:s");
				
				$query = "insert into users (username, email, password, role, date) values (:username, :email, :password, :role, :date)";
				db_query($query,$values);

				message("user created successfully");
				redirect('admin/users');
			}
		
		}
	}
	else
	if($action == 'edit'){

		$query = "select * from users where id = :id limit 1";
		$row = db_query_one($query, ['id'=>$id]);

		if($_SERVER['REQUEST_METHOD'] == "POST" && $row){

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

			if(!empty($_POST['password'])){
				if($_POST['password'] != $_POST['retype_password']){
					$errors['password'] = " passwords do not match";
				}else
				if(strlen($_POST['password']) < 8){
					$errors['password'] = "password must be 8 characters or more";
				} 
			}


			if(empty($_POST['role'])){
					$errors['role'] = "a role is required";
			}
			

			if(empty($errors)){

				$values = [];
				$values['username'] 	= trim($_POST['username']);
				$values['email'] 		= trim($_POST['email']);
				$values['role'] 		= trim($_POST['role']);
				$values['id'] 			= $id;
			

				$query = "update users set email = :email, username = :username, role = :role where id = :id limit 1";

				if(!empty($_POST['password'])){
					$query = "update users set email = :email, password = :password, username = :username, role = :role where id = :id limit 1";
					$values['password'] 	= password_hash($_POST['password'], PASSWORD_DEFAULT);
				}
				
				db_query($query,$values);

				message("User edited successfully");
				redirect('admin/users');
			}
		
		}
	}else
	if($action == 'delete'){

		$query = "select * from users where id = :id limit 1";
		$row = db_query_one($query, ['id'=>$id]);

		if($_SERVER['REQUEST_METHOD'] == "POST" && $row){

			$errors = [];

			if($row['id'] == 1){
				$errors['username'] = "The main admin can not be deleted";
			}

			if(empty($errors)){

				$values = [];

				$values['id'] 			= $id;
			

				$query = "delete from users where id = :id limit 1";
				
				db_query($query,$values);

				message("User deleted successfully");
				redirect('admin/users');
			}
		
		}
	}

?>






<?= require page('includes/admin-header')?>

	<section class="admin-content" style="min-height: 200px;">

		<?php if($action == 'add'):?>
			<div style="max-width: 500px; margin: auto;">
				<form method="post">
					<h3>Add New User</h3>
					<input class="form-control my-1" value="<?=set_value('username')?>"  type="text" name="username" placeholder="Username">
					<?php if(!empty($errors['username'])):?>
						<small class="error"><?=$errors['username']?></small>
					<?php endif;?>
					

					<input class="form-control my-1" value="<?=set_value('email')?>" type="eamil" name="email" placeholder="Email">
					<?php if(!empty($errors['email'])):?>
						<small class="error"><?=$errors['email']?></small>
					<?php endif;?>

					<select name="role" class="form-control my-1">
						<option value="">--Select Role--</option>
						<option <?=set_select('role', 'user') ?> value="user">User</option>
						<option <?=set_select('role', 'admin')?> value="admin">Admin</option>

					</select>
					<?php if(!empty($errors['role'])):?>
						<small class="error"><?=$errors['role']?></small>
					<?php endif;?>


					<input class="form-control my-1" value="<?=set_value('password')?>" type="password" name="password" placeholder="Password ( leave empty to keep old one )">
					<?php if(!empty($errors['password'])):?>
						<small class="error"><?=$errors['password']?></small>				
					<?php endif;?>

					<input class="form-control my-1" value="<?=set_value('retype_password')?>" type="password" name="retype_password" placeholder="Retype Password">

					<button class="btn bg-orange">Save</button>
					<a href="<?=ROOT?>/admin/users">
						<button type="button" class="float-end btn">Back</button>
					</a>
				</form>
			</div>
			

		<?php elseif($action == 'edit'):?>

			<div style="max-width: 500px; margin: auto;">
				<form method="post">
					<h3>Edit User</h3>

					<?php if(!empty($row)):?>

					<input class="form-control my-1" value="<?=set_value('username', $row['username'])?>"  type="text" name="username" placeholder="Username">
					<?php if(!empty($errors['username'])):?>
						<small class="error"><?=$errors['username']?></small>
					<?php endif;?>
					

					<input class="form-control my-1" value="<?=set_value('email', $row['email'])?>" type="eamil" name="email" placeholder="Email">
					<?php if(!empty($errors['email'])):?>
						<small class="error"><?=$errors['email']?></small>
					<?php endif;?>

					<select name="role" class="form-control my-1">
						<option value="">--Select Role--</option>
						<option <?=set_select('role', 'user', $row['role'])?> value="user">User</option>
						<option <?=set_select('role', 'admin', $row['role'])?> value="admin">Admin</option>

					</select>
					<?php if(!empty($errors['role'])):?>
						<small class="error"><?=$errors['role']?></small>
					<?php endif;?>


					<input class="form-control my-1" value="<?=set_value('password')?>" type="password" name="password" placeholder="Password (leave empty to keep old one)">
					<?php if(!empty($errors['password'])):?>
						<small class="error"><?=$errors['password']?></small>				
					<?php endif;?>

					<input class="form-control my-1" value="<?=set_value('retype_password')?>" type="password" name="retype_password" placeholder="Retype Password">

					<button class="btn bg-orange">Save</button>
					<a href="<?=ROOT?>/admin/users">
						<button type="button" class="float-end btn">Back</button>
					</a>

					<?php else:?>
						<div class="alert">That record was not found</div>
						<a href="<?=ROOT?>/admin/users">
							<button type="button" class="float-end btn">Back</button>
						</a>
					<?php endif;?>

				</form>
			</div>


		<?php elseif($action == 'delete'):?>

			<div style="max-width: 500px; margin: auto;">
				<form method="post">
					<h3>Delete User</h3>

					<?php if(!empty($row)):?>

					<div class="form-control my-1" ><?=set_value('username', $row['username'])?></div>
					<?php if(!empty($errors['username'])):?>
						<small class="error"><?=$errors['username']?></small>
					<?php endif;?>
					

					<div class="form-control my-1" ><?=set_value('email', $row['email'])?></div> 

					<div class="form-control my-1" ><?=set_value('role', $row['role'])?></div> 
					

					<button class="btn bg-red">Delete</button>
					<a href="<?=ROOT?>/admin/users">
						<button type="button" class="float-end btn">Back</button>
					</a>

					<?php else:?>
						<div class="alert">That record was not found</div>
						<a href="<?=ROOT?>/admin/users">
							<button type="button" class="float-end btn">Back</button>
						</a>
					<?php endif;?>

				</form>
			</div>
		<?php else:?>


			<?php
				$query = "select * from users order by id asc limit 20";
				$rows = db_query($query);

			?>
			<div class="tab_head_container">
				<div class="page_limit">
					<span>Show</span>
					<select id = "table_size">
						<option value="10">10</option>
						<option value="20">20</option>
						<option value="50">50</option>
						<option value="100">100</option>
					</select>
					<span>entries.</span>
				</div>			
				<div class="tab_filter_container">
					<input type="" id="tab_filter_text">
					<button  id="tab_filter_btn" class="active">Filter</button>
				</div>
			</div>

			<h3>Users
				<a href="<?=ROOT?>/admin/users/add"><button class="float-end btn bg-purple">Add New</button> </a>
				
			</h3> 
			<table class="table">
				<thead>
					<tr>
						<th class="sortRank" columnName="id">ID</th>
						<th class="sortRank" columnName="username">Username</th>
						<th class="sortRank" columnName="email">Email</th>
						<th class="sortRank" columnName="role">Role</th>
						<th class="sortRank" columnName="date">Date</th>
						<th>Action</th>
					</tr>
				</thead>

				<tbody></tbody>
			</table>

			<div class="footer">
				<span></span>
				<div class="index_buttons">
				</div>
			</div>
		
		<?php endif;?>

		
	</section>

	<footer style="display: block;">
		<center>Copyright @<?=date("Y")?></center>
	</footer>

</body>



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>

var styles = document.documentElement.style;
var array = [];
var array_length = 0;   // size of the arrays objects
var table_size = 10;  // the num of table rows
var start_index = 1;  // start value of the record footer
var end_index = 0; 
var current_index = 1;
var max_index = 0;
var sortCol = 'id';
var ascOrder = true;

let rankList = [];

$.ajax({
	url: 'http://localhost/HGMusic/public/users_data',
	type : 'GET',
	dataType: 'json',
	success:function(data){
		rankList = data;
		console.log(rankList);
		displayIndexButtons();
	}

}
)


function preLoadCalculations(){
	filterRankList();
	sortRankList();
	array_length = array.length;
	max_index = parseInt( array_length / table_size );

	if((array_length % table_size) > 0 ){
		max_index++;
	}
}


function filterRankList() {
	var tab_filter_text = $("#tab_filter_text").val();
	if(tab_filter_text != ''){
		var temp_array = rankList.filter(function(object){
			return object.id.toString().includes(tab_filter_text)
			|| object.username.toUpperCase().includes(tab_filter_text.toUpperCase())
			|| object.email.toUpperCase().includes(tab_filter_text.toUpperCase())
			|| object.role.toUpperCase().includes(tab_filter_text.toUpperCase())
			|| object.date.toUpperCase().includes(tab_filter_text.toUpperCase());
		});
		array = temp_array;
	}else{
		array = rankList;
	}
}

function sortRankList(){
	array.sort((a, b)=>{
		if(ascOrder){
			return (a[sortCol] > b[sortCol] ? 1 : -1);
		}else{
			return (b[sortCol] > a[sortCol] ? 1 : -1);
		}
	});

	$(".table .sortRank").removeClass('sort_indication');
	$(".table .sortRank[columnName='"+sortCol+"']").addClass('sort_indication');

	if(ascOrder){
		styles.setProperty('--up_arrow_color', ' #fff');
		styles.setProperty('--up_arrow_shadow', '0px, 0px, 10px, white');
		styles.setProperty('--down_arrow_color', '#ffffff49');
		styles.setProperty('--down_arrow_shadow', '0px, 0px, 0px rgb(255, 255, 255, 0)');
	}else{		
		styles.setProperty('--up_arrow_color', '#ffffff49');
		styles.setProperty('--up_arrow_shadow', '0px, 0px, 0px rgb(255, 255, 255, 0)');	
		styles.setProperty('--down_arrow_color', ' #fff');
		styles.setProperty('--down_arrow_shadow', '0px, 0px, 10px, white');

	}
}

function displayIndexButtons(){
	preLoadCalculations();
	$(".index_buttons button").remove()
	$(".index_buttons").append('<button class="pagination btn px-3 py-2" onclick="prev();">Previous</button>') ;

	for(var i=1; i<=max_index; i++){
		$(".index_buttons").append('<button class="pagination btn px-3 py-2" onclick="indexPagination('+i+')" index="'+i+'">'+i+'</button>');
	}

	$(".index_buttons").append('<button class="pagination btn px-3 py-2" onclick="next();">Next</button>');
	highlightIndexButton();
}



function highlightIndexButton(){
	start_index = ((current_index - 1) * table_size) + 1;
	end_index = (start_index + table_size) - 1;
	if(end_index > array_length){
		end_index = array_length;
	}

	$(".footer span").text('Showing '+start_index+' to '+end_index+' of '+array_length+' entries');
	$(".index_buttons .pagination").removeClass('active');
	$(".index_buttons .pagination[index='"+current_index+"']").addClass('active');
	
	displayTableRows();
}


function displayTableRows(){
	$(".table tbody tr").remove();
	var tab_start = start_index - 1;
	var tab_end = end_index;

	for(var i=tab_start; i<tab_end; i++){
		var user = array[i];
		var tr = 	'<tr>'+
						'<td>' 	+user['id']+ '</td>'+
						'<td>' 	+user['username']+ '</td>'+
						'<td>' 	+user['email']+ '</td>'+
						'<td>' 	+user['role']+ '</td>'+
						'<td>' 	+user['date']+ '</td>'+
						'<td>' +
								'<a href="http://localhost/HGMusic/public/admin/users/edit/'+user['id']+'">'+
									'<img class="bi" src="http://localhost/HGMusic/public/assets/icons/pencil-square.svg">' + 
								'</a>'+
								'<a href="http://localhost/HGMusic/public/admin/users/delete/'+user['id']+'">'+								
									'<img class="bi"src="http://localhost/HGMusic/public/assets/icons/trash3.svg">'+
								'</a>'+
						'</td>'+
					'</tr';

		$(".table tbody").append(tr);
	}
}

displayIndexButtons();

function next(){
	if(current_index < max_index){
		current_index++;
		highlightIndexButton();
	}
	
}

function prev(){
	if(current_index > 1){
		current_index--;
		highlightIndexButton();
	}
}

function indexPagination(index){
	current_index = parseInt(index);
	highlightIndexButton();
	
}


$("#table_size").change(function(){
	table_size = parseInt($(this).val());
	current_index = 1;
	start_index = 1;
	displayIndexButtons();
}
);


$("#tab_filter_btn").click(function(){
	current_index = 1;
	start_index = 1;
	displayIndexButtons();
});


$(".table .sortRank").click(function(){
	var colName = $(this).attr("columnName");
	ascOrder = (sortCol == colName) ? !ascOrder : true;
	sortCol = colName;
	current_index = 1;
	start_index = 1;
	displayIndexButtons();
});

</script>


</html>

<?php
	
	if($action == 'add'){

		if($_SERVER['REQUEST_METHOD'] == "POST"){

			$errors = [];

			// data validation
			if(empty($_POST['name'])){
				$errors['name'] = "an image is required";
			}
			else
			if(!preg_match("/^[a-zA-Z0-9 \.\&\-\p{L}]+$/u", $_POST['name'])){
				$errors['name'] = "a name can only have letters & spaces";
			}

			//image
			if(!empty($_FILES['image']['name'])){

				$folder = "uploads/";
				if(!file_exists($folder)){
					mkdir($folder, 0777, true);
					file_put_contents($folder."imdex.php", "");
				}

				$allowed = ['image/jpeg', 'image/png', 'image/jpg'];
				if($_FILES['image']['error'] == 0 && in_array( $_FILES['image']['type'], $allowed)){
					$destination = $folder.$_FILES['image']['name'];	
					move_uploaded_file($_FILES['image']['tmp_name'], $destination);

				}else{
					$errors['name'] = "Image no valid. Allowed tyes are ". implode(',', $allowed);
				}

				


			}else{
				$errors['name'] = "a name is required";
			}

			if(empty($errors)){

				$values = [];
				$values['name'] 	= trim($_POST['name']);
				$values['image'] 	= $destination;
				$values['user_id'] 	= user('id');
				
				$query = "insert into artists (name, image, user_id) values (:name, :image, :user_id)";
				db_query($query,$values);

				message("name created successfully");
				redirect('admin/artists');
			}
		
		}
	}
	else
	if($action == 'edit' ){

		$query = "select * from artists where id = :id limit 1";
		$row = db_query_one($query, ['id'=>$id]);

		if($_SERVER['REQUEST_METHOD'] == "POST" && $row){

			$errors = [];

			// data validation
			if(empty($_POST['name'])){
				$errors['name'] = "a name is required";
			}
			else
			if(!preg_match("/^[a-zA-Z0-9 \.\&\-\p{L}]+$/u", $_POST['name'])){
				$errors['name'] = "a name can only have letters & spaces";
			}


			//image
			if(!empty($_FILES['image']['name'])){

				$folder = "uploads/";
				if(!file_exists($folder)){
					mkdir($folder, 0777, true);
					file_put_contents($folder."imdex.php", "");
				}

				$allowed = ['image/jpeg', 'image/png', 'image/jpg'];
				if($_FILES['image']['error'] == 0 && in_array( $_FILES['image']['type'], $allowed)){
					$destination = $folder.$_FILES['image']['name'];	
					move_uploaded_file($_FILES['image']['tmp_name'], $destination);

					// delete old file
					if(file_exists($row['image'])){
						unlink($row['image']);
					}

				}else{
					$errors['name'] = "Image no valid. Allowed tyes are ". implode(',', $allowed);
				}

			}

			if(empty($errors)){

				$values = [];
				$values['name'] 	= trim($_POST['name']);
			
				$values['user_id'] 	= user('id');
				$values['id']   	= $id;

				$query = "update artists set name = :name, user_id = :user_id where id = :id limit 1";
				
				if(!empty($destination)){
					$query = "update artists set name = :name, image = :image, user_id = :user_id where id = :id limit 1";
				
					$values['image'] 	= $destination;
				}


				db_query($query,$values);

				message("Artist edited successfully");
				redirect('admin/artists');
			}
		
		}
	}else
	if($action == 'delete'){

		$query = "select * from artists where id = :id limit 1";
		$row = db_query_one($query, ['id'=>$id]);

		if($_SERVER['REQUEST_METHOD'] == "POST" && $row){

			$errors = [];

			if(empty($errors)){
				$values = [];

				$values['id'] 	= $id;
			

				$query = "delete from artists where id = :id limit 1";
				
				db_query($query,$values);

				// delete old file
				if(file_exists($row['image'])){
					unlink($row['image']);
				}

				message("Artist deleted successfully");
				redirect('admin/artists');
			}
		
		}
	}

?>






<?= require page('includes/admin-header')?>

	<section class="admin-content" style="min-height: 200px;">

		<?php if($action == 'add'):?>
			<div style="max-width: 500px; margin: auto;">
				<form method="post" enctype="multipart/form-data">

					<h3>Add New Artist</h3>

					<input class="form-control my-1" value="<?=set_value('name')?>"  type="text" name="name" placeholder="name">
					<?php if(!empty($errors['name'])):?>
						<small class="error"><?=$errors['name']?></small>
					<?php endif;?>
					
					<input class="form-control my-1" type="file" name="image">

					<?php if(!empty($errors['image'])):?>
						<small class="error"><?=$errors['image']?></small>
					<?php endif;?>


					<button class="btn bg-orange">Save</button>
					<a href="<?=ROOT?>/admin/artists">
						<button type="button" class="float-end btn">Back</button>
					</a>
				</form>
			</div>
			

		<?php elseif($action == 'edit'):?>

			<div style="max-width: 500px; margin: auto;">
				<form method="post" enctype="multipart/form-data">
					<h3>Edit Artist</h3>

					<?php if(!empty($row)):?>

					<input class="form-control my-1" value="<?=set_value('name', $row['name'])?>"  type="text" name="name" placeholder="name">
					<?php if(!empty($errors['name'])):?>
						<small class="error"><?=$errors['name']?></small>
					<?php endif;?>

					<img src="<?=ROOT?>/<?=$row['image']?>" style="width: 150px; height: 150px; object-fit: cover;">
					<input class="form-control my-1" type="file" name="image">


					
					<button class="btn bg-orange">Save</button>
					<a href="<?=ROOT?>/admin/artists">
						<button type="button" class="float-end btn">Back</button>
					</a>

					<?php else:?>
						<div class="alert">That record was not found</div>
						<a href="<?=ROOT?>/admin/artists">
							<button type="button" class="float-end btn">Back</button>
						</a>
					<?php endif;?>

				</form>
			</div>


		<?php elseif($action == 'delete'):?>

			<div style="max-width: 500px; margin: auto;">
				<form method="post">
					<h3>Delete Artist</h3>

					<?php if(!empty($row)):?>

					<div class="form-control my-1" ><?=set_value('name', $row['name'])?></div>
					<?php if(!empty($errors['name'])):?>
						<small class="error"><?=$errors['name']?></small>
					<?php endif;?>
					

					<button class="btn bg-red">Delete</button>
					<a href="<?=ROOT?>/admin/artists">
						<button type="button" class="float-end btn">Back</button>
					</a>

					<?php else:?>
						<div class="alert">That record was not found</div>
						<a href="<?=ROOT?>/admin/artists">
							<button type="button" class="float-end btn">Back</button>
						</a>
					<?php endif;?>

				</form>
			</div>
		<?php else:?>


			<?php
				$query = "select * from artists order by id asc limit 20";
				$rows = db_query($query);

			?>

			<h3>Artist
				<a href="<?=ROOT?>/admin/artists/add"><button class="float-end btn bg-purple">Add New</button> </a>
				
			</h3> 
			<table class="table">
				<tr>
					<th>ID</th>
					<th>Artist</th>
					<th>Image</th>
					<th>Action</th>
				</tr>

				<?php if(!empty($rows)):?>
					<?php foreach($rows as $row):?>
						<tr>
							<td><?=$row['id']?></td>
							<td><?=$row['name']?></td>
							<td><img src="<?=ROOT?>/<?=$row['image']?>" style="width: 100px; height: 100px; object-fit: cover;"></td>
							<td>
								<a href="<?=ROOT?>/admin/artists/edit/<?=$row['id']?>">
									<img class="bi" src="<?=ROOT?>/assets/icons/pencil-square.svg"> 
								</a>
								<a href="<?=ROOT?>/admin/artists/delete/<?=$row['id']?>">								
									<img class="bi"src="<?=ROOT?>/assets/icons/trash3.svg">
								</a>
							</td>
						</tr>
					<?php endforeach;?>
				<?php endif;?>
			</table>
		
		<?php endif;?>

		
	</section>

<?= require page('includes/admin-footer')?>

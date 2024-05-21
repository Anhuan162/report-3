<?php
	
	if($action == 'add'){

		if($_SERVER['REQUEST_METHOD'] == "POST"){

			$errors = [];

			// data validation
			if(empty($_POST['title'])){
				$errors['title'] = "a title is required";
			}
			else
			if(!preg_match("/^[a-zA-Z0-9 \.\&\-\p{L})]+$/u", $_POST['title'])){
				$errors['title'] = "a title can only have letters & spaces";
			}

			if(empty($_POST['category_id'])){
				$errors['category_id'] = "a category is required";
			}

			if(empty($_POST['artist_id'])){
				$errors['artist_id'] = "an artist is required";
			}


			//image
			if(!empty($_FILES['image']['name'])){

				$folder = "uploads/";
				if(!file_exists($folder)){
					mkdir($folder, 0777, true);
					file_put_contents($folder."index.php", "");
				}

				$allowed = ['image/jpeg', 'image/png', 'image/jpg'];
				if($_FILES['image']['error'] == 0 && in_array( $_FILES['image']['type'], $allowed)){
					$destination_image = $folder.$_FILES['image']['name'];	
					move_uploaded_file($_FILES['image']['tmp_name'], $destination_image);

				}else{
					$errors['image'] = "Image no valid. Allowed tyes are ". implode(',', $allowed);
				}		

			}else{
				$errors['image'] = "an image is required";
			}



			//audio file
			if(!empty($_FILES['file']['name'])){

				$folder = "uploads/";
				if(!file_exists($folder)){
					mkdir($folder, 0777, true);
					file_put_contents($folder."index.php", "");
				}

				$allowed = ['audio/mpeg'];
				if($_FILES['file']['error'] == 0 && in_array( $_FILES['file']['type'], $allowed)){
					$destination_file = $folder.$_FILES['file']['name'];	
					move_uploaded_file($_FILES['file']['tmp_name'], $destination_file);

				}else{
					$errors['file'] = "file not valid. Allowed tyes are ". implode(',', $allowed);
				}		

			}else{
				$errors['file'] = "an audio file is required";
			}


			if(empty($errors)){

				$values = [];
				$values['title'] 	= trim($_POST['title']);
				$values['category_id'] 	= trim($_POST['category_id']);
				$values['artist_id'] 	= trim($_POST['artist_id']);

				$values['image'] 	= $destination_image;
				$values['file'] 	= $destination_file;
				$values['user_id'] 	= user('id');
				$values['date'] 	= date("Y-m-d H:i:s");
				$values['views'] 	= 0;
				$values['slug'] 	= str_to_url($values['title']);
				
				$query = "insert into songs (title,image,file,user_id,category_id,artist_id,date,views,slug) values (:title,:image,:file,:user_id,:category_id,:artist_id,:date,:views,:slug)";
				db_query($query,$values);

				message("Song created successfully");
				redirect('admin/songs');
			}
		
		}
	}
	else
	if($action == 'edit' ){

		$query = "select * from songs where id = :id limit 1";
		$row = db_query_one($query, ['id'=>$id]);

		if($_SERVER['REQUEST_METHOD'] == "POST" && $row){

			$errors = [];

			// data validation
			if(empty($_POST['title'])){
				$errors['title'] = "a title is required";
			}
			else
			if(!preg_match("/^[a-zA-Z0-9 \.\&\-\p{L}]+$/u", $_POST['title'])){
				$errors['title'] = "a title can only have letters & spaces";
			}

			if(empty($_POST['category_id'])){
				$errors['category_id'] = "a category is required";
			}

			if(empty($_POST['artist_id'])){
				$errors['artist_id'] = "an artist is required";
			}



			//image
			if(!empty($_FILES['image']['name'])){

				$folder = "uploads/";
				if(!file_exists($folder)){
					mkdir($folder, 0777, true);
					file_put_contents($folder."index.php", "");
				}

				$allowed = ['image/jpeg', 'image/png', 'image/jpg'];
				if($_FILES['image']['error'] == 0 && in_array( $_FILES['image']['type'], $allowed)){
					$destination_image = $folder.$_FILES['image']['name'];	
					move_uploaded_file($_FILES['image']['tmp_name'], $destination_image);

					// delete old image
					if(file_exists($row['image'])){
						unlink($row['image']);
					}

				}else{
					$errors['name'] = "File not valid. Allowed tyes are ". implode(',', $allowed);
				}

			}



			//audio file
			if(!empty($_FILES['file']['name'])){

				$folder = "uploads/";
				if(!file_exists($folder)){
					mkdir($folder, 0777, true);
					file_put_contents($folder."index.php", "");
				}

				$allowed = ['audio/mpeg'];
				if($_FILES['file']['error'] == 0 && in_array( $_FILES['file']['type'], $allowed)){
					$destination_file = $folder.$_FILES['file']['name'];	
					move_uploaded_file($_FILES['file']['tmp_name'], $destination_file);

					// delete old file
					if(file_exists($row['file'])){
						unlink($row['file']);
					}

				}else{
					$errors['file'] = "File no valid. Allowed tyes are ". implode(',', $allowed);
				}

			}


			if(empty($errors)){

				$values = [];
				$values['title'] 	= trim($_POST['title']);
				$values['category_id'] 	= trim($_POST['category_id']);
				$values['artist_id'] 	= trim($_POST['artist_id']);

				$values['user_id'] 	= user('id');
				$values['id']   	= $id;


				$query = "update songs set title = :title, user_id = :user_id, category_id = :category_id, artist_id = :artist_id";
				
				if(!empty($destination_image)){
					$query .= ", image = :image";
					$values['image'] 	= $destination_image;
				}

				if(!empty($destination_file)){
					$query .= ", file = :file";
					$values['file'] 	= $destination_file;
				}

				$query .= " where id = :id limit 1";

				db_query($query,$values);

				message("Song edited successfully");
				redirect('admin/songs');
			}
		
		}
	}else
	if($action == 'delete'){

		$query = "select * from songs where id = :id limit 1";
		$row = db_query_one($query, ['id'=>$id]);

		if($_SERVER['REQUEST_METHOD'] == "POST" && $row){

			$errors = [];

			if(empty($errors)){
				$values = [];

				$values['id'] 	= $id;
			

				$query = "delete from songs where id = :id limit 1";
				
				db_query($query,$values);

				// delete ole image
				if(file_exists($row['image'])){
					unlink($row['image']);
				}

				// delete old audio file
				if(file_exists($row['file'])){
					unlink($row['file']);
				}

				message("Song deleted successfully");
				redirect('admin/songs');
			}
		
		}
	}

?>






<?= require page('includes/admin-header')?>
	<section class="admin-content" style="min-height: 200px;">

		<?php if($action == 'add'):?>
			<div style="max-width: 500px; margin: auto;">
				<form method="post" enctype="multipart/form-data">

					<h3>Add New Song</h3>

					<input class="form-control my-1" value="<?=set_value('title')?>"  type="text" name="title" placeholder="Song title">
					<?php if(!empty($errors['title'])):?>
						<small class="error"><?=$errors['title']?></small>
					<?php endif;?>



					<?php
						$query = "select * from categories order by category asc";
						$categories = db_query($query);
					?>
					
					<select name="category_id" class="form-control my-1">
						<option value="">--Select Category--</option>
						<?php if(!empty($categories)):?>
							<?php foreach($categories as $cat):?>
								<option <?=set_select('category_id', $cat['id'])?> value="<?=$cat['id']?>"><?=$cat['category']?></option>
							<?php endforeach;?>
						<?php endif;?>
					</select>
					<?php if(!empty($errors['category_id'])):?>
						<small class="error"><?=$errors['category_id']?></small>
					<?php endif;?>



					<?php
						$query = "select * from artists order by name asc";
						$artists = db_query($query);
					?>

					<select name="artist_id" class="form-control my-1">
						<option value="">--Select Artist--</option>
						<?php if(!empty($artists)):?>
							<?php foreach($artists as $cat):?>
								<option <?=set_select('artist_id', $cat['id'])?> value="<?=$cat['id']?>"><?=$cat['name']?></option>
							<?php endforeach;?>
						<?php endif;?>Admin</option>
					</select>

					<?php if(!empty($errors['artist_id'])):?>
						<small class="error"><?=$errors['artist_id']?></small>
					<?php endif;?>



					<div class="form-control my-1">					
						<div>Image:</div>
						<input class="form-control my-1" type="file" name="image">
						<?php if(!empty($errors['image'])):?>
							<small class="error"><?=$errors['image']?></small>
						<?php endif;?>
					</div>


					<div class="form-control my-1">
						<div>Audio File:</div>
						<input class="form-control my-1" type="file" name="file">
						<?php if(!empty($errors['file'])):?>
							<small class="error"><?=$errors['file']?></small>
						<?php endif;?>
					</div>


					<button class="btn bg-orange">Save</button>
					<a href="<?=ROOT?>/admin/songs">
						<button type="button" class="float-end btn">Back</button>
					</a>
				</form>
			</div>
			

		<?php elseif($action == 'edit'):?>

			<div style="max-width: 500px; margin: auto;">
				<form method="post" enctype="multipart/form-data">
					<h3>Edit Song</h3>

					<?php if(!empty($row)):?>

					<input class="form-control my-1" value="<?=set_value('title', $row['title'])?>"  type="text" name="title" placeholder="Song title">
					<?php if(!empty($errors['title'])):?>
						<small class="error"><?=$errors['title']?></small>
					<?php endif;?>



					<?php
						$query = "select * from categories order by category asc";
						$categories = db_query($query);
					?>
					
					<select name="category_id" class="form-control my-1">
						<option value="">--Select Category--</option>
						<?php if(!empty($categories)):?>
							<?php foreach($categories as $cat):?>
								<option <?=set_select('category_id', $cat['id'], $row['artist_id'])?> value="<?=$cat['id']?>"><?=$cat['category']?></option>
							<?php endforeach;?>
						<?php endif;?>
					</select>
					<?php if(!empty($errors['category_id'])):?>
						<small class="error"><?=$errors['category_id']?></small>
					<?php endif;?>



					<?php

						$query = "select * from artists order by name asc";
						$artists = db_query($query);

					?>

					<select name="artist_id" class="form-control my-1">
						<option value="">--Select Artist--</option>
						<?php if(!empty($artists)):?>
							<?php foreach($artists as $cat):?>
								<option <?=set_select('artist_id', $cat['id'], $row['artist_id'])?> value="<?=$cat['id']?>"><?=$cat['name']?></option>
							<?php endforeach;?>
						<?php endif;?>Admin</option>
					</select>
					<?php if(!empty($errors['artist_id'])):?>
						<small class="error"><?=$errors['artist_id']?></small>
					<?php endif;?>
					

					<div class="form-control my-1">					
						<div>Image:</div>
						<img src="<?=ROOT?>/<?=$row['image']?>" style="width: 150px; height: 150px; object-fit: cover;">
						<input class="form-control my-1" type="file" name="image">
						<?php if(!empty($errors['image'])):?>
							<small class="error"><?=$errors['image']?></small>
						<?php endif;?>
					</div>


					<div class="form-control my-1">
						<div>Audio File:</div>
						<div><?=$row['file']?></div>
						<input class="form-control my-1" type="file" name="file">
						<?php if(!empty($errors['file'])):?>
							<small class="error"><?=$errors['file']?></small>
						<?php endif;?>
					</div>

					
					<button class="btn bg-orange">Save</button>
					<a href="<?=ROOT?>/admin/songs">
						<button type="button" class="float-end btn">Back</button>
					</a>

					<?php else:?>
						<div class="alert">That record was not found</div>
						<a href="<?=ROOT?>/admin/songs">
							<button type="button" class="float-end btn">Back</button>
						</a>
					<?php endif;?>

				</form>
			</div>


		<?php elseif($action == 'delete'):?>

			<div style="max-width: 500px; margin: auto;">
				<form method="post">
					<h3>Delete Song</h3>

					<?php if(!empty($row)):?>

					<div class="form-control my-1" ><?=set_value('title', $row['title'])?></div>
					<?php if(!empty($errors['title'])):?>
						<small class="error"><?=$errors['title']?></small>
					<?php endif;?>
					

					<button class="btn bg-red">Delete</button>
					<a href="<?=ROOT?>/admin/songs">
						<button type="button" class="float-end btn">Back</button>
					</a>

					<?php else:?>
						<div class="alert">That record was not found</div>
						<a href="<?=ROOT?>/admin/songs">
							<button type="button" class="float-end btn">Back</button>
						</a>
					<?php endif;?>

				</form>
			</div>
		<?php else:?>


			<?php
				$query = "select * from songs order by id asc limit 20";
				$rows = db_query($query);

			?>

			<h3>Song
				<a href="<?=ROOT?>/admin/songs/add"><button class="float-end btn bg-purple">Add New</button> </a>
				
			</h3> 
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



			<table class="table">
				<thead>
					<tr>
						<th class="sortRank" columnName="id">ID</th>
						<th class="sortRank" columnName="title">Title</th>
						<th >Image</th>
						<th class="sortRank" columnName="category">Category</th>
						<th class="sortRank" columnName="artist">Artist</th>
						<th >Audio</th>
						<th >Action</th>
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
	url: 'http://localhost/HGMusic/public/songs_data',
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
			|| object.artist.toUpperCase().includes(tab_filter_text.toUpperCase())
			|| object.category.toUpperCase().includes(tab_filter_text.toUpperCase())
			|| object.title.toUpperCase().includes(tab_filter_text.toUpperCase());
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
		var song = array[i];
		var tr = 	'<tr>'+
						'<td>' 	+song['id']+ '</td>'+
						'<td>' 	+song['title']+ '</td>'+
						'<td>' +'<img src="http://localhost/HGMusic/public/'+ song['image'] +'" style="width: 100px; height: 100px; object-fit: cover;"></td>'+
						'<td>' 	+song['category']+ '</td>'+
						'<td>' 	+song['artist']+ '</td>'+
						'<td>' +'<audio controls>'+
									'<source src="http://localhost/HGMusic/public/'+ song['file']+'" type="audio/mpeg"></audio>'+
						'</td>'+
						'<td>' +
								'<a href="http://localhost/HGMusic/public/admin/songs/edit/'+song['id']+'">'+
									'<img class="bi" src="http://localhost/HGMusic/public/assets/icons/pencil-square.svg">' + 
								'</a>'+
								'<a href="http://localhost/HGMusic/public/admin/songs/delete/'+song['id']+'">'+								
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

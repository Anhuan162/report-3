<?php
	
	if($action == 'add'){

		if($_SERVER['REQUEST_METHOD'] == "POST"){

			$errors = [];

			// data validation
			if(empty($_POST['category'])){
				$errors['category'] = "a category is required";
			}
			else
			if(!preg_match("/^[a-zA-Z0-9 \.\&\-\p{L}]+$/u", $_POST['category'])){

				
				$errors['category'] = "a category can only have letters & spaces";
			}

			if(empty($_POST['area_id'])){
				$errors['area_id'] = "an area is required";
			}


			if(empty($errors)){

				$values = [];
				$values['category'] 	= trim($_POST['category']);
				$values['disabled'] 	= trim($_POST['disabled']);
				$values['area_id'] 	= trim($_POST['area_id']);
				
				$query = "insert into categories (category, disabled, area_id) values (:category, :disabled, :area_id)";
				db_query($query,$values);

				message("Category created successfully");
				redirect('admin/categories');
			}
		
		}
	}
	else
	if($action == 'edit'){

		$query = "select * from categories where id = :id limit 1";
		$row = db_query_one($query, ['id'=>$id]);

		if($_SERVER['REQUEST_METHOD'] == "POST" && $row){

			$errors = [];

			// data validation
			if(empty($_POST['category'])){
				$errors['category'] = "a category is required";
			}
			else
			if(!preg_match("/^[a-zA-Z0-9 \.\&\-\p{L}]+$/u", $_POST['category'])){
				$errors['category'] = "a category can only have letters with no spaces";
			}

			if(empty($_POST['area_id'])){
				$errors['area_id'] = "an area is required";
			}

			if(empty($errors)){

				$values = [];
				$values['category'] 	= trim($_POST['category']);
				$values['disabled'] 	= trim($_POST['disabled']);
				$values['area_id'] 		= trim($_POST['area_id']);
				$values['id'] 			= $id;
			

				$query = "update categories set category = :category, disabled = :disabled, area_id = :area_id where id = :id limit 1";
				
				db_query($query,$values);

				message("Category edited successfully");
				redirect('admin/categories');
			}
		
		}
	}else
	if($action == 'delete'){

		$query = "select * from categories where id = :id limit 1";
		$row = db_query_one($query, ['id'=>$id]);

		if($_SERVER['REQUEST_METHOD'] == "POST" && $row){

			$errors = [];

			if(empty($errors)){

				$values 				= [];

				$values['id'] 			= $id;
			

				$query = "delete from categories where id = :id limit 1";
				
				db_query($query,$values);

				message("Category deleted successfully");
				redirect('admin/categories');
			}
		
		}
	}

?>






<?= require page('includes/admin-header')?>

	<section class="admin-content" style="min-height: 200px;">

		<?php if($action == 'add'):?>
			<div style="max-width: 500px; margin: auto;">
				<form method="post">
					<h3>Add New Category</h3>
					<input class="form-control my-1" value="<?=set_value('category')?>"  type="text" name="category" placeholder="Category name">
					<?php if(!empty($errors['category'])):?>
						<small class="error"><?=$errors['category']?></small>
					<?php endif;?>
					

					<select name="disabled" class="form-control my-1">
						<option value="">--Select Disabled--</option>
						<option <?=set_select('disabled', '1') ?> value="1">Yes</option>
						<option <?=set_select('disabled', '0')?> value="0">No</option>

					</select>

					<?php if(!empty($errors['disabled'])):?>
						<small class="error"><?=$errors['disabled']?></small>
					<?php endif;?>


					<?php
						$query = "select * from areas order by area asc";
						$areas = db_query($query);
					?>

					<select name="area_id" class="form-control my-1">
						<option value="">--Select Area--</option>
						<?php if(!empty($areas)):?>
							<?php foreach($areas as $cat):?>
								<option <?=set_select('area_id', $cat['id'])?> value="<?=$cat['id']?>"><?=$cat['area']?></option>
							<?php endforeach;?>
						<?php endif;?>Admin</option>
					</select>

					<?php if(!empty($errors['area_id'])):?>
						<small class="error"><?=$errors['area_id']?></small>
					<?php endif;?>



					<button class="btn bg-orange">Save</button>
					<a href="<?=ROOT?>/admin/categories">
						<button type="button" class="float-end btn">Back</button>
					</a>
				</form>
			</div>
			

		<?php elseif($action == 'edit'):?>

			<div style="max-width: 500px; margin: auto;">
				<form method="post" enctype="multipart/form-data">
					<h3>Edit Category</h3>

					<?php if(!empty($row)):?>

					<input class="form-control my-1" value="<?=set_value('category', $row['category'])?>"  type="text" name="category" placeholder="category">
					<?php if(!empty($errors['category'])):?>
						<small class="error"><?=$errors['category']?></small>
					<?php endif;?>

					<select name="disabled" class="form-control my-1">
						<option value="">--Select Disabled--</option>
						<option <?=set_select('disabled', '1', $row['category']) ?> value="1">Yes</option>
						<option <?=set_select('disabled', '0', $row['category'])?> value="0">No</option>

					</select>


					<?php
						$query = "select * from areas order by area asc";
						$areas = db_query($query);
					?>

					<select name="area_id" class="form-control my-1">
						<option value="">--Select Area--</option>
						<?php if(!empty($areas)):?>
							<?php foreach($areas as $cat):?>
								<option <?=set_select('area_id', $cat['id'], $row['area_id'])?> value="<?=$cat['id']?>"><?=$cat['area']?></option>
							<?php endforeach;?>
						<?php endif;?>Admin</option>
					</select>
					<?php if(!empty($errors['area_id'])):?>
						<small class="error"><?=$errors['area_id']?></small>
					<?php endif;?>


					
					<button class="btn bg-orange">Save</button>
					<a href="<?=ROOT?>/admin/categories">
						<button type="button" class="float-end btn">Back</button>
					</a>

					<?php else:?>
						<div class="alert">That record was not found</div>
						<a href="<?=ROOT?>/admin/categories">
							<button type="button" class="float-end btn">Back</button>
						</a>
					<?php endif;?>

				</form>
			</div>


		<?php elseif($action == 'delete'):?>

			<div style="max-width: 500px; margin: auto;">
				<form method="post">
					<h3>Delete Category</h3>

					<?php if(!empty($row)):?>

					<div class="form-control my-1" ><?=set_value('category', $row['category'])?></div>
					<?php if(!empty($errors['category'])):?>
						<small class="error"><?=$errors['category']?></small>
					<?php endif;?>
					

					<button class="btn bg-red">Delete</button>
					<a href="<?=ROOT?>/admin/categories">
						<button type="button" class="float-end btn">Back</button>
					</a>

					<?php else:?>
						<div class="alert">That record was not found</div>
						<a href="<?=ROOT?>/admin/categories">
							<button type="button" class="float-end btn">Back</button>
						</a>
					<?php endif;?>

				</form>
			</div>
		<?php else:?>


			<?php
				$query = "select * from categories order by id asc limit 20";
				$rows = db_query($query);

			?>

			<h3>Categories
				<a href="<?=ROOT?>/admin/categories/add"><button class="float-end btn bg-purple">Thêm mới</button> </a>
				
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
						<th class="sortRank" columnName="category">Category</th>
						<th class="sortRank" columnName="area">Area</th>
						<th>Active</th>
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


			</table>
		
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
	url: 'http://localhost/HGMusic/public/categories_data',
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
			|| object.category.toUpperCase().includes(tab_filter_text.toUpperCase())
			|| object.area.toUpperCase().includes(tab_filter_text.toUpperCase());
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
						'<td>' 	+user['category']+ '</td>'+
						'<td>' 	+user['area']+ '</td>'+
						'<td>' 	+user['disabled'] + '</td>'+
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



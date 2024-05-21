<?php require page('includes/header') ?>
<!-- songs record-->
	<div class="admin-content" style="margin-top: 5%;">
		<div class="container p-5">
			<h2 style="margin-left: 5%;">Top 5 của tuần</h2>
			<div class="row" >
				<div class="col-sm-4 p-4 text-white" style="background-color: rgb(51 71 99);">
					<?php
						$query = "select * from songs order by id asc limit 5";
						$rows = db_query($query);

					?>

					<h3>Tất cả</h3> 
					<table class="table">

						<?php if(!empty($rows)):?>
							<?php foreach($rows as $row):?>
								<tr>
									<td><img src="<?=ROOT?>/<?=$row['image']?>" style="width: 100px; height: 100px; object-fit: cover;"></td>
									<td>
										<a href="<?=ROOT?>/song/<?=$row['slug']?>">
											<div><h3><?=$row['title']?></h3></div>
											<div><?=get_artist($row['artist_id'])?></div>
										</a>
									</td>
								</tr>
							<?php endforeach;?>
						<?php endif;?>
					</table>
				</div>



			    <div class="col-sm-4 p-4 bg-dark text-white">
					<?php
						$query = "select * from songs order by id asc limit 5";
						$rows = db_query($query);

					?>

					<h3>Việt Nam</h3> 
					<table class="table">

						<?php if(!empty($rows)):?>
							<?php foreach($rows as $row):?>
								<tr>
									<td><img src="<?=ROOT?>/<?=$row['image']?>" style="width: 100px; height: 100px; object-fit: cover;"></td>
									<td>
										<a href="<?=ROOT?>/song/<?=$row['slug']?>">
											<div><h3><?=$row['title']?></h3></div>
											<div><?=get_artist($row['artist_id'])?></div>
										</a>
									</td>
								</tr>
							<?php endforeach;?>
						<?php endif;?>
					</table>
			    </div>



			    <div class="col-sm-4 p-4 text-white" style="background-color: #aaa">
					<?php
						$query = "select * from songs order by id asc limit 5";
						$rows = db_query($query);

					?>

					<h3>Quốc tế</h3> 
					<table class="table">

						<?php if(!empty($rows)):?>
							<?php foreach($rows as $row):?>
								<tr>
									<td><img src="<?=ROOT?>/<?=$row['image']?>" style="width: 100px; height: 100px; object-fit: cover;"></td>
									<td>
										<a href="<?=ROOT?>/song/<?=$row['slug']?>">
											<div><h3><?=$row['title']?></h3></div>
											<div><?=get_artist($row['artist_id'])?></div>
										</a>
									</td>
								</tr>
							<?php endforeach;?>
						<?php endif;?>
					</table>
			    </div>
			</div>			
		</div>
	</div>



<!-- songs list-->
	<div class="container-fluid p-5" style="background-color: rgb(88 78 119 / 80%);">
		<div class="container">
			<div class="listSong align-items-center justify-content-center">
				<h2>Bài hát hot</h2>

				<section class="content" style="margin-bottom: 20px;">

				</section>

				<div class="footer">
					<div class="index_buttons d-flex"></div>
				</div>
			</div>

		</div>
	</div>




<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>
var array = [];
var array_length = 0;
var items_size = 10; // Set a default item size if not provided
var start_index = 1;
var end_index = 0;
var current_index = 1;
var max_index = 0;

let rankList = [];

// Perform AJAX request
$.ajax({
    url: 'http://localhost/HGMusic/public/songs_data',
    type: 'GET',
    dataType: 'json',
    success: function (data) {
        rankList = data;
        displayIndexButtons();
    }
});

function preLoadCalculations() {
    array = rankList;
    array_length = array.length;
    max_index = Math.ceil(array_length / items_size); // Calculate max index correctly
}

function displayIndexButtons() {
    preLoadCalculations();
    $(".index_buttons").empty(); // Remove all buttons within the index_buttons div

    $(".index_buttons").append('<button class="pagination btn-seondary px-3 py-2" onclick="prev();">Previous</button>');

    for (var i = 1; i <= max_index; i++) {
        $(".index_buttons").append('<button class="pagination btn-seondary px-3 py-2" onclick="indexPagination(' + i + ')" index="' + i + '">' + i + '</button>');
    }

    $(".index_buttons").append('<button class="pagination btn-seondary px-3 py-2" onclick="next();">Next</button>');
    highlightIndexButton();
}

function highlightIndexButton() {
    start_index = ((current_index - 1) * items_size) + 1;
    end_index = Math.min(start_index + items_size - 1, array_length);

    $(".index_buttons .pagination").removeClass('active');
    $(".index_buttons .pagination[index='" + current_index + "']").addClass('active');

    displayTableRows();
}

function displayTableRows() {
    $(".listSong .content").empty(); // Remove existing content
    var tab_start = start_index - 1;
    var tab_end = end_index;

    for (var i = tab_start; i < tab_end; i++) {
        var song = array[i];
        var div = `
            <div class="music-card">
                <div style="overflow: hidden;">
                    <a href="http://localhost/HGMusic/public/song/${song['slug']}">
                        <img src="http://localhost/HGMusic/public/${song['image']}">
                    </a>
                </div>
                <div class="card-content">
                    <div class="card-title">${song['title']}</div>
                    <div class="card-subtitle">${song['artist']}</div>
                </div>
            </div>`;
        $(".listSong .content").append(div);
    }
}

function next() {
    if (current_index < max_index) {
        current_index++;
        highlightIndexButton();
    }
}

function prev() {
    if (current_index > 1) {
        current_index--;
        highlightIndexButton();
    }
}

function indexPagination(index) {
    current_index = parseInt(index);
    highlightIndexButton();
}

// Initial call to display buttons
displayIndexButtons();



</script>

<?php require page('includes/footer') ?>

	
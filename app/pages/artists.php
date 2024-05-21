<?php require page('includes/header') ?>

	<div class="admin-content" style="margin-top: 5%">
		<div class="section-title">Nghệ sĩ</div>

		<div class="container">
			<div class="listSong">
				<section class="content">
				</section>
				<div class="footer">
					<div class="index_buttons d-flex"></div>
				</div>
			</div>
		</div>



		<div class="row" style="margin-left: 5%; margin-right: 5%;">
			<div class="col-sm-4 p-4 text-white">
				<?php
					$query = "select * from artists where id <= 6 order by id asc";
					$rows = db_query($query);

				?>

				<h3>Tất cả</h3> 
				<table class="table">

					<?php if(!empty($rows)):?>
						<?php foreach($rows as $row):?>
							<tr>
								<td><img src="<?=ROOT?>/<?=$row['image']?>" style="width: 100px; height: 100px; object-fit: cover;"></td>
								<td>
									<a href="<?=ROOT?>/artist/<?=$row['id']?>">
										<div><h3><?=$row['name']?></h3></div>
									</a>
								</td>
							</tr>
						<?php endforeach;?>
					<?php endif;?>
				</table>
			</div>



		    <div class="col-sm-4 p-4 text-white">
				<?php
					$query = "select * from artists where id > 6 and id <= 11 order by id asc";
					$rows = db_query($query);

				?>

				<h3>Việt Nam</h3> 
				<table class="table">

					<?php if(!empty($rows)):?>
						<?php foreach($rows as $row):?>
							<tr>
								<td><img src="<?=ROOT?>/<?=$row['image']?>" style="width: 100px; height: 100px; object-fit: cover;"></td>
								<td>
									<a href="<?=ROOT?>/artist/<?=$row['id']?>">
										<div><h3><?=$row['name']?></h3></div>
									</a>
								</td>
							</tr>
						<?php endforeach;?>
					<?php endif;?>
				</table>
		    </div>



		    <div class="col-sm-4 p-4 text-white">
				<?php
					$query = "select * from artists where id > 11 and id <= 16 order by id asc ";
					$rows = db_query($query);

				?>

				<h3>Quốc tế</h3> 
				<table class="table">

					<?php if(!empty($rows)):?>
						<?php foreach($rows as $row):?>
							<tr>
								<td><img src="<?=ROOT?>/<?=$row['image']?>" style="width: 100px; height: 100px; object-fit: cover;"></td>
								<td>
									<a href="<?=ROOT?>/artist/<?=$row['id']?>">
										<div><h3><?=$row['name']?></h3></div>
									</a>
								</td>
							</tr>
						<?php endforeach;?>
					<?php endif;?>
				</table>
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
    url: 'http://localhost/HGMusic/public/artists_data',
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
    // Remove existing content
    $(".listSong .content").empty();

    // Ensure start_index and end_index are within array bounds
    var tab_start = Math.max(0, start_index - 1);
    var tab_end = Math.min(array.length, end_index);

    for (var i = tab_start; i < tab_end; i++) {
        var artist = array[i];
        
        if (artist) {  // Check if artist is defined
            var div = `
                <div class="music-card">
                    <div style="overflow: hidden;">
                        <a href="http://localhost/HGMusic/public/artist/${artist['id']}">
                            <img src="http://localhost/HGMusic/public/${artist['image']}">
                        </a>
                    </div>
                    <div class="card-content">
                        <div class="card-title">${artist['name']}</div>
                    </div>
                </div>`;
            $(".listSong .content").append(div);
        }
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

	
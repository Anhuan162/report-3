<?php require page('includes/header') ?>


<div class="container-fluid mb-5" style="margin-top: 7%">

	<div class="container">
		<h2>Gợi ý hàng tuần dành cho bạn</h2>
		<?php
			$query = "select * from songs order by views limit 15";
			$first = db_query_one($query);
		?>

		<div class="music-player">
		    <h2></h2>
		    <div class="image">
		    	<img id="imagePlayer" src="<?=ROOT?>/<?=$first['image']?>">
		    </div>

		    <div class="music">
			    <audio id="audioPlayer" controls src="<?=ROOT?>/<?=$first['file']?>">
				    <!-- Đây là nơi audio sẽ được phát -->
				</audio>
		    </div>
		</div>

		<div style="overflow: auto; height: 350px; width: 100%;">

			<?php
				$query = "select * from songs order by views limit 15";
				$rows = db_query($query);
			?>

			<ul class="list-group">
				<?php if(!empty($rows)):?>
					<?php $t = 0; ?> 
					<?php foreach($rows as $row):?>
							<li class="list-group-item" style="display: flex; align-items: center;" onclick="playSong('<?=ROOT?>/<?=$row['file']?>', '<?=ROOT?>/<?=$row['image']?>')">
								<span style="font-size: 40px"><?= ++$t; ?></span>
								<div class="info_data" style="display: inline-block; margin-left: 10px;">
									<h3 style="font-size: 20px;">
										<a style="color: black;"><?=$row['title']?></a>
									</h3>
									<h4 style="font-size: 15px;"><?=get_artist($row['artist_id'])?></h4>
								</div>
							</li>
					<?php endforeach;?>
				<?php else:?>
					<div class="m-2">No songs found</div>
				<?php endif;?>
			</ul>

		</div>

	</div>
</div>


<?php require page('includes/footer') ?>

				



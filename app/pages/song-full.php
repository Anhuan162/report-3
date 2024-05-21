<?php

	db_query("update songs set views = views + 1 where id = :id limit 1", ['id'=>$row['id']]);

?>



<!--start music card-->
<div class="music-card-full" style="max-width: 600px; height: 400px;">


		<h2 class="card-title"><?=esc($row['title'])?></h2>
		<div class="card-subtitle">by : <?=esc(get_artist($row['artist_id']))?></div>	

	<div style="overflow: hidden;">
		<a href="<?=ROOT?>/song/<?=$row['title']?>"> <img style="width: 100%; height: 450px" src="<?=ROOT?>/<?=$row['image']?>"></a>
	</div>
	<div class="card-content">
		<audio controls style="width: 100%;">
			<source src="<?=ROOT?>/<?=$row['file']?>" type="audio/mpeg">
		</audio>

		<div>Lượt xem: <?=$row['views']?></div>
		<div>Ngày đăng: <?=get_date($row['date'])?></div>

		<a href="<?=ROOT?>/download/<?=$row['slug']?>">
			<button class="btn bg-purple">Download</button>
		</a>

	</div>
</div>

<div class="suggest-songs">
	<?php
		$rows = db_query( "select * from songs inner join categories on songs.category_id = categories.id where category_id = :category_id order by views desc limit 10", ['category_id'=>$row['category_id']]);
	?>
	
	<ul class="list-group">
		<?php if(!empty($rows)):?>
			<?php $t = 0; ?> 
			<?php foreach($rows as $row):?>
				<?php include page('includes/record')?>
			<?php endforeach;?>
		<?php else:?>
			<div class="m-2">No songs found</div>
		<?php endif;?>
	</ul>
</div>
<!--end music card-->






<?php

	db_query("update songs set views = views + 1 where id = :id limit 1", ['id'=>$row['id']]);

?>



<!--start music card-->
<div class="music-card-full" style="max-width: 600px;">


	<h2 class="card-title"><?=esc($row['name'])?></h2>

	<div style="overflow: hidden;">
		 <img src="<?=ROOT?>/<?=$row['image']?>">
	</div>
	<div class="card-content">
		<div><?=esc($row['bio'])?></div>

		<h3>Bài hát của <?=$row['name']?>: </h3>

		<div style="display:flex; flex-wrap: wrap; justify-content: center;">
			<?php 

				$query = "select * from songs where artist_id = :artist_id order by views desc limit 20";
				$songs = db_query($query, ['artist_id'=>$row['id']]);
			?>

			<?php if(!empty($songs)):?>
				<?php foreach($songs as $row):?>
					<?php include page('includes/song')?>
				<?php endforeach;?>
			<?php endif;?>
		</div>



	</div>
</div>
<!--end music card-->
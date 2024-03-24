<?php

	db_query("update songs set views = views + 1 where id = :id limit 1", ['id'=>$row['id']]);

?>



<!--start music card-->
<div class="music-card-full" style="max-width: 600px;">


		<h2 class="card-title"><?=esc($row['title'])?></h2>
		<div class="card-subtitle">by : <?=esc(get_artist($row['artist_id']))?></div>	

	<div style="overflow: hidden;">
		<a href="<?=ROOT?>/song/<?=$row['title']?>"> <img src="<?=ROOT?>/<?=$row['image']?>"></a>
	</div>
	<div class="card-content">
		<audio controls style="width: 100%;">
			<source src="<?=ROOT?>/<?=$row['file']?>" type="audio/mpeg">
		</audio>

		<div>Lượt xem: <?=$row['views']?></div>
		<div>Ngày đăng: <?=get_date($row['date'])?></div>
	</div>
</div>
<!--end music card-->
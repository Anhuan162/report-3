<!--start music card-->
	<li class="list-group-item" style="display: flex; align-items: center;">
		<span style="font-size: 40px"><?= ++$t; ?></span>
		<div class="info_data" style="display: inline-block; margin-left: 10px;">
			<h3 style="font-size: 20px;">
				<a style="color: black;" href="<?=ROOT?>/song/<?=$row['slug']?>"><?=$row['title']?></a>
			</h3>
			<h4 style="font-size: 15px;"><?=get_artist($row['artist_id'])?></h4>
		</div>
		
	</li>
<!--end music card-->
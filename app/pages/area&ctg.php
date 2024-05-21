<?php require page('includes/header') ?>

	<div class="admin-content">
		<div class="section-title">Thể loại</div>

		<section class="content">

			<?php

				$category = $URL[1] ?? null;
				$query = "select * from songs inner join categories on songs.category_id = category.id inner join areas on categories.area_id = areas.id where categories.id = :categories.id and areas.id = :areas.id";
				$rows = db_query($query, ['category'=>$category]);
			?>
			
			<?php if(!empty($rows)):?>
				<?php foreach($rows as $row):?>
					<?php include page('includes/song')?>
				<?php endforeach;?>
			<?php else:?>
					<div class="m-2">No songs found</div>
			<?php endif;?>

		

		</section>
	</div>

<?php require page('includes/footer') ?>

	
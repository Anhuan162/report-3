<?php require page('includes/header') ?>

	<div class="admin-content" style="min-height: 50vh; margin-top: 5%;">
		<div class="section-title mt-5"><?=get_category($URL[1])?></div>
		<section class="content">

			<?php

				$id = $URL[1] ?? null;
				$query = "select * from songs where category_id in (select id from categories where id = :id) order by views desc limit 24";
				$rows = db_query($query, ['id'=>$id]);
			?>
			
			<?php if(!empty($rows)):?>
				<?php foreach($rows as $row):?>
					<?php include page('includes/category')?>
				<?php endforeach;?>
			<?php else:?>
					<div class="m-2">No songs found</div>
			<?php endif;?>

		
		</section>
	</div>

<?php require page('includes/footer') ?>

	
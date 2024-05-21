<?php require page('includes/header') ?>

<div style="margin-top: 8%; justify-content: center;">

	<section class="content">
		<?php

			$id = $URL[1] ?? null;
			$query = "select * from artists where id = :id limit 1";
			$row = db_query_one($query, ['id'=>$id]);
		?>
		
		<?php if(!empty($row)):?>
				<?php include page('artist-full')?>
		<?php endif;?>

	

	</section>
</div>

<?php require page('includes/footer') ?>

				
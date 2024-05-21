<?php require page('includes/header') ?>

	<center> <div class="section-title">Đang phát</div> </center>

	<section class="container d-flex" style="height: 67%; margin-top: 6%; margin-bottom: 4%; justify-content: space-between;">

		<?php

			$slug = $URL[1] ?? null;
			$query = "select * from songs where slug = :slug limit 1";
			$row = db_query_one($query, ['slug'=>$slug]);
		?>
		
		<?php if(!empty($row)):?>
				<?php include page('song-full')?>
		<?php endif;?>

	</section>

<?php require page('includes/footer') ?>

	
<?php require page('includes/header') ?>

	<section style="margin-left: 5%; margin-right: 5%;">
		<img class="hero" src="<?=ROOT?>/assets/images/hero.png">
	</section>

	<div class="section-title">Featured</div>

	<section class="content" >

		<?php

			$rows = db_query("select * from songs order by views desc limit 16")
		?>
		
		<?php if(!empty($rows)):?>
			<?php foreach($rows as $row):?>
				<?php include page('includes/song')?>
			<?php endforeach;?>
		<?php endif;?>

	

	</section>

<?php require page('includes/footer') ?>

	
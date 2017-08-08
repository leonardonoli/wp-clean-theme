<?php
/**
 * @package clean
 */
global $title, $post_id;
?>

<article id="post-<?= $post_id; ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<div id="article-title">
			<h1 class="entry-title"><?= $title; ?></h1>
		</div>
		<?php
		 // Function declared in widgets/init
		?>
		<script>document.write(load_widget('mobile-above-content','desktop-above-content'));</script>
	</header><!-- .entry-header -->

	<div class="entry-content sub_content_block">
		<div id="article-content">
			<?php the_content(); ?>
		</div>
		<?php
		// Function declared in widgets/init
		?>
		<script>document.write(load_widget('mobile-above-pagination','desktop-above-pagination'));</script>
		<div id="pagination-container">
		<?php
		// Function declared in widgets/init
		?>
		<script>document.write(load_widget('mobile-in-pagination',''));</script>
		<?php
			global $Paginext_Link_Pages;
			$Paginext_Link_Pages->display();
		?>
		</div>
		<?php
		// Function declared in widgets/init
		?>
		<script>document.write(load_widget('mobile-below-content','desktop-below-content'));</script>
	</div><!-- .entry-content -->

</article><!-- #post-## -->

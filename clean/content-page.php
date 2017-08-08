<?php
/**
 * @package clean
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<div class="entry-meta">
			<?php clean_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php
		    // Function declared in widgets/init				
				if (isset($_GET['utm_source']))
				{
					if ($_GET['utm_source']!='test')
					{
					?>
		    <script>document.write(load_widget('mobile-above-content','desktop-above-content'));</script>
					<?php
					}
				}
				?>
	</header><!-- .entry-header -->

	<div class="entry-content sub_content_block">
		<?php the_content(); ?>
		<?php
		    // Function declared in widgets/init
				if (isset($_GET['utm_source']))
				{
					if ($_GET['utm_source']=='test')
					{
						?>
						<script>document.write(load_widget('mobile-test','desktop-test'));</script>
						<?php
					}
				}
				if (isset($_GET['utm_source']))
				{
					if ($_GET['utm_source']!='test')
					{
					?>
					<script>document.write(load_widget('mobile-above-pagination','desktop-above-pagination'));</script>
					<?php
					}
				}
		    // Function declared in widgets/init
				if (isset($_GET['utm_source']))
				{
					if ($_GET['utm_source']!='test')
					{
					?>
					<script>document.write(load_widget('mobile-below-content','desktop-below-content'));</script>
					<?php
					}
				}
				?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php clean_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->

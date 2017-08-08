<?php
/**
 * The template for displaying all single posts.
 *
 * @package clean
 */
get_header(); ?>
<?php
global $content_loading_delay, $content_loading_display;
if ((!wp_is_mobile() && $content_loading_display_desktop) || (wp_is_mobile() && $content_loading_display_mobile))
{
?>
<style type="text/css">
	#content-block {
		display: none;
	}

	#loader {
		width: 100%;
		padding: 150px 0;
		text-align: center;
	}
</style>
<?php	
}
?>
	<div id="primary" class="main_content_block content">
		<div id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>
			<?php $this_post = $post_id; ?>
			<?php get_template_part( 'content', 'single' ); ?>

			<?php 
			// Not used currently
			// Site Navigation
			//the_post_navigation(array('prev_text'=>'<button id="previous-nav">&laquo; Previous</button>','next_text'=>'<button id="next-nav">Next &raquo;</button>')); ?>

			<fb:comments href="http://<?= $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']; ?>" numposts="15" colorscheme="light" width="100%"></fb:comments>  

		<?php endwhile; // end of the loop. ?>

		</div><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php
if ((!wp_is_mobile() && $content_loading_display_desktop) || (wp_is_mobile() && $content_loading_display_mobile))
{
?>
<script type="text/javascript">
	jQuery(document).ready(function(){
		setTimeout(function(){
			jQuery('#loader').hide();
			jQuery('#content-block').show();
		},<?= ($content_loading_delay)?$content_loading_delay:0; ?>000);
	});
</script>
<?php	
}
?>
<?php get_footer(); ?>

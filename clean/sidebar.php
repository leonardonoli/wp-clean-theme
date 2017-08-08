<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package clean
 */
global $post_id;
$this_post = $post_id;
?>

<div id="sidebar" class="side_bar_content" role="complementary">
	<?php
	// Function declared in widgets/init
	?>
	<script>document.write(load_widget('','desktop-sidebar'));</script>
</div><!-- #secondary -->

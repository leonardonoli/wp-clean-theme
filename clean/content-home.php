<?php
/**
 * @package clean
 */
$image = get_the_post_thumbnail( $post->ID, 'medium', array('class'=>'image') );
if (empty($image))
{
	$image = '<img src="http://placehold.it/300x218">';
}
$link = get_the_permalink($post->ID);
$title = get_the_title($post->ID);
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<ul class="posts-list">
		<li>
			<div class="image-container">
				<a href="<?= $link ?>" title="<?= $title ?>">
					<?= $image; ?>
				</a>
			</div>
			<div class="content-container">
				<div class="post-title">
					<a href="<?= $link ?>" title="<?= $title ?>">
						<?= $title; ?>
					</a>
				</div>
				<div class="post-content">
				<?php
				if (!the_excerpt()) 
				{
					strip_tags(mb_strimwidth(get_the_content(), 0, 100, "..."));
				}
				else
				{
					strip_tags(the_excerpt());
				}
				?>
				</div>
			</div>
			<div class="clear"></div>
		</li>
	</ul>
	<hr class="faded" />
</article><!-- #post-## -->

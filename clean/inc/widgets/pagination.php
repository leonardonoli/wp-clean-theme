<?php
/*
Plugin Name: PagiNext Link Pages
Description: This plugin allows you to display Number links, PREV/NEXT buttons, or both simultaneously. Just make a call to paginext_link_pages() wherever you want the pagination to display. You must pass in either 'next', 'number' or 'both' as an argument to the 'next_or_number_or_both' option. Ex) paginext_link_pages(array('next_or_number_or_both'=>'next'));
Version: 1.0
Author: Jack Gersten
Author URI: www.solutionswide.com
License: GPLv2 or later
*/

/**
 * The formatted output of a list of pages.
 *
 * Displays page links for paginated posts (i.e. includes the <!--nextpage-->.
 * Quicktag one or more times). This tag must be within The Loop.
 *
 * The defaults for overwriting are:
 * 'next_or_number_or_both' - Default is 'number' (string). Indicates whether page
 *      numbers should be used. Valid values are 'number', 'next', or 'both'.
 * 'nextpagelink' - Default is 'Next Page' (string). Text for link to next page.
 *      of the bookmark.
 * 'previouspagelink' - Default is 'Previous Page' (string). Text for link to
 *      previous page, if available.
 * 'pagelink' - Default is '%' (String).Format string for page numbers. The % in
 *      the parameter string will be replaced with the page number, so Page %
 *      generates "Page 1", "Page 2", etc. Defaults to %, just the page number.
 * 'before' - Default is '<p> Pages:' (string). The html or text to prepend to
 *      each bookmarks.
 * 'after' - Default is '</p>' (string). The html or text to append to each
 *      bookmarks.
 * 'link_before' - Default is '' (string). The html or text to prepend to each
 *      Pages link inside the <a> tag. Also prepended to the current item, which
 *      is not linked.
 * 'link_after' - Default is '' (string). The html or text to append to each
 *      Pages link inside the <a> tag. Also appended to the current item, which
 *      is not linked.
 *
 * @since 1.2.0
 * @access private
 *
 * @param string|array $args Optional. Overwrite the defaults.
 * @return string Formatted output in HTML.
 */
 
/**
* Register and enqueue style sheet.
*/
class Paginext_Link_Pages {
	
	public function display($args = '') {
		$args = apply_filters('pagination_arguments' ,$args);
		$defaults = array(
			'before' => '<div class="pagination float">',
			'after'  => '<div class="clear"></div></div>',
			'link_before' => '', 'link_after' => '',
			'link_before_prev' => '',
			'link_before_next' => '',
			'next_or_number_or_both' => 'next',
			'nextpagelink' => '<button class="button previous-button float">Next &raquo;</button>',
			'previouspagelink' => '<button class="button next-button float">&laquo; Previous</button>',
			'echo' => 1,
			'code_between_numbers_and_next' => '',
			'color' => '#00adef',
			'conent' => ''
		);
		$r = wp_parse_args( $args, $defaults );
		$r = apply_filters( 'wp_link_pages_args', $r );
		extract( $r, EXTR_SKIP );

		global $page, $numpages, $multipage, $more, $pagenow, $ajax_site;
		$output = '';
		if ( $multipage ) 
		{
			
			if ( 'both' == $next_or_number_or_both ) 
			{
				$page_numbers ='<div class="pagination-numbers-container">';
				if (wp_is_mobile()) 
				{
					$total = 7;
					$interval = 3;
				}
				else
				{
					$total = 11;
					$interval = 5;
				}
				if (($page-$interval)<1)
				{
					$start = 1;
				}
				else
				{
					$start = $page-$interval;
				}
				if (($page+$interval) > ($numpages-1))
				{
					$end = $numpages;
					$start = $end - $total;
					if ($start<1)
					{
						$start = 1;
					}
				}
				else
				{
					$end = $page+$interval;
					if ($page < $interval && ($start+$total)<$numpages)
					{
						$end = $total;
					}
				}
				for ( $i = $start; $i <= $end; $i = $i + 1 ) {
						if ( ($i != $page) || ((!$more) && ($page==1)) ) {
							$page_numbers .= ' <span id="page'.$i.'">';
						}else{
							$page_numbers .= ' <span id="page'.$i.'" class="current_page">';
						}
						if ($ajax_site)
						{
							$page_numbers .= $link_before . $i . $link_after;
						}
						else
						{
							$page_numbers .= $this->_paginext_link_page($i);
							$page_numbers .= $link_before . $i . $link_after;
							$page_numbers .= '</a>';							
						}
						$page_numbers .= '</span>';
				}
				$page_numbers .= "</div>";
			}
			if (!empty($code_between_numbers_and_next))
				$output .= '<div>'.$code_between_numbers_and_next.'</div>';
			if ( $more ) 
			{
				$output .= $before;
				$i = $page - 1;
				if ($ajax_site)
				{
					$output .= $previouspagelink;							
				}
				else
				{
						$output .= $this->_paginext_link_page($i);
					if ( $i && $more ) 
					{
						$output .= $link_before_prev. $previouspagelink . $link_after . '</a>';							
					}
					else
					{
						$output .= '<span style="visibility:hidden">'.$link_before_prev. $previouspagelink . $link_after . '</a></span>';
					}
				}
				$i = $page + 1;
				if ( 'both' == $next_or_number_or_both ) 
				{
					$output .= '<div class="pagination-desktop">'.$page_numbers.'</div>';
				}
				else if ( 'page of' == $next_or_number_or_both ) 
				{
					$output .= '<div class="page-of-desktop">Page '.$page.' of '.$numpages.'</div>';
				}
				if ($ajax_site)
				{
					$output .= $nextpagelink;
				}
				else
				{
						$output .= $this->_paginext_link_page($i);
					if ( $i <= $numpages && $more ) 
					{
						$output .= $link_before_next. $nextpagelink . $link_after . '</a>';
					}
					else
					{
						$output .= '<span style="visibility:hidden">'.$link_before_next. $nextpagelink . $link_after . '</a></span>';
					}
				}
				$output .= $after;
				if ( 'both' == $next_or_number_or_both ) 
				{
					$output .= '<div class="pagination-mobile">'.$page_numbers.'</div>';
				}
				else if ( 'page of' == $next_or_number_or_both ) 
				{
					$output .= '<div class="page-of-mobile">Page<br />'.$page.' of '.$numpages.'</div>';
				}
			}
		}

		if ( $echo )
			echo $output;

		return $output;
	}

	/**
	 * Helper function for paginext_link_pages().
	 *
	 * @since 3.1.0
	 * @access private
	 *
	 * @param int $i Page number.
	 * @return string Link.
	 */
	private function _paginext_link_page( $i ) {
		global $wp_rewrite, $permalink, $post;
		if ( 1 == $i ) {
			$url = $permalink;
		} else {
			if ( '' == get_option('permalink_structure') || in_array($post->post_status, array('draft', 'pending')) )
				$url = add_query_arg( 'page', $i, $permalink );
			elseif ( 'page' == get_option('show_on_front') && get_option('page_on_front') == $post->ID )
				$url = trailingslashit($permalink) . user_trailingslashit("$wp_rewrite->pagination_base/" . $i, 'single_paged');
			else
				$url = trailingslashit($permalink) . user_trailingslashit($i, 'single_paged');
		}

		return '<a href="' . esc_url( $url ) . '">';
	}
}


// Start this plugin once all other plugins are fully loaded
add_action( 'init', 'Paginext_Link_Pages' ); function Paginext_Link_Pages() { global $Paginext_Link_Pages; $Paginext_Link_Pages = new Paginext_Link_Pages(); }

?>
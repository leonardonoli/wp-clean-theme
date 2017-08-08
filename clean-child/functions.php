<?php
add_filter('pagination_arguments','child_modified_pagination');

function child_modified_pagination($args) 
{
	$args['next_or_number_or_both'] = 'both';
	$args['before'] = '<div class="pagination">';
		
	return $args;
}
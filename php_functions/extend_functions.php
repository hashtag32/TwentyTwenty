<?php

function filter_subcategory( ) {
	$cat = get_queried_object();

    //todo: check if parent is stocks
	if( 0 < $cat->category_parent )
		$single_template=get_template_directory() . '/own-template-parts/template-subcategory.php' ;
    return $single_template; 
}
add_filter( 'category_template', 'filter_subcategory' ); 


function add_pages_to_search( $query ) {
    if ( $query->is_search ) {
		$query->set( 'post_type', array('post','page') );
        add_query_arg( 'cat', "stocks" );
    }
    return $query;
}
add_filter('pre_get_posts','add_pages_to_search');

// Also include unused categories 
add_filter('wpseo_sitemap_exclude_empty_terms', '__return_false');
 
?>
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

//***Currently not working
add_action( 'init', 'create_stock_taxonomy' );

function create_stock_taxonomy() {
    // Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => _x( 'Stocks', 'taxonomy general name', 'textdomain' ),
		'singular_name'     => _x( 'Stock', 'taxonomy singular name', 'textdomain' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
	);

	register_taxonomy( 'stocks', array( 'post' ), $args );
}


function filter_taxonomy($tax_template) {

    //todo: check if parent is stocks
    $tax_template=get_template_directory() . '/own-template-parts/template-taxonomy.php' ;
    return $tax_template; 
}
add_filter( 'taxonomy_template', 'filter_taxonomy' );   


//***

 
?>
<?php

function filter_subcategory( ) {
	$cat = get_queried_object();

    //todo: check if parent is stocks
	if( 0 < $cat->category_parent )
		$single_template=get_template_directory() . '/own-template-parts/template-subcategory.php' ;
    return $single_template; 
}
add_filter( 'category_template', 'filter_subcategory' ); 

?>
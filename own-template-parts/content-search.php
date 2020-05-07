<?php

/**
 * The default template for displaying content
 *
 * Used for both singular and index.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0.0
 */

?>



<!-- Logic Stocks -->
<?php
	// Stock search

	// plus von fmtp -> first 3 results
	$search_query=get_search_query( false );
	$stocks_search=fetch_stock_search($search_query);
	// Now the elements should be in the database
	
	// Stocks in db
	$search_term = explode( ' ', get_search_query( false ) ); // Array of separated search elements   
	global $wpdb;
	$select = "
	SELECT DISTINCT t.*, tt.* 
	FROM wp_terms AS t 
	INNER JOIN wp_term_taxonomy AS tt 
	ON t.term_id = tt.term_id 
	WHERE tt.taxonomy IN ('category')";      
	$first = true;
	$select .= " AND (t.name LIKE '%s')";
	$string_replace[] = '%'.$wpdb->esc_like( $s ).'%';

	$select .= " OR (t.slug LIKE '%s')";
	$string_replace[] = '%'. $wpdb->esc_like( $s ).'%';
	// 	}
	// foreach ( $search_term as $s ){
	// 	if ( $first ){
	// 		$select .= " AND (t.name LIKE '%s')";
	// 		$string_replace[] = '%'.$wpdb->esc_like( $s ).'%';
	// 		$first = false;
	// 	}else{
	// 		$select .= " OR (t.name LIKE '%s')";
	// 		$string_replace[] = '%'. $wpdb->esc_like( $s ).'%';
	// 	}
	// }
	$select .= " ORDER BY t.name ASC";
	$stocks_db = $wpdb->get_results( $wpdb->prepare( $select, $string_replace ) );
	$stocks_db=array();

	// Unify both, but make sure only one element of each is given
	//todo: If one element is in search and db, not working -> displays both elements
	$stocks=array_unique(array_merge($stocks_db,$stocks_search), SORT_REGULAR); 
	
	
	// Search results subheading
	$search_title = sprintf(
		'%1$s %2$s',
		'<span class="color-accent">' . __( 'Search:', 'twentytwenty' ) . '</span>',
		'&ldquo;' . get_search_query() . '&rdquo;'
	);

	global $wp_query;
	$number_results=(int)$wp_query->found_posts + count($stocks);

	if($number_results>0)
	{
		$search_subtitle = sprintf(
			/* translators: %s: Number of search results. */
			_n(
				'We found %s result for your search.',
				'We found %s results for your search.',
				$number_results,
				'twentytwenty'
			),
			number_format_i18n($number_results )
		);
	}
	else
	{
		$search_subtitle = __( 'We could not find any results for your search. You can give it another try through the search form below.', 'twentytwenty' );
	}
	?>
	
<!-- Search results -->
<header class="archive-header has-text-align-center header-footer-group">
	<div class="archive-header-inner section-inner medium">
		<h1 class="archive-title"><?php echo wp_kses_post( $search_title ); ?></h1>
		<div class="archive-subtitle section-inner thin max-percentage intro-text"><?php echo wp_kses_post( wpautop( $search_subtitle ) ); ?></div>
	</div><!-- .archive-header-inner -->
</header><!-- .archive-header -->


<!-- Search Form -->
<?php 
if($number_results==0)
	{ 
?>
	<div class="no-search-results-form section-inner thin">
		<?php
		get_search_form(
			array(
				'label' => __( 'search again', 'twentytwenty' ),
			)
		);
		?>
	</div>
<?php 
	} 
?>


<!-- Stock results displaying -->
<?php
	if(count($stocks)>0)
	{
	?>
	<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
	<header class="entry-header has-text-align-center header-footer-group">
	<div class="entry-header-inner section-inner medium">
		<h1 class="entry-title">Stocks</h1>
	</div><!-- .entry-header-inner -->
	</header>
	</article>

	<!-- List all stocks -->
	<div class="entry-content">
	<?php
	foreach ( $stocks as $stock ) { ?> 
		<div class="wp-block-columns"><!-- wp:column {"className":"analysis-column"} -->
			<div class="wp-block-column has-accent-color">

			<?php
			echo '<h3 class="has-accent-color has-text-color"><a href="'.esc_url( get_term_link( $stock ) ).'" title="'.esc_attr( $stock->name ).'">' . esc_html( $stock->name ) . '</a></li>';
			?>
			</div>
		</div>
		<?php } ?> 
	</div> 
<?php } ?>


<!-- List posts (and pages) -->
<?php
	if(have_posts())
	{
		get_template_part( 'own-template-parts/content-posts' );
	}
?>

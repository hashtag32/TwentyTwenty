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

<!-- Search Form -->
<div class="no-search-results-form section-inner thin">
<?php
get_search_form(
	array(
		'label' => __( 'search again', 'twentytwenty' ),
	)
);
?>
</div>

<!-- Logic Stocks -->
<?php
	// Stock search
	$search_term = explode( ' ', get_search_query( false ) );   
	global $wpdb;
	$select = "
	SELECT DISTINCT t.*, tt.* 
	FROM wp_terms AS t 
	INNER JOIN wp_term_taxonomy AS tt 
	ON t.term_id = tt.term_id 
	WHERE tt.taxonomy IN ('category')";      
	$first = true;
	foreach ( $search_term as $s ){
		if ( $first ){
			$select .= " AND (t.name LIKE '%s')";
			$string_replace[] = '%'.$wpdb->esc_like( $s ).'%';
			$first = false;
		}else{
			$select .= " OR (t.name LIKE '%s')";
			$string_replace[] = '%'. $wpdb->esc_like( $s ).'%';
		}
	}
	$select .= " ORDER BY t.name ASC";
	$stocks = $wpdb->get_results( $wpdb->prepare( $select, $string_replace ) );



	// Search results subheading
	$number_results=count(have_posts()) + count($stocks)-1;
	if($number_results!=0)
	{
		$results_subtitle = sprintf(
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
		$results_subtitle = __( 'We could not find any results for your search. You can give it another try through the search form below.', 'twentytwenty' );
	}
	?>
	
<!-- Search results -->
<header class="archive-header has-text-align-center header-footer-group">
<div class="archive-header-inner section-inner medium">
	<?php if ( $results_subtitle ) { ?>
		<div class="archive-subtitle section-inner thin max-percentage intro-text"><?php echo wp_kses_post( wpautop( $results_subtitle ) ); ?></div>
	<?php } ?>
</div>
</header>


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
	foreach ( $stocks as $term ) { ?> 
		<div class="wp-block-columns"><!-- wp:column {"className":"analysis-column"} -->
			<div class="wp-block-column has-accent-color">

			<?php
			echo '<h2 class="has-accent-color has-text-color heading-size-2"><a href="'.esc_url( get_term_link( $term ) ).'" title="'.esc_attr( $term->name ).'">' . esc_html( $term->name ) . '</a></li>';
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

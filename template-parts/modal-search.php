<?php

/**
 * Displays the search icon and modal
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

?>
<div class="search-modal cover-modal header-footer-group" data-modal-target-string=".search-modal">

	<div class="search-modal-inner modal-inner">

		<div class="section-inner">

			<?php
			get_search_form(
				array(
					'label' => __('Search for:', 'twentytwenty'),
				)
			);
			?>

			<button class="toggle search-untoggle close-search-toggle fill-children-current-color" data-toggle-target=".search-modal" data-toggle-body-class="showing-search-modal" data-set-focus=".search-modal .search-field" aria-expanded="false">
				<span class="screen-reader-text"><?php _e('Close search', 'twentytwenty'); ?></span>
				<?php twentytwenty_the_theme_svg('cross'); ?>
			</button><!-- .search-toggle -->

		</div><!-- .section-inner -->

	</div><!-- .search-modal-inner -->

	<div class="list-group" id="myList" role="tablist">
		<a class="list-group-item list-group-item-action"  style="display:none;">Home</a>
		<a class="list-group-item list-group-item-action"  style="display:none;">Profile</a>
		<a class="list-group-item list-group-item-action"  style="display:none;">Profile</a>
		<a class="list-group-item list-group-item-action"  style="display:none;">Messages</a>
		<a class="list-group-item list-group-item-action"  style="display:none;">Settings</a>
	</div>

</div><!-- .menu-modal -->
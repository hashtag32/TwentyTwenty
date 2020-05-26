<?php

/**
 * Template Name: Test Template
 * Template Post Type: post, page
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0
 */

get_header();
?>

<main id="site-content" role="main">



	<!-- Example Usage React -->
	<script src="https://unpkg.com/react@16/umd/react.development.js" crossorigin></script>
	<script src="https://unpkg.com/react-dom@16/umd/react-dom.development.js" crossorigin></script>

	<!-- Load our React component. -->
	<script>
		'use strict';

		const e = React.createElement;

		class LikeButton extends React.Component {
			constructor(props) {
				super(props);
				this.state = {
					liked: false
				};
			}

			render() {
				if (this.state.liked) {
					return 'You liked this.';
				}

				return e(
					'button', {
						onClick: () => this.setState({
							liked: true
						})
					},
					'Like'
				);
			}
		}

		const domContainer = document.querySelector('#like_button_container');
		ReactDOM.render(e(LikeButton), domContainer);
	</script>

</main><!-- #site-content -->
<iframe src="https://www.stockvotin.net"></iframe>


<?php get_template_part('template-parts/footer-menus-widgets'); ?>

<?php get_footer(); ?>
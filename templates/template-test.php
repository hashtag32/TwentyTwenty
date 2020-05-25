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


<div class="wp-block-columns alignwide first-cover-header-block">
<div class="wp-block-column animated slideInUp delay-200ms zoom">
<div class="wp-block-image"><figure class="aligncenter size-medium is-resized"><img src="https://stockvoting.net/wp-content/uploads/2020/04/vote.svg" alt="" class="wp-image-755" width="150" height="150" srcset="https://stockvoting.net/wp-content/uploads//2020/04/vote.svg 150w, https://stockvoting.net/wp-content/uploads//2020/04/vote.svg 300w, https://stockvoting.net/wp-content/uploads//2020/04/vote.svg 1024w, https://stockvoting.net/wp-content/uploads//2020/04/vote.svg 512w" sizes="(max-width: 150px) 100vw, 150px"></figure></div>



<h2 class="has-primary-color has-text-color has-text-align-center">Vote</h2>



<p class="has-text-color has-text-align-left has-large-font-size has-secondary-color"><strong>Predict</strong> how a stock will develop over the next weeks. </p>



<p class="has-text-color has-text-align-left has-large-font-size has-secondary-color">Watch your <strong>score</strong> to keep track of the performance.</p>
</div>



<div class="wp-block-column animated slideInUp delay-200ms">
<figure class="wp-block-image size-large is-resized"><img src="https://stockvoting.net/wp-content/uploads/2020/04/write.svg" alt="" class="wp-image-756" width="150" height="150" srcset="https://stockvoting.net/wp-content/uploads//2020/04/write.svg 150w, https://stockvoting.net/wp-content/uploads//2020/04/write.svg 300w, https://stockvoting.net/wp-content/uploads//2020/04/write.svg 1024w, https://stockvoting.net/wp-content/uploads//2020/04/write.svg 401w" sizes="(max-width: 150px) 100vw, 150px"></figure>



<h2 class="has-primary-color has-text-color has-text-align-center">Write</h2>



<p class="has-text-color has-text-align-left has-large-font-size has-secondary-color">While you can <strong>read</strong> other articles, you can also <strong>write</strong> your own analysis.</p>



<p class="has-text-color has-large-font-size has-secondary-color">Through <strong>claps </strong>you can  see how much others agree with you. </p>
</div>



<div class="wp-block-column zoom animated slideInUp delay-200ms">
<div class="wp-block-image"><figure class="aligncenter size-large is-resized"><img src="https://stockvoting.net/wp-content/uploads/2020/04/payment-1.svg" alt="" class="wp-image-758" width="150" height="150" srcset="https://stockvoting.net/wp-content/uploads//2020/04/payment-1.svg 150w, https://stockvoting.net/wp-content/uploads//2020/04/payment-1.svg 300w, https://stockvoting.net/wp-content/uploads//2020/04/payment-1.svg 1024w" sizes="(max-width: 150px) 100vw, 150px"></figure></div>



<h2 class="has-primary-color has-text-color has-text-align-center">Get Paid</h2>



<p class="has-text-color has-text-align-left has-large-font-size has-secondary-color">Per article you will receive <strong>your share</strong> to your contribution.</p>



<p class="has-text-color has-text-align-left has-large-font-size has-secondary-color">For your first approved article, you will receive <strong>10 $</strong>.</p>
</div>
</div>


</main><!-- #site-content -->

<?php get_template_part('template-parts/footer-menus-widgets'); ?>

<?php get_footer(); ?>
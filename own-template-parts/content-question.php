<?php

/**
 * Used for questions
 */
?>

<main id="site-content" role="main">

<!-- todo: Check isPatron($user_id): https://github.com/Patreon/patreon-wordpress/blob/master/classes/patreon_wordpress.php -->
    <?php
    while (have_posts()) {
        the_post();
        get_template_part( 'own-template-parts/content-analysis', get_post_type() );
    }
    ?>
</main><!-- #site-content -->
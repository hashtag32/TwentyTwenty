<?php

/**
 * Used for questions
 */
?>

<main id="site-content" role="main">
    <?php
    while (have_posts()) {
        the_post();
        get_template_part( 'own-template-parts/content-analysis', get_post_type() );
    }
    ?>
</main><!-- #site-content -->
<?php get_header(); ?>

<?php get_template_part('template-parts/header-inner'); ?>

<main>

    <?php

    while (have_posts()) {
        the_post();

        the_title('<h1>', '</h1>');

        the_content();
    }

    ?>

</main>

<?php get_footer(); ?>
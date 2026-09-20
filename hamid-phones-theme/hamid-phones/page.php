<?php get_header(); ?>

<?php get_template_part('template-parts/header-inner'); ?>

<main class="legal-page">

    <div class="legal-page__container">

        <?php while (have_posts()) : the_post(); ?>

            <header class="legal-page__header">

                <span class="legal-page__eyebrow">
                    Hamid Phones
                </span>

                <h1>
                    <?php the_title(); ?>
                </h1>

            </header>


            <div class="legal-page__content">

                <?php the_content(); ?>

            </div>

        <?php endwhile; ?>

    </div>

</main>

<?php get_footer(); ?>
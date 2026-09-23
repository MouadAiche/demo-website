<?php get_header(); ?>

<?php get_template_part('template-parts/header-home'); ?>

<main>

    <section class="hero" id="home">

        <div class="hero__bg" aria-hidden="true"></div>
        <div class="hero__overlay" aria-hidden="true"></div>

        <div class="hero__content">

            <img class="hero__logo" src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png" alt="Logo Hamid Phones">

            <h1>
                Des smartphones pour un avenir plus connecté
            </h1>

            <p>
                Derniers modèles
                <span>•</span>
                Marques de confiance
                <span>•</span>
                Meilleure expérience
            </p>

            <div class="hero__actions">

                <a href="<?php echo esc_url(home_url('/#products')); ?>" class="hero__button hero__button--primary">
                    Voir les produits

                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M5 12h14M13 6l6 6-6 6" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </a>

                <a href="<?php echo esc_url(home_url('/#brands')); ?>" class="hero__button hero__button--secondary">
                    Voir les marques

                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M5 12h14M13 6l6 6-6 6" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </a>

            </div>

        </div>

    </section>

    <!-- #region BRANDS -->

    <section class="brands-section" id="brands">

        <div class="brands-container">

            <!-- HEADER -->
            <div class="brands-header">

                <span class="brands-eyebrow">
                    Grandes marques
                </span>

                <h2>
                    Acheter par marque
                </h2>

                <p>
                    Découvrez les produits de certaines des marques technologiques
                    les plus fiables et les plus populaires.
                </p>

            </div>


            <!-- BRANDS GRID -->
            <div class="brands-grid">


                <?php

                $brands = get_terms(array(
                    'taxonomy'   => 'product_brand',
                    'hide_empty' => true,
                ));

                if (!is_wp_error($brands) && !empty($brands)) {

                    foreach ($brands as $brand) {

                        $thumbnail_id = get_term_meta(
                            $brand->term_id,
                            'thumbnail_id',
                            true
                        );

                        $logo_url = '';

                        if ($thumbnail_id) {
                            $logo_url = wp_get_attachment_image_url(
                                $thumbnail_id,
                                'full'
                            );
                        }

                        $brand_url = get_term_link($brand);

                        if (is_wp_error($brand_url)) {
                            continue;
                        }

                ?>

                        <a
                            href="<?php echo esc_url($brand_url); ?>"
                            class="brand-card">

                            <div class="brand-card-logo">

                                <?php if ($logo_url) { ?>

                                    <img
                                        src="<?php echo esc_url($logo_url); ?>"
                                        alt="<?php echo esc_attr($brand->name); ?>"
                                        loading="lazy">

                                <?php } ?>

                            </div>

                            <div class="brand-card-content">

                                <strong>
                                    <?php echo esc_html($brand->name); ?>
                                </strong>

                                <span>
                                    Découvrir les produits
                                </span>

                            </div>

                            <div class="brand-card-arrow">

                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M5 12h14M13 6l6 6-6 6" />
                                </svg>

                            </div>

                        </a>

                <?php
                    }
                }

                ?>

            </div>

        </div>

    </section>

    <!-- #endregion -->

    <!-- #region FEATURED PRODUCTS -->

    <section class="featured-products" id="products">

        <div class="featured-products__container">

            <!-- HEADER -->
            <div class="featured-products__header">

                <span class="featured-products__eyebrow">
                    Notre sélection
                </span>

                <h2>Produits en vedette</h2>

                <p>
                    Découvrez une sélection de nos smartphones et appareils
                    des plus grandes marques.
                </p>

            </div>


            <!-- PRODUCTS GRID -->
            <div class="featured-products__grid">


                <?php

                $featured_product_ids = wc_get_featured_product_ids();

                $featured_products = new WP_Query(array(
                    'post_type'      => 'product',
                    'post_status'    => 'publish',
                    'posts_per_page' => 8,
                    'post__in'       => $featured_product_ids,

                    'meta_query' => array(
                        'stock_status' => array(
                            'key'     => '_stock_status',
                            'compare' => 'EXISTS',
                        ),
                    ),

                    'orderby' => array(
                        'stock_status' => 'ASC',
                        'date'         => 'DESC',
                    ),
                ));

                if ($featured_products->have_posts()) {

                    while ($featured_products->have_posts()) {

                        $featured_products->the_post();

                        $featured_product = wc_get_product(get_the_ID());

                        if (!$featured_product) {
                            continue;
                        }

                        $product_url = get_permalink();

                        $product_image = get_the_post_thumbnail_url(
                            get_the_ID(),
                            'large'
                        );

                        $brands = wp_get_post_terms(
                            get_the_ID(),
                            'product_brand'
                        );

                        $brand = null;

                        if (!empty($brands) && !is_wp_error($brands)) {
                            $brand = $brands[0];
                        }

                ?>

                        <article class="product-card">

                            <a href="<?php echo esc_url($product_url); ?>"
                                class="product-card__image">

                                <span class="product-card__badge <?php echo $featured_product->is_in_stock() ? '' : 'product-card__badge--out'; ?>">

                                    <?php
                                    echo $featured_product->is_in_stock()
                                        ? 'Disponible'
                                        : 'Rupture de stock';
                                    ?>

                                </span>

                                <?php if ($product_image) { ?>

                                    <img
                                        src="<?php echo esc_url($product_image); ?>"
                                        alt="<?php echo esc_attr($featured_product->get_name()); ?>"
                                        loading="lazy">

                                <?php } ?>

                            </a>


                            <div class="product-card__content">

                                <?php if ($brand) { ?>

                                    <a
                                        href="<?php echo esc_url(get_term_link($brand)); ?>"
                                        class="product-card__category">

                                        <?php echo esc_html($brand->name); ?>

                                    </a>

                                <?php } ?>


                                <h3>

                                    <a href="<?php echo esc_url($product_url); ?>">

                                        <?php echo esc_html($featured_product->get_name()); ?>

                                    </a>

                                </h3>


                                <div class="product-card__bottom">

                                    <div class="product-card__price">

                                        <span>Prix</span>

                                        <strong>

                                            <?php

                                            if ($featured_product->is_type('variable')) {

                                                $min_price =
                                                    $featured_product->get_variation_price(
                                                        'min',
                                                        true
                                                    );

                                                $max_price =
                                                    $featured_product->get_variation_price(
                                                        'max',
                                                        true
                                                    );

                                                if ($min_price !== $max_price) {

                                                    echo esc_html(
                                                        hamid_format_price($min_price)
                                                            . ' - '
                                                            . hamid_format_price($max_price)
                                                            . ' DH'
                                                    );
                                                } else {

                                                    echo esc_html(
                                                        hamid_format_price($min_price)
                                                            . ' DH'
                                                    );
                                                }
                                            } else {

                                                echo esc_html(
                                                    hamid_format_price(
                                                        $featured_product->get_price()
                                                    )
                                                        . ' DH'
                                                );
                                            }

                                            ?>

                                        </strong>

                                    </div>


                                    <a
                                        href="<?php echo esc_url($product_url); ?>"
                                        class="product-card__button"
                                        aria-label="<?php echo esc_attr(
                                                        'Voir ' . $featured_product->get_name()
                                                    ); ?>">

                                        <svg viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor">

                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M5 12h14M13 6l6 6-6 6" />

                                        </svg>

                                    </a>

                                </div>

                            </div>

                        </article>

                <?php
                    }
                }

                wp_reset_postdata();

                ?>

            </div>


            <!-- VIEW ALL -->
            <div class="featured-products__footer">

                <a href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>"
                    class="featured-products__button">
                    Voir tous les produits

                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 12h14M13 6l6 6-6 6" />
                    </svg>

                </a>

            </div>

        </div>

    </section>

    <!-- #endregion -->

    <section class="about-section" id="about">
        <div class="about-container">

            <!-- CONTENT -->
            <div class="about-content">

                <!-- TEXT -->
                <div class="about-text">
                    <span class="about-eyebrow">À propos de nous</span>

                    <h2>
                        Une technologie en laquelle vous pouvez
                        <span>avoir confiance</span>
                    </h2>

                    <p class="about-description">
                        Nous sommes spécialisés dans les smartphones modernes, les accessoires
                        et les marques mobiles de confiance. Notre objectif est de permettre à
                        chaque client de trouver plus facilement l'appareil qui lui convient,
                        avec des informations claires, des prix compétitifs et un service fiable.
                    </p>

                    <p class="about-description">
                        Des dernières nouveautés aux appareils pratiques du quotidien, nous
                        privilégions des produits de qualité et une expérience d'achat simple
                        qui vous inspire confiance.
                    </p>
                </div>


                <!-- MOBILE / TABLET IMAGE -->
                <div class="about-visual about-visual--mobile">

                    <div class="about-image-wrapper">

                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/image.webp" alt="Intérieur de notre magasin de téléphones"
                            class="about-image">

                        <div class="about-image-overlay"></div>

                        <div class="about-badge">
                            <span class="about-badge-number">100%</span>
                            <span class="about-badge-text">Service de confiance</span>
                        </div>

                    </div>

                </div>


                <!-- FEATURES + BUTTON -->
                <div class="about-bottom">

                    <div class="about-features">

                        <!-- FEATURE -->
                        <div class="about-feature">

                            <div class="about-feature-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                        d="M20 6 9 17l-5-5" />
                                </svg>
                            </div>

                            <div class="about-feature-content">
                                <strong>Produits de confiance</strong>

                                <span>
                                    Des appareils soigneusement sélectionnés parmi des marques fiables.
                                </span>
                            </div>

                        </div>


                        <!-- FEATURE -->
                        <div class="about-feature">

                            <div class="about-feature-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 2 3 7v5c0 5.5 3.8 9.8 9 10
                                5.2-.2 9-4.5 9-10V7l-9-5z" />

                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                        d="m9 12 2 2 4-4" />
                                </svg>
                            </div>

                            <div class="about-feature-content">
                                <strong>Service fiable</strong>

                                <span>
                                    Un accompagnement clair avant et après votre achat.
                                </span>
                            </div>

                        </div>


                        <!-- FEATURE -->
                        <div class="about-feature">

                            <div class="about-feature-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                        d="M3 12h18M12 3v18" />
                                </svg>
                            </div>

                            <div class="about-feature-content">
                                <strong>Dernières technologies</strong>

                                <span>
                                    Smartphones modernes, accessoires et dernières nouveautés.
                                </span>
                            </div>

                        </div>


                        <!-- FEATURE -->
                        <div class="about-feature">

                            <div class="about-feature-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 21a9 9 0 1 0 0-18
                                9 9 0 0 0 0 18z" />

                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                        d="M8 12h8M12 8v8" />
                                </svg>
                            </div>

                            <div class="about-feature-content">
                                <strong>Expérience simple</strong>

                                <span>
                                    Trouvez facilement vos produits grâce à des informations claires.
                                </span>
                            </div>

                        </div>

                    </div>


                    <!-- BUTTON -->
                    <a href="<?php echo esc_url(home_url('/#products')); ?>" class="about-button">

                        Découvrir les produits

                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 12h14M13 6l6 6-6 6" />
                        </svg>

                    </a>

                </div>

            </div>


            <!-- DESKTOP IMAGE -->
            <div class="about-visual about-visual--desktop">

                <div class="about-image-wrapper">

                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/image.webp" alt="Intérieur de notre magasin de téléphones" class="about-image">

                    <div class="about-image-overlay"></div>

                    <div class="about-badge">
                        <span class="about-badge-number">100%</span>
                        <span class="about-badge-text">Service de confiance</span>
                    </div>

                </div>

            </div>

        </div>
    </section>

    <?php

    $store_phone      = get_option('hamid_store_phone');
    $store_whatsapp   = get_option('hamid_store_whatsapp');
    $store_email      = get_option('hamid_store_email');
    $store_location   = get_option('hamid_store_location');
    $store_maps_embed = get_option('hamid_store_maps_embed');
    $store_maps_link  = get_option('hamid_store_maps_link');

    $whatsapp_number = preg_replace('/\D+/', '', $store_whatsapp);

    ?>

    <section class="contact-section" id="contact">

        <div class="contact-container">

            <div class="contact-header">

                <span class="contact-eyebrow">Contactez-nous</span>

                <h2>Nous contacter</h2>

                <p>
                    Vous avez une question sur un produit, sa disponibilité ou son prix ?
                    Contactez-nous, nous serons heureux de vous aider.
                </p>

            </div>

            <div class="contact-grid">

                <!-- MAP -->

                <div class="contact-map-wrapper">

                    <div class="contact-map">

                        <iframe
                            src="<?php echo esc_url($store_maps_embed); ?>"
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            title="Localisation du magasin">

                        </iframe>

                    </div>

                    <a href="<?php echo esc_url($store_maps_link); ?>"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="contact-map-button">

                        Ouvrir dans Google Maps

                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 12h14M13 6l6 6-6 6" />

                        </svg>

                    </a>

                </div>


                <!-- CONTACT INFO -->

                <div class="contact-info">

                    <!-- PHONE -->

                    <div class="contact-card">

                        <div class="contact-card-icon">

                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">

                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M22 16.92v3a2 2 0 0 1-2.18 2
            19.79 19.79 0 0 1-8.63-3.07
            19.5 19.5 0 0 1-6-6
            19.79 19.79 0 0 1-3.07-8.67
            A2 2 0 0 1 4.11 2h3
            a2 2 0 0 1 2 1.72
            12.84 12.84 0 0 0 .7 2.81
            2 2 0 0 1-.45 2.11
            L8.09 9.91a16 16 0 0 0 6 6
            l1.27-1.27a2 2 0 0 1 2.11-.45
            12.84 12.84 0 0 0 2.81.7
            A2 2 0 0 1 22 16.92z" />

                            </svg>

                        </div>

                        <div class="contact-card-content">

                            <span>Téléphone</span>

                            <strong>

                                <?php

                                $display_phone = preg_replace(
                                    '/^212(\d{3})(\d{3})(\d{3})$/',
                                    '+212 $1 $2 $3',
                                    preg_replace('/\D+/', '', $store_phone)
                                );

                                echo esc_html($display_phone);

                                ?>

                            </strong>

                        </div>

                        <button
                            type="button"
                            class="contact-card-action contact-copy-button"
                            data-copy="<?php echo esc_attr($display_phone); ?>"
                            aria-label="Copier le numéro de téléphone">

                            <svg class="contact-copy-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">

                                <rect x="9" y="9" width="11" height="11" rx="2" stroke-width="2" />

                                <path d="M15 9V6a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v7a2 2 0 0 0 2 2h3"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round" />

                            </svg>

                            <svg class="contact-check-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">

                                <path d="M5 12l4 4L19 6"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round" />

                            </svg>

                        </button>

                    </div>


                    <!-- WHATSAPP -->

                    <div class="contact-card">

                        <div class="contact-card-icon">

                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">

                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M21 11.5a8.38 8.38 0 0 1-.9 3.8
            8.5 8.5 0 0 1-7.6 4.7
            8.38 8.38 0 0 1-3.8-.9
            L3 21l1.9-5.7
            a8.38 8.38 0 0 1-.9-3.8
            8.5 8.5 0 0 1 4.7-7.6
            8.38 8.38 0 0 1 3.8-.9h.5
            a8.48 8.48 0 0 1 8 8z" />

                            </svg>

                        </div>

                        <div class="contact-card-content">

                            <span>WhatsApp</span>

                            <strong>Discutez avec nous</strong>

                        </div>

                        <a
                            href="<?php echo esc_url('https://wa.me/' . $whatsapp_number); ?>"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="contact-card-action">

                            Nous contacter

                        </a>

                    </div>


                    <!-- EMAIL -->

                    <div class="contact-card">

                        <div class="contact-card-icon">

                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">

                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 4h16c1.1 0 2 .9 2 2v12
            c0 1.1-.9 2-2 2H4
            c-1.1 0-2-.9-2-2V6
            c0-1.1.9-2 2-2z" />

                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="m22 6-10 7L2 6" />

                            </svg>

                        </div>

                        <div class="contact-card-content">

                            <span>E-mail</span>

                            <strong><?php echo esc_html($store_email); ?></strong>

                        </div>

                        <button
                            type="button"
                            class="contact-card-action contact-copy-button"
                            data-copy="<?php echo esc_attr($store_email); ?>"
                            aria-label="Copier l'adresse e-mail">

                            <svg class="contact-copy-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">

                                <rect x="9" y="9" width="11" height="11" rx="2" stroke-width="2" />

                                <path d="M15 9V6a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v7a2 2 0 0 0 2 2h3"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round" />

                            </svg>

                            <svg class="contact-check-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">

                                <path d="M5 12l4 4L19 6"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round" />

                            </svg>

                        </button>

                    </div>


                    <!-- LOCATION -->

                    <div class="contact-card">

                        <div class="contact-card-icon">

                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">

                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M21 10c0 7-9 12-9 12S3 17 3 10
                                a9 9 0 1 1 18 0z" />

                                <circle cx="12" cy="10" r="3" stroke-width="1.8" />

                            </svg>

                        </div>

                        <div class="contact-card-content">

                            <span>Localisation</span>

                            <strong><?php echo esc_html($store_location); ?></strong>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

</main>

<?php get_footer(); ?>
<?php get_header(); ?>

<?php get_template_part('template-parts/header-home'); ?>

<main>

    <section class="hero" id="home">

        <div class="hero__bg" aria-hidden="true"></div>
        <div class="hero__overlay" aria-hidden="true"></div>

        <div class="hero__content">

            <img class="hero__logo" src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png" alt="Phone Store Logo">

            <h1>
                Smart Phones For A Brighter Tomorrow
            </h1>

            <p>
                Latest devices
                <span>•</span>
                Trusted brands
                <span>•</span>
                Better experiences
            </p>

            <div class="hero__actions">

                <a href="#products" class="hero__button hero__button--primary">
                    See Products

                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M5 12h14M13 6l6 6-6 6" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </a>

                <a href="#brands" class="hero__button hero__button--secondary">
                    See Brands

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
                    Top Brands
                </span>

                <h2>
                    Shop By Brand
                </h2>

                <p>
                    Discover products from some of the most trusted and popular
                    technology brands.
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
                                    Explore Products
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
                    Our Selection
                </span>

                <h2>Featured Products</h2>

                <p>
                    Discover some of our selected smartphones and devices
                    from leading brands.
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
                    'orderby'        => 'date',
                    'order'          => 'DESC',
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
                            'woocommerce_thumbnail'
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
                                        ? 'Featured'
                                        : 'Out of Stock';
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

                                        <span>Price</span>

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
                                                        wc_format_localized_price($min_price)
                                                            . ' - '
                                                            . wc_format_localized_price($max_price)
                                                            . ' DH'
                                                    );
                                                } else {

                                                    echo esc_html(
                                                        wc_format_localized_price($min_price)
                                                            . ' DH'
                                                    );
                                                }
                                            } else {

                                                echo esc_html(
                                                    wc_format_localized_price(
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
                                                        'View ' . $featured_product->get_name()
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
                    See All Products

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
                    <span class="about-eyebrow">About Us</span>

                    <h2>
                        Technology You Can
                        <span>Trust</span>
                    </h2>

                    <p class="about-description">
                        We specialize in modern smartphones, accessories, and trusted
                        mobile brands. Our goal is to make it easier for every customer
                        to find the right device with clear information, competitive
                        prices, and reliable service.
                    </p>

                    <p class="about-description">
                        From the latest releases to practical everyday devices, we focus
                        on quality products and a simple buying experience you can feel
                        confident about.
                    </p>
                </div>


                <!-- MOBILE / TABLET IMAGE -->
                <div class="about-visual about-visual--mobile">

                    <div class="about-image-wrapper">

                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/bg-image.png" alt="Inside our mobile phone store"
                            class="about-image">

                        <div class="about-image-overlay"></div>

                        <div class="about-badge">
                            <span class="about-badge-number">100%</span>
                            <span class="about-badge-text">Trusted Service</span>
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
                                <strong>Trusted Products</strong>

                                <span>
                                    Carefully selected devices from reliable brands.
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
                                <strong>Reliable Service</strong>

                                <span>
                                    Clear support before and after your purchase.
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
                                <strong>Latest Technology</strong>

                                <span>
                                    Modern smartphones, accessories, and new releases.
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
                                <strong>Simple Experience</strong>

                                <span>
                                    Easy product discovery with straightforward details.
                                </span>
                            </div>

                        </div>

                    </div>


                    <!-- BUTTON -->
                    <a href="#products" class="about-button">

                        Explore Products

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

                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/bg-image.png" alt="Inside our mobile phone store" class="about-image">

                    <div class="about-image-overlay"></div>

                    <div class="about-badge">
                        <span class="about-badge-number">100%</span>
                        <span class="about-badge-text">Trusted Service</span>
                    </div>

                </div>

            </div>

        </div>
    </section>

    <section class="contact-section" id="contact">
        <div class="contact-container">

            <div class="contact-header">
                <span class="contact-eyebrow">Get In Touch</span>

                <h2>Contact Us</h2>

                <p>
                    Have a question about a product, availability, or pricing?
                    Reach out to us and we’ll be happy to help.
                </p>
            </div>

            <div class="contact-grid">

                <!-- MAP -->
                <div class="contact-map-wrapper">

                    <div class="contact-map">
                        <iframe src="https://www.google.com/maps?q=Casablanca%20Morocco&output=embed" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade" title="Store location">
                        </iframe>
                    </div>

                    <a href="https://www.google.com/maps/search/?api=1&query=Casablanca+Morocco" target="_blank"
                        rel="noopener noreferrer" class="contact-map-button">
                        Open In Google Maps

                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 12h14M13 6l6 6-6 6" />
                        </svg>
                    </a>

                </div>


                <!-- CONTACT INFO -->
                <div class="contact-info">

                    <!-- PHONE -->
                    <a href="tel:+212600000000" class="contact-card">

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
                            <span>Phone</span>
                            <strong>+212 600 000 000</strong>
                        </div>

                    </a>


                    <!-- WHATSAPP -->
                    <a href="https://wa.me/212600000000" target="_blank" rel="noopener noreferrer"
                        class="contact-card">

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
                            <strong>Chat With Us</strong>
                        </div>

                    </a>


                    <!-- EMAIL -->
                    <a href="mailto:contact@yourstore.com" class="contact-card">

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
                            <span>Email</span>
                            <strong>contact@yourstore.com</strong>
                        </div>

                    </a>


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
                            <span>Location</span>
                            <strong>Casablanca, Morocco</strong>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
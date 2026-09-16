<?php get_header(); ?>

<?php get_template_part('template-parts/header-inner'); ?>

<main class="single-product-page">

    <?php
    $wc_product = wc_get_product(get_the_ID());

    if ($wc_product && $wc_product->is_type('variable')) {
        $available_variations = $wc_product->get_available_variations();
    ?>

        <script id="productVariationsData" type="application/json">
            <?php echo wp_json_encode($available_variations); ?>
        </script>

    <?php
    }
    ?>

    <!-- =====================================================
         MAIN PRODUCT
    ====================================================== -->

    <section class="single-product-section">

        <div class="single-product-container">

            <!-- =============================================
                 LEFT — STICKY IMAGE GALLERY
            ============================================== -->

            <div class="single-product-gallery">

                <div class="single-product-gallery__sticky">

                    <!-- =====================================
                         MAIN IMAGE
                    ====================================== -->

                    <div class="single-product-main-image">

                        <?php
                        $wc_product = wc_get_product(get_the_ID());

                        if ($wc_product) {
                            $is_in_stock = $wc_product->is_in_stock();
                        ?>

                            <span
                                class="single-product-badge <?php echo $is_in_stock ? '' : 'single-product-badge--out'; ?>"
                                id="singleProductStock">

                                <?php echo $is_in_stock ? 'In Stock' : 'Out of Stock'; ?>

                            </span>

                        <?php
                        }
                        ?>

                        <!-- Previous Image -->
                        <button class="single-product-main-arrow single-product-main-arrow--prev" type="button"
                            aria-label="Previous image" id="singleProductPrev">

                            &#10094;

                        </button>

                        <img src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'full')); ?>"
                            alt="<?php echo esc_attr(get_the_title()); ?>"
                            id="singleProductImage">

                        <!-- Next Image -->
                        <button class="single-product-main-arrow single-product-main-arrow--next" type="button"
                            aria-label="Next image" id="singleProductNext">

                            &#10095;

                        </button>

                    </div>


                    <!-- =====================================
                         THUMBNAILS
                    ====================================== -->

                    <div class="single-product-thumbnails-wrapper">

                        <!-- Scroll Left -->
                        <button class="single-product-thumbnail-arrow single-product-thumbnail-arrow--prev"
                            type="button" aria-label="Scroll thumbnails left" id="thumbnailPrev">

                            &#10094;

                        </button>


                        <div class="single-product-thumbnails" id="singleProductThumbnails">

                            <?php
                            $wc_product = wc_get_product(get_the_ID());

                            if ($wc_product) {

                                // Main product image
                                $image_ids = array();

                                if ($wc_product->get_image_id()) {
                                    $image_ids[] = $wc_product->get_image_id();
                                }

                                // Product gallery images
                                $image_ids = array_merge(
                                    $image_ids,
                                    $wc_product->get_gallery_image_ids()
                                );

                                foreach ($image_ids as $index => $image_id) {

                                    $full_image = wp_get_attachment_image_url($image_id, 'full');
                                    $thumbnail_image = wp_get_attachment_image_url($image_id, 'woocommerce_thumbnail');

                                    if (!$full_image || !$thumbnail_image) {
                                        continue;
                                    }
                            ?>

                                    <button
                                        class="single-product-thumbnail <?php echo $index === 0 ? 'active' : ''; ?>"
                                        type="button"
                                        data-image="<?php echo esc_url($full_image); ?>">

                                        <img
                                            src="<?php echo esc_url($thumbnail_image); ?>"
                                            alt="<?php echo esc_attr(get_the_title() . ' view ' . ($index + 1)); ?>">

                                    </button>

                            <?php
                                }
                            }
                            ?>

                        </div>


                        <!-- Scroll Right -->

                        <button class="single-product-thumbnail-arrow single-product-thumbnail-arrow--next"
                            type="button" aria-label="Scroll thumbnails right" id="thumbnailNext">

                            &#10095;

                        </button>

                    </div>

                </div>

            </div>


            <!-- =============================================
                 RIGHT — PRODUCT DETAILS
            ============================================== -->

            <div class="single-product-details">


                <!-- BRAND -->
                <?php

                $brands = wp_get_post_terms(
                    get_the_ID(),
                    'product_brand'
                );

                if (!empty($brands) && !is_wp_error($brands)) {

                    $brand = $brands[0];
                ?>

                    <a
                        href="<?php echo esc_url(get_term_link($brand)); ?>"
                        class="single-product-brand">

                        <?php echo esc_html($brand->name); ?>

                    </a>

                <?php
                }

                ?>


                <!-- TITLE -->
                <h1 class="single-product-title">
                    <?php the_title(); ?>
                </h1>


                <!-- SHORT DESCRIPTION -->
                <p class="single-product-intro">
                    <?php echo wp_kses_post(get_the_excerpt()); ?>
                </p>


                <!-- PRICE -->
                <div class="single-product-price">

                    <span class="single-product-price__label">
                        Price
                    </span>

                    <strong class="single-product-price__value" id="singleProductPrice">
                        <?php
                        $wc_product = wc_get_product(get_the_ID());

                        if ($wc_product) {
                            echo wp_kses_post($wc_product->get_price_html());
                        }
                        ?>
                    </strong>

                </div>


                <?php
                $wc_product = wc_get_product(get_the_ID());

                $color_terms = array();

                if ($wc_product) {
                    $color_terms = wc_get_product_terms(
                        $wc_product->get_id(),
                        'pa_color'
                    );
                }

                if (!empty($color_terms)) {
                ?>

                    <!-- =========================================
                        COLOR
                    ========================================== -->

                    <div class="single-product-option">

                        <div class="single-product-option__header">

                            <span class="single-product-option__title">
                                Color
                            </span>

                            <span class="single-product-option__selected" id="selectedColor">
                                Select
                            </span>

                        </div>


                        <div class="single-product-variant-scroll">

                            <button
                                class="single-product-variant-scroll__arrow single-product-variant-scroll__arrow--previous"
                                type="button" aria-label="Previous colors">

                                <svg viewBox="0 0 24 24">
                                    <path d="m15 18-6-6 6-6"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>

                            </button>


                            <div class="single-product-colors single-product-variant-scroll__track"
                                role="radiogroup"
                                aria-label="Choose color">

                                <?php
                                foreach ($color_terms as $index => $color_term) {

                                    $color_value = get_term_meta(
                                        $color_term->term_id,
                                        'hamid_color_value',
                                        true
                                    );

                                    if (empty($color_value)) {
                                        $color_value = '#cccccc';
                                    }
                                ?>

                                    <button
                                        class="single-product-color"
                                        type="button"
                                        data-color="<?php echo esc_attr($color_term->name); ?>"
                                        aria-label="<?php echo esc_attr($color_term->name); ?>"
                                        aria-pressed="false">

                                        <span style="background: <?php echo esc_attr($color_value); ?>;"></span>

                                    </button>

                                <?php
                                }
                                ?>

                            </div>


                            <button
                                class="single-product-variant-scroll__arrow single-product-variant-scroll__arrow--next"
                                type="button" aria-label="Next colors">

                                <svg viewBox="0 0 24 24">
                                    <path d="m9 18 6-6-6-6"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>

                            </button>

                        </div>

                    </div>

                <?php
                }
                ?>


                <?php
                $wc_product = wc_get_product(get_the_ID());

                $storage_options = array();

                if ($wc_product) {
                    $storage_options = wc_get_product_terms(
                        $wc_product->get_id(),
                        'pa_storage',
                        array('fields' => 'names')
                    );
                }

                if (!empty($storage_options)) {
                ?>

                    <!-- =========================================
                        STORAGE
                    ========================================== -->

                    <div class="single-product-option">

                        <div class="single-product-option__header">

                            <span class="single-product-option__title">
                                Storage
                            </span>

                            <span class="single-product-option__selected" id="selectedStorage">
                                Select
                            </span>

                        </div>


                        <div class="single-product-variant-scroll">

                            <button
                                class="single-product-variant-scroll__arrow single-product-variant-scroll__arrow--previous"
                                type="button"
                                aria-label="Previous storage options">

                                <svg viewBox="0 0 24 24">
                                    <path d="m15 18-6-6 6-6"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>

                            </button>


                            <div class="single-product-storage single-product-variant-scroll__track">

                                <?php foreach ($storage_options as $index => $storage) { ?>

                                    <button
                                        class="single-product-storage__button"
                                        type="button"
                                        data-storage="<?php echo esc_attr($storage); ?>">

                                        <?php echo esc_html($storage); ?>

                                    </button>

                                <?php } ?>

                            </div>


                            <button
                                class="single-product-variant-scroll__arrow single-product-variant-scroll__arrow--next"
                                type="button"
                                aria-label="Next storage options">

                                <svg viewBox="0 0 24 24">
                                    <path d="m9 18 6-6-6-6"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>

                            </button>

                        </div>

                    </div>

                <?php
                }
                ?>


                <!-- =========================================
                     MAIN SPECS
                ========================================== -->

                <div class="single-product-specifications">

                    <div class="single-product-specifications__header">

                        <span>
                            Main Specifications
                        </span>

                    </div>


                    <div class="single-product-spec-grid">

                        <?php
                        $specifications = get_post_meta(
                            get_the_ID(),
                            '_hamid_product_specifications',
                            true
                        );

                        if (is_array($specifications)) {

                            $main_count = 0;

                            foreach ($specifications as $specification) {

                                if (
                                    empty($specification['main']) ||
                                    $main_count >= 6
                                ) {
                                    continue;
                                }

                                $title = isset($specification['title'])
                                    ? $specification['title']
                                    : '';

                                $value = isset($specification['value'])
                                    ? $specification['value']
                                    : '';

                                if ($title === '' && $value === '') {
                                    continue;
                                }

                        ?>

                                <div class="single-product-spec">

                                    <span>
                                        <?php echo esc_html($title); ?>
                                    </span>

                                    <strong>
                                        <?php echo esc_html($value); ?>
                                    </strong>

                                </div>

                        <?php

                                $main_count++;
                            }
                        }
                        ?>

                    </div>


                    <!-- =========================================
                     ACTION
                ========================================== -->

                    <?php

                    $product_name = get_the_title();

                    $whatsapp_message =
                        'Hello, I am interested in ' . $product_name;

                    ?>

                    <a
                        href="https://wa.me/212680449271?text=<?php echo rawurlencode($whatsapp_message); ?>"
                        class="single-product-contact-button"
                        id="singleProductContactButton"
                        target="_blank"
                        rel="noopener noreferrer">

                        Contact Us About This Product

                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path
                                d="M5 12h14M13 6l6 6-6 6"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>

                    </a>

                </div>

            </div>

    </section>


    <!-- =====================================================
         MORE DETAILS
    ====================================================== -->

    <section class="single-product-more">

        <div class="single-product-more__container">

            <div class="single-product-more__heading">

                <span>
                    Product Details
                </span>

                <h2>
                    More About <?php the_title(); ?>
                </h2>

                <p>
                    Everything you need to know.
                </p>

            </div>


            <div class="single-product-more__layout">


                <!-- LEFT -->
                <div class="single-product-description">

                    <?php echo wp_kses_post(get_the_content()); ?>

                </div>


                <!-- RIGHT SPECIFICATIONS -->
                <div class="single-product-full-specs">

                    <div class="single-product-full-specs__table">

                        <?php
                        $specifications = get_post_meta(
                            get_the_ID(),
                            '_hamid_product_specifications',
                            true
                        );

                        if (is_array($specifications)) {

                            foreach ($specifications as $specification) {

                                $title = isset($specification['title'])
                                    ? $specification['title']
                                    : '';

                                $value = isset($specification['value'])
                                    ? $specification['value']
                                    : '';

                                if ($title === '' && $value === '') {
                                    continue;
                                }
                        ?>

                                <div class="single-product-full-spec">

                                    <span>
                                        <?php echo esc_html($title); ?>
                                    </span>

                                    <strong>
                                        <?php echo esc_html($value); ?>
                                    </strong>

                                </div>

                        <?php
                            }
                        }
                        ?>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <!-- #region RELATED PRODUCTS -->

    <?php

    $wc_product = wc_get_product(get_the_ID());

    $related_product_ids = array();

    if ($wc_product) {

        $related_product_ids = wc_get_related_products(
            $wc_product->get_id(),
            4
        );
    }

    ?>

    <section class="featured-products">

        <div class="featured-products__container">

            <!-- HEADER -->
            <div class="featured-products__header">

                <span class="featured-products__eyebrow">
                    You May Also Like
                </span>

                <h2>Related Products</h2>

                <p>
                    Discover other products you may be interested in.
                </p>

            </div>


            <!-- PRODUCTS GRID -->
            <div class="featured-products__grid">
                <?php foreach ($related_product_ids as $related_product_id) {

                    $related_product = wc_get_product($related_product_id);

                    if (!$related_product) {
                        continue;
                    }

                    $product_url = get_permalink($related_product_id);

                    $product_image = get_the_post_thumbnail_url(
                        $related_product_id,
                        'woocommerce_thumbnail'
                    );

                    $brands = wp_get_post_terms(
                        $related_product_id,
                        'product_brand'
                    );

                    $brand_name = '';

                    if (!empty($brands) && !is_wp_error($brands)) {
                        $brand_name = $brands[0]->name;
                    }

                ?>

                    <article class="product-card">

                        <a href="<?php echo esc_url($product_url); ?>" class="product-card__image">

                            <span class="product-card__badge">
                                Related
                            </span>

                            <?php if ($product_image) { ?>

                                <img
                                    src="<?php echo esc_url($product_image); ?>"
                                    alt="<?php echo esc_attr($related_product->get_name()); ?>"
                                    loading="lazy">

                            <?php } ?>

                        </a>


                        <div class="product-card__content">

                            <?php if (!empty($brands) && !is_wp_error($brands)) { ?>

                                <a
                                    href="<?php echo esc_url(get_term_link($brands[0])); ?>"
                                    class="product-card__category">

                                    <?php echo esc_html($brand_name); ?>

                                </a>

                            <?php } ?>

                            <h3>
                                <a href="<?php echo esc_url($product_url); ?>">
                                    <?php echo esc_html($related_product->get_name()); ?>
                                </a>
                            </h3>

                            <div class="product-card__bottom">

                                <div class="product-card__price">

                                    <span>
                                        Price
                                    </span>

                                    <strong>
                                        <?php
                                        if ($related_product->is_type('variable')) {

                                            $min_price = $related_product->get_variation_price('min', true);
                                            $max_price = $related_product->get_variation_price('max', true);

                                            if ($min_price !== $max_price) {

                                                echo esc_html(
                                                    wc_format_localized_price($min_price)
                                                        . ' - '
                                                        . wc_format_localized_price($max_price)
                                                        . ' DH'
                                                );
                                            } else {

                                                echo esc_html(
                                                    wc_format_localized_price($min_price) . ' DH'
                                                );
                                            }
                                        } else {

                                            echo esc_html(
                                                wc_format_localized_price(
                                                    $related_product->get_price()
                                                ) . ' DH'
                                            );
                                        }
                                        ?>
                                    </strong>

                                </div>


                                <a
                                    href="<?php echo esc_url($product_url); ?>"
                                    class="product-card__button"
                                    aria-label="<?php echo esc_attr('View ' . $related_product->get_name()); ?>">

                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
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

                <?php } ?>
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

</main>


<?php get_footer(); ?>
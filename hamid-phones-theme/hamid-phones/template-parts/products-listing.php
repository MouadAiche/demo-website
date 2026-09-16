<?php

$current_brand = null;

if (is_tax('product_brand')) {
    $current_brand = get_queried_object();
}

?>

<main>

    <!-- #region PRODUCTS LISTING -->

    <section class="featured-products">

        <div class="featured-products__container">

            <!-- HEADER -->
            <div class="featured-products__header">

                <span class="featured-products__eyebrow">
                    Browse Our Store
                </span>

                <h2>All Products</h2>

                <p>
                    Explore our available smartphones and devices
                    from different brands and categories.
                </p>

            </div>


            <!-- PRODUCTS GRID -->
            <div class="featured-products__grid">


                <?php

                if (have_posts()) {

                    while (have_posts()) {

                        the_post();

                        $listing_product = wc_get_product(get_the_ID());

                        if (!$listing_product) {
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

                            <a href="<?php echo esc_url($product_url); ?>" class="product-card__image">

                                <span class="product-card__badge <?php echo $listing_product->is_in_stock() ? '' : 'product-card__badge--out'; ?>">
                                    <?php echo $listing_product->is_in_stock() ? 'Available' : 'Out of Stock'; ?>
                                </span>

                                <?php if ($product_image) { ?>

                                    <img
                                        src="<?php echo esc_url($product_image); ?>"
                                        alt="<?php echo esc_attr($listing_product->get_name()); ?>"
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
                                        <?php echo esc_html($listing_product->get_name()); ?>
                                    </a>
                                </h3>


                                <div class="product-card__bottom">

                                    <div class="product-card__price">

                                        <span>Price</span>

                                        <strong>
                                            <?php

                                            if ($listing_product->is_type('variable')) {

                                                $min_price =
                                                    $listing_product->get_variation_price('min', true);

                                                $max_price =
                                                    $listing_product->get_variation_price('max', true);

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
                                                        $listing_product->get_price()
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
                                                        'View ' . $listing_product->get_name()
                                                    ); ?>">

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

                <?php
                    }
                }

                ?>


            </div>

            <!-- PAGINATION -->
            <?php

            global $wp_query;

            $total_pages = $wp_query->max_num_pages;
            $current_page = max(1, get_query_var('paged'));

            if ($total_pages > 1) {

                $pagination_links = paginate_links(array(
                    'total'     => $total_pages,
                    'current'   => $current_page,
                    'mid_size'  => 1,
                    'end_size'  => 1,
                    'prev_text' => '
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M19 12H5M11 18l-6-6 6-6"
                />
            </svg>
        ',
                    'next_text' => '
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M5 12h14M13 6l6 6-6 6"
                />
            </svg>
        ',
                    'type' => 'array'
                ));

                if ($pagination_links) {
            ?>

                    <nav
                        class="products-pagination"
                        aria-label="Products pagination">

                        <?php

                        foreach ($pagination_links as $link) {

                            if (strpos($link, 'prev page-numbers') !== false) {

                                echo str_replace(
                                    'page-numbers',
                                    'products-pagination__button products-pagination__button--previous',
                                    $link
                                );
                            } elseif (strpos($link, 'next page-numbers') !== false) {

                                echo str_replace(
                                    'page-numbers',
                                    'products-pagination__button products-pagination__button--next',
                                    $link
                                );
                            } elseif (strpos($link, 'dots') !== false) {

                                echo str_replace(
                                    'page-numbers dots',
                                    'products-pagination__dots',
                                    $link
                                );
                            } else {

                                $link = str_replace(
                                    'page-numbers current',
                                    'products-pagination__number is-active',
                                    $link
                                );

                                $link = str_replace(
                                    'page-numbers',
                                    'products-pagination__number',
                                    $link
                                );

                                echo $link;
                            }
                        }

                        ?>

                    </nav>

            <?php
                }
            }
            ?>

        </div>

    </section>

    <!-- #endregion -->

</main>
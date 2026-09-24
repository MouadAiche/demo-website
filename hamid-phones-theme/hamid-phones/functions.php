<?php

add_theme_support('woocommerce');

function hamid_phones_assets()
{

    wp_enqueue_style(
        'hamid-phones-style',
        get_stylesheet_uri()
    );

    wp_enqueue_script(
        'hamid-phones-main',
        get_template_directory_uri() . '/assets/js/main.js',
        array(),
        null,
        true
    );
    wp_localize_script(
        'hamid-phones-main',
        'hamidPhones',
        array(
            'homeUrl' => home_url('/'),
            'ajaxUrl' => admin_url('admin-ajax.php'),
        )
    );
}

add_action('wp_enqueue_scripts', 'hamid_phones_assets');


/* =========================================================
   COLOR ATTRIBUTE - COLOR PICKER
========================================================= */


/*
 * Add color field when creating a new Color term
 */
function hamid_phones_add_color_field()
{
?>

    <div class="form-field">
        <label for="hamid_color_value">
            Color
        </label>

        <input
            type="color"
            name="hamid_color_value"
            id="hamid_color_value"
            value="#000000">
    </div>

<?php
}

add_action('pa_color_add_form_fields', 'hamid_phones_add_color_field');


/*
 * Add color field when editing an existing Color term
 */
function hamid_phones_edit_color_field($term)
{

    $color = get_term_meta(
        $term->term_id,
        'hamid_color_value',
        true
    );

    if (empty($color)) {
        $color = '#000000';
    }

?>

    <tr class="form-field">

        <th scope="row">
            <label for="hamid_color_value">
                Color
            </label>
        </th>

        <td>
            <input
                type="color"
                name="hamid_color_value"
                id="hamid_color_value"
                value="<?php echo esc_attr($color); ?>">
        </td>

    </tr>

<?php
}

add_action('pa_color_edit_form_fields', 'hamid_phones_edit_color_field');


/*
 * Save the color value
 */
function hamid_phones_save_color_field($term_id)
{

    if (isset($_POST['hamid_color_value'])) {

        $color = sanitize_hex_color(
            wp_unslash($_POST['hamid_color_value'])
        );

        if ($color) {
            update_term_meta(
                $term_id,
                'hamid_color_value',
                $color
            );
        }
    }
}

add_action('created_pa_color', 'hamid_phones_save_color_field');
add_action('edited_pa_color', 'hamid_phones_save_color_field');

/* =========================================================
   PRODUCT SPECIFICATIONS - ADMIN PANEL
========================================================= */

function hamid_phones_product_specifications_panel()
{

    add_meta_box(
        'hamid_product_specifications',
        'Product Specifications',
        'hamid_phones_product_specifications_panel_html',
        'product',
        'normal',
        'default'
    );
}

add_action(
    'add_meta_boxes',
    'hamid_phones_product_specifications_panel'
);


function hamid_phones_product_specifications_panel_html($post)
{

    wp_nonce_field(
        'hamid_save_product_specifications',
        'hamid_product_specifications_nonce'
    );


    $specifications = get_post_meta(
        $post->ID,
        '_hamid_product_specifications',
        true
    );

    if (!is_array($specifications)) {
        $specifications = array();
    }

?>

    <div class="hamid-product-specifications">

        <!-- SPECIFICATIONS -->
        <div id="hamid-specifications-list">

            <?php foreach ($specifications as $index => $specification) {

                $title = isset($specification['title'])
                    ? $specification['title']
                    : '';

                $value = isset($specification['value'])
                    ? $specification['value']
                    : '';

                $main = !empty($specification['main']);

            ?>

                <div
                    class="hamid-specification-row"
                    style="
                        display: grid;
                        grid-template-columns: 1fr 2fr auto auto;
                        gap: 10px;
                        align-items: center;
                        margin-bottom: 10px;
                    ">

                    <input
                        type="text"
                        name="hamid_specifications[<?php echo esc_attr($index); ?>][title]"
                        value="<?php echo esc_attr($title); ?>"
                        placeholder="Specification">

                    <input
                        type="text"
                        name="hamid_specifications[<?php echo esc_attr($index); ?>][value]"
                        value="<?php echo esc_attr($value); ?>"
                        placeholder="Value">

                    <label>
                        <input
                            type="checkbox"
                            name="hamid_specifications[<?php echo esc_attr($index); ?>][main]"
                            value="1"
                            <?php checked($main); ?>>
                        Main
                    </label>

                    <button
                        type="button"
                        class="button hamid-remove-specification">
                        Remove
                    </button>

                </div>

            <?php } ?>

        </div>


        <button
            type="button"
            class="button button-secondary"
            id="hamid-add-specification">
            + Add Specification
        </button>


        <p style="margin-top: 10px; color: #646970;">
            You can select up to 6 specifications as Main.
            Main specifications will still appear in the full specifications table.
        </p>

    </div>


    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const list =
                document.getElementById("hamid-specifications-list");

            const addButton =
                document.getElementById("hamid-add-specification");

            if (!list || !addButton) return;


            let specificationIndex =
                list.querySelectorAll(".hamid-specification-row").length;


            /* =====================================================
               ADD SPECIFICATION
            ===================================================== */

            addButton.addEventListener("click", function() {

                const row = document.createElement("div");

                row.className = "hamid-specification-row";

                row.style.cssText = `
                    display: grid;
                    grid-template-columns: 1fr 2fr auto auto;
                    gap: 10px;
                    align-items: center;
                    margin-bottom: 10px;
                `;


                row.innerHTML = `
                    <input
                        type="text"
                        name="hamid_specifications[${specificationIndex}][title]"
                        placeholder="Specification"
                    >

                    <input
                        type="text"
                        name="hamid_specifications[${specificationIndex}][value]"
                        placeholder="Value"
                    >

                    <label>
                        <input
                            type="checkbox"
                            name="hamid_specifications[${specificationIndex}][main]"
                            value="1"
                        >
                        Main
                    </label>

                    <button
                        type="button"
                        class="button hamid-remove-specification"
                    >
                        Remove
                    </button>
                `;

                list.appendChild(row);

                specificationIndex++;

            });


            /* =====================================================
               REMOVE SPECIFICATION
            ===================================================== */

            list.addEventListener("click", function(event) {

                if (
                    event.target.classList.contains(
                        "hamid-remove-specification"
                    )
                ) {

                    event.target
                        .closest(".hamid-specification-row")
                        .remove();

                }

            });

        });
    </script>

<?php
}

/* =========================================================
   PRODUCT SPECIFICATIONS - SAVE
========================================================= */

function hamid_phones_save_product_specifications($post_id)
{

    /* Verify nonce */
    if (
        !isset($_POST['hamid_product_specifications_nonce']) ||
        !wp_verify_nonce(
            sanitize_text_field(
                wp_unslash($_POST['hamid_product_specifications_nonce'])
            ),
            'hamid_save_product_specifications'
        )
    ) {
        return;
    }


    /* Ignore autosaves */
    if (
        defined('DOING_AUTOSAVE') &&
        DOING_AUTOSAVE
    ) {
        return;
    }


    /* Check permission */
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }


    $clean_specifications = array();


    if (
        isset($_POST['hamid_specifications']) &&
        is_array($_POST['hamid_specifications'])
    ) {

        $specifications =
            wp_unslash($_POST['hamid_specifications']);


        foreach ($specifications as $specification) {

            $title = isset($specification['title'])
                ? sanitize_text_field($specification['title'])
                : '';

            $value = isset($specification['value'])
                ? sanitize_text_field($specification['value'])
                : '';


            /* Skip completely empty rows */
            if ($title === '' && $value === '') {
                continue;
            }


            $clean_specifications[] = array(
                'title' => $title,
                'value' => $value,
                'main'  => !empty($specification['main']) ? 1 : 0
            );
        }
    }


    update_post_meta(
        $post_id,
        '_hamid_product_specifications',
        $clean_specifications
    );
}

add_action(
    'save_post_product',
    'hamid_phones_save_product_specifications'
);


/* =========================================================
   STORE INFORMATION SETTINGS
========================================================= */

function hamid_phones_store_information_menu()
{

    add_options_page(
        'Store Information',
        'Store Information',
        'manage_options',
        'hamid-store-information',
        'hamid_phones_store_information_page'
    );
}
add_action('admin_menu', 'hamid_phones_store_information_menu');


function hamid_phones_store_information_settings()
{

    $fields = array(
        'hamid_store_phone',
        'hamid_store_whatsapp',
        'hamid_store_email',
        'hamid_store_location',
        'hamid_store_maps_link',
        'hamid_store_facebook',
        'hamid_store_instagram',
        'hamid_store_tiktok',
    );

    foreach ($fields as $field) {

        register_setting(
            'hamid_store_information',
            $field,
            array(
                'sanitize_callback' => 'sanitize_text_field',
            )
        );
    }
}
add_action('admin_init', 'hamid_phones_store_information_settings');


function hamid_phones_store_information_page()
{

    if (!current_user_can('manage_options')) {
        return;
    }

?>

    <div class="wrap">

        <h1>Store Information</h1>

        <p>
            Manage the store contact information and social media links.
        </p>

        <form method="post" action="options.php">

            <?php settings_fields('hamid_store_information'); ?>

            <table class="form-table">

                <tr>
                    <th scope="row">
                        Phone
                    </th>

                    <td>
                        <input
                            type="text"
                            name="hamid_store_phone"
                            value="<?php echo esc_attr(get_option('hamid_store_phone')); ?>"
                            class="regular-text">
                    </td>
                </tr>


                <tr>
                    <th scope="row">
                        WhatsApp
                    </th>

                    <td>
                        <input
                            type="text"
                            name="hamid_store_whatsapp"
                            value="<?php echo esc_attr(get_option('hamid_store_whatsapp')); ?>"
                            class="regular-text">

                        <p class="description">
                            Example: 212680449271
                        </p>
                    </td>
                </tr>


                <tr>
                    <th scope="row">
                        Email
                    </th>

                    <td>
                        <input
                            type="email"
                            name="hamid_store_email"
                            value="<?php echo esc_attr(get_option('hamid_store_email')); ?>"
                            class="regular-text">
                    </td>
                </tr>


                <tr>
                    <th scope="row">
                        Location
                    </th>

                    <td>
                        <input
                            type="text"
                            name="hamid_store_location"
                            value="<?php echo esc_attr(get_option('hamid_store_location')); ?>"
                            class="regular-text">
                    </td>
                </tr>

                <tr>
                    <th scope="row">
                        Google Maps Embed Link
                    </th>

                    <td>
                        <input
                            type="url"
                            name="hamid_store_maps_embed"
                            value="<?php echo esc_attr(get_option('hamid_store_maps_embed')); ?>"
                            class="regular-text">

                        <p class="description">
                            Paste the Google Maps embed URL for the exact shop location.
                        </p>
                    </td>
                </tr>

                <tr>
                    <th scope="row">
                        Google Maps Link
                    </th>

                    <td>
                        <input
                            type="url"
                            name="hamid_store_maps_link"
                            value="<?php echo esc_attr(get_option('hamid_store_maps_link')); ?>"
                            class="regular-text">

                        <p class="description">
                            Paste the normal Google Maps share link for the exact shop location.
                        </p>
                    </td>
                </tr>

                <tr>
                    <th scope="row">
                        Facebook
                    </th>

                    <td>
                        <input
                            type="url"
                            name="hamid_store_facebook"
                            value="<?php echo esc_attr(get_option('hamid_store_facebook')); ?>"
                            class="regular-text">
                    </td>
                </tr>


                <tr>
                    <th scope="row">
                        Instagram
                    </th>

                    <td>
                        <input
                            type="url"
                            name="hamid_store_instagram"
                            value="<?php echo esc_attr(get_option('hamid_store_instagram')); ?>"
                            class="regular-text">
                    </td>
                </tr>


                <tr>
                    <th scope="row">
                        TikTok
                    </th>

                    <td>
                        <input
                            type="url"
                            name="hamid_store_tiktok"
                            value="<?php echo esc_attr(get_option('hamid_store_tiktok')); ?>"
                            class="regular-text">
                    </td>
                </tr>

            </table>

            <?php submit_button('Save Store Information'); ?>

        </form>

    </div>

<?php
}


/* =========================================================
   PRODUCT SEARCH
========================================================= */


/*
 * Normalize a search value.
 *
 * Examples:
 * "iPhone 15"  -> "iphone15"
 * "iphone15"   -> "iphone15"
 * "iPhone 15 Pro" -> "iphone15pro"
 */
function hamid_normalize_product_search($value)
{
    $value = strtolower($value);

    return preg_replace('/\s+/', '', $value);
}


/*
 * Apply our title-only, space-insensitive product search.
 *
 * Used by:
 * - Live AJAX search
 * - Full search results page
 */
function hamid_search_products_by_title($where, $query)
{
    global $wpdb;

    $search_term = $query->get('hamid_title_search');

    if (!$search_term) {
        return $where;
    }

    $normalized_search =
        hamid_normalize_product_search($search_term);

    if ($normalized_search === '') {
        return $where;
    }

    $where .= $wpdb->prepare(
        "
        AND LOWER(
            REPLACE({$wpdb->posts}.post_title, ' ', '')
        ) LIKE %s
        ",
        '%' . $wpdb->esc_like($normalized_search) . '%'
    );

    return $where;
}

add_filter(
    'posts_where',
    'hamid_search_products_by_title',
    10,
    2
);


/* =========================================================
   LIVE AJAX SEARCH
========================================================= */

function hamid_live_product_search()
{
    $search_term = isset($_GET['search'])
        ? sanitize_text_field(wp_unslash($_GET['search']))
        : '';

    if (trim($search_term) === '') {
        wp_send_json_success(array());
    }


    /*
     * Maximum 4 matching products.
     */
    $product_query = new WP_Query(array(
        'post_type'          => 'product',
        'post_status'        => 'publish',
        'posts_per_page'     => 4,
        'hamid_title_search' => $search_term,

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


    $results = array();


    while ($product_query->have_posts()) {

        $product_query->the_post();

        $product = wc_get_product(get_the_ID());

        if (!$product) {
            continue;
        }


        /* Product image */

        $image_id = $product->get_image_id();

        $image_url = $image_id
            ? wp_get_attachment_image_url(
                $image_id,
                'woocommerce_thumbnail'
            )
            : wc_placeholder_img_src();


        /* Product brand */

        $brands = wp_get_post_terms(
            $product->get_id(),
            'product_brand'
        );

        $brand_name = '';

        if (!empty($brands) && !is_wp_error($brands)) {
            $brand_name = $brands[0]->name;
        }


        /* Product price */

        if ($product->is_type('variable')) {

            $min_price =
                $product->get_variation_price('min', true);

            $max_price =
                $product->get_variation_price('max', true);


            if ($min_price !== $max_price) {

                $price =
                    hamid_format_price($min_price)
                    . ' - '
                    . hamid_format_price($max_price)
                    . ' DH';
            } else {

                $price =
                    hamid_format_price($min_price)
                    . ' DH';
            }
        } else {

            $price =
                hamid_format_price(
                    $product->get_price()
                )
                . ' DH';
        }


        /* Result */

        $results[] = array(
            'name'  => $product->get_name(),
            'url'   => $product->get_permalink(),
            'image' => $image_url,
            'brand' => $brand_name,
            'price' => $price,
        );
    }


    wp_reset_postdata();

    wp_send_json_success($results);
}


/* Logged-in users */

add_action(
    'wp_ajax_hamid_live_product_search',
    'hamid_live_product_search'
);


/* Visitors */

add_action(
    'wp_ajax_nopriv_hamid_live_product_search',
    'hamid_live_product_search'
);


/* =========================================================
   FULL SEARCH RESULTS PAGE
========================================================= */

function hamid_product_search_results($query)
{
    if (
        is_admin() ||
        !$query->is_main_query() ||
        !$query->is_search()
    ) {
        return;
    }


    $search_term = $query->get('s');

    if (!$search_term) {
        return;
    }


    /*
     * Search only WooCommerce products.
     */
    $query->set(
        'post_type',
        'product'
    );


    /*
     * Use our custom search instead of WordPress's
     * normal content/excerpt search.
     *
     * Save the original keyword first.
     */
    $query->set(
        'hamid_title_search',
        $search_term
    );


    /*
     * Disable WordPress's built-in text search.
     */
    $query->set('s', '');


    /*
     * Keep this as a search page even though "s"
     * was cleared internally.
     */
    $query->is_search = true;
}

add_action(
    'pre_get_posts',
    'hamid_product_search_results'
);

/* =========================================================
   DISABLE SINGLE PRODUCT SEARCH REDIRECT
========================================================= */

function hamid_disable_single_product_search_redirect($redirect_url)
{
    if (is_search()) {
        return false;
    }

    return $redirect_url;
}

add_filter(
    'woocommerce_redirect_single_search_result',
    'hamid_disable_single_product_search_redirect'
);

/* =========================================================
   SHOW IN-STOCK PRODUCTS FIRST
========================================================= */

function hamid_in_stock_products_first($clauses, $query)
{
    global $wpdb;

    if (
        is_admin() ||
        !$query->is_main_query()
    ) {
        return $clauses;
    }

    if (
        !is_shop() &&
        !is_product_taxonomy() &&
        !$query->is_search()
    ) {
        return $clauses;
    }

    $clauses['join'] .= "
        LEFT JOIN {$wpdb->postmeta} AS hamid_stock_status
        ON (
            {$wpdb->posts}.ID = hamid_stock_status.post_id
            AND hamid_stock_status.meta_key = '_stock_status'
        )
    ";

    $clauses['orderby'] = "
        CASE
            WHEN hamid_stock_status.meta_value = 'instock' THEN 0
            ELSE 1
        END ASC,
        {$clauses['orderby']}
    ";

    return $clauses;
}

add_filter(
    'posts_clauses',
    'hamid_in_stock_products_first',
    20,
    2
);


function hamid_format_price($price)
{
    return number_format(
        (float) $price,
        0,
        ',',
        '.'
    );
}

/* =========================================================
   VARIATION PRICES BY STORAGE
========================================================= */


/* =========================================================
   SHOW STORAGE PRICE FIELDS
========================================================= */

function hamid_storage_price_fields()
{
    global $post;

    if (!$post) {
        return;
    }

    $product = wc_get_product($post->ID);

    if (!$product || !$product->is_type('variable')) {
        return;
    }

    $storage_terms = wc_get_product_terms(
        $product->get_id(),
        'pa_storage',
        array(
            'fields' => 'all',
        )
    );

    if (empty($storage_terms)) {
        return;
    }

?>

    <div class="options_group">

        <p class="form-field">
            <strong>Prix par stockage</strong>
        </p>

        <?php foreach ($storage_terms as $term) : ?>

            <?php

            woocommerce_wp_text_input(array(

                'id' =>
                'hamid_storage_price_' . $term->slug,

                'value' => get_post_meta(
                    $product->get_id(),
                    '_hamid_storage_price_' . $term->slug,
                    true
                ),

                'label' => $term->name,

                'type' => 'number',

                'custom_attributes' => array(
                    'step' => '1',
                    'min'  => '0',
                ),

                'description' => 'Prix en DH',

                'desc_tip' => true,
            ));

            ?>

        <?php endforeach; ?>

    </div>

<?php
}

add_action(
    'woocommerce_product_options_general_product_data',
    'hamid_storage_price_fields'
);


/* =========================================================
   SAVE STORAGE PRICES
   AND APPLY THEM TO MATCHING VARIATIONS
========================================================= */

function hamid_save_storage_prices($product)
{
    if (!$product || !$product->is_type('variable')) {
        return;
    }

    $product_id = $product->get_id();

    $storage_terms = wc_get_product_terms(
        $product_id,
        'pa_storage',
        array(
            'fields' => 'all',
        )
    );

    if (empty($storage_terms)) {
        return;
    }


    /* Get all variations */

    $variation_ids = $product->get_children();


    foreach ($storage_terms as $term) {

        $field_name =
            'hamid_storage_price_' . $term->slug;


        if (!isset($_POST[$field_name])) {
            continue;
        }


        /* Get submitted price */

        $price = wc_format_decimal(
            wp_unslash($_POST[$field_name])
        );


        /* Save storage price field */

        update_post_meta(
            $product_id,
            '_' . $field_name,
            $price
        );


        /* Update matching variations */

        foreach ($variation_ids as $variation_id) {

            $variation =
                wc_get_product($variation_id);

            if (!$variation) {
                continue;
            }


            $variation_attributes =
                $variation->get_attributes();

            $variation_storage =
                isset($variation_attributes['pa_storage'])
                ? $variation_attributes['pa_storage']
                : '';


            if ($variation_storage !== $term->slug) {
                continue;
            }


            $variation->set_regular_price($price);

            $variation->set_price($price);

            $variation->save();
        }
    }


    /* Clear WooCommerce product cache */

    wc_delete_product_transients($product_id);
}

add_action(
    'woocommerce_admin_process_product_object',
    'hamid_save_storage_prices',
    20
);


/* =========================================================
   PRODUCT IMAGE — LARGE IMAGE PROTECTION
========================================================= */

/**
 * Scale oversized uploaded images to a maximum
 * dimension of 2000px.
 *
 * WordPress preserves the original aspect ratio.
 *
 * Examples:
 * 4000x4000 -> 2000x2000
 * 3000x3000 -> 2000x2000
 * 1600x1600 -> unchanged
 */
function hamid_big_image_size_threshold($threshold)
{
    return 2000;
}

add_filter(
    'big_image_size_threshold',
    'hamid_big_image_size_threshold'
);

/* =========================================================
   PRODUCT IMAGE — COMPRESSION QUALITY
========================================================= */

/**
 * Use a good balance between image quality
 * and file size for generated images.
 */
function hamid_image_quality($quality, $mime_type)
{
    if ($mime_type === 'image/jpeg') {
        return 82;
    }

    if ($mime_type === 'image/webp') {
        return 82;
    }

    return $quality;
}

add_filter(
    'wp_editor_set_quality',
    'hamid_image_quality',
    10,
    2
);

/* =========================================================
   PRODUCT IMAGE — REMOVE UNUSED IMAGE SIZES
========================================================= */

/**
 * Keep only the image sizes used by the theme:
 *
 * medium       -> 300px
 * medium_large -> 768px
 * large        -> 1024px
 *
 * The main scaled image remains up to 2000px.
 */
function hamid_limit_generated_image_sizes($sizes)
{
    $allowed_sizes = array(
        'medium',
        'medium_large',
        'large',
    );

    foreach ($sizes as $size_name => $size_data) {

        if (!in_array($size_name, $allowed_sizes, true)) {
            unset($sizes[$size_name]);
        }
    }

    return $sizes;
}

add_filter(
    'intermediate_image_sizes_advanced',
    'hamid_limit_generated_image_sizes'
);


/* =========================================================
   PRODUCT IMAGE — REMOVE OVERSIZED ORIGINAL
========================================================= */

/**
 * After WordPress successfully creates the scaled image,
 * remove the oversized original to save hosting storage.
 */
function hamid_remove_oversized_original(
    $metadata,
    $attachment_id,
    $context
) {
    // Only run during the initial image creation.
    if ($context !== 'create') {
        return $metadata;
    }

    // WordPress only adds this when a scaled replacement
    // has successfully been created.
    if (empty($metadata['original_image'])) {
        return $metadata;
    }

    $attached_file = get_attached_file($attachment_id);

    if (!$attached_file) {
        return $metadata;
    }

    $original_file = path_join(
        dirname($attached_file),
        $metadata['original_image']
    );

    // Never delete the active scaled attachment itself.
    if (
        $original_file !== $attached_file &&
        file_exists($original_file)
    ) {
        wp_delete_file($original_file);

        // The original no longer exists, so don't leave
        // WordPress metadata pointing to it.
        unset($metadata['original_image']);
    }

    return $metadata;
}

add_filter(
    'wp_generate_attachment_metadata',
    'hamid_remove_oversized_original',
    20,
    3
);

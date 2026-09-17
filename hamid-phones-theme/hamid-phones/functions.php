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

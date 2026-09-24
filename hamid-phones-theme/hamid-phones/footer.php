<footer class="site-footer">
    <?php

    $store_phone     = get_option('hamid_store_phone');
    $store_email     = get_option('hamid_store_email');
    $store_location  = get_option('hamid_store_location');

    $store_facebook  = get_option('hamid_store_facebook');
    $store_instagram = get_option('hamid_store_instagram');
    $store_whatsapp  = get_option('hamid_store_whatsapp');
    $store_tiktok    = get_option('hamid_store_tiktok');

    $display_phone = preg_replace(
        '/^212(\d{3})(\d{3})(\d{3})$/',
        '+212 $1 $2 $3',
        preg_replace('/\D+/', '', $store_phone)
    );

    ?>

    <div class="footer-main">
        <div class="footer-container">

            <!-- Brand -->
            <div class="footer-brand">

                <a href="<?php echo esc_url(home_url('/')); ?>" class="footer-logo">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png" alt="Logo Hamid Phones">
                </a>

                <p>
                    Découvrez les derniers smartphones, et marques de confiance
                    avec une expérience d'achat simple et premium.
                </p>

                <div class="footer-socials">

                    <?php if ($store_facebook) { ?>

                        <a href="<?php echo esc_url($store_facebook); ?>"
                            target="_blank"
                            rel="noopener noreferrer"
                            aria-label="Facebook">

                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M14 8h3V4h-3c-3 0-5 2-5 5v2H6v4h3v7h4v-7h3l1-4h-4V9c0-.7.3-1 1-1Z"
                                    fill="currentColor" />
                            </svg>

                        </a>

                    <?php } ?>


                    <?php if ($store_instagram) { ?>

                        <a href="<?php echo esc_url($store_instagram); ?>"
                            target="_blank"
                            rel="noopener noreferrer"
                            aria-label="Instagram">

                            <svg viewBox="0 0 24 24" aria-hidden="true">

                                <rect x="3" y="3" width="18" height="18" rx="5"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2" />

                                <circle cx="12" cy="12" r="4"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2" />

                                <circle cx="17.5" cy="6.5" r="1"
                                    fill="currentColor" />

                            </svg>

                        </a>

                    <?php } ?>


                    <?php if ($store_whatsapp) {

                        $whatsapp_number = preg_replace(
                            '/[^0-9]/',
                            '',
                            $store_whatsapp
                        );

                    ?>

                        <a href="<?php echo esc_url('https://wa.me/' . $whatsapp_number); ?>"
                            target="_blank"
                            rel="noopener noreferrer"
                            aria-label="WhatsApp">

                            <svg viewBox="0 0 24 24" aria-hidden="true">

                                <path d="M20 11.7a8 8 0 0 1-11.8 7l-4.2 1.1 1.1-4A8 8 0 1 1 20 11.7Z"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linejoin="round" />

                                <path
                                    d="M9 8.5c.2-.4.4-.4.6-.4h.5c.2 0 .4.1.5.5l.7 1.7c.1.3 0 .5-.2.7l-.6.7c-.2.2-.1.4 0 .6.6 1.1 1.5 2 2.7 2.6.2.1.4.1.6-.1l.8-1c.2-.2.4-.3.7-.2l1.7.8c.3.1.5.3.5.5 0 .4-.2 1.4-1 2-.6.6-1.5.9-2.5.6-1.2-.3-2.7-1-4.3-2.5-1.4-1.3-2.4-2.9-2.8-4.1-.4-1.1 0-1.9.4-2.4Z"
                                    fill="currentColor" />

                            </svg>

                        </a>

                    <?php } ?>


                    <?php if ($store_tiktok) { ?>

                        <a href="<?php echo esc_url($store_tiktok); ?>"
                            target="_blank"
                            rel="noopener noreferrer"
                            aria-label="TikTok">

                            <svg viewBox="0 0 24 24" aria-hidden="true">

                                <path d="M14 4v10.2a3.8 3.8 0 1 1-3-3.7"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linecap="round" />

                                <path d="M14 4c.5 2.6 2.2 4.2 5 4.7"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linecap="round" />

                            </svg>

                        </a>

                    <?php } ?>

                </div>

            </div>


            <!-- Quick Links -->
            <div class="footer-column">

                <h3>Navigation</h3>

                <nav>
                    <a href="<?php echo esc_url(home_url('/#home')); ?>">Accueil</a>
                    <a href="<?php echo esc_url(home_url('/#brands')); ?>">Marques</a>
                    <a href="<?php echo esc_url(home_url('/#products')); ?>">Produits</a>
                    <a href="<?php echo esc_url(home_url('/#about')); ?>">À propos</a>
                    <a href="<?php echo esc_url(home_url('/#contact')); ?>">Contact</a>
                </nav>

            </div>


            <!-- Brands -->
            <div class="footer-column">

                <h3>Marques</h3>

                <nav>

                    <?php

                    $footer_brands = get_terms(array(
                        'taxonomy'   => 'product_brand',
                        'hide_empty' => true,
                    ));

                    if (!is_wp_error($footer_brands) && !empty($footer_brands)) {

                        foreach ($footer_brands as $brand) {

                            $brand_url = get_term_link($brand);

                            if (is_wp_error($brand_url)) {
                                continue;
                            }

                    ?>

                            <a href="<?php echo esc_url($brand_url); ?>">
                                <?php echo esc_html($brand->name); ?>
                            </a>

                    <?php
                        }
                    }

                    ?>

                </nav>

            </div>


            <!-- Contact -->
            <div class="footer-column footer-contact">

                <h3>Contact</h3>


                <?php if ($store_phone) { ?>

                    <div class="contact-item">

                        <span class="contact-icon">
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <path
                                    d="M6.6 3h3l1.2 5-2 1.5c1.2 2.4 3.1 4.3 5.5 5.5l1.5-2 5 1.2v3c0 1-.8 1.8-1.8 1.8C10.2 19 5 13.8 5 5c0-1 .7-2 1.6-2Z"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linejoin="round" />
                            </svg>
                        </span>

                        <span class="footer-contact-text">
                            <small>Téléphone</small>
                            <span><?php echo esc_html($display_phone); ?></span>
                        </span>

                        <button
                            type="button"
                            class="footer-copy-button contact-copy-button"
                            data-copy="<?php echo esc_attr($display_phone); ?>"
                            aria-label="Copier le numéro de téléphone">

                            <svg class="contact-copy-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <rect x="9" y="9" width="10" height="10" rx="2" stroke-width="2" />
                                <path d="M15 9V7a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h2" stroke-width="2" />
                            </svg>

                            <svg class="contact-check-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path d="M5 12l4 4L19 6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>

                        </button>

                    </div>

                <?php } ?>


                <?php if ($store_email) { ?>

                    <div class="contact-item">

                        <span class="contact-icon">
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <rect
                                    x="3"
                                    y="5"
                                    width="18"
                                    height="14"
                                    rx="2"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2" />

                                <path
                                    d="m4 7 8 6 8-6"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linejoin="round" />
                            </svg>
                        </span>

                        <span class="footer-contact-text">
                            <small>E-mail</small>
                            <span><?php echo esc_html($store_email); ?></span>
                        </span>

                        <button
                            type="button"
                            class="footer-copy-button contact-copy-button"
                            data-copy="<?php echo esc_attr($store_email); ?>"
                            aria-label="Copier l'adresse e-mail">

                            <svg class="contact-copy-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <rect x="9" y="9" width="10" height="10" rx="2" stroke-width="2" />
                                <path d="M15 9V7a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h2" stroke-width="2" />
                            </svg>

                            <svg class="contact-check-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path d="M5 12l4 4L19 6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>

                        </button>

                    </div>

                <?php } ?>


                <?php if ($store_location) { ?>

                    <div class="contact-item">

                        <span class="contact-icon">
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <path
                                    d="M12 21s6-5.2 6-11a6 6 0 1 0-12 0c0 5.8 6 11 6 11Z"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2" />

                                <circle
                                    cx="12"
                                    cy="10"
                                    r="2"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2" />
                            </svg>
                        </span>

                        <span>
                            <small>Localisation</small>
                            <?php echo esc_html($store_location); ?>
                        </span>

                    </div>

                <?php } ?>

            </div>

        </div>
    </div>


    <!-- Bottom -->
    <div class="footer-bottom">

        <div class="footer-bottom-container">

            <p>
                © <?php echo esc_html(date('Y')); ?> <?php echo esc_html(get_bloginfo('name')); ?>.
                Tous droits réservés.
            </p>

            <div class="footer-bottom-links">
                <?php

                $privacy_page = get_page_by_path('privacy-policy');

                if ($privacy_page) {
                ?>

                    <a href="<?php echo esc_url(get_permalink($privacy_page->ID)); ?>">
                        Politique de confidentialité
                    </a>

                <?php
                }

                ?>
                <?php

                $terms_page = get_page_by_path('terms-conditions');

                if ($terms_page) {
                ?>

                    <a href="<?php echo esc_url(get_permalink($terms_page->ID)); ?>">
                        Conditions générales
                    </a>

                <?php
                }

                ?>
            </div>

        </div>

    </div>

</footer>

<div class="developer-credit">
    <span>
        Créé par
        <a href="https://www.instagram.com/mouad_aiche/" target="_blank" rel="noopener noreferrer">
            Mouad
        </a>
    </span>
</div>

<?php wp_footer(); ?>

</body>

</html>
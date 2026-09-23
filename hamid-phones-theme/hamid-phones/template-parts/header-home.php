<header class="site-header" id="siteHeader">
    <div class="header-container">

        <!-- Logo -->
        <a href="<?php echo esc_url(home_url('/')); ?>"
            class="header-logo"
            aria-label="Accueil">

            <img
                src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/logo.png'); ?>"
                alt="Logo Hamid Phones">

        </a>

        <!-- Desktop Navigation -->
        <nav class="desktop-nav" aria-label="Navigation principale">

            <a href="<?php echo esc_url(home_url('/#home')); ?>">
                Accueil
            </a>

            <a href="<?php echo esc_url(home_url('/#brands')); ?>">
                Marques
            </a>

            <a href="<?php echo esc_url(home_url('/#products')); ?>">
                Produits
            </a>

            <a href="<?php echo esc_url(home_url('/#about')); ?>">
                À propos
            </a>

            <a href="<?php echo esc_url(home_url('/#contact')); ?>">
                Contact
            </a>

        </nav>

        <!-- Desktop Search -->
        <div class="desktop-search search-wrapper">

            <form
                class="search-box"
                role="search"
                method="get"
                action="<?php echo esc_url(home_url('/')); ?>">

                <input
                    type="search"
                    name="s"
                    class="search-input"
                    placeholder="Rechercher des produits..."
                    autocomplete="off"
                    aria-label="Rechercher">

                <input type="hidden" name="post_type" value="product">

                <button type="submit" class="search-submit">
                    Rechercher
                </button>

            </form>

            <div class="search-dropdown">

                <a href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>"
                    class="see-results">
                    Voir tous les produits

                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M5 12h14M13 6l6 6-6 6" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </a>

            </div>

        </div>

        <!-- Header Actions -->
        <div class="header-actions">

            <!-- Mobile Search Button -->
            <button class="icon-button mobile-search-button" type="button" aria-label="Ouvrir la recherche"
                aria-expanded="false">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <circle cx="11" cy="11" r="7" fill="none" stroke="currentColor" stroke-width="2" />

                    <path d="M20 20l-4-4" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" />
                </svg>
            </button>

            <!-- Dark Mode -->
            <button class="icon-button theme-toggle" type="button" aria-label="Changer le thème">

                <!-- Moon -->
                <svg class="moon-icon" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M20.5 15.4A8.5 8.5 0 0 1 8.6 3.5 9 9 0 1 0 20.5 15.4Z" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linejoin="round" />
                </svg>

                <!-- Sun -->
                <svg class="sun-icon" viewBox="0 0 24 24" aria-hidden="true">
                    <circle cx="12" cy="12" r="4" fill="none" stroke="currentColor" stroke-width="2" />

                    <path
                        d="M12 2v2M12 20v2M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41M2 12h2M20 12h2M4.93 19.07l1.41-1.41M17.66 6.34l1.41-1.41"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                </svg>

            </button>

            <!-- Mobile Menu Button -->
            <button class="hamburger-button" type="button" aria-label="Ouvrir la navigation" aria-expanded="false">
                <span></span>
                <span></span>
                <span></span>
            </button>

        </div>

    </div>


    <!-- Mobile Search -->
    <div class="mobile-panel mobile-search-panel">

        <div class="mobile-search-inner search-wrapper">

            <form
                class="search-box"
                role="search"
                method="get"
                action="<?php echo esc_url(home_url('/')); ?>">

                <input
                    type="search"
                    name="s"
                    class="search-input"
                    placeholder="Rechercher des produits..."
                    autocomplete="off"
                    aria-label="Rechercher">

                <input type="hidden" name="post_type" value="product">

                <button type="submit" class="search-submit">
                    Rechercher
                </button>

            </form>


            <!-- MOBILE SEARCH RESULTS -->
            <div class="search-dropdown">

                <a href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>"
                    class="see-results">
                    Voir tous les produits

                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M5 12h14M13 6l6 6-6 6" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </a>

            </div>

        </div>

    </div>


    <!-- Mobile Navigation -->
    <div class="mobile-panel mobile-nav-panel">

        <nav class="mobile-nav" aria-label="Navigation mobile">

            <a href="<?php echo esc_url(home_url('/#home')); ?>">
                <span>Accueil</span>
                <span>01</span>
            </a>

            <a href="<?php echo esc_url(home_url('/#brands')); ?>">
                <span>Marques</span>
                <span>02</span>
            </a>

            <a href="<?php echo esc_url(home_url('/#products')); ?>">
                <span>Produits</span>
                <span>03</span>
            </a>

            <a href="<?php echo esc_url(home_url('/#about')); ?>">
                <span>À propos</span>
                <span>04</span>
            </a>

            <a href="<?php echo esc_url(home_url('/#contact')); ?>">
                <span>Contact</span>
                <span>05</span>
            </a>

        </nav>

    </div>

</header>
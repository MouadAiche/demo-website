<header class="secondary-header" id="secondaryHeader">

    <div class="secondary-header__container">

        <!-- LEFT -->
        <div class="secondary-header__left">

            <button class="secondary-header__back" type="button" aria-label="Retour">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path d="M19 12H5M11 18l-6-6 6-6" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </button>



        </div>


        <!-- CENTER LOGO -->
        <a
            href="<?php echo esc_url(home_url('/')); ?>"
            class="secondary-header__logo"
            aria-label="Accueil">

            <img
                src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/logo.png'); ?>"
                alt="Logo Hamid Phones">

        </a>


        <!-- RIGHT -->
        <div class="secondary-header__right">

            <!-- DESKTOP SEARCH -->
            <div class="secondary-search secondary-search--desktop">

                <form
                    class="secondary-search__box"
                    role="search"
                    method="get"
                    action="<?php echo esc_url(home_url('/')); ?>">

                    <input
                        type="search"
                        name="s"
                        class="secondary-search__input"
                        placeholder="Rechercher des produits..."
                        autocomplete="off"
                        aria-label="Rechercher">

                    <input
                        type="hidden"
                        name="post_type"
                        value="product">

                    <button
                        type="submit"
                        class="secondary-search__submit">
                        Rechercher
                    </button>

                </form>


                <div class="secondary-search__dropdown">

                </div>

            </div>


            <!-- MOBILE SEARCH BUTTON -->
            <button class="secondary-header__mobile-search-button" type="button" aria-label="Ouvrir la recherche"
                aria-expanded="false">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <circle cx="11" cy="11" r="7" stroke-width="2" />

                    <path d="M20 20l-4-4" stroke-width="2" stroke-linecap="round" />
                </svg>
            </button>


            <button class="secondary-header__theme-toggle" type="button" aria-label="Changer le thème">
                <svg class="secondary-header__moon-icon" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M20.5 15.4A8.5 8.5 0 0 1 8.6 3.5 9 9 0 1 0 20.5 15.4Z" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linejoin="round" />
                </svg>

                <svg class="secondary-header__sun-icon" viewBox="0 0 24 24" aria-hidden="true">
                    <circle cx="12" cy="12" r="4" fill="none" stroke="currentColor" stroke-width="2" />

                    <path
                        d="M12 2v2M12 20v2M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41M2 12h2M20 12h2M4.93 19.07l1.41-1.41M17.66 6.34l1.41-1.41"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                </svg>
            </button>

        </div>

    </div>


    <!-- MOBILE SEARCH -->
    <div class="secondary-mobile-search-panel">

        <div class="secondary-mobile-search secondary-search">

            <form
                class="secondary-search__box"
                role="search"
                method="get"
                action="<?php echo esc_url(home_url('/')); ?>">

                <input
                    type="search"
                    name="s"
                    class="secondary-search__input"
                    placeholder="Rechercher des produits..."
                    autocomplete="off"
                    aria-label="Rechercher">

                <input
                    type="hidden"
                    name="post_type"
                    value="product">

                <button
                    type="submit"
                    class="secondary-search__submit">
                    Rechercher
                </button>

            </form>


            <div class="secondary-search__dropdown">

            </div>

        </div>

    </div>

</header>
<header class="site-header" id="siteHeader">
        <div class="header-container">

            <!-- Logo -->
            <a href="#" class="header-logo" aria-label="Home">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png" alt="Phone Store Logo">
            </a>

            <!-- Desktop Navigation -->
            <nav class="desktop-nav" aria-label="Main navigation">
                <a href="#home">Home</a>
                <a href="#brands">Brands</a>
                <a href="#products">Products</a>
                <a href="#about">About</a>
                <a href="#contact">Contact</a>
            </nav>

            <!-- Desktop Search -->
            <div class="desktop-search search-wrapper">

                <div class="search-box">
                    <input type="search" class="search-input" placeholder="Search products..." autocomplete="off"
                        aria-label="Search products">

                    <a href="products-listing/index.html" class="search-submit">
                        Search
                    </a>
                </div>

                <div class="search-dropdown">

                    <!-- Product 1 -->
                    <a href="single/index.html" class="search-product">

                        <div class="product-image">
                            <img src="https://images.unsplash.com/photo-1592750475338-74b7b21085ab?auto=format&fit=crop&w=700&q=85"
                                alt="iPhone 15 Pro" loading="lazy">
                        </div>

                        <div class="product-info">
                            <span class="product-category">Apple</span>
                            <strong>iPhone 15 Pro</strong>
                            <span class="product-price">12,499 DH</span>
                        </div>

                        <span class="search-product-arrow" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 12h14M13 6l6 6-6 6" />
                            </svg>
                        </span>

                    </a>

                    <!-- Product 2 -->
                    <a href="single/index.html" class="search-product">

                        <div class="product-image">
                            <img src="https://images.unsplash.com/photo-1610945265064-0e34e5519bbf?auto=format&fit=crop&w=700&q=85"
                                alt="Galaxy S24 Ultra" loading="lazy">
                        </div>

                        <div class="product-info">
                            <span class="product-category">Samsung</span>
                            <strong>Galaxy S24 Ultra</strong>
                            <span class="product-price">11,999 DH</span>
                        </div>

                        <span class="search-product-arrow" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 12h14M13 6l6 6-6 6" />
                            </svg>
                        </span>

                    </a>

                    <!-- Product 3 -->
                    <a href="single/index.html" class="search-product">

                        <div class="product-image">
                            <img src="https://images.unsplash.com/photo-1598327105666-5b89351aff97?auto=format&fit=crop&w=700&q=85"
                                alt="Xiaomi 14" loading="lazy">
                        </div>

                        <div class="product-info">
                            <span class="product-category">Xiaomi</span>
                            <strong>Xiaomi 14</strong>
                            <span class="product-price">7,499 DH</span>
                        </div>

                        <span class="search-product-arrow" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 12h14M13 6l6 6-6 6" />
                            </svg>
                        </span>

                    </a>

                    <!-- Product 4 -->
                    <a href="single/index.html" class="search-product">

                        <div class="product-image">
                            <img src="https://images.unsplash.com/photo-1592899677977-9c10ca588bbd?auto=format&fit=crop&w=700&q=85"
                                alt="Google Pixel 9 Pro" loading="lazy">
                        </div>

                        <div class="product-info">
                            <span class="product-category">Google</span>
                            <strong>Google Pixel 9 Pro</strong>
                            <span class="product-price">9,499 DH</span>
                        </div>

                        <span class="search-product-arrow" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 12h14M13 6l6 6-6 6" />
                            </svg>
                        </span>

                    </a>

                    <a href="products-listing/index.html" class="see-results">
                        See all products

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
                <button class="icon-button mobile-search-button" type="button" aria-label="Open search"
                    aria-expanded="false">
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <circle cx="11" cy="11" r="7" fill="none" stroke="currentColor" stroke-width="2" />

                        <path d="M20 20l-4-4" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" />
                    </svg>
                </button>

                <!-- Dark Mode -->
                <button class="icon-button theme-toggle" type="button" aria-label="Toggle dark mode">

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

                <!-- Language Switcher -->
                <div class="language-wrapper">

                    <button class="language-button" type="button" aria-expanded="false">
                        <span class="current-language">EN</span>

                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <path d="m7 9 5 5 5-5" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>

                    <div class="language-dropdown">

                        <button type="button" data-lang="EN">
                            <span>EN</span>
                            English
                        </button>

                        <button type="button" data-lang="FR">
                            <span>FR</span>
                            Français
                        </button>

                        <button type="button" data-lang="AR">
                            <span>AR</span>
                            العربية
                        </button>

                        <button type="button" data-lang="ES">
                            <span>ES</span>
                            Español
                        </button>

                    </div>

                </div>

                <!-- Mobile Menu Button -->
                <button class="hamburger-button" type="button" aria-label="Open navigation" aria-expanded="false">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>

            </div>

        </div>


        <!-- Mobile Search -->
        <div class="mobile-panel mobile-search-panel">

            <div class="mobile-search-inner search-wrapper">

                <div class="search-box">

                    <input type="search" class="search-input" placeholder="Search products..." autocomplete="off"
                        aria-label="Search products">

                    <a href="products-listing/index.html" class="search-submit">
                        Search
                    </a>

                </div>


                <!-- MOBILE SEARCH RESULTS -->
                <div class="search-dropdown">

                    <!-- Product 1 -->
                    <a href="single/index.html" class="search-product">

                        <div class="product-image">
                            <img src="https://images.unsplash.com/photo-1592750475338-74b7b21085ab?auto=format&fit=crop&w=700&q=85"
                                alt="iPhone 15 Pro" loading="lazy">
                        </div>

                        <div class="product-info">
                            <span class="product-category">Apple</span>
                            <strong>iPhone 15 Pro</strong>
                            <span class="product-price">12,499 DH</span>
                        </div>

                        <span class="search-product-arrow">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 12h14M13 6l6 6-6 6" />
                            </svg>
                        </span>

                    </a>

                    <!-- Product 2 -->
                    <a href="single/index.html" class="search-product">

                        <div class="product-image">
                            <img src="https://images.unsplash.com/photo-1610945265064-0e34e5519bbf?auto=format&fit=crop&w=700&q=85"
                                alt="Galaxy S24 Ultra" loading="lazy">
                        </div>

                        <div class="product-info">
                            <span class="product-category">Samsung</span>
                            <strong>Galaxy S24 Ultra</strong>
                            <span class="product-price">11,999 DH</span>
                        </div>

                        <span class="search-product-arrow">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 12h14M13 6l6 6-6 6" />
                            </svg>
                        </span>

                    </a>

                    <!-- Product 3 -->
                    <a href="single/index.html" class="search-product">

                        <div class="product-image">
                            <img src="https://images.unsplash.com/photo-1598327105666-5b89351aff97?auto=format&fit=crop&w=700&q=85"
                                alt="Xiaomi 14" loading="lazy">
                        </div>

                        <div class="product-info">
                            <span class="product-category">Xiaomi</span>
                            <strong>Xiaomi 14</strong>
                            <span class="product-price">7,499 DH</span>
                        </div>

                        <span class="search-product-arrow">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 12h14M13 6l6 6-6 6" />
                            </svg>
                        </span>

                    </a>

                    <!-- Product 4 -->
                    <a href="single/index.html" class="search-product">

                        <div class="product-image">
                            <img src="https://images.unsplash.com/photo-1592899677977-9c10ca588bbd?auto=format&fit=crop&w=700&q=85"
                                alt="Google Pixel 9 Pro" loading="lazy">
                        </div>

                        <div class="product-info">
                            <span class="product-category">Google</span>
                            <strong>Google Pixel 9 Pro</strong>
                            <span class="product-price">9,499 DH</span>
                        </div>

                        <span class="search-product-arrow">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 12h14M13 6l6 6-6 6" />
                            </svg>
                        </span>

                    </a>

                    <a href="products-listing/index.html" class="see-results">
                        See all products

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

            <nav class="mobile-nav" aria-label="Mobile navigation">

                <a href="#home">
                    <span>Home</span>
                    <span>01</span>
                </a>

                <a href="#brands">
                    <span>Brands</span>
                    <span>02</span>
                </a>

                <a href="#products">
                    <span>Products</span>
                    <span>03</span>
                </a>

                <a href="#about">
                    <span>About</span>
                    <span>04</span>
                </a>

                <a href="#contact">
                    <span>Contact</span>
                    <span>05</span>
                </a>

            </nav>

        </div>

    </header>
<?php get_header(); ?>

<?php get_template_part('template-parts/header-inner'); ?>

<main class="single-product-page">

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

                            <span class="single-product-badge">
                                In Stock
                            </span>

                            <!-- Previous Image -->
                            <button class="single-product-main-arrow single-product-main-arrow--prev" type="button"
                                aria-label="Previous image" id="singleProductPrev">

                                &#10094;

                            </button>

                            <img src="https://images.unsplash.com/photo-1592750475338-74b7b21085ab?auto=format&fit=crop&w=1000&q=90"
                                alt="iPhone 15 Pro" id="singleProductImage">

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

                                <!-- IMAGE 1 -->

                                <button class="single-product-thumbnail active" type="button"
                                    data-image="https://images.unsplash.com/photo-1592750475338-74b7b21085ab?auto=format&fit=crop&w=1000&q=90">

                                    <img src="https://images.unsplash.com/photo-1592750475338-74b7b21085ab?auto=format&fit=crop&w=300&q=80"
                                        alt="iPhone 15 Pro view 1">

                                </button>


                                <!-- IMAGE 2 -->

                                <button class="single-product-thumbnail" type="button"
                                    data-image="https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?auto=format&fit=crop&w=1000&q=90">

                                    <img src="https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?auto=format&fit=crop&w=300&q=80"
                                        alt="iPhone 15 Pro view 2">

                                </button>


                                <!-- IMAGE 3 -->

                                <button class="single-product-thumbnail" type="button"
                                    data-image="https://images.unsplash.com/photo-1580910051074-3eb694886505?auto=format&fit=crop&w=1000&q=90">

                                    <img src="https://images.unsplash.com/photo-1580910051074-3eb694886505?auto=format&fit=crop&w=300&q=80"
                                        alt="iPhone 15 Pro view 3">

                                </button>


                                <!-- IMAGE 4 -->

                                <button class="single-product-thumbnail" type="button"
                                    data-image="https://images.unsplash.com/photo-1605236453806-6ff36851218e?auto=format&fit=crop&w=1000&q=90">

                                    <img src="https://images.unsplash.com/photo-1605236453806-6ff36851218e?auto=format&fit=crop&w=300&q=80"
                                        alt="iPhone 15 Pro view 4">

                                </button>


                                <!-- IMAGE 5 -->

                                <button class="single-product-thumbnail" type="button"
                                    data-image="https://images.unsplash.com/photo-1601784551446-20c9e07cdbdb?auto=format&fit=crop&w=1000&q=90">

                                    <img src="https://images.unsplash.com/photo-1601784551446-20c9e07cdbdb?auto=format&fit=crop&w=300&q=80"
                                        alt="iPhone 15 Pro view 5">

                                </button>


                                <!-- IMAGE 6 -->

                                <button class="single-product-thumbnail" type="button"
                                    data-image="https://images.unsplash.com/photo-1567581935884-3349723552ca?auto=format&fit=crop&w=1000&q=90">

                                    <img src="https://images.unsplash.com/photo-1567581935884-3349723552ca?auto=format&fit=crop&w=300&q=80"
                                        alt="iPhone 15 Pro view 6">

                                </button>

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
                    <a href="../products-listing/index.html" class="single-product-brand">
                        Apple
                    </a>


                    <!-- TITLE -->
                    <h1 class="single-product-title">
                        iPhone 15 Pro
                    </h1>


                    <!-- SHORT DESCRIPTION -->
                    <p class="single-product-intro">
                        Powerful performance, premium titanium design,
                        advanced cameras, and the A17 Pro chip in a compact
                        flagship smartphone.
                    </p>


                    <!-- PRICE -->
                    <div class="single-product-price">

                        <span class="single-product-price__label">
                            Price
                        </span>

                        <strong class="single-product-price__value">
                            12,499 DH
                        </strong>

                    </div>


                    <!-- =========================================
                     COLOR
                ========================================== -->

                    <div class="single-product-option">

                        <div class="single-product-option__header">

                            <span class="single-product-option__title">
                                Color
                            </span>

                            <span class="single-product-option__selected" id="selectedColor">
                                Natural Titanium
                            </span>

                        </div>


                        <div class="single-product-variant-scroll">

                            <button
                                class="single-product-variant-scroll__arrow single-product-variant-scroll__arrow--previous"
                                type="button" aria-label="Previous colors">
                                <svg viewBox="0 0 24 24">
                                    <path d="m15 18-6-6 6-6" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>


                            <div class="single-product-colors single-product-variant-scroll__track" role="radiogroup"
                                aria-label="Choose color">

                                <button class="single-product-color is-selected" type="button"
                                    data-color="Natural Titanium" aria-label="Natural Titanium" aria-pressed="true">
                                    <span style="background:#bbb7ae;"></span>
                                </button>


                                <button class="single-product-color" type="button" data-color="Blue Titanium"
                                    aria-label="Blue Titanium" aria-pressed="false">
                                    <span style="background:#536475;"></span>
                                </button>


                                <button class="single-product-color" type="button" data-color="White Titanium"
                                    aria-label="White Titanium" aria-pressed="false">
                                    <span style="background:#e7e5df;"></span>
                                </button>


                                <button class="single-product-color" type="button" data-color="Black Titanium"
                                    aria-label="Black Titanium" aria-pressed="false">
                                    <span style="background:#30302e;"></span>
                                </button>

                            </div>


                            <button
                                class="single-product-variant-scroll__arrow single-product-variant-scroll__arrow--next"
                                type="button" aria-label="Next colors">
                                <svg viewBox="0 0 24 24">
                                    <path d="m9 18 6-6-6-6" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>

                        </div>

                    </div>


                    <!-- =========================================
                     STORAGE
                ========================================== -->

                    <div class="single-product-option">

                        <div class="single-product-option__header">

                            <span class="single-product-option__title">
                                Storage
                            </span>

                            <span class="single-product-option__selected" id="selectedStorage">
                                256 GB
                            </span>

                        </div>


                        <div class="single-product-variant-scroll">

                            <button
                                class="single-product-variant-scroll__arrow single-product-variant-scroll__arrow--previous"
                                type="button" aria-label="Previous storage options">
                                <svg viewBox="0 0 24 24">
                                    <path d="m15 18-6-6 6-6" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>


                            <div class="single-product-storage single-product-variant-scroll__track">

                                <button class="single-product-storage__button" type="button" data-storage="128 GB">
                                    128 GB
                                </button>

                                <button class="single-product-storage__button is-selected" type="button"
                                    data-storage="256 GB">
                                    256 GB
                                </button>

                                <button class="single-product-storage__button" type="button" data-storage="512 GB">
                                    512 GB
                                </button>

                                <button class="single-product-storage__button" type="button" data-storage="1 TB">
                                    1 TB
                                </button>

                            </div>


                            <button
                                class="single-product-variant-scroll__arrow single-product-variant-scroll__arrow--next"
                                type="button" aria-label="Next storage options">
                                <svg viewBox="0 0 24 24">
                                    <path d="m9 18 6-6-6-6" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>

                        </div>

                    </div>


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


                            <!-- RAM -->
                            <div class="single-product-spec">

                                <span>
                                    RAM
                                </span>

                                <strong>
                                    8 GB
                                </strong>

                            </div>


                            <!-- CAMERA -->
                            <div class="single-product-spec">

                                <span>
                                    Camera
                                </span>

                                <strong>
                                    48 MP
                                </strong>

                            </div>


                            <!-- DISPLAY -->
                            <div class="single-product-spec">

                                <span>
                                    Display
                                </span>

                                <strong>
                                    6.1″
                                </strong>

                            </div>


                            <!-- BATTERY -->
                            <div class="single-product-spec">

                                <span>
                                    Battery
                                </span>

                                <strong>
                                    3274 mAh
                                </strong>

                            </div>


                            <!-- PROCESSOR -->
                            <div class="single-product-spec">

                                <span>
                                    Processor
                                </span>

                                <strong>
                                    A17 Pro
                                </strong>

                            </div>


                            <!-- NETWORK -->
                            <div class="single-product-spec">

                                <span>
                                    Network
                                </span>

                                <strong>
                                    5G
                                </strong>

                            </div>

                        </div>

                    </div>


                    <!-- =========================================
                     ACTION
                ========================================== -->

                    <a href="https://wa.me/" class="single-product-contact-button">
                        Contact Us About This Product

                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path d="M5 12h14M13 6l6 6-6 6" stroke-width="2" stroke-linecap="round"
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
                        More About The iPhone 15 Pro
                    </h2>

                    <p>
                        Everything you need to know about the device,
                        from its display and performance to its cameras,
                        connectivity, and physical design.
                    </p>

                </div>


                <div class="single-product-more__layout">


                    <!-- LEFT -->
                    <div class="single-product-description">

                        <h3>
                            Premium Performance
                        </h3>

                        <p>
                            The iPhone 15 Pro combines a lightweight titanium
                            design with Apple's A17 Pro processor, providing
                            powerful performance for everyday use, photography,
                            gaming, and demanding applications.
                        </p>

                        <p>
                            Its Super Retina XDR display offers rich colors,
                            excellent brightness, and smooth interaction,
                            while the advanced camera system provides flexible
                            photography and video capabilities.
                        </p>

                        <p>
                            With 5G connectivity, USB-C, Face ID, and a durable
                            premium construction, it is designed for users
                            looking for a modern high-end smartphone.
                        </p>

                    </div>


                    <!-- RIGHT SPECIFICATIONS -->
                    <div class="single-product-full-specs">

                        <div class="single-product-full-specs__table">


                            <div class="single-product-full-spec">

                                <span>
                                    Brand
                                </span>

                                <strong>
                                    Apple
                                </strong>

                            </div>


                            <div class="single-product-full-spec">

                                <span>
                                    Model
                                </span>

                                <strong>
                                    iPhone 15 Pro
                                </strong>

                            </div>


                            <div class="single-product-full-spec">

                                <span>
                                    Display
                                </span>

                                <strong>
                                    6.1″ Super Retina XDR OLED
                                </strong>

                            </div>


                            <div class="single-product-full-spec">

                                <span>
                                    Refresh Rate
                                </span>

                                <strong>
                                    120 Hz ProMotion
                                </strong>

                            </div>


                            <div class="single-product-full-spec">

                                <span>
                                    Processor
                                </span>

                                <strong>
                                    Apple A17 Pro
                                </strong>

                            </div>


                            <div class="single-product-full-spec">

                                <span>
                                    RAM
                                </span>

                                <strong>
                                    8 GB
                                </strong>

                            </div>


                            <div class="single-product-full-spec">

                                <span>
                                    Rear Camera
                                </span>

                                <strong>
                                    48 MP + 12 MP + 12 MP
                                </strong>

                            </div>


                            <div class="single-product-full-spec">

                                <span>
                                    Front Camera
                                </span>

                                <strong>
                                    12 MP
                                </strong>

                            </div>


                            <div class="single-product-full-spec">

                                <span>
                                    Battery
                                </span>

                                <strong>
                                    3274 mAh
                                </strong>

                            </div>


                            <div class="single-product-full-spec">

                                <span>
                                    Charging
                                </span>

                                <strong>
                                    USB-C / MagSafe
                                </strong>

                            </div>


                            <div class="single-product-full-spec">

                                <span>
                                    Connectivity
                                </span>

                                <strong>
                                    5G / Wi-Fi 6E / Bluetooth 5.3
                                </strong>

                            </div>


                            <div class="single-product-full-spec">

                                <span>
                                    Operating System
                                </span>

                                <strong>
                                    iOS
                                </strong>

                            </div>


                        </div>

                    </div>

                </div>

            </div>

        </section>

        <!-- #region RELATED PRODUCTS -->

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


                    <!-- PRODUCT 1 -->
                    <article class="product-card">

                        <a href="index.html" class="product-card__image">

                            <span class="product-card__badge">
                                Related
                            </span>

                            <img src="https://images.unsplash.com/photo-1592750475338-74b7b21085ab?auto=format&fit=crop&w=700&q=85"
                                alt="Smartphone" loading="lazy">

                        </a>


                        <div class="product-card__content">

                            <span class="product-card__category">
                                Apple
                            </span>

                            <h3>
                                <a href="index.html">
                                    iPhone 15 Pro
                                </a>
                            </h3>

                            <div class="product-card__bottom">

                                <div class="product-card__price">

                                    <span>
                                        Price
                                    </span>

                                    <strong>
                                        12,499 DH
                                    </strong>

                                </div>


                                <a href="index.html" class="product-card__button" aria-label="View iPhone 15 Pro">

                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 12h14M13 6l6 6-6 6" />
                                    </svg>

                                </a>

                            </div>

                        </div>

                    </article>


                    <!-- PRODUCT 2 -->
                    <article class="product-card">

                        <a href="index.html" class="product-card__image">

                            <span class="product-card__badge">
                                Related
                            </span>

                            <img src="https://images.unsplash.com/photo-1610945265064-0e34e5519bbf?auto=format&fit=crop&w=700&q=85"
                                alt="Samsung smartphone" loading="lazy">

                        </a>


                        <div class="product-card__content">

                            <span class="product-card__category">
                                Samsung
                            </span>

                            <h3>
                                <a href="index.html">
                                    Galaxy S24 Ultra
                                </a>
                            </h3>

                            <div class="product-card__bottom">

                                <div class="product-card__price">

                                    <span>
                                        Price
                                    </span>

                                    <strong>
                                        11,999 DH
                                    </strong>

                                </div>


                                <a href="index.html" class="product-card__button" aria-label="View Galaxy S24 Ultra">

                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 12h14M13 6l6 6-6 6" />
                                    </svg>

                                </a>

                            </div>

                        </div>

                    </article>


                    <!-- PRODUCT 3 -->
                    <article class="product-card">

                        <a href="index.html" class="product-card__image">

                            <span class="product-card__badge">
                                Related
                            </span>

                            <img src="https://images.unsplash.com/photo-1598327105666-5b89351aff97?auto=format&fit=crop&w=700&q=85"
                                alt="Smartphone" loading="lazy">

                        </a>


                        <div class="product-card__content">

                            <span class="product-card__category">
                                Xiaomi
                            </span>

                            <h3>
                                <a href="index.html">
                                    Xiaomi 14
                                </a>
                            </h3>

                            <div class="product-card__bottom">

                                <div class="product-card__price">

                                    <span>
                                        Price
                                    </span>

                                    <strong>
                                        7,499 DH
                                    </strong>

                                </div>


                                <a href="index.html" class="product-card__button" aria-label="View Xiaomi 14">

                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 12h14M13 6l6 6-6 6" />
                                    </svg>

                                </a>

                            </div>

                        </div>

                    </article>


                    <!-- PRODUCT 4 -->
                    <article class="product-card">

                        <a href="index.html" class="product-card__image">

                            <span class="product-card__badge">
                                Related
                            </span>

                            <img src="https://images.unsplash.com/photo-1592899677977-9c10ca588bbd?auto=format&fit=crop&w=700&q=85"
                                alt="Smartphone" loading="lazy">

                        </a>


                        <div class="product-card__content">

                            <span class="product-card__category">
                                Google
                            </span>

                            <h3>
                                <a href="index.html">
                                    Google Pixel 9 Pro
                                </a>
                            </h3>

                            <div class="product-card__bottom">

                                <div class="product-card__price">

                                    <span>
                                        Price
                                    </span>

                                    <strong>
                                        9,499 DH
                                    </strong>

                                </div>


                                <a href="index.html" class="product-card__button" aria-label="View Google Pixel 9 Pro">

                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 12h14M13 6l6 6-6 6" />
                                    </svg>

                                </a>

                            </div>

                        </div>

                    </article>

                </div>


                <!-- VIEW ALL -->
                <div class="featured-products__footer">

                    <a href="../products-listing/index.html" class="featured-products__button">
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
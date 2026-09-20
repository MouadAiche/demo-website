// #region DARK MODE

const html = document.documentElement;

function applySavedTheme() {

    const savedTheme =
        localStorage.getItem("theme");

    if (savedTheme === "dark") {
        html.setAttribute(
            "data-theme",
            "dark"
        );
    } else {
        html.removeAttribute(
            "data-theme"
        );
    }
}


/* Apply theme when page first loads */
applySavedTheme();


document.addEventListener(
    "DOMContentLoaded",
    () => {

        const themeButtons =
            document.querySelectorAll(
                ".theme-toggle, .secondary-header__theme-toggle"
            );

        themeButtons.forEach(
            (button) => {

                button.addEventListener(
                    "click",
                    () => {

                        const isDark =
                            html.getAttribute(
                                "data-theme"
                            ) === "dark";

                        if (isDark) {

                            html.removeAttribute(
                                "data-theme"
                            );

                            localStorage.setItem(
                                "theme",
                                "light"
                            );

                        } else {

                            html.setAttribute(
                                "data-theme",
                                "dark"
                            );

                            localStorage.setItem(
                                "theme",
                                "dark"
                            );

                        }

                    }
                );

            }
        );

    }
);


/* Re-apply theme when returning with browser back/history */
window.addEventListener(
    "pageshow",
    () => {

        applySavedTheme();

    }
);

// #endregion


// #region HEADER

document.addEventListener("DOMContentLoaded", () => {

    /* =====================================================
       ELEMENTS
    ===================================================== */

    const languageWrapper = document.querySelector(".language-wrapper");
    const languageButton = document.querySelector(".language-button");
    const currentLanguage = document.querySelector(".current-language");
    const languageOptions = document.querySelectorAll(
        ".language-dropdown button"
    );

    const hamburgerButton = document.querySelector(".hamburger-button");
    const mobileNavPanel = document.querySelector(".mobile-nav-panel");

    const mobileSearchButton = document.querySelector(
        ".mobile-search-button"
    );
    const mobileSearchPanel = document.querySelector(
        ".mobile-search-panel"
    );

    const searchWrappers = document.querySelectorAll(".search-wrapper");


    /* =====================================================
       LANGUAGE DROPDOWN
    ===================================================== */

    languageButton.addEventListener("click", (event) => {
        event.stopPropagation();

        const isOpen =
            languageWrapper.classList.contains("language-open");

        closeAllPanels();

        if (!isOpen) {
            languageWrapper.classList.add("language-open");
            languageButton.setAttribute(
                "aria-expanded",
                "true"
            );
        }
    });


    languageOptions.forEach((option) => {

        option.addEventListener("click", () => {

            const selectedLanguage =
                option.dataset.lang;

            currentLanguage.textContent =
                selectedLanguage;

            languageWrapper.classList.remove(
                "language-open"
            );

            languageButton.setAttribute(
                "aria-expanded",
                "false"
            );

            localStorage.setItem(
                "selectedLanguage",
                selectedLanguage
            );
        });

    });


    const savedLanguage =
        localStorage.getItem("selectedLanguage");

    if (savedLanguage) {
        currentLanguage.textContent =
            savedLanguage;
    }


    /* =====================================================
       MOBILE NAVIGATION
    ===================================================== */

    hamburgerButton.addEventListener("click", (event) => {
        event.stopPropagation();

        const isOpen =
            mobileNavPanel.classList.contains(
                "panel-open"
            );

        closeAllPanels();

        if (!isOpen) {

            mobileNavPanel.classList.add(
                "panel-open"
            );

            hamburgerButton.classList.add(
                "menu-active"
            );

            hamburgerButton.setAttribute(
                "aria-expanded",
                "true"
            );
        }
    });


    /* =====================================================
       MOBILE SEARCH PANEL
    ===================================================== */

    mobileSearchButton.addEventListener(
        "click",
        (event) => {

            event.stopPropagation();

            const isOpen =
                mobileSearchPanel.classList.contains(
                    "panel-open"
                );

            closeAllPanels();

            if (!isOpen) {

                mobileSearchPanel.classList.add(
                    "panel-open"
                );

                mobileSearchButton.setAttribute(
                    "aria-expanded",
                    "true"
                );

                const input =
                    mobileSearchPanel.querySelector(
                        ".search-input"
                    );

                setTimeout(() => {
                    input.focus();
                }, 120);
            }
        }
    );


    /* =====================================================
       SEARCH DROPDOWNS
    ===================================================== */

    searchWrappers.forEach((wrapper) => {

        const input =
            wrapper.querySelector(".search-input");

        input.addEventListener("focus", () => {

            closeSearchDropdowns(wrapper);

            wrapper.classList.add(
                "search-active"
            );
        });


        input.addEventListener("input", () => {

            wrapper.classList.add(
                "search-active"
            );
        });

        wrapper.addEventListener(
            "click",
            (event) => {

                event.stopPropagation();

            }
        );

    });

    /* =====================================================
       CLOSE SEARCH DROPDOWNS
    ===================================================== */

    function closeSearchDropdowns(
        exception = null
    ) {

        searchWrappers.forEach((wrapper) => {

            if (wrapper !== exception) {
                wrapper.classList.remove(
                    "search-active"
                );
            }

        });
    }


    /* =====================================================
       CLOSE EVERYTHING
    ===================================================== */

    function closeAllPanels() {

        languageWrapper.classList.remove(
            "language-open"
        );

        languageButton.setAttribute(
            "aria-expanded",
            "false"
        );


        mobileNavPanel.classList.remove(
            "panel-open"
        );

        hamburgerButton.classList.remove(
            "menu-active"
        );

        hamburgerButton.setAttribute(
            "aria-expanded",
            "false"
        );


        mobileSearchPanel.classList.remove(
            "panel-open"
        );

        mobileSearchButton.setAttribute(
            "aria-expanded",
            "false"
        );


        closeSearchDropdowns();
    }


    /* =====================================================
       CLICK OUTSIDE
    ===================================================== */

    document.addEventListener(
        "click",
        (event) => {

            if (
                !event.target.closest(
                    ".site-header"
                )
            ) {
                closeAllPanels();
                return;
            }


            if (
                !event.target.closest(
                    ".language-wrapper"
                )
            ) {
                languageWrapper.classList.remove(
                    "language-open"
                );

                languageButton.setAttribute(
                    "aria-expanded",
                    "false"
                );
            }


            if (
                !event.target.closest(
                    ".search-wrapper"
                )
            ) {
                closeSearchDropdowns();
            }
        }
    );


    /* =====================================================
       ESCAPE KEY
    ===================================================== */

    document.addEventListener(
        "keydown",
        (event) => {

            if (event.key === "Escape") {
                closeAllPanels();
            }

        }
    );


    /* =====================================================
       MOBILE NAV LINKS
    ===================================================== */

    document
        .querySelectorAll(".mobile-nav a")
        .forEach((link) => {

            link.addEventListener(
                "click",
                () => {

                    mobileNavPanel.classList.remove(
                        "panel-open"
                    );

                    hamburgerButton.classList.remove(
                        "menu-active"
                    );

                    hamburgerButton.setAttribute(
                        "aria-expanded",
                        "false"
                    );
                }
            );

        });


    /* =====================================================
       RESET MOBILE PANELS WHEN RESIZING
    ===================================================== */

    window.addEventListener(
        "resize",
        () => {

            if (window.innerWidth > 900) {

                mobileNavPanel.classList.remove(
                    "panel-open"
                );

                mobileSearchPanel.classList.remove(
                    "panel-open"
                );

                hamburgerButton.classList.remove(
                    "menu-active"
                );

                hamburgerButton.setAttribute(
                    "aria-expanded",
                    "false"
                );

                mobileSearchButton.setAttribute(
                    "aria-expanded",
                    "false"
                );
            }

        }
    );

});

// #endregion


// #region SECONDARY HEADER

document.addEventListener("DOMContentLoaded", () => {

    const secondaryHeader =
        document.querySelector(".secondary-header");

    if (!secondaryHeader) return;


    const backButton =
        secondaryHeader.querySelector(
            ".secondary-header__back"
        );

    const language =
        secondaryHeader.querySelector(
            ".secondary-language"
        );

    const languageButton =
        secondaryHeader.querySelector(
            ".secondary-language__button"
        );

    const currentLanguage =
        secondaryHeader.querySelector(
            ".secondary-language__current"
        );

    const languageOptions =
        secondaryHeader.querySelectorAll(
            ".secondary-language__dropdown button"
        );

    const mobileSearchButton =
        secondaryHeader.querySelector(
            ".secondary-header__mobile-search-button"
        );

    const mobileSearchPanel =
        secondaryHeader.querySelector(
            ".secondary-mobile-search-panel"
        );

    const searches =
        secondaryHeader.querySelectorAll(
            ".secondary-search, .secondary-mobile-search"
        );


    /* =====================================================
       BACK
    ===================================================== */

    backButton.addEventListener(
        "click",
        () => {
            window.history.back();
        }
    );


    /* =====================================================
       LANGUAGE
    ===================================================== */

    const savedLanguage =
        localStorage.getItem(
            "selectedLanguage"
        );

    if (savedLanguage) {
        currentLanguage.textContent =
            savedLanguage;
    }


    languageButton.addEventListener(
        "click",
        (event) => {

            event.stopPropagation();

            const open =
                language.classList.contains(
                    "secondary-language--open"
                );

            closeSecondaryPanels();

            if (!open) {

                language.classList.add(
                    "secondary-language--open"
                );

                languageButton.setAttribute(
                    "aria-expanded",
                    "true"
                );
            }

        }
    );


    languageOptions.forEach(
        (option) => {

            option.addEventListener(
                "click",
                () => {

                    const selected =
                        option.dataset.lang;

                    currentLanguage.textContent =
                        selected;

                    localStorage.setItem(
                        "selectedLanguage",
                        selected
                    );

                    language.classList.remove(
                        "secondary-language--open"
                    );

                    languageButton.setAttribute(
                        "aria-expanded",
                        "false"
                    );

                }
            );

        }
    );


    /* =====================================================
       MOBILE SEARCH
    ===================================================== */

    mobileSearchButton.addEventListener(
        "click",
        (event) => {

            event.stopPropagation();

            const open =
                mobileSearchPanel.classList.contains(
                    "secondary-mobile-search-panel--open"
                );

            closeSecondaryPanels();

            if (!open) {

                mobileSearchPanel.classList.add(
                    "secondary-mobile-search-panel--open"
                );

                mobileSearchButton.setAttribute(
                    "aria-expanded",
                    "true"
                );

                const input =
                    mobileSearchPanel.querySelector(
                        ".secondary-search__input"
                    );

                setTimeout(
                    () => input.focus(),
                    120
                );
            }

        }
    );


    /* =====================================================
       SEARCHES
    ===================================================== */

    searches.forEach(
        (search) => {

            const input =
                search.querySelector(
                    ".secondary-search__input"
                );

            input.addEventListener(
                "focus",
                () => {

                    closeSecondarySearch(
                        search
                    );

                    search.classList.add(
                        "secondary-search--active"
                    );

                }
            );


            input.addEventListener(
                "input",
                () => {

                    search.classList.add(
                        "secondary-search--active"
                    );

                }
            );

            search.addEventListener(
                "click",
                (event) => {
                    event.stopPropagation();
                }
            );

        }
    );

    /* =====================================================
       CLOSE SEARCH
    ===================================================== */

    function closeSecondarySearch(
        exception = null
    ) {

        searches.forEach(
            (search) => {

                if (search !== exception) {

                    search.classList.remove(
                        "secondary-search--active"
                    );
                }

            }
        );
    }


    /* =====================================================
       CLOSE PANELS
    ===================================================== */

    function closeSecondaryPanels() {

        language.classList.remove(
            "secondary-language--open"
        );

        languageButton.setAttribute(
            "aria-expanded",
            "false"
        );


        mobileSearchPanel.classList.remove(
            "secondary-mobile-search-panel--open"
        );

        mobileSearchButton.setAttribute(
            "aria-expanded",
            "false"
        );


        closeSecondarySearch();
    }


    /* =====================================================
       OUTSIDE CLICK
    ===================================================== */

    document.addEventListener(
        "click",
        (event) => {

            if (
                !event.target.closest(
                    ".secondary-language"
                )
            ) {

                language.classList.remove(
                    "secondary-language--open"
                );

                languageButton.setAttribute(
                    "aria-expanded",
                    "false"
                );
            }


            if (
                !event.target.closest(
                    ".secondary-search"
                )
                &&
                !event.target.closest(
                    ".secondary-mobile-search"
                )
            ) {

                closeSecondarySearch();
            }

        }
    );


    /* =====================================================
       ESCAPE
    ===================================================== */

    document.addEventListener(
        "keydown",
        (event) => {

            if (event.key === "Escape") {
                closeSecondaryPanels();
            }

        }
    );


    /* =====================================================
       RESIZE
    ===================================================== */

    window.addEventListener(
        "resize",
        () => {

            if (window.innerWidth > 900) {

                mobileSearchPanel.classList.remove(
                    "secondary-mobile-search-panel--open"
                );

                mobileSearchButton.setAttribute(
                    "aria-expanded",
                    "false"
                );
            }

        }
    );

});

// #endregion

// #region HERO

document.addEventListener("DOMContentLoaded", () => {

    const hero =
        document.querySelector(".hero");

    const scrollButton =
        document.querySelector(".hero__scroll");


    /* =====================================================
       SCROLL DOWN
    ===================================================== */

    if (hero && scrollButton) {

        scrollButton.addEventListener(
            "click",
            () => {

                const nextSection =
                    hero.nextElementSibling;


                if (nextSection) {

                    nextSection.scrollIntoView({
                        behavior: "smooth",
                        block: "start"
                    });

                    return;
                }


                window.scrollTo({
                    top:
                        hero.offsetTop +
                        hero.offsetHeight,

                    behavior: "smooth"
                });

            }
        );

    }

});

//  #endregion

// #region SINGLE PRODUCT

document.addEventListener("DOMContentLoaded", () => {

    const singleProduct =
        document.querySelector(".single-product-page");

    if (!singleProduct) return;

    /* =====================================================
   WOOCOMMERCE VARIATIONS
===================================================== */

    const variationsDataElement =
        document.getElementById("productVariationsData");

    let productVariations = [];

    if (variationsDataElement) {

        try {
            productVariations =
                JSON.parse(variationsDataElement.textContent);
        } catch (error) {
            console.error(
                "Could not load product variations.",
                error
            );
        }

    }

    /* =====================================================
   FIND SELECTED VARIATION
===================================================== */

    function findSelectedVariation() {

        const selectedStorageButton =
            singleProduct.querySelector(
                ".single-product-storage__button.is-selected"
            );

        const selectedColorButton =
            singleProduct.querySelector(
                ".single-product-color.is-selected"
            );


        const storage = selectedStorageButton
            ? selectedStorageButton.dataset.storage
            : null;

        const color = selectedColorButton
            ? selectedColorButton.dataset.color
            : null;


        return productVariations.find((variation) => {

            const variationStorage =
                variation.attributes.attribute_pa_storage;

            const variationColor =
                variation.attributes.attribute_pa_color;


            const storageMatches =
                !storage ||
                !variationStorage ||
                variationStorage ===
                storage.toLowerCase().replace(/\s+/g, "-");

            const colorMatches =
                !color ||
                !variationColor ||
                variationColor ===
                color.toLowerCase().replace(/\s+/g, "-");


            return storageMatches && colorMatches;

        });

    }

    /* =====================================================
   UPDATE VARIATION PRICE
===================================================== */

    const singleProductPrice =
        singleProduct.querySelector("#singleProductPrice");


    function updateVariationPrice() {

        if (!singleProductPrice) return;

        const variation = findSelectedVariation();

        if (!variation) return;

        singleProductPrice.innerHTML =
            variation.price_html;

    }

    /* =====================================================
   UPDATE VARIATION STOCK
===================================================== */

    const singleProductStock =
        singleProduct.querySelector("#singleProductStock");


    function updateVariationStock() {

        if (!singleProductStock) return;

        const variation = findSelectedVariation();

        if (!variation) return;


        if (variation.is_in_stock) {

            singleProductStock.textContent = "In Stock";

            singleProductStock.classList.remove(
                "single-product-badge--out"
            );

        } else {

            singleProductStock.textContent = "Out of Stock";

            singleProductStock.classList.add(
                "single-product-badge--out"
            );

        }

    }

    /* =====================================================
   UPDATE VARIATION IMAGE
===================================================== */

    function updateVariationImage() {

        const variation = findSelectedVariation();

        if (!variation) return;

        if (
            !variation.image ||
            !variation.image.full_src
        ) {
            return;
        }


        const variationImage =
            variation.image.full_src;


        // Update main image
        mainImage.src = variationImage;


        // Find matching thumbnail
        const matchingThumbnail =
            thumbnails.find((thumbnail) =>
                thumbnail.dataset.image === variationImage
            );


        // Remove active state from all thumbnails
        thumbnails.forEach((thumbnail) => {
            thumbnail.classList.remove("active");
        });


        // Activate matching thumbnail if it exists
        if (matchingThumbnail) {

            matchingThumbnail.classList.add("active");

            matchingThumbnail.scrollIntoView({
                behavior: "smooth",
                block: "nearest",
                inline: "center"
            });

        }

    }

    /* =====================================================
   UPDATE WHATSAPP MESSAGE
===================================================== */

    const singleProductContactButton =
        singleProduct.querySelector("#singleProductContactButton");

    function updateWhatsAppMessage() {

        if (!singleProductContactButton) return;

        const selectedStorageButton =
            singleProduct.querySelector(
                ".single-product-storage__button.is-selected"
            );

        const selectedColorButton =
            singleProduct.querySelector(
                ".single-product-color.is-selected"
            );

        const storage = selectedStorageButton
            ? selectedStorageButton.dataset.storage
            : null;

        const color = selectedColorButton
            ? selectedColorButton.dataset.color
            : null;

        const productName =
            document.querySelector(".single-product-title")
                ?.textContent.trim();


        let message =
            `Hello, I am interested in ${productName}`;


        if (storage) {
            message += `\nStorage: ${storage}`;
        }


        if (color) {
            message += `\nColor: ${color}`;
        }


        singleProductContactButton.href =
            `https://wa.me/212680449271?text=${encodeURIComponent(message)}`;

    }

    /* =====================================================
       COLOR
    ===================================================== */

    const colorButtons =
        singleProduct.querySelectorAll(
            ".single-product-color"
        );

    const selectedColor =
        singleProduct.querySelector(
            "#selectedColor"
        );


    colorButtons.forEach((button) => {

        button.addEventListener("click", () => {

            colorButtons.forEach((item) => {

                item.classList.remove(
                    "is-selected"
                );

                item.setAttribute(
                    "aria-pressed",
                    "false"
                );

            });


            button.classList.add(
                "is-selected"
            );

            button.setAttribute(
                "aria-pressed",
                "true"
            );


            selectedColor.textContent =
                button.dataset.color;

            updateVariationPrice();
            updateVariationStock();
            updateVariationImage();
            updateWhatsAppMessage();

        });

    });


    /* =====================================================
       STORAGE
    ===================================================== */

    const storageButtons =
        singleProduct.querySelectorAll(
            ".single-product-storage__button"
        );

    const selectedStorage =
        singleProduct.querySelector(
            "#selectedStorage"
        );


    storageButtons.forEach((button) => {

        button.addEventListener("click", () => {

            storageButtons.forEach((item) => {

                item.classList.remove(
                    "is-selected"
                );

            });


            button.classList.add(
                "is-selected"
            );


            selectedStorage.textContent =
                button.dataset.storage;

            updateVariationPrice();
            updateVariationStock();
            updateVariationImage();
            updateWhatsAppMessage();

        });

    });


    /* =====================================================
       VARIANT HORIZONTAL SCROLL
    ===================================================== */

    const variantScrollers =
        singleProduct.querySelectorAll(
            ".single-product-variant-scroll"
        );


    variantScrollers.forEach((scroller) => {

        const track =
            scroller.querySelector(
                ".single-product-variant-scroll__track"
            );

        const previousButton =
            scroller.querySelector(
                ".single-product-variant-scroll__arrow--previous"
            );

        const nextButton =
            scroller.querySelector(
                ".single-product-variant-scroll__arrow--next"
            );


        if (
            !track ||
            !previousButton ||
            !nextButton
        ) {
            return;
        }


        function getScrollAmount() {

            const firstItem =
                track.firstElementChild;

            if (!firstItem) {
                return 120;
            }


            const itemWidth =
                firstItem.getBoundingClientRect().width;

            const trackStyles =
                window.getComputedStyle(track);

            const gap =
                parseFloat(trackStyles.gap) || 0;


            return itemWidth + gap;

        }


        previousButton.addEventListener(
            "click",
            () => {

                track.scrollBy({
                    left: -getScrollAmount(),
                    behavior: "smooth"
                });

            }
        );


        nextButton.addEventListener(
            "click",
            () => {

                track.scrollBy({
                    left: getScrollAmount(),
                    behavior: "smooth"
                });

            }
        );


        function updateArrows() {

            const maximumScroll =
                track.scrollWidth -
                track.clientWidth;


            previousButton.disabled =
                track.scrollLeft <= 1;


            nextButton.disabled =
                maximumScroll <= 1 ||
                track.scrollLeft >=
                maximumScroll - 1;

        }


        track.addEventListener(
            "scroll",
            updateArrows,
            { passive: true }
        );


        window.addEventListener(
            "resize",
            updateArrows
        );


        updateArrows();

    });

});


/* =========================================================
   SINGLE PRODUCT GALLERY
========================================================= */

const mainImage = document.getElementById("singleProductImage");

const thumbnails = Array.from(
    document.querySelectorAll(".single-product-thumbnail")
);

const prevImageButton = document.getElementById("singleProductPrev");
const nextImageButton = document.getElementById("singleProductNext");

const thumbnailsContainer = document.getElementById(
    "singleProductThumbnails"
);

const thumbnailPrev = document.getElementById("thumbnailPrev");
const thumbnailNext = document.getElementById("thumbnailNext");


if (
    mainImage &&
    thumbnails.length &&
    prevImageButton &&
    nextImageButton
) {

    let currentImageIndex = 0;


    /* =====================================================
       CHANGE IMAGE
    ====================================================== */

    function changeProductImage(index) {

        if (index < 0) {
            index = thumbnails.length - 1;
        }

        if (index >= thumbnails.length) {
            index = 0;
        }

        currentImageIndex = index;

        const selectedThumbnail = thumbnails[currentImageIndex];

        const imageUrl =
            selectedThumbnail.dataset.image;

        mainImage.src = imageUrl;


        /* Remove active state */

        thumbnails.forEach((thumbnail) => {
            thumbnail.classList.remove("active");
        });


        /* Add active state */

        selectedThumbnail.classList.add("active");


        /* Keep selected thumbnail visible */

        selectedThumbnail.scrollIntoView({
            behavior: "smooth",
            block: "nearest",
            inline: "nearest"
        });

    }


    /* =====================================================
       CLICK THUMBNAIL
    ====================================================== */

    thumbnails.forEach((thumbnail, index) => {

        thumbnail.addEventListener("click", () => {

            changeProductImage(index);

        });

    });


    /* =====================================================
       MAIN IMAGE — PREVIOUS
    ====================================================== */

    prevImageButton.addEventListener("click", () => {

        changeProductImage(currentImageIndex - 1);

    });


    /* =====================================================
       MAIN IMAGE — NEXT
    ====================================================== */

    nextImageButton.addEventListener("click", () => {

        changeProductImage(currentImageIndex + 1);

    });

}


/* =========================================================
   THUMBNAIL SCROLL ARROWS
========================================================= */

if (
    thumbnailsContainer &&
    thumbnailPrev &&
    thumbnailNext
) {

    thumbnailPrev.addEventListener("click", () => {

        thumbnailsContainer.scrollBy({
            left: -250,
            behavior: "smooth"
        });

    });


    thumbnailNext.addEventListener("click", () => {

        thumbnailsContainer.scrollBy({
            left: 250,
            behavior: "smooth"
        });

    });

}


// #endregion

// #region SEARCH

/* =========================================================
   LIVE PRODUCT SEARCH
========================================================= */

const searchWrappers = document.querySelectorAll(
    ".search-wrapper, .secondary-search"
);

searchWrappers.forEach((wrapper) => {

    const input = wrapper.querySelector(
        ".search-input, .secondary-search__input"
    );

    const dropdown = wrapper.querySelector(
        ".search-dropdown, .secondary-search__dropdown"
    );

    const isSecondarySearch =
        wrapper.classList.contains("secondary-search");

    if (!input || !dropdown) return;

    const searchForm = wrapper.querySelector(
        ".search-box, .secondary-search__box"
    );

    if (searchForm) {

        searchForm.addEventListener("submit", (event) => {

            const searchValue = input.value.trim();

            // Do not submit an empty search
            if (searchValue === "") {
                event.preventDefault();

                dropdown.style.display = "none";

                input.focus();
            }

        });

    }

    dropdown.style.display = "none";

    let searchTimeout;

    input.addEventListener("input", () => {

        const searchValue = input.value.trim();

        clearTimeout(searchTimeout);

        // Empty search
        if (searchValue.length === 0) {
            dropdown.style.display = "none";
            dropdown.innerHTML = "";
            return;
        }

        // Wait slightly before sending the request
        searchTimeout = setTimeout(() => {

            fetch(
                `${hamidPhones.ajaxUrl}?action=hamid_live_product_search&search=${encodeURIComponent(searchValue)}`
            )
                .then((response) => response.json())

                .then((response) => {

                    // Make sure the user hasn't changed the search
                    if (input.value.trim() !== searchValue) {
                        return;
                    }

                    dropdown.innerHTML = "";

                    if (
                        !response.success ||
                        !response.data ||
                        response.data.length === 0
                    ) {

                        dropdown.innerHTML = `
                            <div class="search-no-results">
                                No products found
                            </div>
                        `;

                        dropdown.style.display = "";
                        return;
                    }


                    response.data.forEach((product) => {

                        const productElement = document.createElement("a");

                        productElement.href = product.url;
                        productElement.className = isSecondarySearch
                            ? "secondary-search-product"
                            : "search-product";

                        productElement.innerHTML = `
    <div class="${isSecondarySearch
                                ? "secondary-search-product__image"
                                : "product-image"
                            }">
        <img
            src="${product.image}"
            alt="${escapeSearchHTML(product.name)}"
            loading="lazy">
    </div>

    <div class="${isSecondarySearch
                                ? "secondary-search-product__info"
                                : "product-info"
                            }">

        ${product.brand
                                ? `
                    <span class="${isSecondarySearch
                                    ? "secondary-search-product__category"
                                    : "product-category"
                                }">
                        ${escapeSearchHTML(product.brand)}
                    </span>
                `
                                : ""
                            }

        <strong>
            ${escapeSearchHTML(product.name)}
        </strong>

        <span class="${isSecondarySearch
                                ? "secondary-search-product__price"
                                : "product-price"
                            }">
            ${escapeSearchHTML(product.price)}
        </span>

    </div>

    <span class="${isSecondarySearch
                                ? "secondary-search-product__arrow"
                                : "search-product-arrow"
                            }" aria-hidden="true">

        <svg viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor">

            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M5 12h14M13 6l6 6-6 6">
            </path>

        </svg>

    </span>
`;

                        dropdown.appendChild(productElement);

                    });


                    // See all matching products
                    const seeAll = document.createElement("a");

                    seeAll.href =
                        `${hamidPhones.homeUrl}?s=${encodeURIComponent(searchValue)}&post_type=product`;

                    seeAll.className = isSecondarySearch
                        ? "secondary-search__results"
                        : "see-results";

                    seeAll.innerHTML = `
                        See all results

                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <path
                                d="M5 12h14M13 6l6 6-6 6"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round">
                            </path>
                        </svg>
                    `;

                    dropdown.appendChild(seeAll);

                    dropdown.style.display = "";

                })

                .catch(() => {
                    dropdown.style.display = "none";
                });

        }, 300);

    });

});


function escapeSearchHTML(value) {

    const div = document.createElement("div");

    div.textContent = value ?? "";

    return div.innerHTML;

}

//#endregion
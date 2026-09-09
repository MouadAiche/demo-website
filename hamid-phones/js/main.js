//  #region HEADER

document.addEventListener("DOMContentLoaded", () => {

    /* =====================================================
       ELEMENTS
    ===================================================== */

    const html = document.documentElement;

    const themeToggle = document.querySelector(".theme-toggle");

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
       DARK MODE
    ===================================================== */

    const savedTheme = localStorage.getItem("theme");

    if (savedTheme === "dark") {
        html.setAttribute("data-theme", "dark");
    }

    themeToggle.addEventListener("click", () => {

        const isDark =
            html.getAttribute("data-theme") === "dark";

        if (isDark) {
            html.removeAttribute("data-theme");
            localStorage.setItem("theme", "light");
        } else {
            html.setAttribute("data-theme", "dark");
            localStorage.setItem("theme", "dark");
        }
    });


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

        const searchButton =
            wrapper.querySelector(".search-submit");


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


        input.addEventListener("keydown", (event) => {

            if (event.key === "Enter") {
                performSearch(input);
            }

        });


        searchButton.addEventListener(
            "click",
            () => {

                performSearch(input);

            }
        );


        wrapper.addEventListener(
            "click",
            (event) => {

                event.stopPropagation();

            }
        );

    });


    /* =====================================================
       DEMO SEARCH
    ===================================================== */

    function performSearch(input) {

        const query =
            input.value.trim();

        if (!query) {
            input.focus();
            return;
        }

        /*
            Replace this part later with your real
            results page, for example:

            window.location.href =
                `/results/?search=${encodeURIComponent(query)}`;
        */

        console.log(
            "Searching for:",
            query
        );
    }


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

//  #endregion

// #region SECONDARY HEADER

document.addEventListener("DOMContentLoaded", () => {

    const secondaryHeader =
        document.querySelector(".secondary-header");

    if (!secondaryHeader) return;


    const html =
        document.documentElement;

    const backButton =
        secondaryHeader.querySelector(
            ".secondary-header__back"
        );

    const themeButton =
        secondaryHeader.querySelector(
            ".secondary-header__theme-toggle"
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
       THEME
    ===================================================== */

    if (
        localStorage.getItem("theme")
        === "dark"
    ) {
        html.setAttribute(
            "data-theme",
            "dark"
        );
    }


    themeButton.addEventListener(
        "click",
        () => {

            const dark =
                html.getAttribute(
                    "data-theme"
                ) === "dark";

            if (dark) {

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

            const button =
                search.querySelector(
                    ".secondary-search__submit"
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


            input.addEventListener(
                "keydown",
                (event) => {

                    if (event.key === "Enter") {
                        secondaryPerformSearch(
                            input
                        );
                    }

                }
            );


            button.addEventListener(
                "click",
                () => {

                    secondaryPerformSearch(
                        input
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
       SEARCH FUNCTION
    ===================================================== */

    function secondaryPerformSearch(input) {

        const query =
            input.value.trim();

        if (!query) {
            input.focus();
            return;
        }

        console.log(
            "Searching for:",
            query
        );
    }


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

//  #region FOOTER

document.addEventListener("DOMContentLoaded", () => {

    /* =====================================================
       CURRENT YEAR
    ===================================================== */

    const footerYear =
        document.getElementById("footerYear");

    if (footerYear) {
        footerYear.textContent =
            new Date().getFullYear();
    }

});

//  #endregion

// #region SINGLE PRODUCT

document.addEventListener("DOMContentLoaded", () => {

    const singleProduct =
        document.querySelector(".single-product-page");

    if (!singleProduct) return;


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

// #endregion
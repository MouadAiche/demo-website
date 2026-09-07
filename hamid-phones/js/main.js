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
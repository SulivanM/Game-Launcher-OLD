// Preloader Balance -> Balance-Page

document.addEventListener("DOMContentLoaded", function () {
    var loaders = document.querySelectorAll(".dc-loader");
    var sections = document.querySelectorAll(".section");
    var pageLinks = document.querySelectorAll(".page-link");
    var animationInProgress = false;

    function hideAllSections() {
        sections.forEach(section => section.style.display = "none");
    }

    function showLoader() {
        loaders.forEach(loader => loader.style.display = "block");
    }

    function hideLoader() {
        loaders.forEach(loader => loader.style.display = "none");
    }

    function showSection(section) {
        section.style.display = "block";
    }

    hideAllSections();
    showLoader();

    setTimeout(function () {
        hideLoader();
        showSection(sections[0]);
    }, 3000);

    pageLinks.forEach(link => {
        link.addEventListener("click", function (event) {
            event.preventDefault();

            if (animationInProgress) {
                return;
            }

            showLoader();
            hideAllSections();

            var targetSectionId = link.getAttribute("data-target");
            var targetSection = document.getElementById(targetSectionId);

            if (targetSection) {
                animationInProgress = true;

                setTimeout(function () {
                    hideLoader();
                    showSection(targetSection);

                    animationInProgress = false;
                }, 4000);
            }
        });
    });
});
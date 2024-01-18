// Preloader Support -> My Ticket, Open Ticket, FAQ

document.addEventListener("DOMContentLoaded", function () {
    var loaders = document.querySelectorAll(".dc-loader");
    var sections = document.querySelectorAll(".section");
    var pageLinks = document.querySelectorAll(".page-link");

    var animationInProgress = false;

    function hideAllSections() {
        sections.forEach(function (section) {
            section.style.display = "none";
        });
    }

    hideAllSections();

    loaders.forEach(function (loader) {
        loader.style.display = "block";
    });

    setTimeout(function () {
        loaders.forEach(function (loader) {
            loader.style.display = "none";
        });

        sections[0].style.display = "block";
    }, 3000);

    pageLinks.forEach(function (link) {
        link.addEventListener("click", function (event) {
            event.preventDefault();

            if (animationInProgress) {
                return;
            }

            loaders.forEach(function (loader) {
                loader.style.display = "block";
            });

            hideAllSections();

            var targetSectionId = link.getAttribute("data-target");
            var targetSection = document.getElementById(targetSectionId);
            if (targetSection) {
                animationInProgress = true;

                setTimeout(function () {
                    loaders.forEach(function (loader) {
                        loader.style.display = "none";
                    });
                    targetSection.style.display = "block";

                    animationInProgress = false;
                }, 4000);
            }
        });
    });
});

function toggleAnswer(index) {
    var faqItems = document.querySelectorAll(".faq-item");
    faqItems.forEach(function (item, i) {
        var answer = item.querySelector(".faq-answer");
        if (i === index) {
            item.classList.toggle("faq-active");
            answer.style.display =
                answer.style.display === "none" ? "block" : "none";
        } else {
            item.classList.remove("faq-active");
            answer.style.display = "none";
        }
    });
}

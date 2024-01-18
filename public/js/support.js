document.addEventListener("DOMContentLoaded", function () {
    showPreloader();

    // Hide preloader after 4 seconds (4000 milliseconds)
    setTimeout(function () {
        hidePreloader();
    }, 4000);

    // Add event listener for section changes
    document.addEventListener("click", function (event) {
        if (event.target.matches("#ticketsLink")) {
            changeSection("ticketsSection");
        } else if (event.target.matches("#formLink")) {
            changeSection("formSection");
        } else if (event.target.matches("#faqLink")) {
            changeSection("faqSection");
        }
    });
});

function showPreloader() {
    var loaders = document.querySelectorAll(".dc-loader");
    loaders.forEach(function (loader) {
        loader.style.display = "block";
    });
}

function hidePreloader() {
    var loaders = document.querySelectorAll(".dc-loader");
    loaders.forEach(function (loader) {
        loader.style.display = "none";
    });
}

function changeSection(sectionId) {
    showPreloader();

    // Hide all sections
    var sections = document.querySelectorAll(".title-space");
    sections.forEach(function (section) {
        section.style.display = "none";
    });

    // Show the selected section
    document.getElementById(sectionId).style.display = "block";

    // Hide preloader after a short delay (adjust as needed)
    setTimeout(function () {
        hidePreloader();
    }, 500); // You can adjust the delay here if needed
}

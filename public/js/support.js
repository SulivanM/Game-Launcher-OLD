document.addEventListener("DOMContentLoaded", function () {
    // Show preloader on page load
    showPreloader();

    // Hide preloader after 4 seconds (4000 milliseconds)
    setTimeout(function () {
        hidePreloader();
    }, 4000);

    // Add event listeners for section changes
    document
        .getElementById("ticketsLink")
        .addEventListener("click", function () {
            showPreloader();
            showTickets();
        });

    document.getElementById("formLink").addEventListener("click", function () {
        showPreloader();
        showForm();
    });

    document.getElementById("faqLink").addEventListener("click", function () {
        showPreloader();
        showFAQ();
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

function showTickets() {
    document.getElementById("ticketsSection").style.display = "block";
    document.getElementById("formSection").style.display = "none";
    document.getElementById("faqSection").style.display = "none";
}

function showForm() {
    document.getElementById("ticketsSection").style.display = "none";
    document.getElementById("formSection").style.display = "block";
    document.getElementById("faqSection").style.display = "none";
}

function showFAQ() {
    document.getElementById("ticketsSection").style.display = "none";
    document.getElementById("formSection").style.display = "none";
    document.getElementById("faqSection").style.display = "block";
}

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
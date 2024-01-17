function showTickets() {
    document.getElementById("ticketsSection").style.display = "block";
    document.getElementById("formSection").style.display = "none";
    document.getElementById("faqSection").style.display = "none";
};

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
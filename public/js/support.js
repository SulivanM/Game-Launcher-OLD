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

function toggleAnswer(index) {
    var faqAnswer = document.getElementsByClassName('faq-answer');
    faqAnswer[index].style.display = (faqAnswer[index].style.display === 'block') ? 'none' : 'block';
}

document.addEventListener('DOMContentLoaded', function () {
    var faqItems = document.getElementsByClassName('faq-item');
    for (var i = 0; i < faqItems.length; i++) {
        faqItems[i].addEventListener('click', function () {
            this.classList.toggle('active');
            var index = Array.prototype.indexOf.call(this.parentElement.children, this);
            toggleAnswer(index);
        });
    }
});
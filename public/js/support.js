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
    var faqItems = document.querySelectorAll('.faq-item');
    faqItems.forEach(function (item, i) {
        var answer = item.querySelector('.faq-answer');
        if (i === index) {
            item.classList.toggle('faq-active');
            answer.style.display = answer.style.display === 'none' ? 'block' : 'none';
        } else {
            item.classList.remove('faq-active');
            answer.style.display = 'none';
        }
    });
}
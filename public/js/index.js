const sideMenu = document.querySelector("aside")
const menuBtn = document.querySelector("#menu-btn")
const closeBtn = document.querySelector("#close-btn")
const themeToggler = document.querySelector(".theme-toggler");

console.log(themeToggler);

// Show Sidebar
menuBtn.addEventListener('click', () => {
    sideMenu.style.display = 'block';
})

// Close Sidebar
closeBtn.addEventListener('click', () => {
    sideMenu.style.display = 'none';
})

// Change Theme
themeToggler.addEventListener('click', () => {
    document.body.classList.toggle('dark-theme-variables')
    themeToggler.querySelector('span:nth-child(1)').classList.toggle('active');
    themeToggler.querySelector('span:nth-child(2)').classList.toggle('active');
})

// Search Input
document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("search-input");

    searchInput.addEventListener("keyup", function (event) {
        if (event.key === "Enter") {
            const searchTerm = searchInput.value.trim();

            if (searchTerm !== "") {
                window.location.href = `/profile/${encodeURIComponent(searchTerm)}`;
            }
        }
    });
});

// Sound Clic Effect
document.addEventListener('DOMContentLoaded', function () {
            var audio = new Audio('../sounds/clic_doc.mp3');
            document.querySelectorAll('a').forEach(function (link) {
                link.addEventListener('click', function () {
                    audio.play();
                });
            });
        });
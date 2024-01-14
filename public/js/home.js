// Preloader Home -> Basic Information, Statistics, Team, Acheivements, Friends

document.addEventListener("DOMContentLoaded", function () {
  // Sélectionnez tous les loaders et sections
  var loaders = document.querySelectorAll(".dc-loader");
  var sections = document.querySelectorAll(".section");
  var navLinks = document.querySelectorAll(".nav-link");

  // Drapeau pour indiquer si une animation est en cours
  var animationInProgress = false;

  // Fonction pour masquer toutes les sections
  function hideAllSections() {
    sections.forEach(function (section) {
      section.style.display = "none";
    });
  }

  // Masque les sections initialement
  hideAllSections();

  // Affiche le loader pendant 3 secondes
  loaders.forEach(function (loader) {
    loader.style.display = "block";
  });

  setTimeout(function () {
    loaders.forEach(function (loader) {
      loader.style.display = "none";
    });

    // Affiche la première section après 3 secondes
    sections[0].style.display = "block";
  }, 3000);

  // Ajoutez un gestionnaire de clic pour chaque lien de navigation
  navLinks.forEach(function (link) {
    link.addEventListener("click", function (event) {
      event.preventDefault();

      // Vérifie si une animation est en cours, si c'est le cas, ignore le clic
      if (animationInProgress) {
        return;
      }

      // Réinitialise la couleur de texte pour tous les liens
      navLinks.forEach(function (navLink) {
        navLink.style.color = ""; // Réinitialisez la couleur à sa valeur par défaut
      });

      // Change la couleur de texte en blanc pour le lien cliqué
      link.style.color = "white";

      // Affiche le loader à chaque changement de section
      loaders.forEach(function (loader) {
        loader.style.display = "block";
      });

      // Masque toutes les sections
      hideAllSections();

      // Affiche la section correspondante au lien cliqué
      var targetSectionId = link.getAttribute("data-target");
      var targetSection = document.getElementById(targetSectionId);
      if (targetSection) {
        // Indique que l'animation est en cours
        animationInProgress = true;

        // Masque le loader après un court délai (par exemple, 1 seconde)
        setTimeout(function () {
          loaders.forEach(function (loader) {
            loader.style.display = "none";
          });
          targetSection.style.display = "block";

          // Réinitialise le drapeau après l'achèvement de l'animation
          animationInProgress = false;
        }, 4000);
      }
    });
  });
});
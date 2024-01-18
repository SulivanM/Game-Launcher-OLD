document.addEventListener("DOMContentLoaded", function () {
    // Select all loaders, sections, and navigation links
    var loaders = document.querySelectorAll(".dc-loader");
    var sections = document.querySelectorAll(".section");
    var navLinks = document.querySelectorAll(".nav-link");
  
    // Flag to indicate if an animation is in progress
    var animationInProgress = false;
  
    // Function to hide all sections
    function hideAllSections() {
      sections.forEach(function (section) {
        section.style.display = "none";
      });
    }
  
    // Hide all sections initially
    hideAllSections();
  
    // Show the loader for 3 seconds
    loaders.forEach(function (loader) {
      loader.style.display = "block";
    });
  
    setTimeout(function () {
      loaders.forEach(function (loader) {
        loader.style.display = "none";
      });
  
      // Show the first section after 3 seconds
      sections[0].style.display = "block";
    }, 3000);
  
    // Add a click handler for each navigation link
    navLinks.forEach(function (link) {
      link.addEventListener("click", function (event) {
        event.preventDefault();
  
        // Check if an animation is in progress, if so, ignore the click
        if (animationInProgress) {
          return;
        }
  
        // Reset text color for all links
        navLinks.forEach(function (navLink) {
          navLink.style.color = ""; // Reset the color to its default value
        });
  
        // Change text color to white for the clicked link
        link.style.color = "white";
  
        // Show the loader on each section change
        loaders.forEach(function (loader) {
          loader.style.display = "block";
        });
  
        // Hide all sections
        hideAllSections();
  
        // Show the section corresponding to the clicked link
        var targetSectionId = link.getAttribute("data-target");
        var targetSection = document.getElementById(targetSectionId);
        if (targetSection) {
          // Indicate that the animation is in progress
          animationInProgress = true;
  
          // Hide the loader after a short delay (e.g., 4 seconds)
          setTimeout(function () {
            loaders.forEach(function (loader) {
              loader.style.display = "none";
            });
            targetSection.style.display = "block";
  
            // Reset the flag after the animation is complete
            animationInProgress = false;
          }, 4000);
        }
      });
    });
  });
  
// Fonction pour masquer le preloader une fois que le contenu est chargé
function hidePreloader() {
	var preloaderContainer = document.querySelector('.preloader-container');
	preloaderContainer.style.opacity = 0; // Réduit l'opacité à 0 pour démarrer l'animation de fondu
	setTimeout(function() {
		preloaderContainer.style.display = 'none';
		document.body.style.overflow = 'visible'; // Restaure le défilement de la page
	}, 500); // 500 ms pour correspondre à la durée de transition spécifiée dans le CSS (0.5s)
}

// Appelez la fonction après un délai minimum de 2,5 secondes (2500 ms)
setTimeout(hidePreloader, 2500);
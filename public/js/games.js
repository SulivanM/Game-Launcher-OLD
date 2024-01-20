function addToCollection(gameId) {
    $.ajax({
        url: '/check-collection/' + gameId,
        type: 'GET',
        success: function(response) {
            if (response.exists) {
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur',
                    text: 'Le jeu est déjà dans votre collection.',
                    confirmButtonText: 'OK'
                });
            } else {
                document.forms['add-to-collection-' + gameId].submit();
            }
        },
        error: function(error) {
            console.error('Erreur lors de la vérification de la collection', error);
        }
    });
}
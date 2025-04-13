document.getElementById('addNormalClientForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Empêche le rechargement de la page lors de la soumission du formulaire

    let formData = new FormData(this); // Crée un objet FormData avec le formulaire

    fetch('path('admin_add_normal_client') ' {
        method: 'POST', // Envoi de la requête avec la méthode POST
        body: formData // Envoie les données du formulaire
    })
    .then(response => response.json())  // Si la réponse est en JSON, elle est traitée ici
    .then(data => {
        if (data.success) {
            alert('Client ajouté avec succès!');
            // Rediriger ou réinitialiser le formulaire, par exemple :
            // window.location.href = '/admin/client/list'; // Ou pour réinitialiser le formulaire
            // document.getElementById('addNormalClientForm').reset();
        } else {
            alert('Erreur lors de l\'ajout du client.');
        }
    })
    .catch(error => {
        console.error('Erreur:', error);
        alert('Une erreur est survenue.');
    });
});

// Récupérez les éléments nécessaires depuis le DOM
const buyButton = document.getElementById('buy-button');
const quantityInput = document.getElementById('product-quantity');
const productId = 1; // Remplacez ceci par la méthode pour récupérer l'ID du produit approprié

// Ajoutez un événement 'click' au bouton Acheter
buyButton.addEventListener('click', function(event) {
    event.preventDefault(); // Empêche le comportement par défaut du formulaire

    // Récupérez les valeurs des champs nécessaires
    const quantity = parseInt(quantityInput.value);
    const url = window.location.href; // Récupérez l'URL de la page actuelle

    // Créez un objet FormData pour envoyer les données au serveur
    const formData = new FormData();
    formData.append('product_id', productId);
    formData.append('quantity', quantity);

    // Effectuez une requête fetch POST vers votre script PHP de gestion d'achat
    fetch('handle_purchase.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Erreur lors de l\'achat');
        }
        return response.json(); // Si nécessaire, traitez la réponse JSON
    })
    .then(data => {
        console.log('Achat réussi !', data); // Affichez ou traitez la réponse si besoin
        // Redirigez l'utilisateur vers la page de confirmation ou une autre page
        window.location.href = 'panier.php';
    })
    .catch(error => {
        console.error('Erreur :', error);
        // Gérez les erreurs, affichez un message à l'utilisateur, etc.
    });
});
document.querySelectorAll('.add-to-cart').forEach(button => {
    button.addEventListener('click', function(event) {
        event.preventDefault();

        const productName = this.dataset.name;
        const productDescription = this.dataset.description;
        const productImage = this.dataset.image;
        const productPrice = parseFloat(this.dataset.price);

        const formData = new FormData();
        formData.append('name', productName);
        formData.append('description', productDescription);
        formData.append('image', productImage);
        formData.append('price', productPrice);
        formData.append('quantity', 1); // Par défaut à 1, ajustez si nécessaire

        fetch('add_to_cart.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Produit ajouté au panier avec succès.');
                // Optionnel: Mettre à jour l'interface utilisateur
            } else {
                alert('Erreur lors de l\'ajout au panier : ' + data.message);
            }
        })
        .catch(error => {
            console.error('Erreur :', error);
            alert('Erreur lors de l\'ajout au panier. Veuillez réessayer.');
        });
    });
});

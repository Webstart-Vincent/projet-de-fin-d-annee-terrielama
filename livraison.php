<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style.css"/>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
  </head>
<body>    

<?php 
//   <!-- ------header + nav + login------ -->
          include("./header.php"); 
        ?>
<!-- ------------------content-------------------- -->

<div class="livraison_container"> 
        <h1>Livraison</h1>
            <section class="delivery-info">
                <h2>Informations de Livraison</h2>
                <form action="#">
                    <div class="form-group">
                        <label for="name">Nom Complet</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Adresse</label>
                        <input type="text" id="address" name="address" required>
                    </div>
                    <div class="form-group">
                        <label for="city">Ville</label>
                        <input type="text" id="city" name="city" required>
                    </div>
                    <div class="form-group">
                        <label for="postal-code">Code Postal</label>
                        <input type="text" id="postal-code" name="postal-code" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Téléphone</label>
                        <input type="tel" id="phone" name="phone" required>
                    </div>
                    <div class="form-group">
                        <label for="delivery-date">Date de Livraison</label>
                        <input type="date" id="delivery-date" name="delivery-date" required>
                    </div>
                    <div class="form-group">
                        <label for="delivery-time">Heure de Livraison</label>
                        <input type="time" id="delivery-time" name="delivery-time" required>
                    </div>
                    <div class="form-group">
                        <label for="notes">Notes supplémentaires</label>
                        <textarea id="notes" name="notes" rows="4"></textarea>
                    </div>
                    <button type="submit">Envoyer</button>
                </form>
            </section>
        </div>
 


<!-- ------------------footer------------------ -->

<?php 
          include("./footer.php"); 
        ?>

</body>
</html>

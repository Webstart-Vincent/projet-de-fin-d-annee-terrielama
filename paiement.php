<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Paiement</title>
    <link rel="stylesheet" href="./assets/css/style.css"/>
 
  </head>
  <body>
    <!-- Header -->
    <!-- <header>
        <div class="pos_logo">
     </div>
     </header>  -->
<!-- ----------------paiment------------------------ -->


<div class="formulaire_container">    
     <img class="logo" src="./assets/img/logo.svg" alt="BLISS Logo">

    <div class="formulaire_paye">
    <form action="paiement.php">
      <h1>PAIEMENT</h1> <hr>
      <h2> INFORMATION</h2>
      <p>Nom : <input type="text" name="name" placeholder="" required></p>
      <p>Genre :</p> 


      <fieldset>
               <label>
                   <input type="checkbox" class="checkbox" >&nbsp homme &nbsp &nbsp
                   <input type="checkbox" >  Femme  &nbsp &nbsp
                   <input type="checkbox" > Autre

               </label>
      </fieldset>
       <p>
          Adresse : <textarea name="Adresse" id="Adresse" cols="32" rows="" placeholder="Adresse"></textarea>
       </p>
       <p> E-mail : 
           <input type="email" name="email" id="email" placeholder="Username@gmail.com"> 
       </p>
       <p>
        Code pin : <input type="number" name="Codepin" id="Code pin" placeholder="CodePin">
       </p>
       <hr>
       <h2>Paiement</h2>
       <p> Type de carte :
           <select name="card_type" id="card_type">
               <option value="">Selectionnez votre type de carte</option>
               <option value="Visa">Visa</option>
               <option value="Mastercard">Mastercard</option>
           </select>
       </p>
       <p>Numéro de carte :
           <input type="number" name="CRD_NUMBER" id="CARD_NMAR" placeholder="1234 1234 123">
       </p>
       <p>DATE D'EXPIRATION : 
           <input type="date" name="exp" id="exp">
       </p>
       <p>CVV:</p>
           <input type="password" name="cvv" id="cvv" placeholder="123">
       
       <input type="submit" value="Payer">

    </form> 
    </div>
    </div>
  </body>
</html>

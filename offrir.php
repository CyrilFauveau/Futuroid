<?php
include_once("body/header.php");
 ?>

<main class="block-main">
  <div class="banniere banniere-offrir">
    <h2>OFFRIR</h2>
    <p class="resume-title">texte complémentaire</p>
  </div>

  <div class="wrapper">
    <h2 class="h3-title h3-reserver">Etapes :</h2>

    <ul class="liste liste-etapes">
      <li class="validate">OFFRE</li>
      <li>VOS INFORMATIONS</li>
      <li>PAIEMENT</li>
    </ul>
    <p class="indications">Les champs suivi d’une astérisque * sont obligatoires.</p>

    <div class="second-step">
      <h3 class="h3-title">Choisissez votre offre* :</h3>
      <ul class="liste liste-pack">
        <li class="offrir">Chèque cadeau </br><span>GENERIQUE</span></li>
        <li class="offrir">Chèque cadeau </br><span>SPECIFIQUE</span></li>
      </ul>

      <form class="form-step-2" action="index.html" method="post">

        <div class="item">
          <label for="range">Choisissez le montant du chèque-cadeau*: </label>
          <input type="range" min="25" max="250" step="1" value="0" /><span id="range">25</span>
        </div>

        <div class="item">
          <label for="nb_cheque">Choisissez le nombre de chèque-cadeau*: </label>
          <input type="range" min="1" max="250" step="1" value="0" /><span id="nb_cheque">1</span>
        </div>
        <div class="buttons">
          <button class="liens lien-reserver" type="button" name="button">ETAPE SUIVANTE</button>
          <button class="liens lien-reserver" type="button" name="button">ETAPE PRECEDENTE</button>
        </div>
      </form>
    </div>
  </div>

</main>

<?php
include_once('body/footer.php');
 ?>

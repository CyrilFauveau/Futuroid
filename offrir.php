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

        <form class="form-step-2" action="index.html" method="post">

            <div class="step">
                <span class="subtitle">Choisissez votre offre* :</span>
                <ul class="liste liste-pack">
                    <li class="generique select">Chèque cadeau </br>GENERIQUE</li>
                    <li class="specifique">Chèque cadeau </br>SPECIFIQUE</li>
                </ul>
            </div>

            <div class="offre" id="generique">
                <div class="item">
                    <label for="range">Choisissez le montant du chèque-cadeau*: </label>
                    <input id="price" type="range" min="25" max="250" step="1" value="25"/>
                </div>

                <div class="item">
                    <label for="nb_cheque">Choisissez le nombre de chèque-cadeau*: </label>
                    <input id="nb_cheque" type="range" min="1" max="30" step="1" value="1"/>
                </div>
                <div class="buttons">

                    <button class="liens lien-reserver" type="button" name="button">ETAPE PRECEDENTE</button>
                </div>
            </div>

            <div class="offre hide" id="specifique">
                lalala
            </div>


            <div class="next"><p class="price">Prix totale : 25</p>
                <button class="liens lien-reserver" type="button" name="button">ETAPE SUIVANTE</button>
            </div>


        </form>

    </div>

</main>

<?php
include_once('body/footer.php');
?>

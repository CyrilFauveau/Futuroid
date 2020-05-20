<?php
include_once('body/header.php');
?>

<main class="block-main">
    <div class="banniere banniere-reserver">
        <h2>RESERVATION</h2>
        <p class="resume-title">texte complémentaire</p>
    </div>

<?php
if (!empty($_POST['pack']) && !empty($_POST['game']) && !empty($_POST['nb_players']) && !empty($_POST['date'])) {
    if (!empty($_POST['prenom']) && !empty($_POST['nom']) && !empty($_POST['mail']) && !empty($_POST['tel'])) {

        $pack = $_POST['pack'];
        $game = $_POST['game'];
        $number_players = $_POST['nb_players'];
        $date = $_POST['date'];
        $prenom = $_POST['prenom'];
        $nom = $_POST['nom'];
        $mail = $_POST['mail'];
        $phone = $_POST['tel'];
        ?>

        <form class="wrapper" action="check_reservation.php" method="post">

            <h2 class="h3-title h3-reserver">Etapes :</h2>

            <ul class="liste liste-etapes">
                <li class="step active">LE JEU</li>
                <li class="step active">VOS INFORMATIONS</li>
                <li class="step active">RECAPITULATIF</li>
            </ul>

            <p>Pack : <?= $pack; ?><input type="text" name="pack" value="<?= $pack; ?>" hidden></p>
            <p>Jeu choisi : <?= $game; ?><input type="text" name="game" value="<?= $game; ?>" hidden></p>
            <p>Nombre de joueurs : <?= $number_players; ?><input type="text" name="nb_players" value="<?= $number_players; ?>" hidden></p>
            <p>Créneaux horaires :
            <?php foreach ($date as $time_slot) { ?>
                <br><?=$time_slot;?><input type="text" name="date[]" value="<?= $time_slot; ?>" hidden>
            <?php } ?>
            </p>
            <p>Prénom : <?= $prenom;?><input type="text" name="prenom" value="<?= $prenom; ?>" hidden></p>
            <p>Nom : <?= $nom; ?><input type="text" name="nom" value="<?= $nom; ?>" hidden></p>
            <p>Adresse mail : <?= $mail; ?><input type="text" name="mail" value="<?= $mail; ?>" hidden></p>
            <p>Numéro de téléphone : <?= $phone; ?><input type="text" name="tel" value="<?= $phone; ?>" hidden></p>

            <a href="reservation.php" class="liens lien-reserver">étape précédente</a>
            <input type="submit" class="liens lien-reserver" name="" value="Réserver">
        </form>

        <?php
    }
}
else {
    header('Location:reservation.php');
}
?>

</main>

<?php
include_once('body/footer.php');
?>

<?php
include_once('body/header.php');
include_once('PDO/connexion.php');
include_once('functions_helper.php');

if (isset($_SESSION['connected']) && isset($_POST['date'])) {

    $date = $_POST['date'];

    foreach ($date as $time_slot) {

        $date_actual = date('Y-m-d H:i:s', strtotime('+ 2 hour'));

        if ($time_slot < $date_actual) {
            $date = false;
        }
    }

    if ($date) {
        foreach ($date as $time_slot) {
            if (preg_match('#^[0-9]{4}-[0-9]{2}-[0-9]{2}\s[0-9]{2}:[0-9]{2}:[0-9]{2}$#', $time_slot)) {

                $query = $connexion->prepare("SELECT * FROM reservation WHERE time_slot LIKE '$time_slot' AND status = 'libre' OR status = 'reserve'");
                $query->execute();

                while ($row = $query->fetch()) {
                    closeTimeSlot($time_slot, $row, $connexion);
                    $message = 'La fermeture a bien été enregistrée';
                }
            }
            else {
                $message = 'Une erreur est survenue sur les créneaux de réservation';
            }
        }
    }
    else {
        $message = 'Les créneaux choisis ne peuvent pas être antérieures à la date actuelle';
    }
}
else {
    $message = 'Aucune date n\'a été sélectionnée';
}

echo $message;

include_once('body/footer.php');

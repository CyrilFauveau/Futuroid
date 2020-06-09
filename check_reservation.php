<?php
include_once('PDO/connexion.php');
include_once('functions_helper.php');

// Conditions formulaire :
//
// Code promo facultatif
// Pack obligatoire, 5 disponibles
// Jeu obligatoire, 6 disponibles
// Nombre joueurs obligatoire, entre 1 et 12
// Créneau horaire obligatoire, non réservé et entreprise ouverte
// Nom obligatoire
// Prenom obligatoire
// Mail obligatoire, format mail
// Tel obligatoire, format tel

var_dump($_POST);

if (isset($_POST['pack']) && isset($_POST['game']) && isset($_POST['nb_players']) && isset($_POST['date']) && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['mail']) && isset($_POST['tel'])) {

    if (!empty($_POST['pack']) && !empty($_POST['game']) && !empty($_POST['nb_players']) && !empty($_POST['date']) && !empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['mail']) && !empty($_POST['tel'])) {

        $pack = $_POST['pack'];
        $game = $_POST['game'];
        $nb_players = $_POST['nb_players'];
        $date = $_POST['date'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $mail = $_POST['mail'];
        $phone = $_POST['tel'];

        if (count($date) > 3) {
            $message = 'Vous ne pouvez choisir que 3 créneaux horaires maximum';
        }
        else if (count($date) <= 0) {
            $message = 'Vous devez choisir au moins un créneau horaire';
        }
        else {

            if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {

                $phone = str_replace(' ', '', $phone);
                $phone = str_replace('-', '', $phone);
                if (preg_match('#^[0-9]{10}$#', $phone)) {

                    if ($nb_players >= 1 && $nb_players <= 12) {
                        switch ($pack) {
                            case 'pack_classic':
                                $pack_valid = true;
                                break;
                            case 'pack_s':
                                $pack_valid = true;
                                break;
                            case 'pack_m':
                                $pack_valid = true;
                                break;
                            case 'pack_l':
                                $pack_valid = true;
                                break;
                            case 'pack_xl':
                                $pack_valid = true;
                                break;
                            default:
                                $pack_valid = false;
                                break;
                        }
                        if ($pack_valid) {

                            foreach ($date as $time_slot) {

                                $date_actual = date('Y-m-d H:i:s', strtotime('+ 2 hour'));

                                if ($time_slot < $date_actual) {
                                    $date = false;
                                }
                            }

                            if ($date) {
                                foreach ($date as $time_slot) {
                                    if (preg_match('#^[0-9]{4}-[0-9]{2}-[0-9]{2}\s[0-9]{2}:[0-9]{2}:[0-9]{2}$#', $time_slot)) {

                                        $query = $connexion->prepare("SELECT * FROM reservation WHERE time_slot LIKE '$time_slot' AND status = 'libre'");
                                        $query->execute();

                                        while ($row = $query->fetch()) {
                                            updateReservation($time_slot, $row, $connexion);
                                            $message = 'Votre réservation a bien été enregistrée';
                                        }
                                    }
                                    else {
                                        $message = 'Une erreur est survenue sur les créneaux de réservation';
                                    }
                                }
                                $to = 'fauveaucyril@gmail.com';
                                $subject = 'Réservation';

                                $message = 'Pack : ' . $pack . "\n";
                                $message .= 'Jeu : ' . $game . "\n";
                                $message .= 'Nombre de joueurs : ' . $nb_players . "\n";
                                foreach ($date as $time_slot) {
                                    $message .= 'Créneau horaire : ' . $time_slot . "\n";
                                }
                                $message .= 'Nom : ' . $nom . "\n";
                                $message .= 'Prénom : ' . $prenom . "\n";
                                $message .= 'Mail : ' . $mail . "\n";
                                $message .= 'Téléphone : ' . $phone . "\n";
                                $message .= 'Numéro de téléphone : ' . $phone;

                                $headers = 'From:' . $mail . "\r\n" .
                                    'Reply-To:' . $mail . "\r\n" .
                                    'X-Mailer: PHP/' . phpversion();

                                mail($to, $subject, $message, $headers);
                            }
                            else {
                                $message = 'La date choisie ne peut pas être antérieure à la date actuelle';
                            }
                        }
                        else {
                            $message = 'Votre pack n\'est pas valide';
                        }
                    }
                    else {
                        $message = 'Vous devez être entre 1 et 12 personnes pour réserver';
                    }
                }
                else {
                    $message = 'Votre numéro de téléphone n\'est pas valide';
                }
            }
            else {
                $message = 'Votre mail n\'est pas valide';
            }
        }
    }
    else {
        $message = 'Les champs obligatoires ne doivent pas être vides';
    }
}
else {
    $message = 'Les informations ne sont pas complètes';
}

echo $message;

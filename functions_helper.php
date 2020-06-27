<?php

include_once('PDO/connexion.php');



// Retourne un tableau contenant tous les créneaux horaires (de 10h à 21h) sur une année indiquée
function createAllReservationTimeSlots($wishen_year)
{
    $reservation_lines = array();

    $reservation = array();

    // YEARS
    for ($y = $wishen_year; $y <= $wishen_year + 10; $y++) {
        $year = array();

        // MONTHS
        for ($m = 1; $m <= 12; $m++) {
            $month = array();


            if ($m == 4 || $m == 6 || $m == 9 || $m == 11) {

                // DAYS
                for ($d = 1; $d <= 30; $d++) {
                    $day = array();

                    // TIME SLOTS
                    for ($t = 8; $t <= 22; $t++) {
                        $day[] = array(
                            $d => $t
                        );

                        if (strlen($m) < 2) {
                            $m = '0' . $m;
                        }
                        if (strlen($d) < 2) {
                            $d = '0' . $d;
                        }
                        if (strlen($t) < 2) {
                            $t = '0' . $t;
                        }
                        $reservation_lines[] = $y . '-' . $m . '-' . $d . ' ' . $t . ':00:00';
                    }
                    $month[] = $day;
                }
            }
            else if ($m == 2) {

                if (date('L', mktime(0, 0, 0, 1, 1, $y))) {

                    // DAYS
                    for ($d = 1; $d <= 29; $d++) {
                        $day = array();

                        // TIME SLOTS
                        for ($t = 8; $t <= 22; $t++) {
                            $day[] = array(
                                $d => $t
                            );

                            if (strlen($m) < 2) {
                                $m = '0' . $m;
                            }
                            if (strlen($d) < 2) {
                                $d = '0' . $d;
                            }
                            if (strlen($t) < 2) {
                                $t = '0' . $t;
                            }
                            $reservation_lines[] = $y . '-' . $m . '-' . $d . ' ' . $t . ':00:00';
                        }
                        $month[] = $day;
                    }
                }
                else {

                    // DAYS
                    for ($d = 1; $d <= 28; $d++) {
                        $day = array();

                        // TIME SLOTS
                        for ($t = 8; $t <= 22; $t++) {
                            $day[] = array(
                                $d => $t
                            );

                            if (strlen($m) < 2) {
                                $m = '0' . $m;
                            }
                            if (strlen($d) < 2) {
                                $d = '0' . $d;
                            }
                            if (strlen($t) < 2) {
                                $t = '0' . $t;
                            }
                            $reservation_lines[] = $y . '-' . $m . '-' . $d . ' ' . $t . ':00:00';
                        }
                        $month[] = $day;
                    }
                }
            }
            else {

                // DAYS
                for ($d = 1; $d <= 31; $d++) {

                    $day = array();

                    // TIME SLOTS
                    for ($t = 8; $t <= 22; $t++) {
                        $day[] = array(
                            $d => $t
                        );

                        if (strlen($m) < 2) {
                            $m = '0' . $m;
                        }
                        if (strlen($d) < 2) {
                            $d = '0' . $d;
                        }
                        if (strlen($t) < 2) {
                            $t = '0' . $t;
                        }
                        $reservation_lines[] = $y . '-' . $m . '-' . $d . ' ' . $t . ':00:00';
                    }
                    $month[] = $day;
                }
            }
            $year[] = $month;
        }
        $reservation[] = $year;
    }

    return $reservation_lines;
}





// Insert une tableau de créneaux horaires dans la base de données
function insertAllReservationTimeSlots($time_slots, $connexion)
{
    for ($i = 0; $i < count($time_slots); $i++) {

        $query = $connexion->prepare('INSERT INTO reservation (time_slot, status) VALUES (:time_slot, :status)');
        $query->execute(array(
            'time_slot' => $time_slots[$i],
            'status' => 'libre',
        ));
    }
}





// Traduit les dates en français selon le séparateur indiqué
function englishDateToFrench($date, $format)
{
    $date = explode($format, $date);
    // var_dump($date);

    for ($i = 0; $i < count($date); $i++) {

        switch ($date[$i]) {
            case 'Monday':
                $date[$i] = 'Lundi';
                break;
            case 'Tuesday':
                $date[$i] = 'Mardi';
                break;
            case 'Wednesday':
                $date[$i] = 'Mercredi';
                break;
            case 'Thursday':
                $date[$i] = 'Jeudi';
                break;
            case 'Friday':
                $date[$i] = 'Vendredi';
                break;
            case 'Saturday':
                $date[$i] = 'Samedi';
                break;
            case 'Sunday':
                $date[$i] = 'Dimanche';
                break;

            case 'Jan':
                $date[$i] = 'janv';
                break;
            case 'Feb':
                $date[$i] = 'févr';
                break;
            case 'Mar':
                $date[$i] = 'mars';
                break;
            case 'Apr':
                $date[$i] = 'avr';
                break;
            case 'May':
                $date[$i] = 'mai';
                break;
            case 'Jun':
                $date[$i] = 'juin';
                break;
            case 'Jul':
                $date[$i] = 'juil';
                break;
            case 'Aug':
                $date[$i] = 'août';
                break;
            case 'Sep':
                $date[$i] = 'sept';
                break;
            case 'Oct':
                $date[$i] = 'oct';
                break;
            case 'Nov':
                $date[$i] = 'nov';
                break;
            case 'Dec':
                $date[$i] = 'déc';
                break;
        }
    }
    $date = implode($format, $date);
    return $date;
}





// Retourne un tableau de créneaux horaires sur la semaine du jour indiqué
function getAllTimeSlotsByWeek($date1, $connexion)
{
    if (preg_match('#^[0-9]{4}-[0-9]{2}-[0-9]{2}#', $date1)) {

        $date2 = date('Y-m-d', strtotime($date1 . ' + 6 days'));

        $horaires_globales = unserialize(HORAIRES_GLOBALES);
        $date1_min = " " . $horaires_globales[0];
        $date2_max = " " . end($horaires_globales);

        $date1 = $date1 . $date1_min;
        $date2 = $date2 . $date2_max;

        $query = $connexion->prepare("SELECT * FROM reservation WHERE time_slot BETWEEN '$date1' AND '$date2'");
        $query->execute();

        $week_reservation = array();

        while ($row = $query->fetch()) {
            // $week_reservation[] = $row->time_slot;
            $week_reservation[$row->time_slot] = $row->status;
        }

        return $week_reservation;
    }
    else {
        $message = 'La date n\'est pas au bon format';
        return $message;
    }
}





function displayCalendarDayClient($key, $value, $date, $min, $max) {

    // Horaires du jour
    $min_time_slot = date('H:i:s', strtotime($min));
    $max_time_slot = date('H:i:s', strtotime($max));

    $min_time_slot = substr($key, 0, 11) . $min_time_slot;
    $max_time_slot = substr($key, 0, 11) . $max_time_slot;

    // Horaires globales
    $horaires_globales = unserialize(HORAIRES_GLOBALES);
    $min_globale_slot = date('H:i:s', strtotime($horaires_globales[0]));
    $max_globale_slot = date('H:i:s', strtotime(end($horaires_globales)));

    $min_globale_slot = substr($key, 0, 11) . $min_globale_slot;
    $max_globale_slot = substr($key, 0, 11) . $max_globale_slot;

    if ($key >= $min_globale_slot && $key <= $max_globale_slot) {

        if ($key >= $min_time_slot && $key <= $max_time_slot) {

            // Dates antérieures à l'actuelle
            if ($key < $date) { ?>
                <label class="reservation_field" for="<?= $key ?>" onclick="updateReservationCalendarField(this)">reserve</label>
                <input id="<?= $key ?>" type="checkbox" name="date[]" value="<?= $key ?>">
            <?php }

            // Dates postérieures à l'actuelle
            else { ?>
                <label class="reservation_field" for="<?= $key ?>" onclick="updateReservationCalendarField(this)"><?= $value ?></label>
                <input id="<?= $key ?>" type="checkbox" name="date[]" value="<?= $key ?>">
            <?php }
        }
        else { ?>
            <label class="reservation_field" for="<?= $key ?>" onclick="updateReservationCalendarField(this)">close</label>
            <input id="<?= $key ?>" type="checkbox" name="date[]" value="<?= $key ?>">
        <?php }
    }
}





// Affiche le calendrier de réservation client
function displayCalendarClient($reservation_time_slots)
{
    $index = 0;
    foreach ($reservation_time_slots as $key => $value) {

        if ($index != 0) {

            // Détecte si il y a changement de jour
            $next_day = substr_compare($key, $prev_key, 0, 10);

            if ($next_day == 1) {
                echo '</div>';
                echo '<div class="day">';
                $date = date('l d M Y', strtotime($key));
                $date = englishDateToFrench($date, ' ');
                echo '<h4>' . $date . '</h4>';
            }
        }
        else {
            $date = date('l d M Y', strtotime($key));
            $date = englishDateToFrench($date, ' ');
            echo '<h4>' . $date . '</h4>';
        }

        $date = date('Y-m-d H:i:s', strtotime('+ 2 hour'));

        $day = date('D', strtotime($key));

        switch ($day) {
            case 'Mon':
                displayCalendarDayClient($key, $value, $date, HORAIRES_OUVERTURE_LUNDI, HORAIRES_FERMETURE_LUNDI);
                break;
            case 'Tue':
                displayCalendarDayClient($key, $value, $date, HORAIRES_OUVERTURE_MARDI, HORAIRES_FERMETURE_MARDI);
                break;
            case 'Wed':
                displayCalendarDayClient($key, $value, $date, HORAIRES_OUVERTURE_MERCREDI, HORAIRES_FERMETURE_MERCREDI);
                break;
            case 'Thu':
                displayCalendarDayClient($key, $value, $date, HORAIRES_OUVERTURE_JEUDI, HORAIRES_FERMETURE_JEUDI);
                break;
            case 'Fri':
                displayCalendarDayClient($key, $value, $date, HORAIRES_OUVERTURE_VENDREDI, HORAIRES_FERMETURE_VENDREDI);
                break;
            case 'Sat':
                displayCalendarDayClient($key, $value, $date, HORAIRES_OUVERTURE_SAMEDI, HORAIRES_FERMETURE_SAMEDI);
                break;
            case 'Sun':
                displayCalendarDayClient($key, $value, $date, HORAIRES_OUVERTURE_DIMANCHE, HORAIRES_FERMETURE_DIMANCHE);
                break;
        }

        $prev_key = $key;
        $index++;
    }
}





function displayCalendarDayAdmin($key, $value, $min, $max) {

    // Horaires du jour
    $min_time_slot = date('H:i:s', strtotime($min));
    $max_time_slot = date('H:i:s', strtotime($max));

    $min_time_slot = substr($key, 0, 11) . $min_time_slot;
    $max_time_slot = substr($key, 0, 11) . $max_time_slot;

    // Horaires globales
    $horaires_globales = unserialize(HORAIRES_GLOBALES);
    $min_globale_slot = date('H:i:s', strtotime($horaires_globales[0]));
    $max_globale_slot = date('H:i:s', strtotime(end($horaires_globales)));

    $min_globale_slot = substr($key, 0, 11) . $min_globale_slot;
    $max_globale_slot = substr($key, 0, 11) . $max_globale_slot;

    if ($key >= $min_globale_slot && $key <= $max_globale_slot) {

        if ($key >= $min_time_slot && $key <= $max_time_slot) { ?>
            <label class="reservation_field" for="<?= $key ?>" onclick="updateReservationCalendarField(this)"><?= $value ?></label>
            <input id="<?= $key ?>" type="checkbox" name="date[]" value="<?= $key ?>">
        <?php }
        else { ?>
            <label class="reservation_field" for="<?= $key ?>" onclick="updateReservationCalendarField(this)">close</label>
            <input id="<?= $key ?>" type="checkbox" name="date[]" value="<?= $key ?>">
        <?php }
    }
}





// Affiche le calendrier de réservation admin
function displayCalendarAdmin($reservation_time_slots)
{
    $index = 0;
    foreach ($reservation_time_slots as $key => $value) {

        if ($index != 0) {

            // Détecte si il y a changement de jour
            $next_day = substr_compare($key, $prev_key, 0, 10);

            if ($next_day == 1) {
                echo '</div>';
                echo '<div class="day">';
                $date = date('l d M Y', strtotime($key));
                $date = englishDateToFrench($date, ' ');
                echo '<h4>' . $date . '</h4>';
            }
        }
        else {
            $date = date('l d M Y', strtotime($key));
            $date = englishDateToFrench($date, ' ');
            echo '<h4>' . $date . '</h4>';
        }

        $day = date('D', strtotime($key));

        switch ($day) {
            case 'Mon':
                displayCalendarDayAdmin($key, $value, HORAIRES_OUVERTURE_LUNDI, HORAIRES_FERMETURE_LUNDI);
                break;
            case 'Tue':
                displayCalendarDayAdmin($key, $value, HORAIRES_OUVERTURE_MARDI, HORAIRES_FERMETURE_MARDI);
                break;
            case 'Wed':
                displayCalendarDayAdmin($key, $value, HORAIRES_OUVERTURE_MERCREDI, HORAIRES_FERMETURE_MERCREDI);
                break;
            case 'Thu':
                displayCalendarDayAdmin($key, $value, HORAIRES_OUVERTURE_JEUDI, HORAIRES_FERMETURE_JEUDI);
                break;
            case 'Fri':
                displayCalendarDayAdmin($key, $value, HORAIRES_OUVERTURE_VENDREDI, HORAIRES_FERMETURE_VENDREDI);
                break;
            case 'Sat':
                displayCalendarDayAdmin($key, $value, HORAIRES_OUVERTURE_SAMEDI, HORAIRES_FERMETURE_SAMEDI);
                break;
            case 'Sun':
                displayCalendarDayAdmin($key, $value, HORAIRES_OUVERTURE_DIMANCHE, HORAIRES_FERMETURE_DIMANCHE);
                break;
        }

        $prev_key = $key;
        $index++;
    }
}





// Insertion d'une nouvelle réservation
function updateReservation($time_slot, $row, $connexion)
{
    $query_insert = $connexion->prepare("UPDATE reservation SET time_slot = '$time_slot', status = 'reserve' WHERE time_slot LIKE '$row->time_slot' AND status = 'libre'");
    $query_insert->execute();
}



// Fermeture d'un créneau horaire
function closeTimeSlot($time_slot, $row, $connexion)
{
    $query_insert = $connexion->prepare("UPDATE reservation SET status = 'close' WHERE time_slot LIKE '$row->time_slot' AND status = 'libre' OR status = 'reserve'");
    $query_insert->execute();
}

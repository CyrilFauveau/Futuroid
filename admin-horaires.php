<?php
include_once('body/header.php');
include_once('PDO/connexion.php');
include_once('config.php');
include_once('functions_helper.php');

if (!empty($_POST['HORAIRES_OUVERTURE_MINIMUM']) && !empty($_POST['HORAIRES_FERMETURE_MAXIMUM']) && !empty($_POST['HORAIRES_OUVERTURE_LUNDI']) && !empty($_POST['HORAIRES_FERMETURE_LUNDI']) && !empty($_POST['HORAIRES_OUVERTURE_MARDI']) && !empty($_POST['HORAIRES_FERMETURE_MARDI']) && !empty($_POST['HORAIRES_OUVERTURE_MERCREDI']) && !empty($_POST['HORAIRES_FERMETURE_MERCREDI']) && !empty($_POST['HORAIRES_OUVERTURE_JEUDI']) && !empty($_POST['HORAIRES_FERMETURE_JEUDI']) && !empty($_POST['HORAIRES_OUVERTURE_VENDREDI']) && !empty($_POST['HORAIRES_FERMETURE_VENDREDI']) && !empty($_POST['HORAIRES_OUVERTURE_SAMEDI']) && !empty($_POST['HORAIRES_FERMETURE_SAMEDI']) && !empty($_POST['HORAIRES_OUVERTURE_DIMANCHE']) && !empty($_POST['HORAIRES_FERMETURE_DIMANCHE'])) {

    $path = 'config.php';
    $config = file($path);

    // Uniformise les horaires
    foreach ($_POST as $key => $value) {
        if (strlen($value) == 5) {
            $_POST[$key] = $_POST[$key] . ':00';
        }
    }

    // Rentre les horaires dans le fichier de config
    for ($i = 0; $i < count($config); $i++) {
        foreach ($_POST as $key => $value) {
            if (strpos($config[$i], $key)) {
                $config[$i] = "define('" . $key . "', '" . $value . "');\n";
            }
        }
        if (strpos($config[$i], 'HORAIRES_GLOBALES')) {

            $hour = substr($_POST['HORAIRES_OUVERTURE_MINIMUM'], 0, 2);
            $all_array_define = '';

            while ($hour <= substr($_POST['HORAIRES_FERMETURE_MAXIMUM'], 0, 2)) {

                if ($hour == substr($_POST['HORAIRES_FERMETURE_MAXIMUM'], 0, 2)) {
                    $array_define = "'" . $hour . ":00:00" . "'";
                    $all_array_define =  $all_array_define . $array_define;
                }
                else {
                    $array_define = "'" . $hour . ":00:00" . "'";
                    $all_array_define =  $all_array_define . $array_define . ', ';
                }

                $hour += 1;
            }
            $new_define = "define('HORAIRES_GLOBALES', serialize(array(" . $all_array_define . ")));\n";
            $config[$i] = $new_define;
        }
    }
    file_put_contents($path, $config);
}

if (isset($_SESSION['connected'])) { ?>

    <main class="block-main admin">
        <div class="banniere banniere-reserver">
            <h2>HORAIRES</h2>
        </div>

        <form class="form-admin-horaires" action="admin-horaires.php" method="post">
            <div class="day">
                <label>Horaires :</label>
                <input type="time" name="HORAIRES_OUVERTURE_MINIMUM" value="<?= HORAIRES_OUVERTURE_MINIMUM ?>" min="" max="">
                <input type="time" name="HORAIRES_FERMETURE_MAXIMUM" value="<?= HORAIRES_FERMETURE_MAXIMUM ?>" min="" max="">
            </div>
            <div class="day">
                <label>Lundi :</label>
                <input type="time" name="HORAIRES_OUVERTURE_LUNDI" value="<?= HORAIRES_OUVERTURE_LUNDI ?>" min="<?= HORAIRES_OUVERTURE_MINIMUM ?>" max="<?= HORAIRES_FERMETURE_MAXIMUM ?>">
                <input type="time" name="HORAIRES_FERMETURE_LUNDI" value="<?= HORAIRES_FERMETURE_LUNDI ?>" min="<?= HORAIRES_OUVERTURE_MINIMUM ?>" max="<?= HORAIRES_FERMETURE_MAXIMUM ?>">
            </div>
            <div class="day">
                <label>Mardi :</label>
                <input type="time" name="HORAIRES_OUVERTURE_MARDI" value="<?= HORAIRES_OUVERTURE_MARDI ?>" min="<?= HORAIRES_OUVERTURE_MINIMUM ?>" max="<?= HORAIRES_FERMETURE_MAXIMUM ?>">
                <input type="time" name="HORAIRES_FERMETURE_MARDI" value="<?= HORAIRES_FERMETURE_MARDI ?>" min="<?= HORAIRES_OUVERTURE_MINIMUM ?>" max="<?= HORAIRES_FERMETURE_MAXIMUM ?>">
            </div>
            <div class="day">
                <label>Mercredi :</label>
                <input type="time" name="HORAIRES_OUVERTURE_MERCREDI" value="<?= HORAIRES_OUVERTURE_MERCREDI ?>" min="<?= HORAIRES_OUVERTURE_MINIMUM ?>" max="<?= HORAIRES_FERMETURE_MAXIMUM ?>">
                <input type="time" name="HORAIRES_FERMETURE_MERCREDI" value="<?= HORAIRES_FERMETURE_MERCREDI ?>" min="<?= HORAIRES_OUVERTURE_MINIMUM ?>" max="<?= HORAIRES_FERMETURE_MAXIMUM ?>">
            </div>
            <div class="day">
                <label>Jeudi :</label>
                <input type="time" name="HORAIRES_OUVERTURE_JEUDI" value="<?= HORAIRES_OUVERTURE_JEUDI ?>" min="<?= HORAIRES_OUVERTURE_MINIMUM ?>" max="<?= HORAIRES_FERMETURE_MAXIMUM ?>">
                <input type="time" name="HORAIRES_FERMETURE_JEUDI" value="<?= HORAIRES_FERMETURE_JEUDI ?>" min="<?= HORAIRES_OUVERTURE_MINIMUM ?>" max="<?= HORAIRES_FERMETURE_MAXIMUM ?>">
            </div>
            <div class="day">
                <label>Vendredi :</label>
                <input type="time" name="HORAIRES_OUVERTURE_VENDREDI" value="<?= HORAIRES_OUVERTURE_VENDREDI ?>" min="<?= HORAIRES_OUVERTURE_MINIMUM ?>" max="<?= HORAIRES_FERMETURE_MAXIMUM ?>">
                <input type="time" name="HORAIRES_FERMETURE_VENDREDI" value="<?= HORAIRES_FERMETURE_VENDREDI ?>" min="<?= HORAIRES_OUVERTURE_MINIMUM ?>" max="<?= HORAIRES_FERMETURE_MAXIMUM ?>">
            </div>
            <div class="day">
                <label>Samedi :</label>
                <input type="time" name="HORAIRES_OUVERTURE_SAMEDI" value="<?= HORAIRES_OUVERTURE_SAMEDI ?>" min="<?= HORAIRES_OUVERTURE_MINIMUM ?>" max="<?= HORAIRES_FERMETURE_MAXIMUM ?>">
                <input type="time" name="HORAIRES_FERMETURE_SAMEDI" value="<?= HORAIRES_FERMETURE_SAMEDI ?>" min="<?= HORAIRES_OUVERTURE_MINIMUM ?>" max="<?= HORAIRES_FERMETURE_MAXIMUM ?>">
            </div>
            <div class="day">
                <label>Dimanche :</label>
                <input type="time" name="HORAIRES_OUVERTURE_DIMANCHE" value="<?= HORAIRES_OUVERTURE_DIMANCHE ?>" min="<?= HORAIRES_OUVERTURE_MINIMUM ?>" max="<?= HORAIRES_FERMETURE_MAXIMUM ?>">
                <input type="time" name="HORAIRES_FERMETURE_DIMANCHE" value="<?= HORAIRES_FERMETURE_DIMANCHE ?>" min="<?= HORAIRES_OUVERTURE_MINIMUM ?>" max="<?= HORAIRES_FERMETURE_MAXIMUM ?>">
            </div>

            <input type="submit" name="" value="Modifier les horaires">
        </form>
    </main>

<?php }

else {
    header('location: index.php');
}

include_once('body/footer.php');

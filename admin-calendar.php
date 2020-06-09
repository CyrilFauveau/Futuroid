<?php
include_once('body/header.php');
include_once('PDO/connexion.php');
include_once('config.php');
include_once('functions_helper.php');

if (isset($_SESSION['connected'])) { ?>

    <main class="block-main admin">
        <div class="banniere banniere-reserver">
            <h2>RÉSERVATIONS</h2>
        </div>

        <form class="wrapper" action="check_admin.php" method="post">
            <div class="first-step">
                <div class="form-step-2">
                    <div class="item calendar">
                        <?php
                        $first_day = date('Y-m-d', strtotime("this week"));
                        $reservation_time_slots = getAllTimeSlotsByWeek($first_day, $connexion);
                        ?>

                        <div class="day">
                            <?php
                            foreach (unserialize(HORAIRES_GLOBALES) as $value) {
                                $hour = substr($value, 0, 2);
                                if ($hour[0] == 0) {
                                    $hour = substr($hour, 1, 1);
                                }
                                $hour_sup = $hour + 1;
                                echo '<div>' . $hour . 'h' . ' - ' . $hour_sup . 'h' . '</div>';
                            }
                            ?>
                        </div>

                        <div class="day">
                            <?php displayCalendarAdmin($reservation_time_slots); ?>
                        </div>
                    </div>

                    <div class="">
                        <p>Semaine Précédente</p>
                        <p>Semaine Suivante</p>
                    </div>
                </div>
            </div>

            <div class="buttons">
                <input type="submit" class="liens lien-reserver" name="" value="Valider">
            </div>
        </form>
    </main>

    <script src="js/admin.js"></script>

<?php }

else {
    header('location: index.php');
}

include_once('body/footer.php');

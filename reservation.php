<?php
include_once('body/header.php');
include_once('PDO/connexion.php');
include_once('config.php');
include_once('functions_helper.php');
?>

<main class="block-main">
    <div class="banniere banniere-reserver">
        <h2>RESERVATION</h2>
        <p class="resume-title">texte complémentaire</p>
    </div>

    <form id="regForm" class="wrapper" action="reservation_recapitulatif.php" method="post">
        <h2 class="h3-title h3-reserver">Etapes :</h2>

        <ul class="liste liste-etapes">
            <li class="step active">LE JEU</li>
            <li class="step active">VOS INFORMATIONS</li>
            <li class="step">RECAPITULATIF</li>
        </ul>
        <p class="indications">Les champs suivi d’une astérisque * sont obligatoires.</p>


        <!-- <div class="first-step">
            <h3 class="h3-title">Un code promo ? (falcutatif)</h3>
            <div class="form-reserver">
                <input type="text" name="promo" placeholder="Indiquer votre code promo" size="50">
                <p class="indications">Si vous avez plusieurs codes promos, vous pouvez en utiliser plusieurs en les séparant par une virgule (seulement s'il s'agit de chèque-cadeau générique).
                Ex : ABC, DEF</p>
            </div>

            <p class="indications">Si vous souhaitez privatiser la salle ou pour tout autres demandes, contactez-nous !</p>
        </div> -->


        <div class="first-step">
            <h3 class="h3-title">Choisissez votre pack :</h3>
            <ul class="liste liste-pack">
                <li><label class="pack selected" for="classic" onclick="updateReservationPackField(this)">Pack CLASSIC</label></li>
                <li><label class="pack" for="s" onclick="updateReservationPackField(this)">Pack S</label></li>
                <li><label class="pack" for="m" onclick="updateReservationPackField(this)">Pack M</label></li>
                <li><label class="pack" for="l" onclick="updateReservationPackField(this)">Pack L</label></li>
                <li><label class="pack" for="xl" onclick="updateReservationPackField(this)">Pack XL</label></li>
                <input id="classic" type="radio" name="pack" value="pack_classic" required checked>
                <input id="s" type="radio" name="pack" value="pack_s" required>
                <input id="m" type="radio" name="pack" value="pack_m" required>
                <input id="l" type="radio" name="pack" value="pack_l" required>
                <input id="xl" type="radio" name="pack" value="pack_xl" required>
            </ul>

            <div class="form-step-2">
                <div class="item">
                    <label for="game">A quel jeu voulez-vous jouer ?</label>

                    <select id="game" name="game" required>
                        <option value="">-- Veuillez choisir un jeu --</option>
                        <option value="on_mars">On Mars</option>
                        <option value="ragnarok">RagnaRock</option>
                        <option value="propagation">Propagation</option>
                        <option value="bow_islands">Bow Islands</option>
                        <option value="ultim_8">Ultim-8</option>
                        <option value="yin">Yin</option>
                    </select>
                </div>
                <div class="item">
                    <label for="range">Combien êtes-vous ?</label>
                    <input type="range" min="1" max="12" step="1" value="0" name="nb_players" onchange="updateTextRangeInput(this.value)">
                    <span id="selRange">1</span>
                </div>
                <div for="">Quel créneau souhaitez-vous réserver ?</div>
                <div class="item calendar">

                    <?php
                    $first_day = date('Y-m-d', strtotime("this week"));
                    $reservation_time_slots = getAllTimeSlotsByWeek($first_day, $connexion);
                    ?>

                    <div class="day">
                        <h4></h4>
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
                        <?php displayCalendarClient($reservation_time_slots); ?>
                    </div>

                </div>

                <div class="item calendar">

                    <?php
                    $first_day = date('Y-m-d', strtotime("this week + 7 days"));
                    $reservation_time_slots = getAllTimeSlotsByWeek($first_day, $connexion);
                    ?>

                    <div class="day">
                        <h4></h4>
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
                        <?php displayCalendarClient($reservation_time_slots); ?>
                    </div>

                </div>

                <div class="item calendar">

                    <?php
                    $first_day = date('Y-m-d', strtotime("this week + 14 days"));
                    $reservation_time_slots = getAllTimeSlotsByWeek($first_day, $connexion);
                    ?>

                    <div class="day">
                        <h4></h4>
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
                        <?php displayCalendarClient($reservation_time_slots); ?>
                    </div>

                </div>


                <div class="">
                    <p>Semaine Précédente</p>
                    <p>Semaine Suivante</p>
                </div>

            </div>
        </div>


        <div class="second-step">
            <div class="form-infos">
                <label for="">Prénom*</label>
                <input type="text" name="nom" placeholder="Saisissez votre prenom">
                <label for="">Nom*</label>
                <input type="text" name="prenom" placeholder="Saisissez votre nom">
                <label for="">Email*</label>
                <input type="text" name="mail" placeholder="Saisissez votre email">
                <label for="">Téléphone*</label>
                <input type="text" name="tel" placeholder="Saisissez votre telephone">
            </div>
        </div>

        <div class="buttons">
            <input type="submit" class="liens lien-reserver" name="" value="Étape suivante">
        </div>


        <!-- <div class="third-step">
            <div class="recap">
                <div class="jeu">
                    <h3>Le jeu</h3>
                </div>
                <div class="more-infos">
                    <h3>Vos informations</h3>
                </div>
            </div>
        </div>


        <div class="buttons">
            <button id="prevBtn" class="liens lien-reserver" type="button">Modifier ma réservation</button>
            <button id="nextBtn" class="liens lien-reserver" type="button">Réserver</button>
        </div> -->

    </form>
</main>

<script src="js/reservation_form.js"></script>
<?php
include_once('body/footer.php');
?>

<?php
  include_once('body/header.php');
 ?>
<main class="block-main">
  <div class="banniere banniere-contact">
    <h2 class="h2">NOS JEUX</h2>
    <p class="resume-title">A chaque question une réponse</p>
  </div>

  <nav aria-label="Breadcrumb" class="breadcrumb">
      <ul>
          <li><a href="">Accueil</a></li>
          <li><a href="">Nous contacter</a></li>
      </ul>
  </nav>

  <div class="wrapper">
    <p class="intro">Besoin de conseils, d’assistance ? N’hésitez pas à nous contacter.</br>
      Les champs suivi d’une astérisque * sont obligatoires.
    </p>

      <h2 class="h2-contact">Formulaire de contact</h2>

      <div class=" wrapper-contact">
        <form class="formulaire" action="" method="post">
          <div class="form form-demande">
            <span>Sujet de la demande*</span>
            <input type="text" name="sujet" placeholder="Sujet de la demande" required>
          </div>

          <div class="form form-name">
            <span>Prénom*</span>
            <input type="text" name="prenom" placeholder="Votre prenom" required>
          </div>

          <div class="form form-mail">
            <span>Email*</span>
            <input type="email" name="mail" placeholder="Votre email" required>
          </div>

          <div class="form form-tel">
            <span>Téléphone</span>
            <input type="text" name="tel" placeholder="Votre numero de telephone">
          </div>

          <div class="form form-msg">
            <span>Message*</span>
            <textarea name="message" rows="6" cols="8" placeholder="Saisissez votre message ici" required></textarea>
          </div>

          <button type="submit" name="valider">Envoyer</button>

        </form>

        <?php
            if (!empty($_POST['sujet']) && !empty($_POST['prenom']) && !empty($_POST['mail']) && !empty($_POST['message'])) {

                $to = 'fauveaucyril@gmail.com';
                $subject = $_POST['sujet'];
                $mail = $_POST['mail'];
                $prenom = $_POST['prenom'];
                $tel = $_POST['tel'];

                $message = 'Sujet de la demande : ' . $subject . "\n";
                $message .= 'Prénom : ' . $prenom . "\n";
                $message .= 'Numéro de téléphone : ' . $tel . "\n\n";

                $message .= 'Message : ' . "\n" . $_POST['message'];

                $headers = 'From:' . $mail . "\r\n" .
                    'Reply-To:' . $mail . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();

                mail($to, $subject, $message, $headers);
            }
        ?>

        <div class="contact">
          <p class="addresse">
            22 Boulevard Gaston Birgé,</br>
            49100 Angers</br>
            02 85 29 70 00
          </p>
          <div class="rs">
            <a href="#"> <img src="img/twitter.png" alt="Twitter"> </a>
            <a href="#"> <img src="img/linkedin.png" alt="Linkedin"> </a>
            <a href="#"> <img src="img/Facebook.png" alt="Facebook"> </a>
            <a href="#"> <img class="insta" src="img/insta.png" alt="Instagram"> </a>
          </div>
        </div>
      </div>
  </div>


</main>

<?php
  include_once('body/footer.php');
 ?>

<?php session_start(); ?>

<!DOCTYPE html>
<html lang="foreach" dir="ltr">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">

      <title>Futuroid</title>
      <link rel="stylesheet" href="css/style.css">
      <link rel="stylesheet" href="css/normalize.css">
      <link href="dist/hamburgers.css" rel="stylesheet">
      <link rel="stylesheet" href="https://use.typekit.net/pbd1uth.css">
    </head>
  <body>

    <header class="block-header">
      <nav class="block-nav">
        <a href="index.php" class="logo"><img src="img/logo.png" alt="Logo-Futuroid"></a>
        <ul class="menu">
          <li><a href="index.php">Accueil</a></li>
          <li><a href="games.php">Les Jeux</a></li>
          <li><a href="offrir.php">Offrir</a></li>
          <li><a href="entreprise.php">Entreprise</a></li>
          <li><a href="contact.php">Nous contacter</a></li>
          <?php if (isset($_SESSION['connected'])): ?>
              <li><a href="admin.php">Espace Admin</a></li>
              <li><a href="logout.php">Déconnexion</a></li>
          <?php endif; ?>
        </ul>
        <a class="liens reserver" href="reservation.php">RESERVER</a>
      </nav>


      <nav class="block-nav-mobile">
        <a href="index.php" class="logo"><img src="img/logo.png" alt="Logo-Futuroid"></a>

        <button class="hamburger hamburger--slider" type="button">
          <span class="hamburger-box">
            <span class="hamburger-inner"></span>
          </span>
        </button>
        <div class=" menu-mobile">
          <ul>
            <li><a href="index.php">Accueil</a></li>
            <li><a href="games.php">Les Jeux</a></li>
            <li><a href="offrir.php">Offrir</a></li>
            <li><a href="entreprise.php">Entreprise</a></li>
            <li><a href="contact.php">Nous contacter</a></li>
            <a class="liens reserver" href="reservation.php">RESERVER</a>
          </ul>


          <div class="reseaux">
            <a href="#"><img class="rs"src="img/linkedin.png" alt="Linkedin"></a>
            <a href="#"><img class="rs" src="img/Facebook.png" alt="Facebook"></a>
            <a href="#"><img class="rs insta" src="img/insta.png" alt="Instagram"></a>
          </div>
        </div>

      </nav>

    </header>

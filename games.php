<?php
include_once("body/header.php");
 ?>

<main class="block-main">
  <div class="banniere banniere-games">
    <h2>NOS JEUX</h2>
    <p class="resume-title">faites votre choix parmi nos 6 jeux en réalité virtuelle</p>
  </div>

  <nav aria-label="Breadcrumb" class="breadcrumb">
      <ul>
          <li><a href="">Accueil</a></li>
          <li><a href="">Les jeux</a></li>
      </ul>
  </nav>

  <div class="wrapper">

    <h3 class="h3title">Filtrer par thème :</h3>
    <ul class="nav-genre">
      <li id="all " class="current" ><a href="#">TOUT</a></li>
      <li id="Futuriste"><a href="#">FUTURISTE</a></li>
      <li id="Horreur"><a href="#">HORREUR</a></li>
      <li id="Musical"><a href="#">MUSICAL</a></li>
      <li id="Fantastique"><a href="#">FANTASTIQUE</a></li>
    </ul>
    <?php
    include('PDO/connexion.php');
     $reqP = $connexion -> query("SELECT * FROM games");

     while ($game = $reqP ->fetch()) {
       echo "<div class=\"all games game-".$game->id." ".$game->theme."\">";
       echo "<img src=\"".$game->img."\" alt=\"".$game->name."\">";
       echo "<div class=\"game_infos\">";
       echo "<h3 class=\"h3-title\">".$game->name."</h3>";
       echo "<div class=\"additional_infos\">";
       echo "<ul>";
       echo "<li><img class=\"icone\" src=\"img/theme.png\">".$game->theme;
       echo "<li><img class=\"icone\" src=\"img/player.png\">".$game->nb_player." joueurs";
       echo "<li><img class=\"icone\" src=\"img/duree.png\">".$game->duration."min";
       echo "</ul>";
       echo "</div>";
       echo "<p class=\"text\">".$game->resume."</p>";
       echo "<div class=\"buttons accueil_buttons\">";
       echo "<a class=\"liens\" href=\"single_game.php?id=".$game->id."\">DECOUVRIR</a>";
       echo "<a class=\"liens blue-liens\" href=\"reserver.php\">RESERVER</a>";
       echo "</div>";
       echo "</div>";
       echo "</div>";

     }
     ?>
  </div>
</main>

<?php
include_once('body/footer.php');
 ?>

<?php
include_once("body/header.php");
 ?>

<main class="block-main">
  <div class="banniere accueil">
    <h1 class="title">REALITE VIRTUELLE SUR ANGERS</h1>
    <p class="resume-title">Une expérience multijoueur intense</p>

    <a class="liens" href="games.php">DECOUVRIR NOS JEUX</a>
  </div>

  <h2 class="h2-title">NOS JEUX</h2>
  <div class="wrapper">
    <?php
    include('PDO/connexion.php');
     $reqP = $connexion -> query("SELECT * FROM games ORDER by id LIMIT 2");

     while ($game = $reqP ->fetch()) {
       echo "<div class=\"games game-".$game->id."\"\">";
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
       echo "<div class=\"buttons\">";
       echo "<a class=\"liens\" href=\"single_game.php?id=".$game->id."\">DECOUVRIR</a>";
       echo "<a class=\"liens blue-liens\" href=\"reserver.php\">RESERVER</a>";
       echo "</div>";
       echo "</div>";
       echo "</div>";

     }
     ?>

      <a class="liens see-all" href="games.php">TOUT VOIR</a>
  </div>
</main>

<?php
include_once('body/footer.php');
 ?>

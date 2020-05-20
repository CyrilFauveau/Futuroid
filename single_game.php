<?php
include_once('body/header.php');
include_once('PDO/connexion.php');

function getGame($connexion,$nb=null,$id=null){
  if ($nb && !$id) {
    $req = $connexion->query("SELECT * FROM games LIMIT".$nb);
    $game = $req->fetchAll();
  }elseif ($id) {
    $req = $connexion->query("SELECT * FROM games WHERE id=".$id);
    $game = $req->fetchObject();
  }else {
    $req = $connexion->query("SELECT * FROM games");
    $game = $req->fetchAll();
  }
  return $game;
}
$game = getGame($connexion,1,$_GET['id']);

 ?>


<main class="block-main">
  <div class="banniere game-banniere">
    <h2 class="h2-single_game"><?= $game->name ?></h2>
    <p class="resume-title"><?= $game->texte_banniere ?></p>
  </div>

  <nav aria-label="Breadcrumb" class="breadcrumb">
      <ul>
          <li><a href="">Accueil</a></li>
          <li><a href="">Les jeux</a></li>
          <li><a href=""><?= $game->name ?></a></li>
      </ul>
  </nav>


    <div class="wrapper">


          <ul class="infos_singleGame">
            <li><img class="icone" src="img/theme.png"><?= $game->theme ?></li>
            <li><img class="icone" src="img/player.png"><?= $game->nb_player." joueurs" ?></li>
            <li><img class="icone" src="img/duree.png"><?= $game->duration." min" ?></li>
            <li><img class="icone" src="img/price.png"><?= "à partir de ".$game->name." /joueurs" ?></li>
          </ul>

      <h2 class="h2-single_game">Description</h2>
      <div class="description">
        <?= $game->resume ?>
      </div>

      <a class="lien_single_game" href="#">JE RESERVE</a>

    </div>

</main>

<?php
include_once('body/footer.php');
?>

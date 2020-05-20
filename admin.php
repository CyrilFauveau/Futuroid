<?php
include_once('body/header.php');
include_once('PDO/connexion.php');
include_once('config.php');
include_once('functions_helper.php');
?>

<main class="block-main admin">

    <?php
    if (!empty($_POST['user']) && !empty($_POST['password'])) {
        $user = $_POST['user'];
        $password = $_POST['password'];

        $query = $connexion->prepare("SELECT * FROM admin");
        $query->execute();

        while ($row = $query->fetch()) {
            if ($user == $row->user && password_verify($password, $row->password)) {
                $_SESSION['connected'] = true;
            }
            else {
                echo 'Mauvais nom d\'utilisateur ou de mot de passe';
            }
        }
    }
    ?>

    <?php if (!isset($_SESSION['connected'])): ?>

        <form class="form-connexion" action="admin.php" method="post">
            <label for="user">User</label>
            <input type="text" name="user" placeholder="User">
            <label for="password">Password</label>
            <input type="password" name="password" placeholder="Password">
            <input type="submit" name="" value="Se connecter">
        </form>

    <?php else: ?>

        <div class="">
            <a href="admin-calendar.php">Accéder au calendrier de réservation</a>
        </div>
        <div class="">
            <a href="admin-horaires.php">Modifier les horaires d'ouverture</a>
        </div>
        <div class="">
            <a href="admin-reservation.php">Modifier les disponibilités de réservation</a>
        </div>

    <?php endif; ?>

</main>

<?php include_once('body/footer.php'); ?>

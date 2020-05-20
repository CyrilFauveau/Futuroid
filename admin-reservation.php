<?php
include_once('body/header.php');
include_once('PDO/connexion.php');
include_once('config.php');
include_once('functions_helper.php');

if (isset($_SESSION['connected'])) { ?>

    

<?php }

else {
    header('location: index.php');
}

include_once('body/footer.php');

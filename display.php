<?php
//start session
session_start();
$title = "Fiche jeu"; //Title for current page
include('partials/_header.php');
include('helpers/functions.php'); //include function
//inclure PDO pour la connexion à la BDO
require_once("helpers/pdo.php");
//debug_array($_GET);

//1-verifier recup id jeu
//on verifie que l'id existe (donc pas vide) et qu'il est numérique 
if (!empty($_GET["id"]) && is_numeric($_GET["id"])) {
    //2-nettoyer id contre xss
    $id = clear_xss($_GET["id"]);
    //3-faire la query vers la BDD
    $sql = "SELECT * FROM jeux WHERE id=:id";
    //4- Preparation requete
    $query = $pdo->prepare($sql);
    //5- Securise la query contre injection SQL
    $query->bindValue(":id", $id, PDO::PARAM_INT);
    //6- Execute la query
    $query->execute();
    //7- Stocke tous dans une variable
    $game = $query->fetch();
    //debug_array($game);
    // $game = [];

    if (!$game) {
        $_SESSION["error"] = "Ce jeu n'est pas disponible !";
        header("Location: index.php");
    } else {
    }
} else {
    $_SESSION["error"] = "URL invalide !";
    header("Location: index.php");
}


?>

<div class="pt-16 wrap-content ">
    <a href="index.php" class="text-blue-500">
        <- retour</a>
            <div class="wrap-content-head text-center space-y-5">
                <h1 class="text-info text-5xl uppercase font-black"><?= $game["name"] ?></h1>
                <div class="flex justify-center">
                <?php
                if ($game["url_img"] != null) { ?>
                    <img class="" src="<?= $game["url_img"] ?>" alt="">
                <?php }
                ?>
                </div>
                <div class="flex space-x-5 justify-center">
                    <p class="pt-4"><?= $game["plateforms"] ?></p>
                    <p class="pt-4"><?= $game["genre"] ?></p>
                    <p class="pt-4"><?= $game["note"] ?>/20</p>
                    <p class="pt-4 font-bold text-success"><?= $game["price"] ?>€</p>
                </div>
                <p class="pt-4"><?= $game["description"] ?></p>
                <div>
                    <!-- <a href="delete.php?id=<?= $game["id"] ?>&name=<?= $game["name"] ?>" class="btn btn-warning ">Supprimer le jeu</a> -->
                    <a href="update.php?id=<?= $game["id"] ?>&name=<?= $game["name"] ?>" class="btn btn-info ">Modifier le jeu</a>
                    <?php include("partials/_modal.php") ?>
                </div>

            </div>
</div>

<?php include('partials/_footer.php') ?>
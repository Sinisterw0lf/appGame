<?php
//start session
session_start();
$title = "Modifier le jeu"; //Title for current page
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
    // debug_array($game);
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
//2-Envoie vers la base de donnée
if(!empty($_POST["submitted"])) {
    //echo "Tu as cliqué";
    //2- faille xss
    require_once("validation-formulaire/include.php");
    //debug_array($_POST);
    //3- validation de chaque input
    if (count($error) == 0) {
        require_once("sql/updateGameSQL.php");
        //inscription en BS
    }
}
?>

<div class="pt-16">
    <a href="display.php?id=<?= $game["id"] ?>&name=<?= $game["name"] ?>" class="text-blue-500">
        <- retour</a>
            <div class="text-center space-y-5">
                <h1 class="text-info text-5xl uppercase font-black">Modifier un jeu</h1>
            </div>

</div>

<div>
    <form action="" method="POST">
        <!-- input for name -->
        <div class="py-5">
            <label class="font-bold" for="name">Name : </label>
            <input type="text" name="name" class="input input-bordered w-full max-w-xs block" value="<?= $game["name"] ?>">
            <p>
                <?php if (!empty($error["name"])) {
                    echo $error["name"];
                }
                ?></p>
        </div>
        <!-- input for price -->
        <div class="py-5">
            <label class="font-bold" for="price">Price : </label>
            <input type="number" step="0.01" name="price" class="input input-bordered w-full max-w-xs block" value="<?= $game["price"] ?>">
            <p>
                <?php if (!empty($error["price"])) {
                    echo $error["price"];
                }
                ?></p>
        </div>
        <!-- input for genre -->
        <?php
        $genreArray = [
            ["name" => "RPG", "checked" => "checked"],
            ["name" => "Aventure"],
            ["name" => "Roguelike",],
            ["name" => "Infiltration",],
        ];
            // creer un new array avec valeur de BDD avec methode explode
            $arr_genre = explode("|",$game["genre"]);
            // debug_array($arr_genre)
        ?>
        <div class="mt-5 flex space-x-6">
            <h2 class="font-bold">Genre : </h2>
            <?php foreach ($genreArray as $genre) : ?>
                <div class="flex item-center space-x-3">
                    <label>
                        <?= $genre["name"] ?>
                    </label>
                    <input type="checkbox" class="checkbox" name='genre[]' value="<?= $genre["name"] ?>" <?php 
                                                                                                                if (in_array($genre["name"], $arr_genre)) echo "checked";
                                                                                                             ?> />

                </div>
            <?php endforeach ?>

        </div>
        <p>
            <?php if (!empty($error["genre"])) {
                echo $error["genre"];
            }
            ?></p>
        <!-- input for note -->
        <div class="py-5">
            <label class="font-bold" for="note">Note : </label>
            <input type="number" step="0.1" name="note" class="input input-bordered w-full max-w-xs block" value="<?= $game["note"] ?>">
            <p>
                <?php if (!empty($error["note"])) {
                    echo $error["note"];
                }
                ?></p>
        </div>
        <!-- input for plateforms -->
        <?php
        $plateformArray = [
            ["name" => "Switch", "checked" => "checked"],
            ["name" => "PS5"],
            ["name" => "PS4",],
            ["name" => "PC",],
            ["name" => "Playstation 2",],
            ["name" => "Gameboy Advance",],
            ["name" => "Playstation",],
        ];
        $arr_platform = explode("|", $game["plateforms"]);
        ?>
        <div class="mt-5 flex space-x-6">
            <h2 class="font-bold">Plateformes : </h2>
            <?php foreach ($plateformArray as $plateform) : ?>
                <div class="flex item-center space-x-3">
                    <label>
                        <?= $plateform["name"] ?>
                    </label>
                    <input type="checkbox" class="checkbox" name='plateforms[]' value="<?= $plateform["name"] ?>" <?php  if (in_array($plateform["name"], $arr_platform)) echo "checked"; ?> />

                </div>
            <?php endforeach ?>

        </div>
        <p>
            <?php if (!empty($error["plateforms"])) {
                echo $error["plateforms"];
            }
            ?></p>
        <!-- input for description -->
        <div class="py-5 ">
            <label class="font-bold" for="description">Description : </label>
            <textarea name="description" class="textarea textarea-bordered block" cols="60" rows="5"><?= $game["description"] ?></textarea>
            <p>
                <?php if (!empty($error["description"])) {
                    echo $error["description"];
                }
                ?>
            </p>
        </div>
        <!-- input for PEGI -->
        <?php
        $pegiArray = [
            ["name" => 3],
            ["name" => 7],
            ["name" => 12],
            ["name" => 16],
            ["name" => 18],
        ]
        ?>
        <div class="py-5">
            <label class="font-bold" for="pegi">PEGI : </label>
            <select name="pegi" class="select select-bordered w-full max-w-xs">
                <option disabled selected>Le PEGI de votre jeu</option>
                <?php foreach ($pegiArray as $pegi) : ?>
                    <option value="<?= $pegi["name"] ?>" <?php
                                                            if($game["PEGI"] == $pegi["name"]) echo 'selected="selected"';
                                                            ?>>
                        <?= $pegi["name"] ?></option>

                <?php endforeach ?>
            </select>
            <p>
                <?php if (!empty($error["pegi"])) {
                    echo $error["pegi"];
                }
                ?></p>
        </div>
        <!-- //input id -->
        <input type="hidden" name="id" value=""<?=$game["id"] ?>>
        <div>
            <input type="submit" name="submitted" value="Update" class="btn bg-blue-500">
        </div>
    </form>
</div>
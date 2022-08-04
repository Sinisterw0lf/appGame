<?php
session_start();
$title = "Home"; //Title for current page
include('partials/_header.php'); //include helper
include('helpers/functions.php'); //include function
//inclure PDO pour la connexion à la BDO
require_once("helpers/pdo.php");

$error = [];
$errorMessage  = "<span class=text-red-500>* Ce champ est obligatoire ! </span>";
$success = false;

//1- Je vérifie que le bouton submit fonctionne en affichant un message echo "Tu as cliqué"
if (!empty($_POST["submitted"])) {
    //echo "Tu as cliqué";
    //2- faille xss
    $nom = clear_xss($_POST["name"]);
    $prix = clear_xss($_POST["price"]);
    $genres = !empty($_POST["genre"]) ? $_POST["genre"] : [];
    $genre_clear = [];
    foreach ($genres as $genre) {
        $genre_clear[] =  clear_xss($genre);
    };
    $note = clear_xss($_POST["note"]);
    $plateforms = !empty($_POST["plateforms"]) ? $_POST["plateforms"] : [];
    $plateform_clear = [];
    foreach ($plateforms as $plateform) {
        $plateform_clear[] = clear_xss($plateform);
    }
    $description = clear_xss($_POST["description"]);
    $pegi = clear_xss($_POST["pegi"]);
    //debug_array($_POST);
    //3- validation de chaque input
    if (!empty($nom)) {
        if (strlen($nom) <= 2) {
            $error["name"] = "<span class=text-danger>*3 caractères minimum</span>";
        } elseif (strlen($nom) > 100) {
            $error["name"] = "<span class=text-danger>*100 caractères maximum</span>";
        }
    } else {
        $error["name"] = $errorMessage;
    }
    if (!empty($prix)) {
        if (!is_numeric($prix) && is_float($prix)) {
            $error["price"] = "<span class=text-red-500>*Veuillez mettre un prix !</span>";
        } elseif ($prix < 0) {
            $error["price"] = "<span class=text-red-500>*Veuillez entrer un prix supérieur à 0€ !</span>";
        } elseif ($prix > 200) {
            $error["price"] = "<span class=text-red-500>*Veuillez entrer un prix inférieur à 200€ !</span>";
        }
    } else {
        $error["price"] = $errorMessage;
    }
    if (!empty($genre_clear)) {
        $genre = $genre_clear;
        if ($genre == "RPG" || $genre == "Aventure" || $genre == "Roguelike" || $genre == "Infiltration") {
            echo "";
        } else {
            $error["genre"] = "C'est incorrect !";
        }
    } else {
        $error["genre"] = $errorMessage;
    }
    if (!empty($note)) {
        if (!is_numeric($note)) {
            $error["note"] = "<span class=text-red-500>*Veuillez mettre un nombre !</span>";
        } elseif ($note < 0) {
            $error["note"] = "<span class=text-red-500>*Note non autorisée !</span>";
        }
    } else {
        $error["note"] = $errorMessage;
    }
    if (!empty($plateform_clear)) {
        $plateform = $plateform_clear;
        if ($plateform == "Switch" || $plateform == "PS5" || $plateform == "PS4" || $plateform == "PC" || $plateform == "Playstation 2" || $plateform == "Gameboy Advance" || $plateform == "Playstation") {
            echo "";
        } else {
            $error["plateforms"] = "C'est incorrect !";
        }
    } else {
        $error["plateforms"] = $errorMessage;
    }
    if (!empty($description)) {
        if (strlen($description) <= 9) {
            $error["description"] = "<span class=text-danger>*10 caractères minimum</span>";
        } elseif (strlen($description) > 200) {
            $error["description"] = "<span class=text-danger>*200 caractères maximum</span>";
        }
    } else {
        $error["description"] = $errorMessage;
    }
    if (!empty($pegi)) {
    } else {
        $error["pegi"] = $errorMessage;
    }
    if (count($error) == 0) {
        $success = true;
        //inscription en BS
    }
}
?>

<section class="py-12">
    <div class="text-center space-y-5">
        <h1 class="text-info text-5xl uppercase font-black">Ajouter un jeu</h1>
    </div>

    <form action="" method="POST">
        <!-- input for name -->
        <div class="py-5">
            <label class="font-bold" for="name">Name : </label>
            <input type="text" name="name" class="input input-bordered w-full max-w-xs block" value="<?php if (!empty($_POST["name"])) {
                                                                                                            echo $_POST["name"];
                                                                                                        } ?>">
            <p>
                <?php if (!empty($error["name"])) {
                    echo $error["name"];
                }
                ?></p>
        </div>
        <!-- input for price -->
        <div class="py-5">
            <label class="font-bold" for="price">Price : </label>
            <input type="number" step="0.01" name="price" class="input input-bordered w-full max-w-xs block" value="<?php if (!empty($_POST["price"])) {
                                                                                                                        echo $_POST["price"];
                                                                                                                    } ?>">
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
        ]

        ?>
        <div class="mt-5 flex space-x-6">
            <h2 class="font-bold">Genre : </h2>
            <?php foreach ($genreArray as $genres) : ?>
                <div class="flex item-center space-x-3">
                    <label>
                        <?= $genres["name"] ?>
                    </label>
                    <input type="checkbox" class="checkbox" name='genre[]'  value="<?= $genres["name"] ?>" <?= !empty($genre["checked"]) ? "checked" : ""; ?> />

                </div>
            <?php endforeach ?>
            <p>
                <?php if (!empty($error["genre"])) {
                    echo $error["genre"];
                }
                ?></p>
        </div>
        <!-- input for note -->
        <div class="py-5">
            <label class="font-bold" for="note">Note : </label>
            <input type="number" step="0.1" name="note" class="input input-bordered w-full max-w-xs block" value="<?php if (!empty($_POST["note"])) {
                                                                                                                        echo $_POST["note"];
                                                                                                                    } ?>">
            <p>
                <?php if (!empty($error["note"])) {
                    echo $error["note"];
                }
                ?></p>
        </div>
        <!-- input for plateforms -->
        <?php
        $plateformsArray = [
            ["name" => "Switch","checked" =>"checked"],
            ["name" => "PS5"],
            ["name" => "PS4",],
            ["name" => "PC",],
            ["name" => "Playstation 2",],
            ["name" => "Gameboy Advance",],
            ["name" => "Playstation",],
        ]

        ?>
        <div class="mt-5 flex space-x-6">
            <h2 class="font-bold">Plateformes : </h2>
            <?php foreach ($plateformsArray as $plateforms) : ?>
                <div class="flex item-center space-x-3">
                    <label>
                        <?= $plateforms["name"] ?>
                    </label>
                    <input type="checkbox" class="checkbox" name='plateforms[]' value="<?= $plateforms["name"] ?>" />

                </div>
            <?php endforeach ?>
            <p>
                <?php if (!empty($error["plateforms"])) {
                    echo $error["plateforms"];
                }
                ?></p>
        </div>
        <!-- input for description -->
        <div class="py-5 ">
            <label class="font-bold" for="description">Description : </label>
            <textarea name="description" class="textarea textarea-bordered block" cols="60" rows="5"></textarea>
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
                                                            if (!empty($_POST["pegi"])) {
                                                                if (($_POST["pegi"]) == $pegi) {
                                                                    echo 'selected="selected"';
                                                                };
                                                            }
                                                            ?>><?= $pegi["name"] ?></option>

                <?php endforeach ?>
            </select>
            <p>
                <?php if (!empty($error["pegi"])) {
                    echo $error["pegi"];
                }
                ?></p>
        </div>
        <div>
            <input type="submit" name="submitted" value="Ajouter" class="btn bg-blue-500">
        </div>
    </form>
</section>

<?php include('partials/_footer.php') ?>
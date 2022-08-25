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
if (!empty($_POST["submitted"]) && isset($_FILES["url_img"]) && $_FILES["url_img"]["error"] == 0) {
    //echo "Tu as cliqué";
    //2- faille xss
    require_once("validation-formulaire/include.php");
    //debug_array($_POST);
    //3- validation de chaque input
    if (count($error) == 0) {
        require_once("sql/addGameSQL.php");
        //inscription en BS
    }
}
?>
<section class="py-12">
    <a href="index.php" class="text-blue-500">
        <- retour</a>
            <div class="text-center space-y-5">
                <?php $main_title = "Ajouter un jeu";
                include("partials/_h1.php") ?>
            </div>
            <form action="" method="POST" enctype="multipart/form-data">
                <!-- input for name -->
                <div class="py-5">
                    <label class="font-bold text-blue-800" for="name">Name : </label>
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
                    <label class="font-bold text-blue-800" for="price">Price : </label>
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
                ];

                ?>
                <div class="mt-5 flex space-x-6">
                    <h2 class="font-bold text-blue-800">Genre : </h2>
                    <?php foreach ($genreArray as $genre) : ?>
                        <div class="flex item-center space-x-3">
                            <label>
                                <?= $genre["name"] ?>
                            </label>
                            <input type="checkbox" class="checkbox" name='genre[]' value="<?= $genre["name"] ?>" <?php if (!empty($_POST["genre"])) {
                                                                                                                        if (in_array($genre["name"], $_POST["genre"])) echo "checked";
                                                                                                                    } ?> />

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
                    <label class="font-bold text-blue-800" for="note">Note : </label>
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
                $plateformArray = [
                    ["name" => "Switch", "checked" => "checked"],
                    ["name" => "PS5"],
                    ["name" => "PS4",],
                    ["name" => "PC",],
                    ["name" => "Playstation 2",],
                    ["name" => "Gameboy Advance",],
                    ["name" => "Playstation",],
                ];
                ?>
                <div class="mt-5 flex space-x-6">
                    <h2 class="font-bold text-blue-800">Plateformes : </h2>
                    <?php foreach ($plateformArray as $plateform) : ?>
                        <div class="flex item-center space-x-3">
                            <label>
                                <?= $plateform["name"] ?>
                            </label>
                            <input type="checkbox" class="checkbox" name='plateforms[]' value="<?= $plateform["name"] ?>" <?php if (!empty($_POST["plateforms"])) {
                                                                                                                                if (in_array($plateform["name"], $_POST["plateforms"])) echo "checked";
                                                                                                                            } ?> />

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
                    <label class="font-bold text-blue-800" for="description">Description : </label>
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
                    <label class="font-bold text-blue-800" for="pegi">PEGI : </label>
                    <select name="pegi" class="select select-bordered w-full max-w-xs">
                        <option disabled selected>Le PEGI de votre jeu</option>
                        <?php foreach ($pegiArray as $pegi) : ?>
                            <option value="<?= $pegi["name"] ?>" <?php
                                                                    if (!empty($_POST["pegi"])) {
                                                                        if (($_POST["pegi"]) == $pegi["name"])
                                                                            echo 'selected="selected"';
                                                                    }
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
                <!-- upload img -->

                <div>
                    <label for="url_img" class="font-bold text-blue-800">Votre image : </label>
                    <input type="file" class="block py-5 " id="url_img" name="url_img" >
                    <p>
                        <?php if (!empty($error["url_img"])) {
                            echo $error["url_img"];
                        }
                        ?></p>
                </div>
                <div>
                    <input type="submit" name="submitted" value="Ajouter" class="btn bg-blue-500">
                </div>
            </form>
</section>

<?php include('partials/_footer.php') ?>
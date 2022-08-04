<?php
session_start();
$title = "Home"; //Title for current page
include('partials/_header.php'); //include helper
include('helpers/functions.php'); //include function
//inclure PDO pour la connexion à la BDO
require_once("helpers/pdo.php");
?>

<section class="py-12">
    <div class="text-center space-y-5">
        <h1 class="text-info text-5xl uppercase font-black">Ajouter un jeu</h1>
    </div>

    <form action="" method="$_POST">
        <!-- input for name -->
        <div class="py-5">
            <label class="font-bold" for="name">Name : </label>
            <input type="text" name="name" class="input input-bordered w-full max-w-xs block">
        </div>
        <!-- input for price -->
        <div class="py-5">
            <label class="font-bold" for="price">Price : </label>
            <input type="number" step="0.01" name="price" class="input input-bordered w-full max-w-xs block">
        </div>
        <!-- input for genre -->
        <?php
        $genreArray = [
            ["name" => "RPG",],
            ["name" => "Aventure"],
            ["name" => "Roguelike",],
            ["name" => "Infiltration",],
        ]

        ?>
        <div class="mt-5 flex space-x-6">
            <h2 class="font-bold">Genre : </h2>
            <?php foreach ($genreArray as $genre) : ?>
                <div class="flex item-center space-x-3">
                    <label>
                        <?= $genre["name"] ?>
                    </label>
                    <input type="checkbox" class="checkbox" name="genre" value="<?= $genre["name"] ?>" />
                </div>
            <?php endforeach ?>
        </div>
        <!-- input for note -->
        <div class="py-5">
            <label class="font-bold" for="note">Note : </label>
            <input type="number" step="0.1" name="note" class="input input-bordered w-full max-w-xs block">
        </div>
        <!-- input for plateforms -->
        <?php
        $plateformsArray = [
            ["name" => "Switch",],
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
                    <input type="checkbox" class="checkbox" name="genre" value="<?= $plateforms["name"] ?>" />
                </div>
            <?php endforeach ?>
        </div>
        <!-- input for description -->
        <div class="py-5 ">
            <label class="font-bold" for="description">Description : </label>
            <textarea name="description" class="textarea textarea-bordered block" cols="60" rows="5"></textarea>
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
            <label class="font-bold" for="">PEGI : </label>
            <select class="select select-bordered w-full max-w-xs">
                <option disabled selected>Le PEGI de votre jeu</option>
                <?php foreach ($pegiArray as $pegi) : ?>
                    <option value="<?= $pegi["name"] ?>"><?= $pegi["name"] ?></option>
                <?php endforeach ?>
            </select>
        </div>
    </form>
</section>

<?php include('partials/_footer.php') ?>
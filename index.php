<!-- header -->
<?php
session_start();
$title = "Home"; //Title for current page
include('partials/_header.php'); //include helper
include('helpers/functions.php'); //include function
//inclure PDO pour la connexion à la BDO
require_once("helpers/pdo.php");

require_once("sql/selectAllSQL.php");
?>
<!-- main content -->
<div class="pt-16 wrap-content">
    <div class="wrap-content-head text-center">
        <?php $main_title = "App Game";
        include("partials/_h1.php") ?>
        <p>L'app qui répertorie vos jeux</p>
        <div class="pt-5">
            <a href="addGame.php" class="btn btn-primary">
                Add game
            </a>
        </div>
        <?php require_once("partials/_alert.php") ?>

        <!--<button class="btn btn-primary">Click me !</button>-->
    </div>
    <!-- Table -->
    <div class="overflow-x-auto mt-16">
        <table class="table w-full">
            <!-- head -->
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Genre</th>
                    <th>Plateforme</th>
                    <th>Prix</th>
                    <th>PEGI</th>
                    <th>Voir</th>
                    <th>Supprimer</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $index = 1;
                if (count($games) == 0) {
                    echo "<tr><td class=text-center>Pas de jeux disponibles actuellement</td></tr>";
                } else { ?>
                    <?php foreach ($games as $game) : ?>
                        <!-- row 1 -->
                        <tr class="hover:text-blue-500">
                            <th class="text-red-400"><?= $index++ ?></th>
                            <td> <a class="text-blue-700 " href="display.php?id=<?= $game["id"] ?>&name=<?= $game["name"] ?>"><?= $game["name"] ?></a></td>
                            <td><?= $game["genre"] ?></td>
                            <td><?= $game["plateforms"] ?></td>
                            <td><?= $game["price"] ?></td>
                            <td><?= $game["PEGI"] ?></td>
                            <td>
                                <a href="display.php?id=<?= $game["id"] ?>&name=<?= $game["name"] ?>">
                                    <img src="assets/img/loupe.png" alt="loupe" class="w-4">
                                </a>
                            </td>
                            <td><?= include("partials/_modal.php")?></td>
                        </tr>
                    <?php endforeach ?>
                <?php }
                ?>
            </tbody>
        </table>
    </div>
</div>


</main>
<!-- end main content -->

<!-- footer -->

<?php include('partials/_footer.php') ?>
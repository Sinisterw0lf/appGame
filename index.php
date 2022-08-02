<!-- header -->
<?php
$title = "Home"; //Title for current page
include('partials/_header.php'); //include helper
include('helpers/functions.php'); //include function
//inclure PDO pour la connexion à la BDO
require_once("helpers/pdo.php");
//1- recup les jeux - Query for get all games
$sql = "SELECT * FROM jeux";
//2 - Préparer la requete
$query = $pdo->prepare($sql);

$query->execute();
//3 - Stocke le résultat dans une variable
$games = $query->fetchAll();
debug_array($games);
//$games = [];

?>
<!-- main content -->
<div class="pt-16 wrap-content">
    <div class="wrap-content-head text-center">
        <h1 class="text-info text-5xl uppercase font-black">AppGame</h1>
        <p>L'app qui répertorie vos jeux</p>
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
                </tr>
            </thead>
            <tbody>
                <?php
                if (count($games) == 0) {
                    echo "<tr><td class=text-center>Pas de jeux disponibles actuellement</td></tr>";
                } else { ?>
                    <?php foreach ($games as $game) : ?>
                        <!-- row 1 -->
                        <tr>
                            <th>1</th>
                            <td>Fire Emblem : Sacred Stones</td>
                            <td>Tactical-RPG</td>
                            <td>Gameboy Advance </td>
                            <td>15</td>
                            <td>3</td>
                            <td>
                                <a href="display.php">
                                    <img src="assets/img/loupe.png" alt="loupe" class="w-4">
                                </a>
                            </td>
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
<?php //1- recup les jeux - Query for get all games
$sql = "SELECT * FROM jeux ORDER BY name";
//2 - Préparer la requete
$query = $pdo->prepare($sql);

$query->execute();
//3 - Stocke le résultat dans une variable
$games = $query->fetchAll();
//debug_array($games);
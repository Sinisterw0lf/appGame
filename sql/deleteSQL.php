<?php
//2- Récup ID dans URL et je le clean
$id = clear_xss($_GET["id"]);
//3- request to DB
$sql = "DELETE FROM jeux WHERE id=?";
//4- prepare la requete
$query = $pdo->prepare($sql);
//5- execute la query
$query->execute([$id]);
<?php
//start session
session_start();
include('helpers/functions.php'); //include function
//inclure PDO pour la connexion à la BDO
//1- Connexion BDD
require_once("helpers/pdo.php");
//2- Récup ID dans URL et je le clean
$id = clear_xss($_GET["id"]);
//3- request to DB
$sql = "DELETE FROM jeux WHERE id=?";
//4- prepare la requete
$query = $pdo->prepare($sql);
//5- execute la query
$query->execute([$id]);

//6- Redirection
$_SESSION["success"] = "Le jeu a bien été supprimé";
header("Location:index.php")
?>
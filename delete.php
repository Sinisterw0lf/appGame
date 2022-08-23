<?php
//start session
session_start();
include('helpers/functions.php'); //include function
//inclure PDO pour la connexion à la BDO
//1- Connexion BDD
require_once("helpers/pdo.php");
require_once("sql/deleteSQL.php");

//6- Redirection
$_SESSION["success"] = "Le jeu a bien été supprimé";
header("Location:index.php")
?>
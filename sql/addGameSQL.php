<?php
//1-ecriture de la requete
$sql = "INSERT INTO jeux(name, price, genre, note, plateforms, description, PEGI, created_at) VALUES(:name, :price, :genre, :note, :plateforms, :description, :PEGI, NOW())";

//2-prepare la requete
$query = $pdo->prepare($sql);

//3-Associer chaque requete à sa valeur et protection contre injection SQL
$query->bindValue(':name',$nom, PDO::PARAM_STR);
$query->bindValue(':price', $price, PDO::PARAM_STMT);
$query->bindValue(':genre', implode("|", $genre_clear),PDO::PARAM_STR);
$query->bindValue(':note', $note, PDO::PARAM_STMT);
$query->bindValue(':plateforms', implode("|", $plateform_clear), PDO::PARAM_STR);
$query->bindValue(':description', $description, PDO::PARAM_STR);
$query->bindValue(':PEGI', $pegi, PDO::PARAM_STR);

//4-Executer la requete
$query->execute();

//5-Retour sur la page d'accueil
$_SESSION["success"] = "Le jeu a été ajouté avec succes !";
header("Location: index.php");
?>
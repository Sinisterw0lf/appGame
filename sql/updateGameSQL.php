<?php 
//1-ecrire la requete
$sql="UPDATE jeux SET name = :name, price = :price, genre = :genre, note = :note, plateforms= :plateforms, description = :description, PEGI = :PEGI, updated_at = NOW() WHERE id= :id";
//2-Preparer la requete
$query = $pdo->prepare($sql);
//3-Protection SQL et en associant requete et valeur
$query->bindValue(':id', $id, PDO::PARAM_INT);
$query->bindValue(':name', $nom, PDO::PARAM_STR);
$query->bindValue(':price', $price, PDO::PARAM_STMT);
$query->bindValue(':genre', implode("|", $genre_clear), PDO::PARAM_STR);
$query->bindValue(':note', $note, PDO::PARAM_STMT);
$query->bindValue(':plateforms', implode("|", $plateform_clear), PDO::PARAM_STR);
$query->bindValue(':description', $description, PDO::PARAM_STR);
$query->bindValue(':PEGI', $pegi, PDO::PARAM_STR);
//4-Executer la requete
$query->execute();
//5-Retour sur la page d'accueil
$_SESSION["success"] = "Le jeu a été mis à jour avec succes !";
header("Location: index.php");

?>
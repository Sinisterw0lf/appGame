<?php 
//1-ecrire la requete
$sql="UPDATE jeux SET name = :name, price = :price, genre = :genre, note = :note, plateforms= :plateforms, description = :description, PEGI = :PEGI, updated_at = NOW(),WHERE id= :id";

?>
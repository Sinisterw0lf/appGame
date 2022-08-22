<?php
$nom = clear_xss($_POST["name"]);
$price = clear_xss($_POST["price"]);
$genres = !empty($_POST["genre"]) ? $_POST["genre"] : [];
$genre_clear = [];
foreach ($genres as $genre) {
    $genre_clear[] =  clear_xss($genre);
};
$note = clear_xss($_POST["note"]);
$plateforms = !empty($_POST["plateforms"]) ? $_POST["plateforms"] : [];
$plateform_clear = [];
foreach ($plateforms as $plateform) {
    $plateform_clear[] = clear_xss($plateform);
}
$description = clear_xss($_POST["description"]);
$pegi = !empty($_POST["pegi"]) ? clear_xss($_POST["pegi"]) : [];
//debug_array($_POST);
?>
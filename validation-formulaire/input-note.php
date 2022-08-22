<?php
if (!empty($note)) {
    if (!is_numeric($note)) {
        $error["note"] = "<span class=text-red-500>*Veuillez mettre un nombre !</span>";
    } elseif ($note < 0) {
        $error["note"] = "<span class=text-red-500>*Note non autorisée !</span>";
    }
} else {
    $error["note"] = $errorMessage;
}
?>
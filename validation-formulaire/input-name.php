<?php
if (!empty($nom)) {
    if (strlen($nom) <= 2) {
        $error["name"] = "<span class=text-danger>*3 caractères minimum</span>";
    } elseif (strlen($nom) > 100) {
        $error["name"] = "<span class=text-danger>*100 caractères maximum</span>";
    }
} else {
    $error["name"] = $errorMessage;
}

?>


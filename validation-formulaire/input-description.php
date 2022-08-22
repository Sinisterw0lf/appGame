<?php
if (!empty($description)) {
    if (strlen($description) <= 9) {
        $error["description"] = "<span class=text-danger>*10 caractères minimum</span>";
    } elseif (strlen($description) > 200) {
        $error["description"] = "<span class=text-danger>*200 caractères maximum</span>";
    }
} else {
    $error["description"] = $errorMessage;
}
?>
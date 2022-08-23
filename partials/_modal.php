<!-- The button to open modal -->
<label for="<?= $game["id"] ?>" class="btn btn-error text-white modal-button">Supprimer</label>

<!-- Put this part before </body> tag -->
<input type="checkbox" id="<?= $game["id"] ?>" class="modal-toggle" />
<div class="modal">
    <div class="modal-box">
        <h3 class="font-bold text-lg">Voulez-vous supprimer ce jeu ?</h3>
        <div class="flex justify-center space-x-5 pt-5">
            <div class="modal-action">
                <label for="<?= $game["id"] ?>" class="btn btn-error"><a href="delete.php?id=<?= $game["id"] ?>&name=<?= $game["name"] ?>">Oui</a></label>
            </div>
            <div class="modal-action">
                <label for="<?= $game["id"] ?>" class="btn btn-success">Non</label>
            </div>
        </div>
    </div>
</div>


<?php


?>
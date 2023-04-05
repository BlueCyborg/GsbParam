<?php set_error_handler(function ($niveau, $message, $fichier, $ligne) { ?>
    <div class="alert alert-danger" role="alert" style="width: 50%; margin: auto;">
        <h4 class="alert-heading">Erreur de niveau <?= $niveau ?></h4>
        <p><?= $message ?> sur la <u>ligne <?= $ligne ?></u>
            <br><u>Fichier concerné</u> : <?= $fichier ?>
        </p>
        <hr>
        <p class="mb-0">En cas de difficulté, veuillez contacter l'administrateur du site.</p>
    </div>
<?php }); ?>
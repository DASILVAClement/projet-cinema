<?php

require_once '../base.php';
require_once BASE_PROJET . '/src/database/film-db.php';
require_once BASE_PROJET . '/src/database/commentaire-db.php';

session_start();

if (empty($_SESSION)) {
    header("Location: index.php");
}

$utilisateur = null;
if (isset($_SESSION["utilisateur"])) {
    $utilisateur = $_SESSION["utilisateur"];
}

$id_film = null;
if (isset($_GET['id_film'])) {
    $id_film = filter_var($_GET['id_film'], FILTER_VALIDATE_INT);
}

$id = getFilmId($id_film);

$erreurs = [];
$titre_commentaire = "";
$avis_commentaire = "";
$note_commentaire = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Le formulaire a été soumis !
    // Traiter les données du formulaire
    // Récupérer les valeurs saisies par l'utilisateur
    // Superglobale $_POST : tableau associatif
    $titre_commentaire = $_POST['titre_commentaire'];
    $avis_commentaire = $_POST['avis_commentaire'];
    $note_commentaire = $_POST['note_commentaire'];


    //Validation des données
    if (empty($titre_commentaire)) {
        $erreurs['titre_commentaire'] = "Le titre est obligatoire";
    }
    if (empty($avis_commentaire)) {
        $erreurs['avis_commentaire'] = "L'avis' est obligatoire";
    }
    if (empty($note_commentaire)) {
        $erreurs['note_commentaire'] = "La note est obligatoire";
    }
    if ($note_commentaire < 0 || $note_commentaire > 5) {
        $erreurs['note_commentaire'] = "La note doit être comprise entre 0 et 5";
    }


    // Traiter les données
    if (empty($erreurs)) {
        postCommentaire($titre_commentaire, $avis_commentaire, $note_commentaire, date("Y/m/d"), date("H:i:s"), $utilisateur["id_utilisateur"], $id['id_film']);

        header("Location: /index.php");
        exit();
    }
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="/public/assets/css/index.css">
    <title>FILM.COM</title>
</head>

<body class="bg-dark">


<?php
require_once BASE_PROJET . '/src/_partials/header.php';
?>

<div class="container">

    <?php if ($utilisateur) : ?>
        <p class="text-white mt-3">Bienvenue <?= $utilisateur["pseudo_utilisateur"] ?> </p>
    <?php endif; ?>

    <?php if ($id) : ?>

    <h1 class="text-white border-2 border-bottom border-warning">Ajouter un commentaire
        pour <?= $id['titre_film'] ?></h1>

    <div class="w-50 mx-auto shadow my-5 p-4 bg-warning rounded-5">
        <div class="text-center">
            <h1>Votre avis </h1>
        </div>
        <form action="" method="post" novalidate>

            <div class="mb-3">

                <label for="titre_commentaire" class="form-label">Titre*</label>
                <input type="text"
                       class="form-control <?= (isset($erreurs['titre_commentaire'])) ? "border border-2 border-danger" : "" ?>"
                       id="titre_commentaire" name="titre_commentaire" value="<?= $titre_commentaire ?>"
                       placeholder="Saisir le titre du commentaire"
                       aria-describedby="emailHelp">
                <?php if (isset($erreurs['titre_commentaire'])) : ?>
                    <p class="form-text text-danger"><?= $erreurs['titre_commentaire'] ?></p>
                <?php endif; ?>

            </div>

            <div class="mb-3">

                <label for="avis_commentaire" class="form-label">Resumé*</label>
                <input type="text"
                       class="form-control <?= (isset($erreurs['avis_commentaire'])) ? "border border-2 border-danger" : "" ?>"
                       id="avis_commentaire" name="avis_commentaire" value="<?= $avis_commentaire ?>"
                       placeholder="Saisir l'avis du film"
                       aria-describedby="emailHelp">
                <?php if (isset($erreurs['avis_commentaire'])) : ?>
                    <p class="form-text text-danger"><?= $erreurs['avis_commentaire'] ?></p>
                <?php endif; ?>

            </div>

            <div class="mb-3">

                <label for="note_commentaire" class="form-label">Note*</label>
                <input type="number"
                       class="form-control <?= (isset($erreurs['note_commentaire'])) ? "border border-2 border-danger" : "" ?>"
                       id="note_commentaire"
                       name="note_commentaire" value="<?= $note_commentaire ?>" placeholder="Saisir la note du film"
                       aria-describedby="emailHelp">
                <?php if (isset($erreurs['note_commentaire'])) : ?>
                    <p class="form-text text-danger"><?= $erreurs['note_commentaire'] ?></p>
                <?php endif; ?>

            </div>

            <p>* Champs obligatoires</p>

            <div class="text-center">
                <button type="submit" class="btn btn-light ">Valider</button>
            </div>

            <?php elseif (getFilmId($id_film) == null) : ?>

                <div>
                    <div>Film introuvable...</div>
                </div>

            <?php endif; ?>

        </form>
    </div>
</div>


<script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
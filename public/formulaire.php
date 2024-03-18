<?php

/**
 * @var PDO $pdo
 */
require '../src/config/db-config.php';
// Déterminer si le formulaire a été soumis
// Utilisation d'une variable superglobale $_SERVER
// $_SERVER : tableau associatif contenant des informations sur la requête HTTP
$erreurs = [];
$titre_film = "";
$duree_film = "";
$resume_film = "";
$date_sortie = "";
$pays_sortie = "";
$image_film = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Le formulaire a été soumis !
    // Traiter les données du formulaire
    // Récupérer les valeurs saisies par l'utilisateur
    // Superglobale $_POST : tableau associatif
    $titre_film = $_POST['titre_film'];
    $duree_film = $_POST['duree_film'];
    $resume_film = $_POST['resume_film'];
    $date_sortie = $_POST['date_sortie'];
    $pays_sortie = $_POST['pays_sortie'];
    $image_film = $_POST['image_film'];

    //Validation des données
    if (empty($titre_film)) {
        $erreurs['titre_film'] = "Le titre est obligatoire";
    }
    if (empty($duree_film)) {
        $erreurs['duree_film'] = "La durée est obligatoire";
    }
    if (empty($resume_film)) {
        $erreurs['resume_film'] = "Le résumé est obligatoire";
    }
    if (empty($date_sortie)) {
        $erreurs['date_sortie'] = "La date de sortie est obligatoire";
    }
    if (empty($pays_sortie)) {
        $erreurs['pays_sortie'] = "Le pays est obligatoire";
    }
    if (empty($image_film)) {
        $erreurs['image_film'] = "L'image est obligatoire";
    } elseif (!filter_var($image_film, FILTER_VALIDATE_URL, FILTER_FLAG_PATH_REQUIRED)) {
        $erreurs['image_film'] = "Le lien de l'image n'est pas valide";
    }

    // Traiter les données
    if (empty($erreurs)) {
        // Traitement des données (insertion dans une base de données)
        $requete = $pdo->prepare(query: "INSERT INTO film (titre_film, duree_film, resume_film, date_sortie, pays_sortie, image_film) VALUES (?, ?, ?, ?, ?, ?)");

        $requete->bindParam(1, $titre_film);
        $requete->bindParam(2, $duree_film);
        $requete->bindParam(3, $resume_film);
        $requete->bindParam(4, $date_sortie);
        $requete->bindParam(5, $pays_sortie);
        $requete->bindParam(6, $image_film);

        // 3. Exécution de la requête
        $requete->execute();

        // Rediriger l'utilisateur vers une autre page du site
        header("Location: ../index.php");
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
    <title>Film.com</title>
</head>
<body class="bg-dark">

<!--Menu-->
<?php include_once '../src/_partials/header.php' ?>

<div class="container">
    <h1 class="text-white border-2 border-bottom border-warning">Ajouter un film</h1>
    <div class="w-50 mx-auto shadow my-5 p-4 bg-warning rounded-5">
        <form action="" method="post" novalidate>
            <div class="mb-3">
                <label for="titre_film" class="form-label">Titre*</label>
                <input type="text"
                       class="form-control <?= (isset($erreurs['titre_film'])) ? "border border-2 border-danger" : "" ?>"
                       id="titre_film" name="titre_film" value="<?= $titre_film ?>" placeholder="Saisir le titre du film"
                       aria-describedby="emailHelp">
                <?php if (isset($erreurs['titre_film'])) : ?>
                    <p class="form-text text-danger"><?= $erreurs['titre_film'] ?></p>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="duree_film" class="form-label">Durée*</label>
                <input type="number"
                       class="form-control <?= (isset($erreurs['duree_film'])) ? "border border-2 border-danger" : "" ?>"
                       id="duree_film"
                       name="duree_film" value="<?= $duree_film ?>" placeholder="Saisir la durée du film"
                       aria-describedby="emailHelp">
                <?php if (isset($erreurs['duree_film'])) : ?>
                    <p class="form-text text-danger"><?= $erreurs['duree_film'] ?></p>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="resume_film" class="form-label">Resumé*</label>
                <input type="text"
                       class="form-control <?= (isset($erreurs['resume_film'])) ? "border border-2 border-danger" : "" ?>"
                       id="resume_film" name="resume_film" value="<?= $resume_film ?>" placeholder="Saisir le résumé du film"
                       aria-describedby="emailHelp">
                <?php if (isset($erreurs['resume_film'])) : ?>
                    <p class="form-text text-danger"><?= $erreurs['resume_film'] ?></p>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="date_sortie" class="form-label">Date de sortie*</label>
                <input type="date"
                       class="form-control  <?= (isset($erreurs['date_sortie'])) ? "border border-2 border-danger" : "" ?>"
                       id="date_sortie" name="date_sortie" value="<?= $date_sortie ?>"
                       placeholder="Saisir la date de sortie"
                       aria-describedby="emailHelp">
                <?php if (isset($erreurs['date_sortie'])) : ?>
                    <p class="form-text text-danger"><?= $erreurs['date_sortie'] ?></p>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="pays_sortie" class="form-label">Pays*</label>
                <input type="text"
                       class="form-control <?= (isset($erreurs['pays_sortie'])) ? "border border-2 border-danger" : "" ?>"
                       id="pays_sortie" name="pays_sortie" value="<?= $pays_sortie ?>" placeholder="Saisir le pays"
                       aria-describedby="emailHelp">
                <?php if (isset($erreurs['pays_sortie'])) : ?>
                    <p class="form-text text-danger"><?= $erreurs['pays_sortie'] ?></p>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="image_film" class="form-label">Image*</label>
                <input type="text"
                       class="form-control <?= (isset($erreurs['image_film'])) ? "border border-2 border-danger" : "" ?>"
                       id="image_film" name="image_film" value="<?= $image_film ?>" placeholder="Saisir un lien pour l'image du film"
                       aria-describedby="emailHelp">
                <?php if (isset($erreurs['image_film'])) : ?>
                    <p class="form-text text-danger"><?= $erreurs['image_film'] ?></p>
                <?php endif; ?>
            </div>
            <button type="submit" class="btn btn-light">Valider</button>
        </form>
    </div>
</div>


<script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
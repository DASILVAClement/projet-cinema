<?php
session_start();

require_once '../base.php';
require_once BASE_PROJET . '/src/database/user-db.php';

if (!empty($_SESSION)) {
    header("Location: index.php");
}

// Déterminer si le formulaire a été soumis
// Utilisation d'une variable superglobale $_SERVER
// $_SERVER : tableau associatif contenant des informations sur la requête HTTP
$erreurs = [];
$email_utilisateur = "";
$mdp_utilisateur = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Le formulaire a été soumis !
    // Traiter les données du formulaire
    // Récupérer les valeurs saisies par l'utilisateur
    // Superglobale $_POST : tableau associatif
    $email_utilisateur = $_POST['email_utilisateur'];
    $mdp_utilisateur = $_POST['mdp_utilisateur'];
    //Validation des données
    if (empty($email_utilisateur)) {
        $erreurs['email_utilisateur'] = "L'email est obligatoire";
    } elseif (!filter_var($email_utilisateur, FILTER_VALIDATE_EMAIL)) {
        $erreurs['email_utilisateur'] = "L'email n'est pas valide";
        if (empty($mdp_utilisateur)) {
            $erreurs['mdp_utilisateur'] = "Le mot de passe est obligatoire";
        }
    }


    $email_user = getUser($email_utilisateur);
    $mot_de_passe = getMotDePasse($email_utilisateur);
    if ($email_user) {
        foreach ($email_user as $donne_user) {
            foreach ($mot_de_passe as $mdp_user) {
                if (password_verify($mdp_utilisateur, $mdp_user)) {
                    session_start();
                    $_SESSION["utilisateur"] = [
                        "pseudo_utilisateur" => $donne_user["pseudo_utilisateur"],
                        "id_utilisateur" => $donne_user["id_utilisateur"]
                    ];
                    header("Location: ../index.php");
                    exit();
                } else {
                    $erreurs['email_utilisateur'] = "identifiants incorrects";
                    $erreurs['mdp_utilisateur'] = "identifiants incorrects";
                }
            }
        }

    } else {
        $erreurs['email_utilisateur'] = "identifiants incorrects";
        $erreurs['mdp_utilisateur'] = "identifiants incorrects";
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
    <title>FILM.COM</title>
</head>

<body class="bg-dark">

<?php
require_once BASE_PROJET . '/src/_partials/header.php';
?>

<div class="container">

    <h1 class="text-white border-2 border-bottom border-warning">Connexion à votre compte </h1>

    <?php if (isset($erreurs['identifiant'])) : ?>
        <p class="form-text text-danger"><?= $erreurs['identifiant'] ?></p>
    <?php endif; ?>

    <div class="w-50 mx-auto shadow my-5 p-4 bg-warning rounded-5">

        <form action="" method="post" novalidate="">

            <ul class="nav nav-pills nav-justified mb-3 shadow rounded-3 bg-white" id="ex1" role="tablist">

                <li class="nav-item" role="presentation">
                    <a
                            class="nav-link active bg-black text-white"
                            id="tab-login"
                            data-mdb-pill-init
                            href="connexion-compte.php"
                            role="tab"
                            aria-controls="connexion_compte.php"
                            aria-selected="true"
                    >Connexion</a>
                </li>

                <li class="nav-item" role="presentation">
                    <a
                            class="nav-link text-black"
                            id="tab-register"
                            data-mdb-pill-init
                            href="creation-compte.php"
                            role="tab"
                            aria-controls="creation_compte.php"
                            aria-selected="false"
                    >Inscription</a>
                </li>

            </ul>

            <div class="mb-3">

                <label for="email_utilisateur" class="form-label">Email*</label>
                <input type="email"
                       class="form-control <?= (isset($erreurs['email_utilisateur'])) ? "border border-2 border-danger" : "" ?>"
                       id="email_utilisateur"
                       name="email_utilisateur" value="<?= ($erreurs) ? "" : $email_utilisateur ?>"
                       placeholder="Saisir votre email"
                       aria-describedby="emailHelp">
                <?php if (isset($erreurs['email_utilisateur'])) : ?>
                    <p class="form-text text-danger"><?= $erreurs['email_utilisateur'] ?></p>
                <?php endif; ?>

            </div>

            <div class="mb-3">

                <label for="mdp_utilisateur" class="form-label">Mot de passe*</label>
                <input type="password"
                       class="form-control <?= (isset($erreurs['mdp_utilisateur'])) ? "border border-2 border-danger" : "" ?>"
                       id="mdp_utilisateur" name="mdp_utilisateur"
                       value="<?= (!empty($erreurs)) ? $mdp_utilisateur : "" ?>" placeholder="Saisir votre mot de passe"
                       aria-describedby="emailHelp">
                <?php if (isset($erreurs['mdp_utilisateur'])) : ?>
                    <p class="form-text text-danger"><?= $erreurs['mdp_utilisateur'] ?></p>
                <?php endif; ?>

            </div>

            <p>* Champs obligatoires</p>

            <div class="text-center">
                <button type="submit" class="btn btn-light ">Valider</button>
            </div>

        </form>
    </div>
</div>

<script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
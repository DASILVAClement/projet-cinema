<?php
session_start();

require_once '../base.php';
require_once BASE_PROJET . '/src/database/utilisateur-db.php';

$erreurs = [];
$email_utilisateur = "";
$mdp_utilisateur = "";
$identifiant = "";

$comptes = getComptes();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Le formulaire a été soumis !
    // Traiter les données du formulaire
    // Récupérer les valeurs saisies par l'utilisateur
    // Superglobale $_POST : tableau associatif
    $email_utilisateur = $_POST['email_utilisateur'];
    $mdp_utilisateur = $_POST['mdp_utilisateur'];

    if (empty($email_utilisateur)) {
        $erreurs['email_utilisateur'] = "L'email est obligatoire";
    }
    if (empty($mdp_utilisateur)) {
        $erreurs['mdp_utilisateur'] = "L'email ou le mot de passe n'est pas correct";
    }

    if (empty($erreurs)) {
        foreach ($comptes as $compte) {
            if (!getEmail($email_utilisateur) || password_verify($mdp_utilisateur, $compte['mdp_utilisateur'])) {
                $erreurs['identifiant'] = "L'email ou le mot de passe n'est pas correct";
            } else {
                $_SESSION['pseudo'] = $compte['pseudo_utilisateur'];
                header("Location: ../index.php");
                exit();
            }
        }
    }
}
?>
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
<?php require_once BASE_PROJET . '/src/_partials/header.php'; ?>

<div class="container ">
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
                            href="connexion_compte.php"
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
                            href="creation_compte.php"
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
                       name="email_utilisateur" value="<?= $email_utilisateur ?>" placeholder="Saisir un email valide"
                       aria-describedby="emailHelp">
                <?php if (isset($erreurs['email_utilisateur'])) : ?>
                    <p class="form-text text-danger"><?= $erreurs['email_utilisateur'] ?></p>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="email_utilisateur" class="form-label">Mot de passe*</label>
                <input type="password"
                       class="form-control <?= (isset($erreurs['mdp_utilisateur'])) ? "border border-2 border-danger" : "" ?>"
                       id="mdp_utilisateur" name="mdp_utilisateur" value="<?= $mdp_utilisateur ?>"
                       placeholder="Saisir votre mot de passe"
                       aria-describedby="emailHelp">
                <?php if (isset($erreurs['mdp_utilisateur'])) : ?>

                    <p class="form-text text-danger"><?= $erreurs['mdp_utilisateur'] ?></p>

                <?php endif; ?>
            </div>

            <button type="submit" class="btn btn-light">Valider</button>

        </form>

    </div>
</div>


<script src="assets/js/bootstrap.bundle.min.js"></script>

</body>
</html>
<?php

/**
 * @var PDO $pdo
 */
require 'config/db-config.php';
// Déterminer si le formulaire a été soumis
// Utilisation d'une variable superglobale $_SERVER
// $_SERVER : tableau associatif contenant des informations sur la requête HTTP
$erreurs = [];
$pseudo_utilisateur = "";
$email_utilisateur = "";
$mdp_utilisateur = "";
$mdp_verification = "";


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Le formulaire a été soumis !
    // Traiter les données du formulaire
    // Récupérer les valeurs saisies par l'utilisateur
    // Superglobale $_POST : tableau associatif
    $pseudo_utilisateur = $_POST['pseudo_utilisateur'];
    $email_utilisateur = $_POST['email_utilisateur'];
    $mdp_utilisateur = $_POST['mdp_utilisateur'];
    $mdp_verification = $_POST['mdp_verification'];

    //Validation des données
    if (empty($pseudo_utilisateur)) {
        $erreurs['pseudo_utilisateur'] = "Le pseudo est obligatoire";
    }
    if (empty($email_utilisateur)) {
        $erreurs['email_utilisateur'] = "L'email est obligatoire";
    } elseif (!filter_var($email_utilisateur, FILTER_VALIDATE_EMAIL)) {
        $erreurs['email_utilisateur'] = "L'email n'est pas valide";
    }
    if (empty($mdp_utilisateur)) {
        $erreurs['mdp_utilisateur'] = "Le mot de passe est obligatoire";
        $erreurs['mdp_verification'] = "Le mot de passe est obligatoire";
    }
    if (strlen($mdp_utilisateur)<=8 OR strlen($mdp_utilisateur)>=14){
        $erreurs['mdp_utilisateur'] = "Le mot de passe ne contient pas assez de caractères";
        $erreurs['mdp_verification'] = "Le mot de passe ne contient pas assez de caractères";
    }

    if ($mdp_utilisateur != $mdp_verification) {
        $erreurs['mdp_utilisateur'] = "Les mots de passe ne sont pas identiques";
        $erreurs['mdp_verification'] = "Les mots de passes ne sont pas identiques";
    }

    $requete = $pdo->prepare("SELECT * FROM utilisateur WHERE email_utilisateur=?");
    $requete->execute([$email_utilisateur]);
    $user = $requete->fetch();
    if ($user) {
        $erreurs['email_utilisateur'] = "L'email saisie est déjà utilisé";
    } else {

    // Traiter les données
    if (empty($erreurs)) {
        // Traitement des données (insertion dans une base de données)
        $requete = $pdo->prepare(query: "INSERT INTO utilisateur (pseudo_utilisateur, email_utilisateur, mdp_utilisateur) VALUES (?, ?, ?)");

        $requete->bindParam(1, $pseudo_utilisateur);
        $requete->bindParam(2, $email_utilisateur);
        $requete->bindParam(3, password_hash($mdp_utilisateur,PASSWORD_ARGON2I));

        // 3. Exécution de la requête
        $requete->execute();

        // Rediriger l'utilisateur vers une autre page du site
        header("Location: ../index.php");
        exit();
    }
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
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Formulaire</title>
</head>
<body>
<!--Insertion d'un menu-->
<?php include_once 'menu.php' ?>


<div class="container">
    <h1 class="text-dark border-2 border-bottom border-warning">Inscription à votre compte </h1>
    <div class="w-50 mx-auto shadow my-5 p-4 bg-warning rounded-5">
        <form action="" method="post" novalidate>

            <ul class="nav nav-pills nav-justified mb-3 shadow rounded-3 bg-white" id="ex1" role="tablist">
                <li class="nav-item" role="presentation">
                    <a
                            class="nav-link text-black"
                            id="tab-login"
                            data-mdb-pill-init
                            href="connexion_compte.php"
                            role="tab"
                            aria-controls="connexion_compte.php"
                            aria-selected="false"
                    >Connexion</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a
                            class="nav-link bg-black text-white"
                            id="tab-register"
                            data-mdb-pill-init
                            href="creation_compte.php"
                            role="tab"
                            aria-controls="creation_compte.php"
                            aria-selected="true"
                    >Inscription</a>
                </li>
            </ul>

            <div class="mb-3">
                <label for="pseudo_utilisateur" class="form-label">Pseudo*</label>
                <input type="text"
                       class="form-control <?= (isset($erreurs['pseudo_utilisateur'])) ? "border border-2 border-danger" : "" ?>"
                       id="pseudo_utilisateur" name="pseudo_utilisateur" value="<?= $pseudo_utilisateur ?>" placeholder="Saisir votre pseudo "
                       aria-describedby="emailHelp">
                <?php if (isset($erreurs['pseudo_utilisateur'])) : ?>
                    <p class="form-text text-danger"><?= $erreurs['pseudo_utilisateur'] ?></p>
                <?php endif; ?>
            </div>

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
                <label for="mdp_utilisateur" class="form-label">Mot de passe*</label>

        <button type="button" class="btn mb-1" data-bs-toggle="modal"
                data-bs-target="#exampleModal">
            <i class="bi bi-info-circle"></i>
        </button>

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-warning">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Les caractéristiques de votre mot de passe </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <ul>
                            <li>
                                Votre mot de passe doit contenir entre 8 et 14 caractères
                            </li>
                            <li>
                                Il doit contenir au moins une minuscule, une majuscule et un chiffre
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

                <input type="password"
                       class="form-control <?= (isset($erreurs['mdp_utilisateur'])) ? "border border-2 border-danger" : "" ?>"
                       id="mdp_utilisateur" name="mdp_utilisateur" value="<?= $mdp_utilisateur ?>" placeholder="Saisir votre mot de passe"
                       aria-describedby="emailHelp">
                <?php if (isset($erreurs['mdp_utilisateur'])) : ?>
                    <p class="form-text text-danger"><?= $erreurs['mdp_utilisateur'] ?></p>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="mdp_verification" class="form-label">Confirmez votre mot de passe*</label>
                <input type="password"
                       class="form-control <?= (isset($erreurs['mdp_verification'])) ? "border border-2 border-danger" : "" ?>"
                       id="mdp_verification" name="mdp_verification" value="<?= $mdp_verification ?>" placeholder="Confirmez votre mot de passe"
                       aria-describedby="emailHelp">
                <?php if (isset($erreurs['mdp_verification'])) : ?>
                    <p class="form-text text-danger"><?= $erreurs['mdp_verification'] ?></p>
                <?php endif; ?>
            </div>
            <button type="submit" class="btn btn-light">Valider</button>
        </form>
    </div>
</div>


<script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
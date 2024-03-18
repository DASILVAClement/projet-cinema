<html lang="en"><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Formulaire</title>
</head>
<body class="bg-dark">

<?php include_once 'menu.php' ?>

<div class="container ">
    <h1 class="text-white border-2 border-bottom border-warning">Connexion à votre compte </h1>
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
                <input type="email" class="form-control " id="email_utilisateur" name="email_utilisateur" value="" placeholder="Saisir un email valide" aria-describedby="emailHelp">
            </div>

            <div class="mb-3">
                <label for="mdp_utilisateur" class="form-label">Mot de passe*</label>
                <input type="password" class="form-control " id="mdp_utilisateur" name="mdp_utilisateur" value="" placeholder="Saisir votre mot de passe" aria-describedby="emailHelp">
            </div>

            <button type="submit" class="btn btn-light">Valider</button>
        </form>
    </div>
</div>


<script src="../assets/js/bootstrap.bundle.min.js"></script>

</body>
</html>
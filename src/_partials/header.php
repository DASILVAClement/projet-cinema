<header>
    <nav class="navbar navbar-expand-md bg-black border-bottom border-warning border-4">
        <div class="container-fluid">

            <h2 class="text-warning"><i class="bi bi-film"></i> <a href="<?php BASE_PROJET ?> /index.php"
                                                                   class="text-decoration-none text-warning">FILM.com</a>
            </h2>

            <button class="navbar-toggler bg-warning" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto">

                    <?php if (empty($_SESSION)) : ?>
                        <li>
                            <a class="nav-link " href="<?php BASE_PROJET ?>/index.php">
                                <button type="button" class="btn btn-warning border-2 text-black rounded-3">Liste des
                                    films
                                </button>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php BASE_PROJET ?>/connexion-compte.php">
                                <button type="button" class="btn btn-warning border-2 text-black rounded-3">Connexion
                                </button>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php BASE_PROJET ?>/creation-compte.php">
                                <button type="button" class="btn btn-warning border-2 text-black rounded-3">Inscription
                                </button>
                            </a>
                        </li>
                    <?php else : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php BASE_PROJET ?>/creation-film.php">
                                <button type="button" class="btn btn-warning border-2 text-black rounded-3">Ajouter un
                                    film
                                </button>
                            </a>
                        </li>
                        <li class="nav-item rounded-3">
                            <a class="nav-link" href="<?php BASE_PROJET ?>/index.php">
                                <button type="button" class="btn btn-warning border-2 text-black rounded-3">Liste des
                                    films
                                </button>
                            </a>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php BASE_PROJET ?>/deconnexion-compte.php">
                                <button type="button" class="btn btn-warning border-2 text-black rounded-3">
                                    Deconnexion
                                </button>
                            </a>
                        </li>
                    <?php endif; ?>

                </ul>
            </div>
        </div>
    </nav>
</header>

<script src="assets/js/bootstrap.bundle.min.js"></script>



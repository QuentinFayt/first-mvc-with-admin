<?php
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Nos articles</title>
    <link rel="stylesheet" href="css/bootstrap.css" media="screen">
    <link rel="stylesheet" href="css/custom.min.css" media="screen">
    <link rel="stylesheet" href="css/lightbox.min.css" media="screen">
    <link rel="shortcut icon" href="/img/favicon.ico">
</head>

<body id="page-top">
    <div class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
        <div class="container">
            <a href="./" class="navbar-brand">Accueil</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav">
                    <?php
                    foreach ($recupSection as $section) {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link" href="?idsection=<?= $section["idthesection"] ?>"><?= $section["thesectionTitle"] ?></a>
                        </li>
                    <?php
                    }
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="?p=connect">Connexion</a>
                    </li>
                </ul>

            </div>
        </div>
    </div>

    <div class="container">

        <div class="page-header" id="banner">
            <div class="row">
                <div class="col-lg-12 mx-auto">

                    <h1>Tous nos articles</h1>
                    <p class="lead">Nombre d'articles: <?= count($recupArticle) ?></p>
                    <div class="alert alert-dark" role="alert">
                        Ce site est un travail scolaire et n'est pas référencé, il est en lien avec ce référentiel
                        <a href="https://github.com/WebDevCF2m2021/first-mvc-with-admin" target="_blank">Github</a>.<br> Ce site est un exemple de MVC en PHP/MySQL procédural d'une administration à plusieurs niveaux de droits
                    </div>

                    <hr>
                    <?php
                    if (empty($recupArticle)) {
                    ?>
                        <h3>
                            Il n'y a pas encore d'articles
                        </h3>
                        <?php
                    } else {
                        foreach ($recupArticle as $article) {
                        ?>
                            <div class="alert alert-dark" role="alert">
                                <h5><a href="?idarticle=<?= $article["idthearticle"] ?>"><?= $article["thearticleTitle"] ?></a></h5>
                                <?php
                                $sections = array_combine(explode(",", $article["idthesection"]), explode("|||", $article["thesectionTitle"]));
                                asort($sections);
                                if (array_key_first($sections)) {
                                ?>
                                    <div>
                                        <p>
                                            <?php
                                            foreach ($sections as $id => $section) {
                                                echo '<a href="?idsection=' . $id . '">' . $section . '</a>' . ($id === array_key_last($sections) ? '' : '|') . ' ';
                                            }
                                            ?>
                                        </p>
                                    </div>
                                <?php
                                }
                                ?>
                                <div>
                                    <p><?= cuteTheText($article["thearticleText"], 200) ?> <a href="<?= $article["idthearticle"] ?>">Lire la suite</a></p>
                                </div>

                                <div>
                                    <p>Écrit par : <a href="?iduser=<?= $article["idtheuser"] ?>"><?= $article["theuserName"] ?></a> le <?= frenchDate($article["thearticleDate"], 3) ?></p>
                                </div>
                            </div>
                    <?php
                        }
                    }
                    ?>
                    <hr>
                    <a href="#page-top">Retour en haut</a>
                    <hr>
                </div>

            </div>
        </div>

        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/custom.js"></script>
        <script src="js/lightbox.js"></script>
</body>

</html>
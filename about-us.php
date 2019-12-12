<?php
require_once('settings/core.php');
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contato - <?php echo $sitename; ?></title>
    <meta name="title" content="<?php echo $sitename; ?>">
    <meta name="description" content="<?php echo $description; ?>">
    <meta name="keywords" content="<?php echo $keywords; ?>">
    <meta name="robots" content="index, follow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="Portuguese">
    <meta name="author" content="Leandro Guedes">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="/assets/css/bulma.min.css">
    <link rel="stylesheet" href="/assets/css/chameleon.css">
    <link rel="stylesheet" href="/assets/css/emoji.min.css">
    <script src="/assets/js/all.js"></script>

</head>

<body>

    <?php require_once('includes/header.php'); ?>

    <section class="hero is-link is-medium">
        <div class="hero-body has-text-centered">
            <div class="container">
                <h1 class="title">Sobre nós</h1>
            </div>
        </div>
    </section>

    <section class="hero section is-small">
        <div class="container">
            <header class="has-text-centered" style="margin-bottom: 3rem;">
                <h1 class="title is-spaced has-text-weight-bold is-3">Desenvolvedores</h1>
            </header>
            <div class="columns is-centered is-variable is-4 is-multiline">
                <div class="box">
                    <article class="media">
                        <div class="media-left">
                            <figure class="image is-64x64">
                                <img src="/assets/images/leandro.jpg" alt="Image">
                            </figure>
                        </div>
                        <div class="media-content">
                            <div class="content">
                                <p>
                                    <strong>Leandro Guedes</strong> <small>Líder de projeto</small>
                                    <br>
                                    Evangelizador de Software Livre e Linux, estudante de Informatica (CETEPI).
                                </p>
                            </div>
                            <nav class="level is-mobile">
                                <div class="level-left">
                                    <a class="level-item" aria-label="instagram">
                                        <span class="icon is-small">
                                            <i class="fab fa-instagram" aria-hidden="true"></i>
                                        </span>
                                    </a>
                                    <a class="level-item" aria-label="github">
                                        <span class="icon is-small">
                                            <i class="fab fa-github" aria-hidden="true"></i>
                                        </span>
                                    </a>
                                    <a class="level-item" aria-label="globe">
                                        <span class="icon is-small">
                                            <i class="fas fa-globe" aria-hidden="true"></i>
                                        </span>
                                    </a>
                                </div>
                            </nav>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </section>

    <?php include_once('includes/footer.php'); ?>

    <script src="/assets/js/bulma.js"></script>
    <script src="/assets/js/main.js"></script>

</body>

</html>
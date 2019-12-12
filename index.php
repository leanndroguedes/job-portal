<?php
require_once('settings/core.php');
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Início - <?php echo $sitename; ?></title>
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

    <section class="hero section is-small">
        <div class="container">
            <div class="columns is-vcentered is-desktop">
                <?php if (!isset($_SESSION['user_id'])) { ?>
                    <div class="column is-5-desktop has-text-centered-touch">
                        <header>
                            <h1 class="title is-1 is-size-2-mobile">Seu portal de empregos</h1>
                            <p class="subtitle">
                                Começe o ano com uma nova forma de encontrar trabalho.
                            </p>
                            <a class="button is-link is-medium" href="/signup/">Inscrever-se</a>
                        </header>
                    </div>
                    <div class="column is-1"></div>
                    <div class="column">
                        <figure class="image">
                            <img src="/assets/images/undraw_biking_kc4f.svg" alt="Ilustração">
                        </figure>
                    </div>
                <?php } else { ?>
                    <div class="column is-5-desktop has-text-centered-touch">
                        <header>
                            <h1 class="title is-1 is-size-2-mobile">Seu portal de empregos</h1>
                            <p class="subtitle">
                                Começe o ano com uma nova forma de encontrar trabalho.
                            </p>
                            <a class="button is-link is-medium is-outlined" href="/search-jobs/">Encontre vagas</a>
                        </header>
                    </div>
                    <div class="column is-1"></div>
                    <div class="column">
                        <figure class="image">
                            <img src="/assets/images/undraw_biking_kc4f.svg" alt="Ilustração">
                        </figure>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>

    <section class="hero section is-light is-small">
        <div class="container">
            <div class="columns is-vcentered ismultiline">
                <div class="column is-narrow has-text-centered">
                    <img src="/assets/images/mariadb.png" width="150" alt="MariaDB Server is one of the most popular open source relational databases.">
                </div>
                <div class="column is-narrow has-text-centered">
                    <img src="/assets/images/apache.png" width="150" alt="The Apache HTTP Server Project is an effort to develop and maintain an open-source HTTP server for modern operating systems including UNIX and Windows.">
                </div>
                <div class="column is-narrow has-text-centered">
                    <img src="/assets/images/bulma.png" width="150" alt="Bulma is a free, open source CSS framework based on Flexbox and built with Sass.">
                </div>
            </div>
        </div>
    </section>

    <section class="hero section is-link is-small">
        <div class="container">
            <header class="has-text-centered" style="margin-bottom: 3rem;">
                <h1 class="title is-spaced has-text-weight-bold is-3">Desenvolvedores</h1>
            </header>
            <div class="columns is-centered is-variable is-4 is-multiline">

                <div class="box">
                    <article class="media">
                        <div class="media-left">
                            <figure class="image is-64x64">
                                <img class="is-rounded" src="/assets/images/leandro.jpg" alt="Image">
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

    <section class="section is-medium">
        <div class="container">
            <div class="columns is-vcentered">
                <div class="column">
                    <p class="title">Buscar</p>
                    <p class="subtitle is-4">
                        Encontre a vaga que combina com você
                    </p>
                </div>
                <div class="column">
                    <form action="/search-jobs/" method="get">

                        <div class="field is-grouped">
                            <p class="control is-expanded">
                                <input class="input" type="text" placeholder="Função ou Palavra Chave">
                            </p>
                            <p class="control">
                                <a class="button is-link">
                                Buscar
                                </a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <?php include_once('includes/footer.php'); ?>

    <script src="/assets/js/bulma.js"></script>
    <script src="/assets/js/main.js"></script>

</body>

</html>
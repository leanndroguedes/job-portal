<?php
require_once('settings/core.php');
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sucesso - <?php echo $sitename; ?></title>
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
    
    <script data-ad-client="ca-pub-9475263777599256" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

</head>

<body>

    <?php require_once('includes/header.php'); ?>

    </header>

    <section class="hero is-light">
        <div class="hero-body">
            <div class="container">
                <div class="columns">
                    <div class="column is-half is-offset-one-quarter">
                        <p class="title has-text-centered">
                            Boas vindas ao <?php echo $sitename; ?>
                        </p>
                        <figure class="image">
                            <img src="/assets/images/register_confirmation.svg" alt="Homem segurando um laptop com um envelope, um balão de conversa e um avião de papel ao redor dele.">
                        </figure>
                        <div class="hero-buttons">
                            <a class="button is-link is-medium" href="/account/overview/">Visão geral da conta</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include_once('includes/footer.php'); ?>

    <script src="/assets/js/bulma.js"></script>
    <script src="/assets/js/main.js"></script>

</body>

</html>
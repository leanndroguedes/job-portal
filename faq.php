<?php
require_once('settings/core.php');
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>FAQ - <?php echo $sitename; ?></title>
    <meta name="title" content="<?php echo $sitename; ?>">
    <meta name="description" content="<?php echo $description; ?>">
    <meta name="keywords" content="trabalho,vagas,emprego,estagio,<?php echo $sitename; ?>portal,<?php echo $sitename; ?>,<?php echo $sitename; ?> portal,vagas de estágio,vagas de emprego">
    <meta name="robots" content="index, follow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="Portuguese">
    <meta name="author" content="Leandro Guedes">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="/assets/css/bulma.min.css">
    <link rel="stylesheet" href="/assets/css/<?php echo $sitename; ?>.css">
    <link rel="stylesheet" href="/assets/css/emoji.min.css">
    <script src="/assets/js/all.js"></script>

</head>

<body>

    <?php require_once('includes/header.php'); ?>

    <section class="hero is-link is-medium">
        <div class="hero-body has-text-centered">
            <div class="container">
                <h1 class="title">FAQ</h1>
            </div>
        </div>
    </section>

    <section class="hero section is-white is-medium">
        <div>
            <div class="container">
                <article style="padding: 1.6rem 0px; border-bottom: 1px solid rgb(239, 239, 239);">
                    <div class="title is-spaced is-4">
                        <span class="icon is-size-5 has-text-link">
                            <i class="fas fa-plus"></i>
                        </span>
                        O que o <?php echo $sitename; ?> ganha com isso?
                    </div>
                    <div class="subtitle">
                        Por agora, nós da <?php echo $sitename; ?> não ganhamos absolutamente nada em valor monetário, apenas a satisfação de saber e ver as pessoas desempregadas conseguindo suas vagas e o empregadores conseguindo seus trabalhadores.
                    </div>
                </article>
                <article style="padding: 1.6rem 0px; border-bottom: 1px solid rgb(239, 239, 239);">
                    <div class="title is-spaced is-4">
                        <span class="icon is-size-5 has-text-link">
                            <i class="fas fa-plus"></i>
                        </span>
                        Posso me candidatar a qualquer vaga anunciada?
                    </div>
                    <div class="subtitle">
                        Com certeza, não havendo um pré-requisito do empregador. Contudo, é recomendado somente se candidatar a vagas compatíveis com seu perfil profissional e qualificações para maiores chances.
                    </div>
                </article>
                <article style="padding: 1.6rem 0px; border-bottom: 1px solid rgb(239, 239, 239);">
                    <div class="title is-spaced is-4">
                        <span class="icon is-size-5 has-text-link">
                            <i class="fas fa-plus"></i>
                        </span>
                        Há taxa para anunciar ou se candidatar para um vaga?
                    </div>
                    <div class="subtitle">
                        Não! Nós da <?php echo $sitename; ?> não cobramos nenhum valor aos candidatos e empregadores, ou seja, fácil, prático e gratuito.
                    </div>
                </article>
                <article style="padding: 1.6rem 0px; border-bottom: 1px solid rgb(239, 239, 239);">
                    <div class="title is-spaced is-4">
                        <span class="icon is-size-5 has-text-link">
                            <i class="fas fa-plus"></i>
                        </span>
                        Irei ser alertado sobre novas vagas?
                    </div>
                    <div class="subtitle">
                        Infelizmente não, porém há de ser implementado em futuras atualizações, então fique ligado!
                    </div>
                </article>
            </div>
        </div>
    </section>

    <?php include_once('includes/footer.php'); ?>

    <script src="/assets/js/bulma.js"></script>
    <script src="/assets/js/main.js"></script>

</body>

</html>
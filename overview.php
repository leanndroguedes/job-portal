<?php
require_once('settings/core.php');
require_once('settings/session.php');
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Visão geral da conta - <?php echo $sitename; ?></title>
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


    <section class="hero is-link is-bold">
        <div class="hero-body">
            <div class="container">
                <div class="columns is-vcentered is-mobile">
                    <div class="column is-narrow">
                        <div style="background: url('<?= $user_q['avatar'] ?>') center center; background-size: auto 96px; border-radius: 50%; width: 96px; height: 96px;"></div>
                    </div>
                    <div class="column">
                        <p class="title is-size-4"><?= ucfirst(strtolower(explode(" ", $user_q['displayname'])[0])) ?> <?= ucfirst(strtolower(explode(" ", $user_q['displayname'])[1])) ?></p>
                        <p class="subtitle is-size-6"><?= $user_q['email'] ?></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="hero-foot">
            <nav class="tabs is-boxed is-fullwidth">
                <div class="container">
                    <ul>
                        <li class="is-active"><a href="/account/overview/">Conta</a></li>
                        <?php if ($user_q['profile_user_id'] == 2) { ?>
                            <li><a href="/account/apps/">Gerenciar vagas</a></li>
                            <li><a href="/statistics/">Estatisticas</a></li>
                        <?php } else { ?>
                            <li><a href="/account/subscription/receipt/">Inscrições</a></li>
                            <li><a href="#saved-jobs/">Trabalhos salvos</a></li>
                        <?php } ?>
                        <li><a href="/account/change-password/">Mudar senha</a></li>
                    </ul>
                </div>
            </nav>
        </div>
    </section>

    <div class="container">
        <div class="tabs">
            <ul>
                <li class="is-active">
                    <a href="/account/overview/">
                        <span class="icon is-small"><i class="far fa-address-card"></i></span>
                        <span>Visão geral da conta</span>
                    </a>
                </li>
                <li>
                    <a href="/account/profile/">
                        <span class="icon is-small"><i class="far fa-edit"></i></span>
                        <span>Editar perfil</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <section class="section">
        <div class="container">
            <h2 class="subtitle">Perfil</h2>
            <div class="content">
                <strong>Nome do usuário</strong>
                <p><?= $user_q['displayname'] ?></p>
                <strong>Data de nascimento</strong>
                <p><?= date('d/m/Y', strtotime($user_q['birthdate'])) ?></p>
                <strong>CPF</strong>
                <p><?= $user_q['cpf'] ?></p>
                <strong>Sexo</strong>
                <p><?php if ($user_q['gender'] == 'male') {
                        echo "Masculino";
                    } elseif ($user_q['gender'] == 'female') {
                        echo "Feminino";
                    } else {
                        echo "Não binário";
                    } ?></p>
                <strong>E-mail</strong>
                <p><?= $user_q['email'] ?></p>
            </div>
        </div>
    </section>

    <?php include_once('includes/footer.php'); ?>

    <script src="/assets/js/bulma.js"></script>
    <script src="/assets/js/main.js"></script>

</body>

</html>
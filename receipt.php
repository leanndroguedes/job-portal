<?php
require_once('settings/core.php');
require_once('settings/session.php');

$sql = "SELECT * FROM user, job, user_has_job WHERE user.user_id = user_has_job.user_id AND job.job_id = user_has_job.job_id AND user.user_id = $user_q[user_id]";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inscrições - <?php echo $sitename; ?></title>
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
                        <li><a href="/account/overview/">Conta</a></li>
                        <li class="is-active"><a href="/account/subscription/receipt/">Inscrições</a></li>
                        <li><a href="#saved-jobs/">Trabalhos salvos</a></li>
                        <li><a href="/account/change-password/">Mudar senha</a></li>
                    </ul>
                </div>
            </nav>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="columns">
                <div class="column is-half is-offset-one-quarter">
                    <div class="content has-text-centered">
                        <p class="title">Você ainda não se inscreveu em vagas.</p>
                        <figure class="image">
                            <img src="/assets/images/undraw_a_moment_to_relax_bbpa.svg">
                        </figure>
                    </div>
                </div>
            </div>

            <?php while ($row = $result->fetch_assoc()) { ?>
                <a href="/job/<?= $row['job_id'] ?>" class="box">
                    <article class="media">
                        <div class="media-content">
                            <div class="content is-unselectable">
                                <p>
                                    <strong><?= $row['title'] ?></strong> <small><?= date('d/m/Y', strtotime($row['reg_date'])) ?></small>
                                    <br>
                                    <?= $row['text'] ?>
                                </p>
                            </div>
                        </div>
                    </article>
                </a>
            <?php } ?>
    </section>

    <?php include_once('includes/footer.php'); ?>

    <script src="/assets/js/bulma.js"></script>
    <script src="/assets/js/main.js"></script>

</body>

</html>
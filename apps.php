<?php
require_once('settings/core.php');
require_once('settings/session.php');

if ($user_q['profile_user_id'] != 2) {
    header('Location: ' . $site . '/account/');
}

if ($_GET['save'] == "$w") {
    $message = '<div class="notification is-success"><button class="delete"></button>Alterações salvas com sucesso</div>';
}
if ($_GET['error'] == "$w") {
    $message = '<div class="notification is-danger"><button class="delete"></button>Não é possivel excluir a vaga.</div>';
}

if (isset($_GET['appid'])) {
    $appid = $_GET['appid'];

    if ($conn->query("UPDATE job SET status = 0 WHERE job_id = $appid") == TRUE) {
        $message = '<div class="notification is-danger"><button class="delete"></button>Vaga removida!</div>';
        header("Location: $site/account/apps/?save=$w");
    } else {
        header("Location: $site/account/apps/?error=$w");
    }
}

$user_a = $conn->query("SELECT * FROM user WHERE user_id = $_SESSION[user_id]");
$user_q = $user_a->fetch_assoc();

if (isset($_POST['search'])) {
    $search = $_POST['search'];
    $sql = "SELECT * FROM job WHERE title LIKE '%" . $search['args'] . "%' OR text LIKE '%" . $search['args'] . "%' AND status = 1 ORDER BY published_date DESC";
} else {
    if ($_GET['search'] == 'all') {
        $sql = "SELECT * FROM job WHERE author = $_SESSION[user_id] AND status = 1";
    } elseif ($_GET['search'] == 'del') {
        $sql = "SELECT * FROM job WHERE author = $_SESSION[user_id] AND status = 0";
    } else {
        $sql = "SELECT * FROM job WHERE author = $_SESSION[user_id] AND status = 1";
    }
}

$job_a = $conn->query($sql);
echo $conn->error;
$num_job = $job_a->num_rows;
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Minhas Vagas Anunciadas - <?php echo $sitename; ?></title>
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
                        <?php if ($user_q['profile_user_id'] == 2) { ?>
                            <li class="is-active"><a href="/account/apps/">Gerenciar vagas</a></li>
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

    <div class="container has-shadow">
        <div class="tabs">
            <ul>
                <li class="is-active">
                    <a href="/account/apps/">
                        <span class="icon is-small"><i class="fas fa-clipboard-list"></i></span>
                        <span>Minhas Vagas Anunciadas</span>
                    </a>
                </li>
                <li>
                    <a href="/account/apps/new/">
                        <span class="icon is-small"><i class="fas fa-plus"></i></span>
                        <span>Anunciar Vaga</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <section class="section">
        <div class="container">

            <nav class="level">
                <!-- Left side -->
                <div class="level-left">
                    <div class="level-item">
                        <p class="subtitle is-5">
                            <strong><?php echo $num_job; ?></strong> vagas
                        </p>
                    </div>
                    <div class="level-item">
                        <form action="" method="post">
                            <div class="field has-addons">
                                <p class="control">
                                    <input class="input" type="text" name="search[args]" placeholder="Encontre uma vaga" value="<?php echo $_POST['search']['args']; ?>">
                                </p>
                                <p class="control">
                                    <button name="search[submit]" type="submit" class="button">
                                        Buscar
                                    </button>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Right side -->
                <div class="level-right">
                    <a class="level-item" href="/account/apps/?search=all"><?php echo ($_GET['search'] == 'all') ? '<strong>Todas</strong>' : 'Todas' ?></a>
                    <a class="level-item" href="/account/apps/?search=del"><?php echo ($_GET['search'] == 'del') ? '<strong>Deletadas</strong>' : 'Deletadas' ?></a>
                    <p class="level-item"><a href="/account/apps/new/" class="button is-success">Nova</a></p>
                </div>
            </nav>

            <?php echo $message; ?>

            <table class="table is-fullwidth is-hoverable is-mobile">
                <thead>
                    <tr>
                        <th>Trabalho</th>
                        <th class="is-hidden-touch">Descrição</th>
                        <th><abbr title="Data de inscrição">Data</abbr></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $job_a->fetch_assoc()) { ?>
                        <tr>
                            <td><a href="/job/<?= $row['job_id'] ?>"><?= $row['title'] ?></a></td>
                            <td class="is-hidden-touch"><?= substr($row['text'], 0, 128) ?></td>
                            <td><?= date('d/m/Y', strtotime($row['published_date'])) ?></td>
                            <td>
                                <a <?php echo ($_GET['search'] == 'del') ? 'disabled' : ' ' ?> href="/account/apps/revoke/<?php echo $row['job_id']; ?>" class="button is-danger"><span class="icon is-small"><i class="fas fa-trash-alt"></i></span></a>
                                <a <?php echo ($_GET['search'] == 'del') ? 'disabled' : ' ' ?> href="/account/apps/change/<?php echo $row['job_id']; ?>" class="button is-link"><span class="icon is-small"><i class="fas fa-pen"></i></span></a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
    </section>

    <div user_id="modal-ter" class="modal">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">Apagar vaga</p>
                <button class="delete" aria-label="close"></button>
            </header>
            <section class="modal-card-body">
                <div class="content">
                    <p user_id="modal-msg">Apagar a vaga de </p>
                </div>
            </section>
            <footer class="modal-card-foot">
                <a user_id="unsubscribe" class="button is-danger" href="/scripts/delete_vaga.php?cod=">Apagar vaga</a>
                <button class="button">Cancelar</button>
            </footer>
        </div>
    </div>

    <?php include_once('includes/footer.php'); ?>

    <script src="/assets/js/bulma.js"></script>
    <script src="/assets/js/main.js"></script>

</body>

</html>
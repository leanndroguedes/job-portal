<?php
require_once('settings/core.php');
require_once('settings/session.php');

if ($_GET['save'] == "$w") {
    $message = '<div class="notification is-success"><button class="delete"></button>Senha atualizada</div>';
} else if ($_GET['error'] == "$w") {
    $message = '<div class="notification is-danger"><button class="delete"></button>'. $_GET['sql'] . $_GET['conn'] .'</div>';
}

if (isset($_POST['change_password'])) {

    $change_password = $_POST['change_password'];

    $password_verify = $conn->query("SELECT * FROM user WHERE email = '$user_q[email]' AND password = '" . md5($change_password['validate_password']) . "'");

    if (empty($change_password['validate_password'])) {
        $error = '1';
        $validate_password_errors = '<p class="help is-danger">Este campo é obrigatório.</p>';
        $validate_password_class = 'is-danger';
    } else {
        if ($password_verify->num_rows == 0) {
            $error = '1';
            $validate_password_errors = '<p class="help is-danger">Desculpe, senha errada</p>';
            $validate_password_class = 'is-danger';
        }
    }
    
    if (empty($change_password['new_password'])) {
        $error = 1;
        $new_password_errors = '<p class="help is-danger">Este campo é obrigatório.</p>';
        $new_password_class = 'is-danger';
    } else {
        if (strlen($change_password['new_password']) < 8) {
            $error = 1;
            $new_password_errors = '<p class="help is-danger">Segurança da senha: Falhou</p>';
            $new_password_class = 'is-danger';
        } else {
            if (empty($change_password['check_password'])) {
                $error = 1;
                $check_password_errors = '<p class="help is-danger">Este campo é obrigatório.</p>';
                $check_password_class = 'is-danger';
            } else {
                if ($change_password['new_password'] != $change_password['check_password']) {
                    $error = 1;
                    $check_password_errors = '<p class="help is-danger">As senhas não conferem.</p>';
                    $check_password_class = 'is-danger';
                }
            }
        }
    }

    if ($error != 1) {
        $update_password = "UPDATE user SET password = '" . md5($change_password['new_password']) . "' WHERE email = '$user_q[email]'";
        if ($conn->query($update_password) === TRUE) {
            header("Location: $site/account/change-password/?save=$w");
        } else {
            header("Location: $site/account/change-password/?error=$w&sql=$update_password&conn=$conn->error");
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mudar sua senha - <?php echo $sitename; ?></title>
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
                            <li><a href="/account/apps/">Gerenciar vagas</a></li>
                            <li><a href="/statistics/">Estatisticas</a></li>
                        <?php } else { ?>
                            <li><a href="/account/subscription/receipt/">Inscrições</a></li>
                            <li><a href="#saved-jobs/">Trabalhos salvos</a></li>
                        <?php } ?>
                        <li class="is-active"><a href="/account/change-password/">Mudar senha</a></li>
                    </ul>
                </div>
            </nav>
        </div>
    </section>

    <section class="section">
        <div class="container">

            <?php echo $message; ?>

            <div class="columns is-dektop">
                <div class="column is-one-third">
                    <h2 class="subtitle">Mudar sua senha</h2>
                    <form action="" method="post">
                        <div class="field">
                            <label class="label" for="">Senha atual</label>
                            <div class="control">
                                <input class="input <?php echo $validate_password_class; ?>" type="password" name="change_password[validate_password]" id="">
                            </div>
                            <?php echo $validate_password_errors; ?>
                        </div>
                        <div class="field">
                            <label class="label" for="">Nova senha</label>
                            <div class="control">
                                <input class="input <?php echo $new_password_class; ?>" type="password" name="change_password[new_password]" id="">
                            </div>
                            <?php echo $new_password_errors; ?>
                        </div>
                        <div class="field">
                            <label class="label" for="">Repita a nova senha</label>
                            <div class="control">
                                <input class="input <?php echo $check_password_class; ?>" type="password" name="change_password[check_password]" id="">
                            </div>
                            <?php echo $check_password_errors; ?>
                        </div>
                        <div class="buttons">
                            <button class="button is-success" type="submit" name="change_password[submit]">Defina a nova senha</button>
                            <a class="button is-light" href="javascript:history.back()">Cancelar</a>
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
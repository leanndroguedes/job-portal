<?php
require_once('settings/core.php');
if (isset($_SESSION['user_id'])) {
    header("Location: $site");
}

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password_login = $_POST['password'];

    $email_verify = $conn->query("SELECT * FROM user WHERE email = '$email' AND password = '" . md5($password_login) . "'");
    $user_fetch = $email_verify->fetch_assoc();

    if (empty($email)) {
        # Você não pode deixar o campo de email vazio.
        $message = '<div class="notification is-danger"><button class="delete"></button>Você não pode deixar o campo de email vazio.</div>';
    } else {
        if (empty($password_login)) {
            # Você não pode deixar a sua senha vazia.
            $message = '<div class="notification is-danger"><button class="delete"></button>Você não pode deixar a sua senha vazia.</div>';
        } else {
            if ($email_verify->num_rows == 0) {
                # Email ou senha estão incorretos.
                $message = '<div class="notification is-danger"><button class="delete"></button>Email ou senha estão incorretos.</div>';
            } else {
                $_SESSION['user_id'] = $user_fetch['user_id'];
                /* header("Location: $og"); */
                header("Location: $site/account/overview/");
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login - <?php echo $sitename; ?></title>
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

    <section class="hero section is-medium">
        <div class="container has-text-centered">

            <h1 class="title">Bem vindo de volta</h1>

            <?php echo $message; ?>

            <form action="" method="post">
                <div class="field">
                    <div class="control">
                        <input class="input is-medium is-flat" type="email" name="email" id="email" placeholder="Email" value="<?php echo $email; ?>">
                    </div>
                </div>
                <div class="field">
                    <div class="control has-icons-right">
                        <input class="input is-medium is-flat" type="password" name="password" id="password" placeholder="Senha" value="<?php echo $password_login; ?>">
                        <span class="icon is-small is-right">
                            <i class="far fa-eye-slash"></i>
                        </span>
                    </div>
                    <div class="control">

                    </div>
                </div>
                <div class="field">
                    <div class="control">
                        <button type="submit" name="login" class="button is-medium is-link is-fullwidth">Entrar</button>
                    </div>
                </div>
                <div class="has-text-centered">
                    <a href="/signup/">Criar conta</a>&ensp;
                    <a href="#">Esqueci minha senha</a>
                </div>
            </form>
        </div>
    </section>

    <?php include_once('includes/footer.php'); ?>

    <script src="/assets/js/bulma.js"></script>
    <script src="/assets/js/main.js"></script>

</body>

</html>
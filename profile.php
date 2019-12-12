<?php
require_once('settings/core.php');
require_once('settings/session.php');

if ($_GET['save'] == $w) {
    $message = '<div class="notification is-success"><button class="delete"></button>Perfil salvo</div>';
}

if (isset($_POST['profile'])) {
    $profile = $_POST['profile'];

    if (isset($profile['image'])) {
        if (isset($_FILES['profile_img']['name']) && $_FILES['profile_img']['error'] == 0) {

            $arquivo_tmp = $_FILES['profile_img']['tmp_name'];
            $nome = $_FILES['profile_img']['name'];

            $extensao = pathinfo($nome, PATHINFO_EXTENSION);

            $extensao = strtolower($extensao);

            if (strstr('.jpg;.jpeg;.gif;.png', $extensao)) {

                $novoNome = uniqid(time()) . '.' . $extensao;
                $destino = 'usercontent/' . $novoNome;

                if (@move_uploaded_file($arquivo_tmp, $destino)) {
                    $sql = "UPDATE user SET avatar = '/$destino' WHERE user_id = $user_q[user_id]";

                    if ($conn->query($sql) === TRUE) {
                        header('Location: ' . $site . '/account/profile?save=' . $w);
                    }
                } else
                    $message =  '<div class="notification is-danger"><button class="delete"></button>Erro ao salvar o arquivo. Aparentemente você não tem permissão de escrita.</div>';
            } else
                $message = '<div class="notification is-info"><button class="delete"></button>Você poderá enviar apenas arquivos "*.jpg;*.jpeg;*.gif;*.png"</div>';
        } else
            $message =  '<div class="notification is-info"><button class="delete"></button>Você não enviou nenhum arquivo!</div>';
    }

    if (isset($profile['save_profile'])) {

        if (empty($profile['displayname'])) {
            $error = 1;
            $name_errors = '<p class="help is-danger">Precisamos do seu nome completo.</p>';
            $name_class = 'is-danger';
        }
    
        if (empty($profile['birthdate'])) {
            $error = 1;
            $birthdate_errors = '<p class="help is-danger">Este campo é obrigatório.</p>';
            $birthdate_class = 'is-danger';
        }

        if (empty($profile['gender'])) {
            $error = 1;
            $gender_errors = '<p class="help is-danger">Este campo é obrigatório.</p>';
        }
    
        if ($profile['email'] != $user_q['email']) {
            
            $email_verify = $conn->query("SELECT * FROM user WHERE email='$profile[email]' LIMIT 1");
            if ($email_verify->num_rows == 1) {
                $error = '1';
                $emailaddress_errors = '<p class="help is-danger">O e-mail fornecido já foi utilizado.</p>';
                $emailaddress_class = 'is-danger';
            } else {
                if (empty($profile['email'])) {
                    $error = '1';
                    $emailaddress_errors = '<p class="help is-danger">Este campo é obrigatório.</p>';
                    $emailaddress_class = 'is-danger';
                } else {
                    if (!preg_match("/^[A-Z0-9._-]{2,}+@[A-Z0-9._-]{2,}\.[A-Z0-9._-]{2,}$/i", $profile['email'])) {
                        $error = '1';
                        $emailaddress_errors = '<p class="help is-danger">Você precisa fornecer um e-mail válido.</p>';
                        $emailaddress_class = 'is-danger';
                    }
                }
            }
        }

        if ($error != 1) {
            $sql = "UPDATE user SET displayname = '$profile[displayname]', email = '$profile[email]', birthdate = '$profile[birthdate]', gender = '$profile[gender]'  WHERE user_id = '$_SESSION[user_id]'";

            if ($conn->query($sql) === TRUE) {
                header('Location: ' . $site . '/account/profile?save=' . $w);
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
    <title>Editar perfil - <?php echo $sitename; ?></title>
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
                <li>
                    <a href="/account/overview/">
                        <span class="icon is-small"><i class="far fa-address-card"></i></i></span>
                        <span>Visão geral da conta</span>
                    </a>
                </li>
                <li class="is-active">
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

            <?php echo $message; ?>

            <div class="columns is-dektop">
                <div class="column is-one-third">
                    <h2 class="subtitle">Editar perfil</h2>
                    <form action="" method="post" id="form-edit-candidato">
                        <div class="field">
                            <label class="label" for="name">Nome do usuário</label>
                            <div class="control">
                                <input class="input <?php echo $name_class; ?>" type="text" name="profile[displayname]" id="name" placeholder="Nome completo" value="<?= $user_q['displayname'] ?>">
                            </div>
                            <?php echo $name_errors; ?>
                        </div>
                        <div class="field">
                            <label class="label" for="cpf">Data de nascimento</label>
                            <div class="control">
                                <input class="input <?php echo $birthdate_class; ?>" type="date" name="profile[birthdate]" id="birthday" value="<?= date('Y-m-d', strtotime($user_q['birthdate'])) ?>">
                            </div>
                            <?php echo $birthdate_errors; ?>
                        </div>
                        <div class="field">
                            <label class="label" for="cpf">CPF</label>
                            <div class="control">
                                <input class="input" type="number" name="profile[cpf]" id="cpf" placeholder="CPF" value="<?= $user_q['cpf'] ?>" disabled>
                            </div>
                        </div>
                        <div class="field">
                            <label class="label" for="gender">Sexo</label>
                            <div class="control">
                                <div class="select <?php echo $gender_class; ?>">
                                    <select name="profile[gender]" id="gender">
                                        <option value="female" <?php if ($user_q['gender'] == 'female') {
                                                                    echo "selected";
                                                                } ?>>Feminino</option>
                                        <option value="male" <?php if ($user_q['gender'] == 'male') {
                                                                    echo "selected";
                                                                } ?>>Masculino</option>
                                        <option value="neutral" <?php if ($user_q['gender'] == 'neutral') {
                                                                    echo "selected";
                                                                } ?>>Não binário</option>
                                    </select>
                                </div>
                                <?php echo $gender_errors; ?>
                            </div>
                        </div>
                        <div class="field">
                            <label class="label" for="email">E-mail</label>
                            <div class="control">
                                <input class="input <?php echo $emailaddress_class; ?>" type="email" name="profile[email]" id="email" placeholder="Seu endereço de e-mail" value="<?= $user_q['email'] ?>">
                            </div>
                            <?php echo $emailaddress_errors; ?>
                        </div>
                        <div class="field">
                            <div class="control">
                                <button type="submit" name="profile[save_profile]" class="button is-success">Salvar perfil</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="column">
                    <h2 class="subtitle">Foto</h2>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="field">
                            <div class="file">
                                <label class="file-label">
                                    <input class="file-input" type="file" name="profile_img" id="profile_img">
                                    <span class="file-cta">
                                        <span class="file-icon">
                                            <i class="fas fa-upload"></i>
                                        </span>
                                        <span class="file-label">
                                            Selecionar foto do perfil
                                        </span>
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div class="field">
                            <div class="control">
                                <button class="button is-link" name="profile[image]" type="submit">Enviar</button>
                            </div>
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
<?php
require_once('settings/core.php');
require_once('settings/session.php');

if ($user_q['profile_user_id'] != 2) {
    header('Location: '.$site.'/account/');
}

if ($_GET['save'] == $w) {
    $message = '<div class="notification is-success"><button class="delete"></button>Vaga criada com sucesso</div>';
}

$sql = "SELECT * FROM job_categories ORDER BY name";
$category = $conn->query($sql);

$sql = "SELECT * FROM job_type ORDER BY name";
$type = $conn->query($sql);

if (isset($_POST['add-job'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $category_id = $_POST['category'];
    $user_id = $_SESSION['user_id'];
    $job_type_id = $_POST['type'];

    $sql = "INSERT INTO job (title, text, author, job_categories_id, job_type_id) VALUES ('$title', '$description', $user_id, $category_id, $job_type_id)";

    if ($conn->query($sql) === TRUE) {
        header('Location: ' . $og . '?save=' . $w);
    } else {
        $message = '<div class="notification is-danger"><button class="delete"></button>Desculpe ocorreu um erro <span class="ec ec-face-with-head-bandage"></span><br> ' . $sql . $conn->error . '</div>';
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Anunciar Vaga - <?php echo $sitename; ?></title>
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

    <div class="container">
        <div class="tabs">
            <ul>
                <li>
                    <a href="/account/apps/">
                        <span class="icon is-small"><i class="fas fa-clipboard-list"></i></span>
                        <span>Minhas Vagas Anunciadas</span>
                    </a>
                </li>
                <li class="is-active">
                    <a href="/management/add">
                        <span class="icon is-small"><i class="fas fa-plus"></i></span>
                        <span>Anunciar Vaga</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <section class="section">
        <div class="container">

            <?php echo $message; ?>

            <div class="columns is-dektop">
                <div class="column is-two-fifths">
                    <h2 class="subtitle">Dados da Vaga</h2>
                    <form action="" method="post" id="form-edit-candidato">
                        <div class="field">
                            <label class="label" for="title">Função</label>
                            <div class="control">
                                <input class="input" type="text" name="title" id="title" placeholder="Digite o cargo da sua vaga" required>
                            </div>
                        </div>
                        <div class="field">
                            <label class="label" for="category">Catetoria</label>
                            <div class="control">
                                <div class="select">
                                    <select name="category" id="category" required>
                                        <option value="" selected disabled hidden>Selecione...</option>
                                        <?php while ($row = $category->fetch_assoc()) { ?>
                                            <option value="<?= $row['job_categories_id'] ?>"><?= $row['name'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="field">
                            <label class="label" for="type">Qual o tipo de vaga?</label>
                            <div class="control">
                                <div class="select">
                                    <select name="type" id="type" required>
                                        <option value="" selected disabled hidden>Selecione...</option>
                                        <?php while ($row = $type->fetch_assoc()) { ?>
                                            <option value="<?= $row['job_type_id'] ?>"><?= $row['name'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="field">
                            <label class="label" for="description">Descrição da Vaga</label>
                            <div class="control">
                                <textarea class="textarea" name="description" id="description" placeholder="Descreva sua vaga"></textarea>
                            </div>
                        </div>
                        <div class="buttons">
                            <button type="submit" name="add-job" class="button is-link">Salvar e continuar</button>
                            <a class="button is-light" href="/account/apps/">Cancelar</a>
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
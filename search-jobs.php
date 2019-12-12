<?php
require_once('settings/core.php');
if ($_GET['save'] == "$w") {
    $message = '<div class="notification is-success"><button class="delete"></button>Inscrição realizada com sucesso! :D</div>';
}
if ($_GET['error'] == "$w") {
    $message = '<div class="notification is-link"><button class="delete"></button>Você já esta inscrito nessa vaga.</span></div>';
}
if ($_GET['nologed'] == "$w") {
    $message = '<div class="notification is-link"><button class="delete"></button>Você precisa estar logado para se inscrever em uma vaga <span class="ec ec-raised-hands"></span></div>';
}

if (isset($_GET['subscribe'])) {
    if (isset($user_q['user_id'])) {
        $post_id = $_GET['subscribe'];
        $user_id = $user_q['user_id'];

        $sql = "INSERT INTO user_has_job (user_id, job_id) VALUES ($user_id, $post_id)";

        if ($conn->query($sql) === TRUE) {
            header("Location: $site/search-jobs?save=$w");
        } else {
            header("Location: $site/search-jobs?error=$w");
        }
    } else {
        header("Location: $site/search-jobs?nologed=$w");
    }
}
/* --- PRECISA DE MANUTENÇÂO --- */
$category = $conn->query("SELECT job_categories.job_categories_id, job_categories.name FROM job_categories, job WHERE job.job_categories_id = job_categories.job_categories_id ORDER BY name");

$type = $conn->query("SELECT job_type.job_type_id, job_type.name FROM job_type, job WHERE job.job_type_id = job_type.job_type_id ORDER BY name");

if (isset($_GET['categoria'])) {
    $id_cargo = $_GET['categoria'];
    $cargo = " AND job_categories_id = $id_cargo ";
} else {
    $cargo = "";
}
if (isset($_GET['tipo'])) {
    $id_tipo = $_GET['tipo'];
    $tipo = " AND job_type_id = $id_tipo ";
} else {
    $tipo = "";
}

if (isset($_GET['search'])) {
    $sql = "SELECT * FROM job WHERE ( title LIKE '%" . $_GET['search'] . "%' OR text LIKE '%" . $_GET['search'] . "%') AND status = 1 $cargo $tipo ORDER BY published_date DESC";
} else {
    $sql = "SELECT * FROM job WHERE status = 1 $cargo $tipo ORDER BY published_date DESC";
}

$result = $conn->query($sql);
/* --- PRECISA DE MANUTENÇÂO --- */

$job_verify = "SELECT job.job_id FROM user, job, user_has_job WHERE user.user_id = user_has_job.user_id AND job.job_id = user_has_job.job_id AND user.user_id = $user_q[user_id]";
$job_result = $conn->query($job_verify);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pesquisa de vagas no <?php echo $sitename; ?> - <?php echo $sitename; ?></title>
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

    <section class="hero is-dark is-medium has-bg-img">
        <div class="hero-body has-text-centered">
            <div class="container">
                <h1 class="title">Empregos</h1>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="content">
                <form action="/search-jobs/" method="get">
                    <div class="field is-grouped is-grouped-multiline">
                        <div class="control">
                            <div class="select">
                                <select name="categoria" id="categoria">
                                    <option value="" selected disabled hidden>Categoria</option>
                                    <?php while ($row = $category->fetch_assoc()) { ?>
                                        <option value="<?= $row['job_categories_id'] ?>"><?= $row['name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="control">
                            <div class="select">
                                <select name="tipo" id="tipo">
                                    <option value="" selected disabled hidden>Tipo</option>
                                    <?php while ($row = $type->fetch_assoc()) { ?>
                                        <option value="<?= $row['job_type_id'] ?>"><?= $row['name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="button is-info">Aplicar</button>
                    </div>
                </form>
            </div>

            <?php if (isset($_GET['search'])) { ?>
                <p class="subtitle is-size-6"><?= $result->num_rows ?> resultados para '<?= $_GET['search'] ?>'.</p>
            <?php } ?>

            <?php echo $message; ?>

            <div class="columns is-multiline">
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <?php
                        $avatar_a = $conn->query("SELECT avatar FROM user WHERE user_id = $row[author]");
                        $avatar_q = $avatar_a->fetch_assoc();
                        ?>
                    <div class="column is-half">
                        <div class="card">
                            <header class="card-header">
                                <p class="card-header-title"><?= $row['title'] ?></p>
                                <a href="#" class="card-header-icon" aria-label="more options">
                                    <span class="icon">
                                        <div style="background: url('<?= $avatar_q['avatar'] ?>') center center; background-size: auto 24px; border-radius: 50%; width: 24px; height: 24px;">
                                        </div>
                                    </span>
                                </a>
                            </header>
                            <div class="card-content">
                                <div class="content">
                                    <?= substr($row['text'], 0, 280) ?>
                                </div>
                                <div class="tags has-addons">
                                    <span class="tag"><i class="far fa-clock"></i></span>
                                    <span class="tag"><time datetime="<?= date('d/m/Y', strtotime($row['published_date'])) ?>"><?= date('j M \d\e Y, H:i', strtotime($row['published_date'])) ?></time></span>
                                </div>
                            </div>
                            <footer class="card-footer">
                                <a href="#" class="card-footer-item">
                                    <span class="icon is-small">
                                        <i class="far fa-bookmark"></i>
                                    </span>
                                </a>
                                <a href="<?php echo "/search-jobs/?subscribe=$row[job_id]"; ?>" class="card-footer-item">Inscrever-se</a>
                                <a href="/job/<?php echo $row['job_id']; ?>" class="card-footer-item">Ver</a>
                            </footer>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>

    <?php include_once('includes/footer.php'); ?>

    <script src="/assets/js/bulma.js"></script>
    <script src="/assets/js/main.js"></script>

</body>

</html>
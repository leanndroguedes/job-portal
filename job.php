<?php
require_once('settings/core.php');

if (isset($_GET['jobid'])) {
    $job_id = $_GET['jobid'];

    $sql = 
    "SELECT
    job.job_id,
    job.author,
    job_categories.job_categories_id,
    title,
    published_date,
    text,
    job_type.name job_type_name,
    job_categories.name job_categories_name,
    user.displayname,
    email,
    user.avatar
    FROM 
    job,
    job_type,
    job_categories,
    user
    WHERE
    job.job_type_id = job_type.job_type_id
    AND job.job_categories_id = job_categories.job_categories_id
    AND job.author = user.user_id
    AND job.job_id = $job_id";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        header("Location: $site/not-found.php");
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $row['title'] ?> - <?php echo $sitename; ?></title>
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
            <h1 class="title"><?= $row['title'] ?></h1>
            <div class="columns is-vcentered is-mobile">
                <div class="column is-narrow">
                    <div style="background: url('<?= $row['avatar'] ?>') center center; background-size: auto 32px; border-radius: 50%; width: 32px; height: 32px;"></div>
                </div>
                <div class="column">
                    <p class="title is-size-7"><?= explode(" ", $row['displayname'])[0] ?> <?= explode(" ", $row['displayname'])[1] ?></p>
                    <p class="subtitle is-size-7"><?= $row['email'] ?></p>
                </div>
            </div>
            <div class="box">
                <div class="field is-grouped is-grouped-multiline">
                    <div class="control">
                        <div class="tags has-addons">
                            <span class="tag"><i class="far fa-clock"></i></span>
                            <span class="tag"><time datetime="<?= date('d/m/Y', strtotime($row['published_date'])) ?>"><?= date('j M \d\e Y, H:i', strtotime($row['published_date'])) ?></time></span>
                        </div>
                    </div>

                    <div class="control">
                        <div class="tags has-addons">
                            <span class="tag"><i class="far fa-money-bill-alt"></i></span>
                            <span class="tag"></span>
                        </div>
                    </div>

                    <div class="control">
                        <div class="tags has-addons">
                            <span class="tag"><i class="fas fa-briefcase"></i></span>
                            <span class="tag"><?= $row['job_type_name'] ?></span>
                        </div>
                    </div>
                </div>
                <div class="content is-medium">
                    <p><?= $row['text'] ?></p>
                </div>
            </div>
        </div>
    </section>

    <?php include_once('includes/footer.php'); ?>

    <script src="/assets/js/bulma.js"></script>
    <script src="/assets/js/main.js"></script>

</body>

</html>
<?php
require_once('settings/core.php');
require_once("includes/cpf_validation.php");

if (isset($_SESSION['user_id'])) {
    header("Location: $site");
}

$name_class = '';
$cpf_class = '';
$birthday_class = '';
$emailaddress_class = '';
$password_class = '';
$password_repeat_class = '';

if (isset($_POST['register'])) {
    $profile_user = $_POST['profile_user'];
    $name = $_POST['name'];
    $cpf_number = $_POST['cpf'];
    $day = $_POST['day'];
    $month = $_POST['month'];
    $year = $_POST['year'];
    $gender = $_POST['gender'];
    $email = $_POST['emailAddress'];
    $password_new = $_POST['passwordNew'];
    $password_new_repeat = $_POST['passwordNewRepeated'];
    $termsOfServiceAccepted = $_POST['termsOfServiceAccepted'];

    if (empty($name)) {
        $error = 1;
        $name_errors = '<p class="help is-danger">Precisamos do seu nome completo.</p>';
        $name_class = 'is-danger';
    }

    if (!valida_cpf($cpf_number)) {
        $error = 1;
        $cpf_errors = '<p class="help is-danger">Precisamos de um CPF válido.</p>';
        $cpf_class = 'is-danger';
    } else {
        $cpf_verify = $conn->query("SELECT * FROM user WHERE cpf='$cpf_number' LIMIT 1");
        if ($cpf_verify->num_rows == 1) {
            $error = 1;
            $cpf_errors = '<p class="help is-danger">O CPF fornecido já foi utilizado.</p>';
            $cpf_class = 'is-danger';
        }
    }

    if (empty($gender)) {
        $error = 1;
        $gender_errors = '<p class="help is-danger">Este campo é obrigatório.</p>';
    }

    $email_verify = $conn->query("SELECT * FROM user WHERE email='$email' LIMIT 1");
    if ($email_verify->num_rows == 1) {
        $error = '1';
        $emailaddress_errors = '<p class="help is-danger">O e-mail fornecido já foi utilizado.</p>';
        $emailaddress_class = 'is-danger';
    } else {
        if (empty($email)) {
            $error = '1';
            $emailaddress_errors = '<p class="help is-danger">Este campo é obrigatório.</p>';
            $emailaddress_class = 'is-danger';
        } else {
            if (!preg_match("/^[A-Z0-9._-]{2,}+@[A-Z0-9._-]{2,}\.[A-Z0-9._-]{2,}$/i", $email)) {
                $error = '1';
                $emailaddress_errors = '<p class="help is-danger">Você precisa fornecer um e-mail válido.</p>';
                $emailaddress_class = 'is-danger';
            }
        }
    }

    if (empty($password_new)) {
        $error = 1;
        $password_errors = '<p class="help is-danger">Este campo é obrigatório.</p>';
        $password_class = 'is-danger';
    } else {
        if (strlen($password_new) < 8) {
            $error = 1;
            $password_errors = '<p class="help is-danger">Segurança da senha: Falhou</p>';
            $password_class = 'is-danger';
        } else {
            if (empty($password_new_repeat)) {
                $error = 1;
                $password_repeat_errors = '<p class="help is-danger">Este campo é obrigatório.</p>';
                $password_repeat_class = 'is-danger';
            } else {
                if ($password_new != $password_new_repeat) {
                    $error = 1;
                    $password_repeat_errors = '<p class="help is-danger">As senhas não conferem.</p>';
                    $password_repeat_class = 'is-danger';
                }
            }
        }
    }

    if (empty($day)) {
        $error = '1';
        $day_class = 'is-danger';
        $birthdate_errors = '<p class="help is-danger">Este campo é obrigatório.</p>';
    }
    if (empty($month)) {
        $error = '1';
        $month_class = 'is-danger';
        $birthdate_errors = '<p class="help is-danger">Este campo é obrigatório.</p>';
    }
    if (empty($year)) {
        $error = '1';
        $year_class = 'is-danger';
        $birthdate_errors = '<p class="help is-danger">Este campo é obrigatório.</p>';
    }

    if ($termsOfServiceAccepted != 1) {
        $error = 1;
        $termsOfServiceAccepted_errors = '<p class="help is-danger">Este campo é obrigatório.</p>';
    }

    if ($error != 1) {

        $sql = "INSERT INTO user (displayname, birthdate, gender, cpf, email, password, profile_user_id) VALUES ('$name', '$year-$month-$day', '$gender', $cpf_number, '$email', '" . md5($password_new) . "', $profile_user)";
        if ($conn->query($sql) === TRUE) {
            $user_verify = $conn->query("SELECT * FROM user WHERE email = '$email' AND password = '" . md5($password_new) . "'");
            $user_fetch = $user_verify->fetch_assoc();
            $_SESSION['user_id'] = $user_fetch['user_id'];
            header("Location: $site/success/");
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inscrever-se - <?php echo $sitename; ?></title>
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

    <section class="hero section">
        <div class="container">

            <h1 class="title">Criar sua Conta</h1>

            <?php echo $message; ?>

            <form action="" method="post">
                <div class="field">
                    <div class="label">Tipo de conta</div>
                    <div class="control">
                        <label class="radio">
                            <input type="radio" name="profile_user" value="1" checked <?php if ($profile_user == 0) {echo 'checked'; }?>>
                            Para mim
                        </label>
                        <label class="radio">
                            <input type="radio" name="profile_user" value="2" <?php if ($profile_user == 1) {echo 'checked'; }?>>
                            Para gerenciar meu negócio
                        </label>
                    </div>
                </div>
                <div class="field">
                    <label class="label" for="name">Como devemos chamar você?</label>
                    <div class="control">
                        <input class="input <?php echo $name_class; ?>" type="text" name="name" placeholder="Nome completo" value="<?php echo $name; ?>" autofocus>
                    </div>
                    <?php echo $name_errors; ?>
                </div>
                <div class="field">
                    <label class="label" for="cpf">CPF</label>
                    <div class="control">
                        <input class="input <?php echo $cpf_class; ?>" type="number" name="cpf" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="<?php echo $cpf_number; ?>" placeholder="CPF">
                    </div>
                    <?php echo $cpf_errors; ?>
                </div>
                <label class="label">Data de nascimento</label>
                <div class="field is-grouped is-grouped-multiline">
                    <div class="control">
                        <div class="select <?php echo $day_class; ?>">
                            <select name="day">
                                <option value="">Dia</option>
                                <?php for ($i = 1; $i < 32; $i++) { ?>
                                    <option value="<?php echo $i ?>" <?php if ($day == $i) { ?>selected<?php } ?>><?php echo $i ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="control">
                        <div class="select <?php echo $month_class; ?>">
                            <select name="month">
                                <option value="">Mês</option>
                                <option value="1" <?php if ($month == '1') { ?>selected<?php } ?>>Janeiro</option>
                                <option value="2" <?php if ($month == '2') { ?>selected<?php } ?>>Fevereiro</option>
                                <option value="3" <?php if ($month == '3') { ?>selected<?php } ?>>Março</option>
                                <option value="4" <?php if ($month == '4') { ?>selected<?php } ?>>Abril</option>
                                <option value="5" <?php if ($month == '5') { ?>selected<?php } ?>>Maio</option>
                                <option value="6" <?php if ($month == '6') { ?>selected<?php } ?>>Junho</option>
                                <option value="7" <?php if ($month == '7') { ?>selected<?php } ?>>Julho</option>
                                <option value="8" <?php if ($month == '8') { ?>selected<?php } ?>>Agosto</option>
                                <option value="9" <?php if ($month == '9') { ?>selected<?php } ?>>Setembrobro</option>
                                <option value="10" <?php if ($month == '10') { ?>selected<?php } ?>>Outubro</option>
                                <option value="11" <?php if ($month == '11') { ?>selected<?php } ?>>Novembro</option>
                                <option value="12" <?php if ($month == '12') { ?>selected<?php } ?>>Dezembro</option>
                            </select>
                        </div>
                    </div>
                    <div class="control">
                        <div class="select <?php echo $year_class; ?>">
                            <select name="year">
                                <option value="">Ano</option>
                                <?php for ($i = 2011; $i > 1900; $i--) { ?>
                                    <option value="<?php echo $i ?>" <?php if ($year == $i) { ?>selected<?php } ?>><?php echo $i ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <?php echo $birthdate_errors; ?>
                </div>
                <div class="field">
                    <div class="label">Sexo</div>
                    <div class="control">
                        <label class="radio">
                            <input type="radio" name="gender" value="female" <?php if ($gender == 'female') {echo 'checked'; }?>>
                            Feminino
                        </label>
                        <label class="radio">
                            <input type="radio" name="gender" value="male" <?php if ($gender == 'male') {echo 'checked'; }?>>
                            Masculino
                        </label>
                        <label class="radio">
                            <input type="radio" name="gender" value="neutral" <?php if ($gender == 'nautral') {echo 'checked'; }?>>
                            Não binário
                        </label>
                    </div>
                    <?php echo $gender_errors; ?>
                </div>
                <div class="field">
                    <label class="label" for="email">E-mail</label>
                    <div class="control">
                        <input class="input <?php echo $emailaddress_class; ?>" type="email" name="emailAddress" value="<?php echo $email; ?>" placeholder="Seu endereço de e-mail">
                    </div>
                    <?php echo $emailaddress_errors; ?>
                </div>
                <div class="field">
                    <label class="label" for="passwordNew">Senha</label>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <input class="input <?php echo $password_class; ?>" type="password" name="passwordNew" placeholder="Senha">
                            </div>
                            <?php echo $password_errors; ?>
                        </div>
                        <div class="field">
                            <div class="control">
                                <input class="input <?php echo $password_repeat_class; ?>" type="password" name="passwordNewRepeated" placeholder="Confirmar">
                            </div>
                            <?php echo $password_repeat_errors; ?>
                            <p>Utilize, pelo menos, 8 caracteres. Inclua, pelo menos, uma letra, um número e um caracter especial.</p>
                        </div>
                    </div>
                </div>
                <div class="field">
                    <div class="control">
                        <label class="checkbox">
                            <input type="checkbox" name="termsOfServiceAccepted" value="1" <?php if ($termsOfServiceAccepted == '1') {
                                                                                                echo "checked";
                                                                                            } ?>>
                            Eu concordo com os <a href="#">Termos e condições</a> do <?php echo $sitename; ?>.
                        </label>
                    </div>
                    <?php echo $termsOfServiceAccepted_errors; ?>
                </div>
                <div class="field is-grouped">
                    <div class="control">
                        <button type="submit" name="register" class="button is-link">Inscrever-se</button>
                    </div>
                    <div class="control">
                        <a href="/login/" class="button is-light">Faça login em vez disso</a>
                    </div>
                </div>
            </form>

        </div>
    </section>

    <?php include_once('includes/footer.php'); ?>

    <script src="/assets/js/bulma.js"></script>
    <script src="/assets/js/main.js"></script>

</body>

</html>
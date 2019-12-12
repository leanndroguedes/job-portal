<header>
    <nav class="navbar" role="navigation" aria-label="main dropdown navigation">
    <!-- <nav class="navbar is-spaced" role="navigation" aria-label="main dropdown navigation"> -->
        <div class="container">
            <div class="navbar-brand">
                <a class="navbar-item" href="/">
                    <strong><?php echo $sitename; ?></strong>
                    <!-- <img class="image" src="/static/images/logo.svg" alt=""> -->
                </a>

                <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                </a>
            </div>

            <div id="navbarBasicExample" class="navbar-menu">
                <div class="navbar-start">
                    <a class="navbar-item" href="/">Início</a>
                    <!-- <a class="navbar-item" href="/minha-area/">Conta</a> -->
                    <a class="navbar-item" href="/faq/">Ajuda</a>
                    <a class="navbar-item" href="/search-jobs/">Procurar empregos</a>
                    <a class="navbar-item" href="/about-us/contact/">Sobre</a>
                </div>

                <div class="navbar-end">
                    <!-- <div class="navbar-item">
                        <div class="field is-expanded">
                            <form action="/vagas/" method="get">
                                <div class="control">
                                    <input class="input is-flat" type="text" name="search" placeholder="Função ou Palavra Chave" value="<?= isset($_GET['search']) ? $_GET['search'] : "" ?>">
                                </div>
                            </form>
                        </div>
                    </div> -->
                    <?php if (!isset($_SESSION['user_id'])) { ?>
                        <a class="navbar-item" href="/account/overview/">Entrar</a>
                    <?php } else { ?>
                        <div class="navbar-item has-dropdown is-hoverable is-mobile">
                            <a class="navbar-link">
                                Perfil
                            </a>

                            <div class="navbar-dropdown">
                                <a class="navbar-item" href="/account/overview/">
                                    <!-- <span class="icon">
                                        <i class="far fa-address-card"></i>
                                    </span> -->
                                    <span>Conta</span>
                                </a>
                                <!-- <?php if ($user_q['profile_user_id'] == 2) { ?>
                                    <a class="navbar-item" href="/account/apps/">
                                        <span class="icon">
                                            <i class="fas fa-business-time"></i>
                                        </span>
                                        <span>Gerenciar vagas</span>
                                    </a>
                                    <a class="navbar-item" href="#">
                                        <span class="icon">
                                            <i class="far fa-file-alt"></i>
                                        </span>
                                        <span>Estatisticas</span>
                                    </a>
                                <?php } else { ?>
                                    <a class="navbar-item" href="/account/subscription/receipt/">
                                        <span class="icon">
                                            <i class="fas fa-business-time"></i>
                                        </span>
                                        <span>Incrições</span>
                                    </a>
                                    <a class="navbar-item" href="#saved-jobs/">
                                        <span class="icon">
                                            <i class="far fa-file-alt"></i>
                                        </span>
                                        <span>Trabalhos salvos</span>
                                    </a>
                                <?php } ?>
                                <a class="navbar-item" href="/account/change-password/">
                                    <span class="icon">
                                        <i class="fas fa-cog"></i>
                                    </span>
                                    <span>Mudar senha</span>
                                </a>
                                <hr class="dropdown-divider"> -->
                                <a class="navbar-item" href="/logout/">
                                    <!-- <span class="icon">
                                        <i class="fas fa-sign-out-alt"></i>
                                    </span> -->
                                    <span>Sair</span>
                                </a>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </nav>
</header>
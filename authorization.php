<?php 
include('database/db-connection.php');
include('database/get-function.php');
include('database/update-session.php');
?>
<!DOCTYPE html>
<?php include('php-elements/head.php'); ?>
<body class="single is-preload">
    <div id="wrapper">
        <!-- Header -->
        <?php include('php-elements/header.php'); ?>
        <!-- Menu -->
        <?php include('php-elements/menu.php'); ?>
        <!-- Main -->
        <div id="main">
            <!-- Post -->
            <article class="post">
                <section>
                <h3>Вход в аккаунт</h3>
                    <form method="POST" action="database/log.php">
                        <div class="row gtr-uniform">
                            <div class="col-12">
                                <input type="text" name="login" value="" placeholder="Логин или E-mail" />
                            </div>
                            <div class="col-12">
                                <input type="password" name="password" value="" placeholder="Пароль" />
                            </div>
                            <?php include('form_errors.php'); ?> 
                            <div class="col-12">
                                <ul class="actions">
                                    <li><input type="submit" value="Войти" /></li>
                                    <li><input type="reset" value="Сбросить данные" /></li>
                                </ul>
                            </div>
                        </div>
                    </form>
                </section>
            </article>
        </div>
    </div>
    <!-- Scripts -->
    <?php include('php-elements/js-scripts.php'); ?>
</body>

</html>
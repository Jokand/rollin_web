<?php 
include('database/db-connection.php');
include('database/get-function.php');
include('database/update-session.php');
?>

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
                    <h3>Изменить пароль</h3>
                    <form method="POST" action="database/password_change_db.php">
                        <div class="row gtr-uniform">
                            <div class="col-12">
                                <input type="password" name="old_password" value="" minlength="8" placeholder="Старый пароль" />
                            </div>
                            <div class="col-12">
                                <input type="password" name="new_password" value="" minlength="8" placeholder="Новый пароль" />
                            </div>
                            <div class="col-12">
                                <input type="password" name="re_password" value="" minlength="8" placeholder="Повторите новый пароль" />
                            </div>
                            <?php include('form_errors.php'); ?>
                            <div class="col-12">
                                <ul class="actions">
                                    <li><input type="submit" value="Изменить" /></li>
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
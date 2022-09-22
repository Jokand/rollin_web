<?php
include('database/db-connection.php');
include('database/get-function.php');
include('database/update-session.php');
?>
<!DOCTYPE html>
<html lang="en">

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
                    <h2>Регистрация</h2>
                    <form method="POST" action="database/reg.php" enctype="multipart/form-data">
                        <div class="row gtr-uniform">
                            <div class="col-12">
                                <input type="text" name="name" value=""  minlength="3" maxlength="20" placeholder="Логин" />
                            </div>
                            <div class="col-12">
                                <input type="email" name="email" value="" placeholder="E-mail" />
                            </div>
                            <!-- <div class="col-12">
                                <textarea name="content" placeholder="О себе" rows="4"></textarea>
                            </div> 
                            <div class="col-12">
                                <input type="text" name="vk_link" placeholder="Ссылка на ваш профиль в ВКонтакте" />
                            </div> -->
                            <div class="col-12">
                                <input type="password" name="password" value="" minlength="8" placeholder="Пароль" />
                            </div>
                            <div class="col-12">
                                <input type="password" name="repeat_password" value="" minlength="8" placeholder="Повторение пароля" />
                            </div>
                            <div class="col-12">
                                <h2>Аватар</h2>
                                <input type="file" accept='image/jpeg,image/png,image/jpg' name="file">
                            </div>
                            <?php include('form_errors.php'); ?>
                            <div class="col-12">
                                <ul class="actions">
                                    <li><input type="submit" value="Зарегестрироваться" /></li>
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
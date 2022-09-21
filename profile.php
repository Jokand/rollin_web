<?php
include('database/db-connection.php');
include('database/get-function.php');
include('database/update-session.php');
$user = getUserById($_GET['user_id']);
?>

<html lang="ru">

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
                    <h2>Профиль</h2>
                    <img style=" width : 150px; height : 150px; border-radius: 50%;" src=<?= getImageUserPath($user['id']) ?> alt="" />
                        <? if ($user['id'] != $_SESSION['user_id']) : ?>
                            <p>Имя: <?= $user['name'] ?> </p>
                            <p>Обо мне: <?= $user['about_user'] ?></p>
                            <p> Страница VK: <a target="_blank" href="<?= $user['link_vk'] ?>"><?= $user['link_vk'] ?></a></p>
                            <p>Email: <?= $_SESSION['email'] ?></p>
                        <? else : ?>
                            <form method="POST" action="database/changing_profile_data.php">
                            <div class="col-6 col-12-xsmall">
                                <h2 style="margin: 0.5em 0 0.2em 0;">Имя</h2>
                                <input minlength="3" maxlength="20" name="username" type="text" value="<?= $user['name'] ?>" placeholder="Никнейм" />
                            </div>
                            <div class="col-12">
                                <h2 style="margin: 0.5em 0 0.2em 0;">О мне</h2>
                                <textarea name="about_user" maxlength="500" placeholder="Напишите о себе" rows="3" value="<?= $user['about_user'] ?>"><?= $user['about_user'] ?></textarea>
                            </div>
                            <div class="col-6 col-12-xsmall">
                                <h2 style="margin: 0.5em 0 0.2em 0;">Ссылка на страницу ВКонтакте</h2>
                                <input name="vk_link" type="text" value="<?= $user['link_vk'] ?>" placeholder="vk.com/userlink" />
                            </div>
                            <div class="col-6 col-12-xsmall" style="margin: 0 0 1.6em 0;">
                                <h2 style="margin: 0.5em 0 0.2em 0;">E-mail</h2>
                                <input disabled type="email" name="demo-email" id="demo-email" value="<?= $_SESSION['email'] ?>" placeholder="Email" />
                            </div>
                </section>
                <?php include('form_errors.php'); ?>
                <section>
                    <ul class="actions">
                        <li><a href="password_change.php" class="button fit">Изменить пароль</a></li>
                        <li><a href="<?= 'database/exit.php' ?>" class="button fit">Выйти из аккаунта</a></li>
                        <li><input type="submit" value="Сохранить" /></li>
                    </ul>
                </section>
                </form>
            <? endif; ?>
            </article>
        </div>
    </div>
    <!-- Scripts -->
    <?php include('php-elements/js-scripts.php'); ?>
</body>

</html>
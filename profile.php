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
                    <p>Имя: <?= $user['name']?></p>
                    <p>Обо мне: <?= $user['about_user']?></p>
                    <p> Страница VK:  <a target="_blank" href="<?= $user['link_vk']?>"><?= $user['link_vk']?></a></p>
                    <? if($user['id']==$_SESSION['user_id']): ?>
                    <p>Email: <?= $_SESSION['email'] ?></p>
                    <? endif; ?>
                </section>
                <section>
                    <ul class="actions">
                        <li><a href="password_change.php" class="button fit">Изменить пароль</a></li>
                        <li><a href="<?= 'database/exit.php?id=' . $_SESSION['user_id']?>" class="button fit">Выйти из аккаунта</a></li>
                    </ul>
                </section>
            </article>
        </div>
    </div>
    <!-- Scripts -->
    <?php include('php-elements/js-scripts.php'); ?>
</body>

</html>
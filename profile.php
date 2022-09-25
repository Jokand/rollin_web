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
                                <input name="vk_link" type="URL" value="<?= $user['link_vk'] ?>" placeholder="https://vk.com/userlink" />
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
            <details>
                <summary style="font-size: larger;">Игры которые ведёт пользователь</summary>
                <div class="table-wrapper">
                    <table class="alt">
                        <?php
                        $held_games = $database->query("SELECT `id`, `title`, `system`, `beginning_game`, `end_game`, `status`  FROM `games` WHERE `id_master` = '{$_GET['user_id']}'")->fetchAll(PDO::FETCH_ASSOC);
                        if (!empty($held_games)) :
                        ?>
                            <thead>
                                <tr>
                                    <th>Название</th>
                                    <th>Система</th>
                                    <th>Время</th>
                                    <th>Статус</th>
                                </tr>
                            </thead>
                            <? foreach ($held_games as $held_game) : ?>
                                <tbody>
                                    <tr>
                                        <td><a href="<?= 'single.php?id=' . $held_game['id'] ?>"><?= $held_game['title']; ?></a></td>
                                        <td><?= $held_game['system']; ?></td>
                                        <td><time class="published" datetime="<?= $held_game['beginning_game'] ?>"><?= formatDate($held_game['beginning_game'], 'dd MMM y'); ?></time>
                                            <time class="published" datetime="<?= $held_game['beginning_game'] ?>"><?= formatDate($held_game['beginning_game'], 'HH:mm') . " - " .  formatDate($held_game['end_game'], 'HH:mm') ?></time>
                                        </td>
                                        <td><?= status_in_rus($held_game['status']); ?></td>
                                    </tr>
                                <? endforeach;
                        else : ?>
                                <p>Вы не провели ни одной игры</p>
                            <? endif ?>
                                </tbody>
                    </table>
                </div>
            </details>
            <details>
                <summary style="font-size: larger;">Игры в которые сыграл пользователь</summary>
                <div class="table-wrapper">
                    <table class="alt">
                        <?php
                        $id_games = $database->query("SELECT `id_game`  FROM `list_of_registered` WHERE `id_gamer` = '{$_GET['user_id']}'")->fetchAll(PDO::FETCH_ASSOC);
                        if (!empty($id_games)) : ?>
                            <thead>
                                <tr>
                                    <th>Название</th>
                                    <th>Система</th>
                                    <th>Время</th>
                                    <th>Статус</th>
                                </tr>
                            </thead>
                            <? foreach ($id_games as $id_game) :
                                $participation_game = $database->query("SELECT `id`, `title`, `system`, `beginning_game`, `end_game`, `status`  FROM `games` WHERE `id` = '{$id_game['id_game']}'")->fetch(PDO::FETCH_ASSOC);  ?>
                                <tbody>
                                    <tr>
                                        <td><a href="<?= 'single.php?id=' . $participation_game['id'] ?>"><?= $participation_game['title']; ?></a></td>
                                        <td><?= $participation_game['system']; ?></td>
                                        <td><time class="published" datetime="<?= $participation_game['beginning_game'] ?>"><?= formatDate($participation_game['beginning_game'], 'dd MMM y'); ?></time>
                                            <time class="published" datetime="<?= $participation_game['beginning_game'] ?>"><?= formatDate($participation_game['beginning_game'], 'HH:mm') . " - " .  formatDate($participation_game['end_game'], 'HH:mm') ?></time>
                                        </td>
                                        <td><?= status_in_rus($participation_game['status']); ?></td>
                                    </tr>
                                <? endforeach;
                        else : ?>
                                <p>Вы не записались ни на одну игру</p>
                            <? endif ?>
                                </tbody>
                    </table>
                </div>

            </details>
            </article>
        </div>
    </div>
    <!-- Scripts -->
    <?php include('php-elements/js-scripts.php'); ?>
</body>

</html>
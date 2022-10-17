<?php
include('database/db-connection.php');
include('database/get-function.php');
include('database/update-session.php');
if ($_SESSION['role'] != 'admin') {
    header('Location: /index.php');
};
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
                <summary style="font-size: larger;">Игры требующие подтверждения</summary>
                <div class="table-wrapper">
                    <table class="alt">
                        <?php

                        $games_confirmation = getPostsByStatus('unconfirmed');
                        if (!empty($games_confirmation)) :
                        ?>
                            <thead>
                                <tr>
                                    <th>Название</th>
                                    <th>Мастер</th>
                                    <th>Система</th>
                                    <th>Изменение</th>
                                    <th>Статус</th>
                                </tr>
                            </thead>
                            <? foreach ($games_confirmation as $game_confirmation) : ?>
                                <tbody>
                                    <tr>
                                        <td><a href="<?= 'single.php?id=' . $game_confirmation['id'] ?>"><?= $game_confirmation['title']; ?></a></td>

                                        <td><a href="<?= 'profile.php?user_id=' . $game_confirmation['id_master'];?>"><?= getUserById($game_confirmation['id_master'])['name']; ?></a></td>

                                        <td><?= $game_confirmation['system']; ?></td>
                                        <form method="POST" action="game_update.php">
                                            <input name="id" value='<?= $game_confirmation['id'] ?>' hidden>
                                            <td><input type="submit" value="Редактировать" /></td>
                                        </form>
                                        <form method="POST" action="database/game_confirm.php">
                                            <input name="id" value='<?= $game_confirmation['id'] ?>' hidden>
                                            <input name="status" value='accept' hidden>
                                            <td><input type="submit" value="Подтвердить" /> 
                                        </form>  
                                        <form method="POST" action="database/game_confirm.php">
                                            <input name="id" value='<?= $game_confirmation['id'] ?>' hidden>
                                            <input name="status" value='reject' hidden>
                                            <input type="submit" value="Отклонить" /></td>
                                        </form>                       
                                    </tr>
                                <? endforeach;
                        else : ?>
                                <p>Нет игр, требующих подтвержения</p>
                            <? endif ?>
                                </tbody>
                    </table>

                </div>
                <details>
                    <summary style="font-size: larger;">Список пользователей</summary>
                    <div class="table-wrapper">
                        <table class="alt">
                            <?php
                            $held_games = $database->query("SELECT `id`, `title`, `system`, `dategame`, `beginning_game`, `end_game`, `status`  FROM `games` WHERE `id_master` = '{$_GET['user_id']}'")->fetchAll(PDO::FETCH_ASSOC);
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
                                            <td><time class="published" datetime="<?= $held_game['dategame'] ?>"><?= formatDate($held_game['dategame'], 'dd MMM y'); ?></time>
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
                    <summary style="font-size: larger;">Архив проведённых игр</summary>
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
                                    $participation_game = $database->query("SELECT `id`, `title`, `system`, `dategame`, `beginning_game`, `end_game`, `status`  FROM `games` WHERE `id` = '{$id_game['id_game']}'")->fetch(PDO::FETCH_ASSOC);  ?>
                                    <tbody>
                                        <tr>
                                            <td><a href="<?= 'single.php?id=' . $participation_game['id'] ?>"><?= $participation_game['title']; ?></a></td>
                                            <td><?= $participation_game['system']; ?></td>
                                            <td><time class="published" datetime="<?= $participation_game['dategame'] ?>"><?= formatDate($participation_game['dategame'], 'dd MMM y'); ?></time>
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
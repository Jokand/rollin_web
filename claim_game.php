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
                    <h2>Заявить игру</h2>
                    <form method="POST" action="database/claim_game_bd.php">
                        <div class="row gtr-uniform">
                            <div class="col-12">
                                <input type="text" name="title" value="" placeholder="Название игры" />
                            </div>
                            <div class="col-12">
                                <h3>Загрузить иллюстрацию</h3>
                                <input type="file" accept='image/jpeg,image/png,image/jpg' name="file">
                            </div>

                            <div class="col-6 col-12-xsmall">
                                <input type="text" name="setting" id="" value="" placeholder="Сеттинг" />
                            </div>
                            <div class="col-6 col-12-xsmall">
                                <input type="text" name="system" id="" value="" placeholder="Система" />
                            </div>
                            <div class="col-6 col-12-xsmall">
                                <input type="text" name="genre" id="" value="" placeholder="Жанр" />
                            </div>
                            <div class="col-6 col-12-xsmall">
                                <select name="loc" id="">
                                    <option value="1">Оффлайн</option>
                                    <option value="2">Онлайн</option>
                                </select>
                            </div>
                            <div class="col-6 col-12-xsmall">
                                <input type="text" name="location" id="" value="" placeholder="Место проведения" />
                            </div>
                            <div class="col-12">
                                <input type="number" name="price" id="" value="" placeholder="Цена с человека" />
                            </div>
                            <div class="col-12">
                                <h3>Дата и время начала и конца игры</h3>
                            </div>
                            <div class="col-2 col-12-xsmall">
                                <input type="date" name="begin_date" id="" value="" placeholder="" />
                            </div>
                            <div class="col-1 col-12-xsmall">
                                <input type="time" name="begin_time" id="" value="" placeholder="" />
                            </div>
                            <div class="col-3 col-12-xsmall">
                                <input type="time" name="end_time" id="" value="" placeholder="" />
                            </div>
                            <div class="col-12">
                                <h2 style="margin: 0.5em 0 0.2em 0;">Описание</h2>
                                <textarea name="description" maxlength="500" placeholder="Описание игры" rows="3"?></textarea>
                            </div>
                            <div class="col-12">
                                <h2 style="margin: 0.5em 0 0.2em 0;">Примечание</h2>
                                <textarea name="remark" maxlength="500" placeholder="Примечание для игроков" rows="3"?></textarea>
                            </div>
                            <?php include('form_errors.php'); ?>
                            <div class="col-12">
                                <ul class="actions">
                                    <li><input type="submit" value="Отправить заявку" /></li>
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
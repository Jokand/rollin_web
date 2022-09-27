<?php
include('database/db-connection.php');
include('database/get-function.php');
include('database/update-session.php');
if($_SESSION['role']=='banned' || $_SESSION['entrance'] == false ){
    header('Location: ../index.php');
}
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
                    <form method="POST" action="database/claim_game_bd.php" enctype="multipart/form-data">
                        <div class="row gtr-uniform">
                            <div class="col-12">
                                <input type="text" name="title" value="" minlength="3" maxlength="50" placeholder="Название игры" />
                            </div>
                            <div class="col-12">
                                <h3>Загрузить иллюстрацию</h3>
                                <input type="file" accept='image/jpeg,image/png,image/jpg' name="file">
                            </div>

                            <div class="col-6 col-12-xsmall">
                                <input type="text" name="setting" id="" value="" minlength="1" maxlength="15" placeholder="Сеттинг" />
                            </div>
                            <div class="col-6 col-12-xsmall">
                                <input type="text" name="system" id="" value="" minlength="1" maxlength="15"  placeholder="Система" />
                            </div>
                            <div class="col-6 col-12-xsmall">
                                <input type="text" name="genre" id="" value="" minlength="1" maxlength="15"  placeholder="Жанр" />
                            </div>
                            <div class="col-6 col-12-xsmall">
                                <select name="environment" id="">
                                    <option value="offline">Офлайн</option>
                                    <option value="online">Онлайн</option>
                                </select>
                            </div>
                            <div class="col-6 col-12-xsmall">
                                <input type="text" minlength="1" maxlength="100"  name="location" id="" value="" placeholder="Место проведения" />
                            </div>
                            <div class="col-12">
                                <h3>Количество человек</h3>
                                <input type="number" name="record" minlength="1" maxlength="15" id="" value="" placeholder="Количество человек" />
                            </div>
                            <div class="col-12">
                                <h3>Цена с человека</h3>
                                <input type="number" name="price" minlength="0" maxlength="9999" id="" value="" placeholder="Цена с человека" />
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
                                <textarea name="description" minlength="10" maxlength="500" placeholder="Описание игры" rows="3"?></textarea>
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
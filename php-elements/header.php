<header id="header">
    <!-- <img src="images/logo.png" alt="Rollin Kazan"> -->
    <h1><a href="index.php">Rollin Kazan</a></h1>
    <nav class="links">
        <ul>
            <li><a href="index.php">Главная</a></li>
            <li><a href="calendar.php">Календарь игр</a></li>
            <li><a href="#">События</a></li>
            <li><a href="#">Партнёры</a></li>
            <?php if ($_SESSION['entrance']) : ?>
                <li><a href="../profile.php?user_id=<?= $_SESSION['user_id']?>">Личный кабинет</a></li>
            <?php else : ?>
                <li><a href="../registration.php">Регистрация</a></li>
                <li><a href="../authorization.php">Вход</a></li>
            <?php endif ?>
        </ul>
    </nav>
    <h1 style="margin-right: 1.2em;"><?= $_SESSION['name']?></h1>
    <nav class="main">
        <ul>
            <li class="search">
                <a class="fa-search" href="#search">Search</a>
                <form id="search" method="get" action="#">
                    <input type="text" name="query" placeholder="Search" />
                </form>
            </li>
            <li class="menu">
                <a class="fa-bars" href="#menu">Menu</a>
            </li>
        </ul>
    </nav>
</header>
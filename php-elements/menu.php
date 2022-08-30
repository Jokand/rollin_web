<section id="menu">

    <!-- Search -->
    <section>
        <form class="search" method="get" action="#">
            <input type="text" name="query" placeholder="Search" />
        </form>
    </section>

    <!-- Links -->
    <section>
        <ul class="links">
            <li>
                <a href="#">
                    <h3>Главная</h3>
                    <p>Feugiat tempus veroeros dolor</p>
                </a>
            </li>
            <li>
                <a href="#">
                    <h3>Dolor sit amet</h3>
                    <p>Sed vitae justo condimentum</p>
                </a>
            </li>
            <li>
                <a href="#">
                    <h3>Feugiat veroeros</h3>
                    <p>Phasellus sed ultricies mi congue</p>
                </a>
            </li>
            <li>
                <a href="#">
                    <h3>Etiam sed consequat</h3>
                    <p>Porta lectus amet ultricies</p>
                </a>
            </li>
        </ul>
    </section>

    <!-- Actions -->
    <section>
        <?php if(!$_SESSION['entrance']) :?>
        <ul class="actions stacked">
            <li><a href="../registration.php" class="button large fit">Регистрация</a></li>
        </ul>
        <ul class="actions stacked">
            <li><a href="../authorization.php" class="button large fit">Вход</a></li>
        </ul>
        <?php endif?>
    </section>

</section>
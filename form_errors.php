<div class="errors">
    <?php if (isset($_SESSION['errors'])) : ?>

        <?php foreach ($_SESSION['errors'] as $error) : ?>

            <div class="error">
                <br>
                <?php echo $error; ?>
            </div>

        <?php endforeach; ?>
    <?php endif;
    unset($_SESSION['errors']);
    ?>
</div>
<?php
include('database/db-connection.php');
include('database/get-function.php');
include('database/update-session.php');
if (!isset($_GET['id'])) {
	header('Location: /index.php');
};
$post = getPostById($_GET['id']);
if (empty($post)) {
	header('Location: /index.php');
};
$post_image = $post['image_path'] == NULL ? '../images/picplug.jpg' : $post['image_path'];
$delete_url = 'database/delete_post.php?id=' . $post['id'];
$user = getUserById($post['id_master']);
$rezervation = $database->query("SELECT * FROM `list_of_registered` WHERE `id_game` = '{$_GET['id']}'")->fetch(PDO::FETCH_ASSOC);
?>

<?php include('php-elements/head.php'); ?>

<body class="single is-preload">

	<!-- Wrapper -->
	<div id="wrapper">

		<!-- Header -->
		<?php include('php-elements/header.php'); ?>

		<!-- Menu -->
		<?php include('php-elements/menu.php'); ?>

		<!-- Main -->
		<div id="main">

			<!-- Post -->
			<article class="post">
				<header>
					<div class="title">
						<h2><a href="#"><?= $post['title'] ?></a></h2>
						<p><?= $post['setting'] . "<br>" . $post['system'] . "<br>" . $post['genre'] ?></p>
					</div>
					<div class="meta">
						<time class="published" datetime="<?= formatDate($post['beginning_game']) ?>"><?= formatDate($post['beginning_game']) ?></time>
						<time class="published" datetime="<?= formatDate($post['end_game']) ?>"><?= formatDate($post['end_game']) ?></time>
						<a href="<?= 'profile.php?user_id=' . $post['id_master']; ?>" class="author"><span class="name"><?= $user["name"] ?></span><img src=<?= getImageUserPath($post['id_master']) ?> alt="" /></a>
					</div>
				</header>
				<span class="image featured"><img src=<?= $post_image ?> alt="" /></span>
				<h3 style="margin: 0 0 0.3em 0;">Завязка</h3>
				<p><?= $post['description'] ?></p>
				<h3 style="margin: 0 0 0.3em 0;">Примечание</h3>
				<p><?= $post['remark'] ?></p>

				<? if ($_SESSION['entrance'] && !$rezervation) : ?>
					<section>
						<form method="POST" action="database/rezervation.php">
							<div class="row gtr-uniform">
								<div class="col-12">
									<input name="id_post" value='<?= $_GET['id'] ?>' hidden style="display: none;">
									<ul class="actions">
										<li><input type="submit" value="Забронировать место" /></li>
									</ul>
								</div>
							</div>
						</form>
					</section>
				<? elseif ($rezervation) : ?>
					<section>
						<h3 style="margin: 0 0 0.3em 0;">Вы забронировали место</h3>
						<p><a href=<?="database/cancel_rezervation.php?user_id=".$_SESSION['user_id']?>>Отменить бронь</a></p>
					</section>
				<? else : ?>
					<section>
						<h3>Чтобы забронировать место вы должны войти или зарегистрироваться</h3>
					</section>
				<? endif ?>


				<div class="row">
					<div class="col-6 col-12-medium">
						<h4>Список участников</h4>
						<ul>
							<?
							$record = getRecordUsersByIdGame($post["id"]);
							for ($i = 0; $i < count($record); $i++) :
								$list = $record[$i];
							?>
								<li><?= getUserById($record[$i]['id_gamer'])['name'] ?></li>
							<? endfor; ?>
						</ul>


					</div>
				</div>

				<footer>
					<ul class="stats">
						<li><a href="/index.php">На главную</a></li>
						<li><a style="font-size: medium;" href="#" class="icon solid fa-users"><?= count(getRecordUsersByIdGame($post["id"])) . "/" . $post['record'] ?></a></li>
						<li><a style="font-size: medium;" href="#" class="icon solid fa-ruble-sign"><?= $post['price'] ?></a></li>
						<li><a style="font-size: medium;" href="#" class="icon solid fa-comment"><?= count(getCommByIdPost($post['id'])) ?></a></li>
					</ul>
				</footer>
			</article>

			<article class="post">
				<? if ($_SESSION['entrance']) : ?>
					<section>
						<h3>Написать комментарий</h3>
						<form method="POST" action="database/add_comment.php">
							<div class="row gtr-uniform">
								<div class="col-12">
									<textarea name="content" placeholder="Максимум 200 символов" rows="2" maxlength="200"></textarea>
									<input name="id_post" value='<?= $_GET['id'] ?>' hidden style="display: none;">
									<input name="id_parent" value='<?= $id_parent ?>' hidden style="display: none;">
								</div>
								<?php include('form_errors.php'); ?>
								<div class="col-12">
									<ul class="actions">
										<li><input type="submit" value="Прокомментировать" /></li>
									</ul>
								</div>
							</div>
						</form>
					</section>
				<? else : ?>
					<section>
						<h3>Чтобы комметировать вы должны войти или зарегистрироваться</h3>
					</section>
				<? endif ?>
			</article>

			<?php
			$comms = getCommByIdPost($_GET['id']);
			for ($i = count($comms); $i > 0; $i--) :
				$comm = $comms[$i - 1];
				$user = getUserById($comm['id_author']);
				$user_url = 'profile.php?user_id=' . $user['id'];
			?>
				<article class="post" style="padding-bottom : 0px; margin: 0 0 1em 0">
					<header style="margin-bottom : 0px;">
						<div class="title">
							<p style="font-size: 0.9em;"><?= $comm['content'] ?></p>

						</div>
						<div class="meta" style="padding: 2.5em 3em 1.75em 3em;">
							<a href="<?= $user_url ?>" class="author"><span class="name"><?= $user['name'] ?></span><img src=<?= getImageUserPath($user['id']) ?> alt="" /></a>
							<time class="published" datetime="<?= formatDate($comm['date']) ?>"><?= formatDate($comm['date']) ?></time>
						</div>
					</header>
				</article>
			<?php endfor ?>
			</article>
		</div>

	</div>


	</div>

	<!-- Scripts -->
	<?php include('php-elements/js-scripts.php'); ?>

</body>

</html>
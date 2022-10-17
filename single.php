<?php
include('database/db-connection.php');
include('database/get-function.php');
include('database/update-session.php');
if (isset($_GET['id'])) :
	$post = getPostById($_GET['id']);
	if (!empty($post) && (($post['status'] == 'confirmed') || ($_SESSION['role'] == 'admin' && $post['status'] == 'unconfirmed'))) :
		$post_image = $post['link_to_illustration'] == NULL ? '../images/picplug.jpg' : $post['link_to_illustration'];
		$delete_url = 'database/delete_post.php?id=' . $post['id'];
		$master = getUserById($post['id_master']);
		$rezervation = $database->query("SELECT * FROM `list_of_registered` WHERE `id_game` = '{$_GET['id']}'")->fetch(PDO::FETCH_ASSOC);
		$record = getRecordUsersByIdGame($post["id"]); ?>
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
						<header>
							<div class="title">
								<h2><a href="#"><?= $post['title'] ?></a></h2>
								<p><?= "Сеттинг: " . $post['setting'] . "<br>" . "Система: " . $post['system'] . "<br>" . "Жанр: " . $post['genre'] ?></p>
							</div>
							<div class="meta">
								<time class="published" datetime="<?= $post['dategame'] ?>"><?= formatDate($post['dategame'], 'dd MMM y'); ?></time>
								<time class="published" datetime="<?= $post['beginning_game'] ?>"><?= formatDate($post['beginning_game'], 'HH:mm') . " - " .  formatDate($post['end_game'], 'HH:mm') ?></time>
								<a href="<?= 'profile.php?user_id=' . $post['id_master']; ?>" class="author"><span class="name"><?= $master["name"] ?></span><img src=<?= getImageUserPath($post['id_master']) ?> alt="" /></a>
							</div>
						</header>
						<span class="image featured"><img src=<?= $post_image ?> alt="" /></span>
						<h3 style="margin: 0 0 0.3em 0;">Завязка</h3>
						<p><?= $post['description'] ?></p>
						<h3 style="margin: 0 0 0.3em 0;">Примечание</h3>
						<p><?= $post['remark'] ?></p>
						<? if ($_SESSION['entrance'] && !$rezervation && (count($record) != $post['record'])) : ?>
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
								<p><a href=<?= "database/cancel_rezervation.php?id=" . $_GET['id'] ?>>Отменить бронь</a></p>
							</section>
						<? else : echo '<h3>Чтобы забронировать место вы должны войти или зарегистрироваться</h3>'; endif; ?>
						<div class="row">
							<div class="col-6 col-12-medium">
								<h4>Список участников</h4>
								<ul>
									<?for ($i = 0; $i < count($record); $i++) :
										$user_record = getUserById($record[$i]['id_gamer']);?>
										<li><a href="<?= 'profile.php?user_id=' . $user_record['id']; ?>"><?= $user_record['name'] ?></a></li>
									<? endfor; ?>
								</ul>
							</div>
						</div>
						<footer>
							<ul class="stats">
								<li><a href="/index.php">На главную</a></li>
								<li><a style="font-size: medium;" href="#" class="icon solid fa-users"><?= count($record) . "/" . $post['record'] ?></a></li>
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
						<? else : echo '<h3>Чтобы комметировать вы должны войти или зарегистрироваться</h3>'; endif; ?>
					</article>
					<?php
					$comms = getCommByIdPost($_GET['id']);
					for ($i = count($comms); $i > 0; $i--) :
						$comm = $comms[$i - 1];
						$author = getUserById($comm['id_author']);
						$user_url = 'profile.php?user_id=' . $author['id'];
					?>
						<article class="post" style="padding-bottom : 0px; margin: 0 0 1em 0">
							<header style="margin-bottom : 0px;">
								<div class="title">
									<p style="font-size: 0.9em;"><?= $comm['content'] ?></p>
								</div>
								<div class="meta">
									<a href="<?= $user_url ?>" class="author"><span class="name"><?= $author['name'] ?></span><img src=<?= getImageUserPath($author['id']) ?> alt="" /></a>
									<time class="published" datetime="<?= $comm['date'] ?>"><?= formatDate($comm['date'], 'd MMMM в hh:mm') ?></time>

								</div>
							</header>
						</article>
					<?php endfor; ?>
					</article>
				</div>
			</div>
			<!-- Scripts -->
			<?php include('php-elements/js-scripts.php'); ?>
		</body>
		</html>
<?php else :
		header('Location: /index.php');
	endif;
else :
	header('Location: /index.php');
endif; ?>
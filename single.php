<?php
include('database/db-connection.php');
include('database/get-function.php');
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
						<time class="published" datetime="<?= formatDate($post['beginning_game'])?>"><?= formatDate($post['beginning_game'])?></time>
						<time class="published" datetime="<?= formatDate($post['end_game'])?>"><?= formatDate($post['end_game'])?></time>
						<a href="<?='profile.php?user_id=' . $post['id_master'];?>" class="author"><span class="name"><?=$user["name"]?></span><img src="images/avatar.jpg" alt="" /></a>
					</div>
				</header>
				<span class="image featured"><img src=<?= $post_image ?> alt="" /></span>
				<h2>Завязка</h2>
				<p><?= $post['description'] ?></p>
				<h2>Примечание</h2>
				<p><?= $post['remark'] ?></p>
				<footer>
					<ul class="stats">
						<li><a href="/index.php">На главную</a></li>
						<li><a style="font-size: medium;" href="#" class="icon solid fa-users"><?= count(getRecordUsersByIdGame($post["id"])) . "/" . $post['record']?></a></li>
						<li><a style="font-size: medium;" href="#" class="icon solid fa-ruble-sign"><?= $post['price']?></a></li>
						<li><a style="font-size: medium;" href="#" class="icon solid fa-comment"><?= count(getCommByIdPost($post['id'])) ?></a></li>
						</ul>
				</footer>
			</article>

		</div>


	</div>

	<!-- Scripts -->
	<?php include('php-elements/js-scripts.php'); ?>

</body>

</html>
<html>
<?php
include('database/db-connection.php');
include('database/get-function.php');
include('database/update-session.php');
//$posts = getAllPosts();
//$date = $_GET['mon'] ?  $_GET['mon'] : getdate();
$date = new DateTime(getdate()["MON"]);
//$date-> strtotime('-1 month');
var_dump($date["date"]);
$posts = getPostsByMon(formatDate($date['date'], 'M'));
?>

<?php include('php-elements/head.php'); ?>

<body class="is-preload">

	<!-- Wrapper -->
	<div id="wrapper">

		<!-- Header -->
		<?php include('php-elements/header.php'); ?>

		<!-- Menu -->
		<?php include('php-elements/menu.php'); ?>

		<!-- Main -->
		<div id="main">
			<h2 style="font-size: 1.7em; display: flex; justify-content: center"><?="Расписание ". formatDate(getdate()["MON"], 'MMMM Y');?></h2>
			<?php
			for ($i = count($posts); $i > 0; $i--) :
				$post = $posts[$i - 1];
				$post_image = $post['image_path'] == NULL ? '../images/picplug.jpg' : $post['image_path'];
				$post_url = 'single.php?id=' . $post['id'];
				$user_url = 'profile.php?user_id=' . $post['id_master'];
				$delete_url = 'database/delete_post.php?id=' . $post['id'];
				$user = getUserById($post['id_master']);
			?>
				<article class="post">
					<header>
						<div class="title">
							<h2><a href=<?= $post_url; ?>><?= word_teaser($post['title'], 10); ?></a></h2>
						</div>
						<div class="meta" style="padding: 2.5em 4em 2em 2em;">

							<time class="published" datetime="<?= $post['beginning_game']?>"><?= formatDate($post['beginning_game'], 'dd MMM y'); ?></time>
							<time class="published" datetime="<?= $post['beginning_game']?>"><?= formatDate($post['beginning_game'], 'HH:mm') ." - " .  formatDate($post['end_game'], 'HH:mm')?></time>

							<a href="<?= $user_url ?>" class="author"><span class="name"><?= $user['name'] ?></span><img src=<?= getImageUserPath($user['id']) ?> alt="" /></a>
						</div>
					</header>
					<a href=<?= $post_url; ?> class="image featured"><img src=<?= $post_image; ?> alt="" height="500px" ; style=" object-fit:cover;" /></a>
					<p><?= word_teaser($post['description'], 70); ?></p>
					<footer>
						<ul class="actions">
							<li><a href=<?= $post_url; ?> class="button large">Узнать больше</a></li>
							<?php if ($_SESSION['user_id'] == $user['id'] || $_SESSION['role'] == 'admin') : ?>
								<li><a href="<?= $delete_url ?>" class="button large">Удалить запись</a></li>
							<? endif ?>
						</ul>
						<ul class="stats">
							<!-- <li><a href="#">Главная</a></li> -->
							<li><a style="font-size: medium;" href="#" class="icon solid fa-users"><?= count(getRecordUsersByIdGame($post["id"])) . "/" . $post['record'] ?></a></li>
							<li><a style="font-size: medium;" href="#" class="icon solid fa-ruble-sign"><?= $post['price'] ?></a></li>
							<li><a style="font-size: medium;" href="#" class="icon solid fa-comment"><?= count(getCommByIdPost($post['id'])) ?></a></li>
						</ul>
					</footer>
				</article>
			<?php endfor ?>
			
			<!-- Pagination -->
			<ul class="actions pagination">
				<li><a href="" class="disabled button large previous">Previous Page</a></li>
				<li><a href="#" class="button large next">Next Page</a></li>
			</ul>

		</div>

	</div>

	<!-- Scripts -->
	<?php include('php-elements/js-scripts.php'); ?>

</body>

</html>
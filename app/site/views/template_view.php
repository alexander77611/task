<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title><?php echo $title; ?></title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
</head>
<body>
	<header class="container">
		<h1 class="text-center"><?php echo $title; ?></h1>

		<div class="row">
			<div class="col-12 col-md-8 mx-auto">
				<ul class="nav row">
				  <li class="nav-item">
				    <a class="nav-link active" href="/">Задачи</a>
				  </li>
				  <li class="nav-item">
				    <a class="nav-link active" href="/task/add">Добавить задачу</a>
				  </li>
				  <?php if ($user): ?>
				  <li class="nav-item">
				    <a class="nav-link" href="/user/logout">Выйти</a>
				  </li>
				  <?php else: ?>
				  <li class="nav-item">
				    <a class="nav-link" href="/user/login">Войти</a>
				  </li>
				  <?php endif; ?>
				</ul>
			</div>
		</div>					
	</header>
	<?php include 'app/site/views/'.$content_view; ?>
	<footer></footer>
</body>
</html>
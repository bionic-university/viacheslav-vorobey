


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Hotline</title>
    <link rel="stylesheet" href="<?php echo URL;?>public/css/foundation.min.css" />
	
	<style type="text/css">
		.container {
			width:940px;
			margin:0 auto;
		}
		.content {
			margin-top:30px;
		}
		.required {
			color:#ff0000;
			font-weight:bold;
		}
	</style>
</head>

<body>
	
	<?php $url = trim($_SERVER['REQUEST_URI'], '/'); ?>
	<nav class="top-bar">
		<div class="container">	
			<section class="top-bar-section">
				<ul class="left">
					<li class="<?php echo $url == 'articles' ? 'active' : ''; ?>"><a href="/">Список статей</a></li>
					<li class="<?php echo $url == 'articles/add' ? 'active' : ''; ?>"><a href="/articles/add">Добавить статью</a></li>
				</ul>
				<ul class="right">
					<li class="<?php echo $url == 'task' ? 'active' : ''; ?>"><a href="/task">Тестовое задание</a></li>
				</ul>
			</section>
		</div>
	</nav>
	
	<div class="container content row">
		
		<?php require 'app/views/' . $name . '.php'; ?>
		
	</div>

	<script src="<?php echo URL;?>public/js/jquery.js"></script>
	<script src="<?php echo URL;?>public/js/foundation.js"></script>		
	
	<script>
		$(document).foundation();
		
		$(function () {
			$('#date').fdatepicker({
				format: 'dd.mm.yyyy'
			});
		});
	</script>

  
</body>
</html>
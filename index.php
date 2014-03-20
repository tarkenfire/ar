<?php session_start(); ?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="ISO-8859-1">
		<title>A/R - Home</title>
		
		<link rel="stylesheet" type="text/css" href="stylesheets/foundation.min.css">
		<link rel="stylesheet" type="text/css" href="stylesheets/styles.css">
		
	</head>
	<body>

	
		<div class="row">	
			<div class="large-2 columns">
				<p class="logo">A / R</p>
			</div>
			
			<div class="large-2 columns">
				<!-- TODO: Make dynamic -->
				<p class="text-pad-top">Spring / Week 1</p>
			</div>
			
			
			<?php if(isset($_SESSION['id'])): ?>
				<div class="large-2 large-offset-5 columns">
					<p class="right text-pad-top">@ <?php echo $_SESSION['username'] ?></p>
				</div>
				
				<div class="large-1 columns">
					<img class="avatar" src="<?php echo $_SESSION['avatar_url'] ?>">
				</div>
			<?php else: ?>
				<div class="large-2 large-offset-7 columns">
					<a class="right text-pad-top" href="login.php">Log in/Sign up</a>
				</div>
				
				<div class="large-1 columns">
					<img class="avatar" src="http://placehold.it/50x50">
				</div>
			<?php endif; ?>
			
		</div>	
	
		<div class="row">
			<div class="large-12 columns">
				<div class="fake-content">
					<p>This is content</p>
				</div>
			</div>
		</div>
		
	</body>
</html>
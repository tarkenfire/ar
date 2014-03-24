<?php session_start(); ?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="ISO-8859-1">
		<title>A/R - Home</title>
		
 		<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css">
		<link rel="stylesheet" type="text/css" href="stylesheets/styles.css">
		
	</head>
	<body>
				
	<!--  BEGIN USER INFO -->									
	<?php if(isset($_SESSION['id'])): ?>
		<div id="menu_box">
			<div id="avatar">    	
		    	<img src="<?php echo $_SESSION['avatar_url'] ?>">
		    </div>
		    <div id="menu_list">
		        <div>
		            Review
		        </div>
		        <div>
		            Setting
		        </div>
			</div>
		</div>
		
	<?php else: ?>
		
		<div id="menu_box">
			<div id="avatar">    	
		    	<img src="http://placehold.it/50x50">
		    </div>
		    <div id="menu_list">
		        <div>
					<a href="login.php">Log in</a>
		        </div>
		        <div>
		            Setting
		        </div>
			</div>
		</div>
	<?php endif; ?>
	<!--  END USER INFO -->
	
	<!--  BEGIN HEADER -->	
	<div id="center">
		<div id="header">
			<div id="logo"> A / R </div>
			<div id="season"> Spring / Week 7 </div>
		</div>
  
  	<!-- END HEADER -->
  	
  		<!-- BEGIN CONTENT -->
  	
	  	<div id="content">
			
			<?php
				

			?>
			
	  	</div>
	  	 
  	
  	
  		<!-- END CONTENT -->	
	</div>
	</body>
</html>
<html>
<title> Anonymous World </title>
<link rel="stylesheet" href="style.css">
<header class="1">
<img class="logo" src="logoMKIII.png" width = "150" height="75">
<h1 class="header"> The Company of my Anonymous and Lonesome Self </h1>
<div id="left"></div>
<div id="right"></div>
<div id="top"></div>
<div id="bottom"></div>
<ul class="navbar">
	<li><a class="nav1" href="index.php">Home</a></li>
	<li><a class="nav2" href="posts.php">Posts</a></li>
	<!--<li><a class="nav3" href="privacy.php">Privacy</a></li>-->
	<li><a class="nav3" href="about_us.php">About Us</a></li>
	<li><a class="nav4" href="games.php">Games</a></li>
</ul>
<div class="login">
<?php
if(! ini_get('date.timezone') )
{
	date_default_timezone_set('GMT');
}

include 'core.php';
require 'dbconnect.php';

if(loggedin()){
	$firstname = getfield('firstname');
	$surname = getfield('surname');
	$rank = rank($_SESSION['user_name']);
	echo "You are logged in $rank $firstname.";
?>
<form method="link" action="login/logout.php"> 
	<input type="submit" value="Logout Here"></form>
</div>
</header>
<body style="height: 1000px;">
<br><br><br><br><br>
<div id="div1">
	<object style="z-index: 2;"width="800" height="600" data="company-of-myself.swf"></object>
	<div class="game">
<br><br><br>
<p>&nbsp;
<a href="Sqaure_World.jar"target="_blank">"Please download John and Vlads Anonymous World Online Java executable here."</a>
<br>
<!--
<br>
<p> The melancholy theme from .Hack: </p>
<audio controls>
  <source src="legit-fake-wings.mp3" type="audio/mpeg">\
</audio>
</p>
-->

</div>
</div>
<div id="div2">
<div class="friends">
	<?php
		friends($here);
	?>
</div>
<div class="chat">
	<?php
		chat($here);	
	?>
</div>
<div class="loginform">
	<?php
		}
		else{
			include 'login/login_form.php';
		}
	?>
</div>
</body>
</html>

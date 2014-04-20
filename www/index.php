<html>
<title> Anonymous World </title>
<link rel="stylesheet" href="style.css">
<header class="1">
<img class="logo" src="logoMKIII.png" width = "150" height="75">
<br>
<h1 class="header"> Welcome to Anonymous World! </h1>
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
	date_default_timezone_set('America/New_York');
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
<body>
<br><br>
</div>
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
<br>
<br>
<br>
<form action="upload_file.php" method="post"
enctype="multipart/form-data">
<label for="file">Filename:</label>
<input type="file" name="file" id="file"><br>
<input type="submit" name="submit" value="Submit">
</form>

<a href="upload/">Uploads In Here</a>
<p> Right click "Save Link As..." to save a file from the uploads folder.</p>

</body>
<!--
<footer class="game">
<p> The melancholy theme from .Hack: </p>
<audio controls>
  <source src="legit-fake-wings.mp3" type="audio/mpeg">\
</audio>
<br>
</footer>
-->
<!--
<address>
	Updated 16 April 2014 by a Ryan.
</address>
-->
</html>

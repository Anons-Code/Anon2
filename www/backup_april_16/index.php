<html>
<title> Anonymous World </title>
<link rel="stylesheet" href="style.css">
<body>
<div id="left"></div>
<div id="right"></div>
<div id="top"></div>
<div id="bottom"></div>
<h1> Welcome to Anonymous World </h1>

<img src="logoMKII.png" width = "200" height="100"/>
<br>
<ul class="navbar">
	<li><a class="nav1" href="">Home</a></li>
	<li><a class="nav2" href="">Posts</a></li>
	<li><a class="nav3" href="">Privacy</a></li>
	<li><a class="nav4" href="">About Us</a></li>
</ul>
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
	echo "You are logged in $firstname $surname. <a href= 'login/logout.php'>Logout here</a><br />";
	echo "<br /><br /><a href=\"../posts/post.php\">Post something</a>";
?>
<form method="post" action="index.php">
	<br>View:
	<select name="posts">
		<option value="All">All</option>
		<option value="Oldest">Oldest</option>
		<option value="Newest">Newest</option>
		<option value="Most viewed">Popular</option>
		<option value="Least viewed">Less Popular</option>
	</select>
	<br>Basic search:<input type="text" name="search" /><br />
	<input type="submit" value="Search" />
</form>
<?php
	echo "<a href=\"../search/adv_search.php\">Advanced Search</a><br />";
	if (!empty($_POST['search'])) {
		$search = $_POST['search'];
		$result = pg_query($db,"SELECT id, title FROM anon.posts WHERE title LIKE '%$search%' ORDER BY title;");
		if (!pg_num_rows($result)) {
			echo "<br>There are no posts - why not create one?<br>";
		} 
		else {
			echo "<br><table border=1><tr><th><u>Search results:</u></th></tr>";
			while ($row = pg_fetch_array($result,NULL,PGSQL_ASSOC)) {
			   echo "<tr><td><a href=\"../posts/read.php?MBID=$row[id]\"> $row[title]</a></td></tr>";
			}
			echo "</table><br>";
		}
	}
	else if (!empty($_POST['posts'])) {
		$option = $_POST['posts'];
		if($option == 'Newest'){
			$result = pg_query($db,"SELECT * FROM anon.get_newest ORDER BY title;");
		}
		else if($option == 'Oldest'){
			$result = pg_query($db,"SELECT id, title FROM anon.posts WHERE datesubmitted = (SELECT MIN(datesubmitted) as max FROM anon.posts) ORDER BY title;");
		}
		else if($option == 'Most viewed'){
			$result = pg_query($db,"SELECT id, title FROM anon.posts WHERE views >= (SELECT AVG(views) as max FROM anon.posts) ORDER BY title;");
		}
		else if($option == 'Least viewed'){
			$result = pg_query($db,"SELECT id, title FROM anon.posts WHERE views < (SELECT AVG(views) as min FROM anon.posts) ORDER BY title;");
		}
		else{
			$result = pg_query($db,"SELECT id, title FROM anon.posts ORDER BY title;");
		}
		if (!pg_num_rows($result)) {
			echo "<br>There are no posts - why not create one?<br>";
		} 
		else {
			echo "<br><table border=1><tr><th><u>$option posts:</u></th></tr>";
			while ($row = pg_fetch_array($result,NULL,PGSQL_ASSOC)) {
			   echo "<tr><td><a href=\"../posts/read.php?MBID=$row[id]\"> $row[title]</a></td></tr>";
			}
			echo "</table><br>";
		}
	}
	else{
		$result = pg_query($db,"SELECT id, title FROM anon.posts ORDER BY title;");
		if (!pg_num_rows($result)) {
			echo "<br>There are no posts - why not create one?<br>";
		} 
		else {
			echo "<br><br><table border=1><tr><th><u>All posts:</u></th></tr>";
			while ($row = pg_fetch_array($result,NULL,PGSQL_ASSOC)) {
			   echo "<tr><td><a href=\"../posts/read.php?MBID=$row[id]\"> $row[title]</a></td></tr>";
			}
			echo "</table><br>";
		}
	}
	chat($here);	
}
else{
	include 'login/login_form.php';
}
?>

<div>&nbsp;</div>
<a href="Sqaure_World.jar"target="_blank">"Download Anonymous World Online Java executable here"</a>"
<div>&nbsp;</div>
<div>&nbsp;</div>

<p> The melancholy theme from .Hack: </p>
<audio controls>
  <source src="legit-fake-wings.mp3" type="audio/mpeg">\
</audio>
<address>
	Updated 16 April 2014 by a Ryan.
</address>
</body>
</html>

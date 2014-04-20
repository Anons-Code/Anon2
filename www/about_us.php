<html>
<title> Anonymous World </title>
<link rel="stylesheet" href="style.css">
<header class="1">
<img class="logo" src="logoMKIII.png" width = "150" height="75">
<br>
<h1 class="header"> About Us </h1>
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
<?php
}
else{
    include 'login/login_form.php';
}
?>
</header>
<body>
<br>

<h2 class="SecondHeader"> <u> Anonymity Explained </u> </h2>
<div class="paragraph">
<p>
Hello there. We are Anonymous 
and we have absolutely nothing to say about our identities.
 That being said, let us talk about our website.
</p>
</div>
<table>
<tr>
<td>Anon is an anonymous digital world. 
Originally born as a simple message board, Anon has grown and 
developed into a powerhouse of anonymity. All aspects of Anonymous 
World are seperate, anonymous, and distinct entities, guaranteeing 
super anonymity. The live chat, message board, and MMORPG world 
all use seperate and distinct anonymous profiles to guarantee 
your privacy and security.</td>
<td>There are many ways of guaranteeing anonymity. All 
 posts are limited in scope and automatically deleted with time. 
 Before they can become too popular, they are destroyed. Whether 
 after five views, ten views, or a hundred views, you set your 
 view limit, and the post is destroyed. In the anonymous online 
 game, each login creates a new, anonymous name. It is a world 
 of broken hopes and empty dreams. It is a world of the anonymous.</td>
</tr>
</table>
<br><br>
<h2 class="SecondHeader"> <u> Privacy And You. </u> </h2>
<br><br>
<p>	
This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.
    
    <br>

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
    
    <br>

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.

</p>

<br>
<br>
<!--
<p> The melancholy theme from .Hack: </p>
<audio controls>
  <source src="legit-fake-wings.mp3" type="audio/mpeg">\
</audio>
-->
</p>
</body>
</html>

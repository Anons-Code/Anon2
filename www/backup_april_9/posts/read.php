<?php

	date_default_timezone_set('GMT');

    require '../dbconnect.php';
	require '../core.php';
	if (!isset($_GET['MBID'])){
		echo "Something terrible has occurred. Self-destruct initiated.";
	}
	else{
		$msg_id = $_GET['MBID'];
		$user_id = $_SESSION['user_id'];
		$result = pg_query($db,"SELECT id, poster, title, message, datesubmitted, views FROM anon.posts WHERE ID = $msg_id;");
		if (!$result) exit;
		if (!pg_num_rows($result)) exit;
		$ans = pg_fetch_array($result,0,PGSQL_ASSOC);
		$date = date("Y-m-d", $ans['datesubmitted']);
		echo "<br />Posted by $ans[poster] on $date. Has $ans[views] views<br />";
		echo "<br />$ans[message]<br /><br />";
		echo "<a href=\"../index.php?\"> Back</a>";
		$result = pg_query($db,"SELECT * FROM anon.count WHERE msg_id = $msg_id AND user_id = $user_id;");
		$count = pg_num_rows($result);
		//echo "<br>$count<br>";
		if(!pg_num_rows($result)){
			$result = pg_query($db,"INSERT INTO anon.count (user_id, msg_id) VALUES ($user_id, $msg_id);");
			$views = $ans['views'] + 1;
			if($views >= 3){
				$result = pg_query($db,"DELETE FROM anon.count WHERE msg_id = $msg_id;");
				$result = pg_query($db,"DELETE FROM anon.posts WHERE id = $msg_id;");
				header('Location: itHasBeenDeleted.php');
			}
			else{
				$result = pg_query($db,"UPDATE anon.posts SET views = $views WHERE id = $msg_id;");
				echo "<br> Your view has been counted.";
			}
		}
	}
?>

<embed wmode="transparent" src="http://www.xatech.com/web_gear/chat/chat.swf" quality="high" width="540" height="405" name="chat" FlashVars="id=206978836" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://xat.com/update_flash.php" /><br><small><a target="_BLANK" href="http://xat.com/web_gear/?cb">Get your own Chat Box!</a> <a target="_BLANK" href="http://xat.com/web_gear/chat/go_large.php?id=206978836">Go Large!</a></small><br>

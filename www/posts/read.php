<?php

	date_default_timezone_set('GMT');

    require '../dbconnect.php';
	require '../core.php';
	if (!isset($_GET['MBID'])){
		echo "$error";
	}
	else{
		$msg_id = $_GET['MBID'];
		$user_id = $_SESSION['user_id'];
		$result = pg_query($db,"SELECT * FROM anon.posts WHERE ID = $msg_id;");
		if (!$result) exit;
		if (!pg_num_rows($result)) exit;
		$ans = pg_fetch_array($result,0,PGSQL_ASSOC);
		$date = date("Y-m-d h:i:s A", $ans['datesubmitted']);
		if($ans['poster'] != 'anonymous'){
			$rank = rank($ans['poster']);
		}
		else{
			$rank = "";
		}
		echo "<br><table border=1 cellpadding = 5><tr><th><u>$ans[title]</u></th></tr>";
		echo "<tr><td>Posted by $rank $ans[poster] on $date. Has $ans[views] views<br /><br />";
		echo "$ans[message]</td></tr>";
		echo "</table><br>";
		$result = pg_query($db,"SELECT * FROM anon.count WHERE msg_id = $msg_id AND user_id = $user_id;");
		if(!pg_num_rows($result)){
			$result = pg_query($db,"INSERT INTO anon.count (user_id, msg_id) VALUES ($user_id, $msg_id);");
			$views = $ans['views'] + 1;
			if($views >= $ans['viewcnt']){
				$result = pg_query($db,"DELETE FROM anon.count WHERE msg_id = $msg_id;");
				$result = pg_query($db,"DELETE FROM anon.posts WHERE id = $msg_id;");
				$result = pg_query($db,"DELETE FROM anon.comments WHERE pid = $msg_id;");
				header('Location: itHasBeenDeleted.php');
			}
			else{
				$result = pg_query($db,"UPDATE anon.posts SET views = $views WHERE id = $msg_id;");
				echo "<br> Your view has been counted.";
			}
		}
		$result = pg_query($db,"SELECT * FROM anon.comments WHERE pid = $msg_id ORDER BY datesubmitted;");
		if (!pg_num_rows($result)) {
			echo "<br>There are no comments - why not create one?<br>";
		} 
		else {
			echo "<br><table border=1 cellpadding = 5><tr><th><u>All Comments:</u></th></tr>";
			while ($row = pg_fetch_array($result,NULL,PGSQL_ASSOC)) {
				$date = date("Y-m-d h:i:s A", $row['datesubmitted']);
				if($row['poster'] != 'anonymous'){
					$rank = rank($row['poster']);
				}
				else{
					$rank = "";
				}
				echo "<tr><td>Posted by $rank $row[poster] on $date.<br /><br />";
				echo "$row[message]</td></tr>";
			}
			echo "</table><br>";
		}
		if(!isset($_SESSION['comment'])){
			$_SESSION['comment'] = 0;
		}
		echo "<br>Post a comment:";
		comment($here,$msg_id);
		echo "<br>";
		friends($here);
		chat($here);
		echo "<a href=\"../index.php?\"> Back</a>";
	}
?>
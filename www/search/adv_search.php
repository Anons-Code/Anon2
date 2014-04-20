<form method="post" action="adv_search.php">
<br>Search by:
	<select name="search_by">
		<option value="title">title</option>
		<option value="message">message</option>
	</select>
	<br>Search criteria #1:<input type="text" name="sfirst"/>
	<br>Search criteria #2 (optional):<input type="text" name="sSecond"/>
	<br>Exclude (optional):<input type="text" name="exclude" /><br />
<input type="submit" value="Submit" />
</form>
<?php
	require '../dbconnect.php';
	require '../core.php';
    if (!empty($_POST['search_by'])) {
		$criteria = $_POST['search_by'];
	}
	else{
		$criteria = 'title';
	}
	if (!empty($_POST['sfirst'])) {
		$first = $_POST['sfirst'];
		if (!empty($_POST['sSecond'])) {
			$second = $_POST['sSecond'];
			if (!empty($_POST['exclude'])) {
				$exclude = $_POST['exclude'];
				$result = pg_query($db,"Select s1.id as id, s1.title as title FROM (SELECT id, title FROM anon.posts WHERE $criteria LIKE '%$first%' OR $criteria LIKE '%$second%') as s1 NATURAL JOIN (SELECT id, title FROM anon.posts WHERE $criteria NOT LIKE '%$exclude%') as s2 ORDER BY $criteria;");
			}
			else{
				$result = pg_query($db,"SELECT id, title FROM anon.posts WHERE $criteria LIKE '%$first%' OR $criteria LIKE '%$second%' ORDER BY $criteria");
			}
			
			if (!pg_num_rows($result)) {
				echo "<br>This search yielded no results<br>";
			} 
			else {
				echo "<br><u>Search results:</u><br><br>";
				while ($row = pg_fetch_array($result,NULL,PGSQL_ASSOC)) {
				   echo "<a href=\"../posts/read.php?MBID=$row[id]\"> $row[title]</a><br />";
				}
			}
		}
		else{
			if (!empty($_POST['exclude'])) {
				$exclude = $_POST['exclude'];
				$result = pg_query($db,"SELECT id, title FROM anon.posts WHERE $criteria LIKE '%$first%' ORDER BY $criteria') as s1 NATURAL JOIN (SELECT id, title FROM anon.posts WHERE $criteria NOT LIKE '%$exclude%') as s2 ORDER BY $criteria;");
			}
			$result = pg_query($db,"SELECT id, title FROM anon.posts WHERE $criteria LIKE '%$first%' ORDER BY $criteria;");
			if (!pg_num_rows($result)) {
				echo "<br>This search yielded no results<br>";
			} 
			else {
				echo "<br><u>Search results:</u><br><br>";
				while ($row = pg_fetch_array($result,NULL,PGSQL_ASSOC)) {
				   echo "<a href=\"../posts/read.php?MBID=$row[id]\"> $row[title]</a><br />";
				}
			}
		}		
	}
	else{
		echo "Enter something to search for.";
	}
?>
<?php 
	friends($here);
	chat($here);
	echo "<br><br><a href=\"../index.php\">Back</a><br>";
 ?>
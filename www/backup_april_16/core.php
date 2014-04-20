<?php
ob_start();
session_start();
$current_file = $_SERVER['SCRIPT_NAME'];
$here  = $_SERVER['REQUEST_URI'];
$error = "Something terrible has occurred. Self-destruct initiated.";
if(isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])){
	$http_referer = $_SERVER['HTTP_REFERER'];
}

function loggedin(){
	if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])){
		return true;
	}
	else{
		return false;
	}
}

function getfield($field){
	require 'dbconnect.php';
	$query = "SELECT $field FROM anon.users WHERE id ='".$_SESSION['user_id']."'";
	if($result = pg_query($db,$query)){
		$ans = pg_fetch_array($result,0,PGSQL_ASSOC);
		return $ans["$field"];
	}
}

function updateAlias(){ //Not in use
	require 'dbconnect.php';
	$alias = md5(uniqid(rand(),true));
	$query = "SELECT alias FROM anon.users WHERE alias = '$alias'";
	if($result = pg_query($db,$query)){
		while(pg_num_rows($result) != 0){
			$alias = md5(uniqid(rand(),true));
			$result = pg_query($db,$query);
		}
		$query = "UPDATE anon.users SET alias = '$alias' WHERE id = $user_id";
		$result = pg_query($db,$query);
	}	
}

function chat($return){
	if(isset($_SESSION['chat'])){
		if($_SESSION['chat'] == 0){
			echo '
				<form method="post" action="chat.php">
					<input type="hidden" name = "return" value="';echo $return.'" />
					<input type="submit" value="Enter Chat" />
				</form>
			';
		}
		else{
			echo '<embed wmode="transparent" src="http://www.xatech.com/web_gear/chat/chat.swf" quality="high" width="540" height="405" name="chat" FlashVars="id=206978836" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://xat.com/update_flash.php" /><br><small><a target="_BLANK" href="http://xat.com/web_gear/?cb">Get your own Chat Box!</a> <a target="_BLANK" href="http://xat.com/web_gear/chat/go_large.php?id=206978836">Go Large!</a></small><br>';
			echo '
				<form method="post" action="chat.php">
					<input type="hidden" name = "return" value="';echo $return.'" />
					<input type="submit" value="Leave Chat" />
				</form>
			';
		}
	}
}

?>

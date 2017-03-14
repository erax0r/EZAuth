<?php
session_start();
require('config.php');

function createUser($level, $username, $password)
	{
	global $ezencryption, $ezdbdatabase, $ezdbserver, $ezdbusername, $ezdbpassword, $ezdbtable, $ezdebug;
	mysql_connect($ezdbserver, $ezdbusername, $ezdbpassword) or die(mysql_error());
	mysql_select_db($ezdbdatabase) or die(mysql_error());
	$password = hash($ezencryption,$password);
	$query = "insert into $ezdbtable (level, username,password) values ($level, '$username','$password');";
	if ($ezdebug ==1){echo '<br>'.$query.'<br>';}
	$result = mysql_query($query) or die(mysql_error());
}

function login($user,$password)
	{
	global $ezencryption, $ezdbdatabase, $ezdbserver, $ezdbusername, $ezdbpassword, $ezdbtable, $ezdebug;
	$password = hash($ezencryption,$password);
	$query = "select * from $ezdbtable where username = '$user' and password = '$password';";
	if ($ezdebug ==1){echo '<br>'.$query.'<br>';}
	mysql_connect($ezdbserver, $ezdbusername, $ezdbpassword) or die(mysql_error());
	mysql_select_db($ezdbdatabase) or die(mysql_error());	
	$result = mysql_query($query);
	$numrows = mysql_num_rows($result);
	if ($numrows == 1)
		{
		$userid = mysql_result($result,0,'id');
		$level = mysql_result($result,0,'level');
		$_SESSION['iduser'] = $userid;
		$_SESSION['level'] = $level;
		if ($ezdebug ==1){echo "<br>Login Success. Matched to iduser: $userid with a level of: $level.<br>";}
		return true;
	} 
	else
		{
		if ($ezdebug ==1){echo "<br>Login Failed. No Matches found.<br>";}
		return false;
	}
}

function logout()
	{	
	global $ezdebug;
	if (isLoggedin()== true)
		{
		session_unset();
		session_destroy();
		if ($ezdebug ==1){echo "<br>User logged out. Session variables cleared.<br>";}
	}
	else
		{
		if ($ezdebug ==1){echo "<br>Error! Invalid use of logout(). logout() requires a user to be logged in first.<br>";}
	}
	
}

function isLoggedin()
	{
	if (isset($_SESSION['iduser']))
		{
		return true;
	} 
	else 
		{
		return false;
	}
}

function getLevel()
	{
	if (isset($_SESSION['iduser']))
		{
		return $_SESSION['level'];
	} 
	else 
		{
		echo 'Cannot retrieve level since there is no user logged in.'; 
		die();
	}
}

/*****************
Add this function at the beginning of any page you would like to protect.
******************/
function protectme($level)
	{
	if (isLoggedin() == false){echo 'You must log in!'; die();}	
	if ($_SESSION['level'] < $level){echo 'Insufficient Permissions!'; die();}
}


?>
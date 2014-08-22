<?php
$PHP_SELF = "index.php";
require_once("includes/config.in.php");
require_once("includes/function.in.php");
require_once("includes/class.mysql.php");
require_once("includes/array.in.php");
require_once("includes/class.ban.php");
require_once("includes/class.calendar.php");
require_once("setconf.php");

header( 'Content-Type:text/html; charset='.ISO);

$db = New DB();
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);

 // Make sure you're using correct paths here
$admin_user = empty($_SESSION['admin_user']) ? "" : $_SESSION['admin_user'];
$admin_pwd = empty($_SESSION['admin_pwd']) ? "" : $_SESSION['admin_pwd'];
$login_true = empty($_SESSION['login_true']) ? "" : $_SESSION['login_true'];
$pwd_login = empty($_SESSION['pwd_login']) ? "" : $_SESSION['pwd_login'];
$op = empty($_GET['op']) ? "" : $_GET['op'];
$action = empty($_GET['action']) ? "" : $_GET['action'];
$page = empty($_GET['page']) ? "" : $_GET['page'];
$category = empty($_GET['category']) ? "" : $_GET['category'];
$loop = empty($_POST['loop']) ? "" : $_POST['loop'];

$IPADDRESS = get_real_ip();

function GETMODULE($name, $file){

	global $MODPATH, $MODPATHFILE ;
	$targetPath = WEB_PATH;
	$files = str_replace('../', '', $file);
	$names = str_replace('../', '', $name);
	$modpathfile = WEB_PATH."/modules/".$names."/".$files.".php";

	if (file_exists($modpathfile)) {
		$MODPATHFILE = $modpathfile;
		$MODPATH = WEB_PATH."/modules/".$names."/";
	}else{
		die (_NO_MOD);
	}
}

$PermissionFalse = "<BR><BR>";
$PermissionFalse .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/notview.gif\" BORDER=\"0\"></A><BR><BR>";
$PermissionFalse .= "<FONT COLOR=\"#336600\"><B>"._PERMISSION_ADMIN."</B></FONT><BR><BR>";
$PermissionFalse .= "<A HREF=\"?name=admin&file=main\"><B>"._PERMISSION_INDEX."</B></A>";
$PermissionFalse .= "</CENTER>";
$PermissionFalse .= "<BR><BR>";

$home = WEB_URL;
$admin_email = WEB_EMAIL;
$yourcode = "web";
$member_num_show = 5;
$member_num_show_last = 5;
$member_num_last = 1;

$bkk= mktime(gmdate("H")+7,gmdate("i")+0,gmdate("s"),
	gmdate("m") ,gmdate("d"),gmdate("Y"));
$datetimeformat="j/m/y - H:i";
$now = date($datetimeformat,$bkk);

$timestamp = time();
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$query = $db->select_query("SELECT * FROM ".TB_useronline." where timeout < $timestamp");
while ($user3 = $db->fetch($query)){
	if ($login_true==$user3['useronline']){
		$db->del(TB_useronline,"  timeout < $timestamp and useronline='".$login_true."' ");
		session_unset($user3['useronline']);
		setcookie($user3['useronline'],'');
	} else if ($admin_user==$user3['useronline']){
		$db->del(TB_useronline,"  timeout < $timestamp and useronline='".$admin_user."' ");
		session_unset($user3['useronline']);
		setcookie($user3['useronline'],'');
	} else {
		$db->del(TB_useronline,"  timeout < $timestamp  ");
		session_unset($user3['useronline']);
		setcookie($user3['useronline'],'');
	}
}


require_once("templates/".WEB_TEMPLATES."/function.php");
?>

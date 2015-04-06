<?php
$PHP_SELF = "index.php";
include 'includes/config.in.php';
include 'includes/function.in.php';
include 'includes/class.mysql.php';
include 'lang/thai_utf8.php';
include 'includes/array.in.php';
include 'includes/class.ban.php';
include 'includes/class.calendar.php';

header( 'Content-Type:text/html; charset='.ISO);

$db = New DB();
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);



// Make sure you're using correct paths here
$admin_user = empty($_SESSION['admin_user']) ? '' : $_SESSION['admin_user'];
$admin_pwd = empty($_SESSION['admin_pwd']) ? '' : $_SESSION['admin_pwd'];
$login_true = empty($_SESSION['login_true']) ? '' : $_SESSION['login_true'];
$pwd_login = empty($_SESSION['pwd_login']) ? '' : $_SESSION['pwd_login'];

$op = filter_input(INPUT_GET, 'op', FILTER_SANITIZE_STRING);
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
$page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_STRING);
$category = filter_input(INPUT_GET, 'category', FILTER_SANITIZE_STRING);
$loop = empty($_POST['loop']) ? '' : $_POST['loop'];

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

$home = WEB_URL;
$admin_email = WEB_EMAIL;
$yourcode = "web";
$member_num_show = 5;
$member_num_show_last = 5;
$member_num_last = 1;

$bkk= mktime(gmdate("H")+7,gmdate("i")+0,gmdate("s"),gmdate("m") ,gmdate("d"),gmdate("Y"));
$datetimeformat="j/m/y - H:i";
$now = date($datetimeformat,$bkk);

//$timestamp = time();
//$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
//$query = $db->select_query("SELECT * FROM ".TB_useronline." where timeout < $timestamp");
//while ($user3 = $db->fetch($query)){
//    if ($login_true==$user3['useronline']){
//            $db->del(TB_useronline,"  timeout < $timestamp and useronline='".$login_true."' ");
//            session_unset($user3['useronline']);
//            setcookie($user3['useronline'],'');
//    } else if ($admin_user==$user3['useronline']){
//            $db->del(TB_useronline,"  timeout < $timestamp and useronline='".$admin_user."' ");
//            session_unset($user3['useronline']);
//            setcookie($user3['useronline'],'');
//    } else {
//            $db->del(TB_useronline,"  timeout < $timestamp  ");
//            session_unset($user3['useronline']);
//            setcookie($user3['useronline'],'');
//    }
//}


include 'templates/'.WEB_TEMPLATES.'/function.php';
<?php 

// Set default session into 1day
//ini_set('session.gc_maxlifetime', 86400);
//ini_set('display_error', 0);
//error_reporting(0);

session_start();

require 'vendor/autoload.php';

define('BASE_DIR', getenv('DOCUMENT_ROOT'));

// Extension of all PHP files
define('EXT', '.php');

// Directory separator (Unix-Style works on all OS)
define('DS', '/');

// The current TLD address, scheme, and port
define('DOMAIN', (strtolower(getenv('HTTPS')) == 'on' ? 'https' : 'http') . '://'
. getenv('HTTP_HOST') . (($p = getenv('SERVER_PORT')) != 80 AND $p != 443 ? ":$p" : '').DS);

// The current site path
define('PATH', parse_url( (strpos(getenv('REQUEST_URI'), '/') === 0 ? substr(getenv('REQUEST_URI'), 1) : getenv('REQUEST_URI') ) , PHP_URL_PATH));

//header('Cache-Control: no-cache, no-store, must-revalidate'); // HTTP 1.1.
//header('Pragma: no-cache'); // HTTP 1.0.
//header('Expires: 0'); // Proxies.

define("SANDBOX", false);

if ( !file_exists( 'includes/config.in.php' ) || filesize( 'includes/config.in.php' ) < 9.00 ) {
    header( 'Location: install/index.php' );
    exit();
}

/* Installation sub folder check, removed for work with CVS */
if (file_exists( 'install/index.php' ) && SANDBOX===false) {
    include ('offline.php');
    exit();
}

// Load config and etc
include 'includes/common.php';
include 'includes/config.in.php';
include 'lang/thai_utf8.php';

//if (!preg_match('/(index\.php)|\?/', $_SERVER['REQUEST_URI']) && $_SERVER['REQUEST_URI'] !== '/') {
    
    include 'applications/application.php';
    include 'applications/controller.php';
    include 'applications/view.php';
    include 'applications/helper/validator.php';
    $app = new Application();
    
    exit;
//}

include 'includes/array.in.php';
include 'includes/class.calendar.php';
include 'includes/class.mysql.php';
include 'includes/function.in.php';
include 'includes/whitelists.php';

// Database Config 
$md = new medoo([
    // required
    'database_type' => 'mysql',
    'database_name' => DB_NAME,
    'server' => DB_HOST,
    'username' => DB_USERNAME,
    'password' => DB_PASSWORD,
    'charset' => 'utf8',

    // optional
    'port' => 3306,
    // driver_option for connection, read more from http://www.php.net/manual/en/pdo.setattribute.php
    'option' => [
//        PDO::ATTR_CASE => PDO::CASE_NATURAL
    ]
]);

// @todo REMOVE OLD VERSION
// Old Database config
$db = New DB();
$db->connectdb(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);

// Load config from database
$tb_configs = $md->select("web_config",['posit','name']);
foreach($tb_configs as $config){

    if ($config['posit']=='title'){
        define("WEB_TITILE", $config['name']);
    }
    if ($config['posit']=='url'){
        define("WEB_URL", $config['name']);
    }
    if ($config['posit']=='path'){
        define("WEB_PATH", $config['name']);
    }
    if ($config['posit']=='footer1'){
        define("WEB_FOOTER1", $config['name']);
    }
    if ($config['posit']=='footer2'){
        define("WEB_FOOTER2", $config['name']);
    }
    if ($config['posit']=='email'){
        define("WEB_EMAIL", $config['name']);
    }
    if ($config['posit']=='templates'){
        define("WEB_TEMPLATES", $config['name']);
    }
    if ($config['posit']=='iso'){
        $iso = $config['name'];
    }
}

// Default variable
$admin_user = getSession('admin_user');
$admin_pwd = getSession('admin_pwd');
$login_true = getSession('login_true');
$pwd_login = getSession('pwd_login');

$op = filter_input(INPUT_GET, 'op', FILTER_SANITIZE_STRING);
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
$page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_STRING);
$category = filter_input(INPUT_GET, 'category', FILTER_SANITIZE_STRING);

// Variable for load file
$name = empty($_GET['name']) ? 'index' : filter_input(INPUT_GET, 'name', FILTER_SANITIZE_STRING) ;
$file = empty($_GET['file']) ? 'index' : filter_input(INPUT_GET, 'file', FILTER_SANITIZE_STRING) ;

$IPADDRESS = get_real_ip();
$loop = empty($_POST['loop']) ? '' : $_POST['loop'];

// Check file from white list
//if(!array_key_exists($name, $white_lists) OR !in_array($file, $white_lists[$name])){
//    echo 'invalid name path';
//    exit();
//}

$modpathfile = WEB_PATH.'/modules/'.$name.'/'.$file.'.php';
if (is_file($modpathfile)) {
    $MODPATHFILE = $modpathfile;
}else{
    $MODPATHFILE = WEB_PATH.'/modules/index/index.php';
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

include 'templates/'.WEB_TEMPLATES.'/function.php';
require_once( 'templates/'.WEB_TEMPLATES.'/index.php' );

<?php
function getSession($name){
    return empty($_SESSION[$name]) ? false : $_SESSION[$name];
}

function setSession($k, $v){
    return $_SESSION[$k] = $v;
}

function get_cookie($k){
    return isset($_COOKIE[$k]) ? $_COOKIE[$k] : null ;
}

function set_cookie($k, $v, $t = 3600, $p = '/'){
    setcookie($k, serialize($v), time()+$t, $p);
}

/**
* Return the full URL to a location on this site
*
* @param string $path to use or FALSE for current path
* @param array $params to append to URL
* @return string
*/
function site_url($path = null, array $params = null){
    // In PHP 5.4, http_build_query will support RFC 3986
    return DOMAIN . ($path ? '/'. trim($path, '/') : PATH)
    . ($params ? '?'. str_replace('+', '%20', http_build_query($params, true, '&')) : '');
}


/**
* Safely fetch a $_POST value, defaulting to the value provided if the key is
* not found.
*
* @param string $key name
* @param mixed $default value if key is not found
* @param boolean $string TRUE to require string type
* @return mixed
*/
function post($key, $default = null, $string = false){
    if(isset($_POST[$key])){
        return $string ? (string)$_POST[$key] : $_POST[$key];
    }
    return $default;
}


function input_post(){
    $items = $_POST;
    $item_lists = [];
    foreach($items as $key => $value){
        $item_lists[$key] = post($key);
    }
    return $item_lists;
}

/**
* Safely fetch a $_GET value, defaulting to the value provided if the key is
* not found.
*
* @param string $key name
* @param mixed $default value if key is not found
* @param boolean $string TRUE to require string type
* @return mixed
*/
function get($key, $default = null, $string = false){
    if(isset($_GET[$key])){
        return $string ? (string)$_GET[$key] : $_GET[$key];
    }
    return $default;
}

/**
* Send a HTTP header redirect using "location" or "refresh".
*
* @param string $url the URL string
* @param int $c the HTTP status code
* @param string $method either location or redirect
*/
function redirect($url = null, $code = 302, $method = 'location'){
    $url = DOMAIN.$url;
    //print dump($url);
    header($method == 'refresh' ? "Refresh:0;url = $url" : "Location: $url", true, $code);
}

/**
* Return an HTML safe dump of the given variable(s) surrounded by "pre" tags.
* You can pass any number of variables (of any type) to this function.
*
* @param mixed
* @return string
*/
function dump(){
    $string = '';
    foreach(func_get_args() as $value){
        $string .= '<pre>' . h($value === null ? 'null' : (is_scalar($value) ? $value : print_r($value, true))) . "</pre>\n";
    }
    return $string;
}

/**
 * Change timestamp to date-time
 * 
 * @param int $t timestamp
 * @param string $f format default is Y-m-d H:i:s
 * @return type string
 */
function stampToYmd($t, $f = 'Y-m-d H:i:s'){
    return date($f, $t);
}

/**
 * 
 * @param int $items
 * @param int $limit
 * @param int $current_page
 * @return string
 */
function pagination($items, $limit, $current_page){
    $page_count = ceil($items / $limit);
    $paginate = false;
    if ($page_count > 1) {
        $paginate = '<ul class="pagination">';
        for($i = 1; $i <= $page_count; $i++){
            
            $active = $current_page==$i ? 'class="active"' : '' ;
            
            $paginate .= '<li '.$active.'><a href="'.DOMAIN.'news/page/'.$i.'">'.$i.'</a></li>';
        }
        $paginate .= '</ul>';
    }
    return $paginate;
}

/**
 * 
 * @param string $recive email name
 * @param mixed $from from[name, email]
 * @param string $subject subject
 * @param string $message html format
 * @return bool
 */
function send_mail($recive, $from, $subject, $message) {
    
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
    $headers .= 'From: '.$from['name'].' <'.$from['email'].'>' . "\r\n";
    $headers .= 'X-Mailer: PHP/' . phpversion();

    $send = mail($recive, $subject, $message, $headers, $from['email']);
    return $send;
}

function display_errors($items){
    $txt = [];
    foreach($items as $item){
        $txt[] = $item['0'];
    }
    
    return implode('<br>', $txt);
}

/**
 * 
 * @param string $m Message
 * @param string $s Status default is success
 * @return void
 */
function set_message($m, $s = 'success'){
    setSession('x-msg-status', $s);
    setSession('x-message', $m);
}

function check_hex($h){
    $m = preg_match('/[0-9a-f].*/', $h);
    if($m > 0){
        return true;
    }
    return false;
}
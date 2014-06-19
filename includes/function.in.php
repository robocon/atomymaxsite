<?php

function getBrowserType () {
	if (!empty($_SERVER['HTTP_USER_AGENT'])) 
	{ 
	   $HTTP_USER_AGENT = $_SERVER['HTTP_USER_AGENT']; 
	} 
	else if (!empty($HTTP_SERVER_VARS['HTTP_USER_AGENT'])) 
	{ 
	   $HTTP_USER_AGENT = $HTTP_SERVER_VARS['HTTP_USER_AGENT']; 
	} 
	else if (!isset($HTTP_USER_AGENT)) 
	{ 
	   $HTTP_USER_AGENT = ''; 
	} 
	// Create list of browsers with browser name as array key and user agent as value. 
	$browsers = array(
		'Opera' => 'Opera',
		'Mozilla Firefox'=> '(Firebird)|(Firefox)', // Use regular expressions as value to identify browser
		'Galeon' => 'Galeon',
		'Mozilla'=>'Gecko',
		'MyIE'=>'MyIE',
		'Lynx' => 'Lynx',
		'Netscape' => '(Mozilla/4\.75)|(Netscape6)|(Mozilla/4\.08)|(Mozilla/4\.5)|(Mozilla/4\.6)|(Mozilla/4\.79)',
		'Konqueror'=>'Konqueror',
		'SearchBot' => '(nuhk)|(Googlebot)|(Yammybot)|(Openbot)|(Slurp/cat)|(msnbot)|(ia_archiver)',
		'Internet Explorer 8' => '(MSIE 8\.[0-9]+)',
                'Internet Explorer 7' => '(MSIE 7\.[0-9]+)',
		'Internet Explorer 6' => '(MSIE 6\.[0-9]+)',
		'Internet Explorer 5' => '(MSIE 5\.[0-9]+)',
		'Internet Explorer 4' => '(MSIE 4\.[0-9]+)',
	);

	foreach($browsers as $browser=>$pattern) { // Loop through $browsers array
    // Use regular expressions to check browser type
		if(preg_match("/".$pattern."/", $HTTP_USER_AGENT)) { // Check if a value in $browsers array matches current user agent.
			return $browser; // Browser was matched so return $browsers key
		}
	}
	return 'Unknown'; // Cannot find browser so return Unknown
}

function selfURL() { 
	$s = empty($_SERVER["HTTPS"]) ? '' : ($_SERVER["HTTPS"] == "on") ? "s" : "";
	$protocol = strleft(strtolower($_SERVER["SERVER_PROTOCOL"]), "/").$s; 
	$port = ($_SERVER["SERVER_PORT"] == "80") ? "" : (":".$_SERVER["SERVER_PORT"]); 
	return $protocol."://".$_SERVER['SERVER_NAME'].$port.$_SERVER['REQUEST_URI']; 
}

function strleft($s1, $s2) { 
	return substr($s1, 0, strpos($s1, $s2)); 
}

function getInfo($ips){

    $url = get_content("http://smart-ip.net/geoip-json/".$ips."");
	$xml = json_decode($url,true);

    $info["ip"] = $xml['host'];
    $info["region"] = $xml['region'];
    $info["city"] = $xml['city'];
    $info["lat"] = $xml['latitude'];
    $info["long"] = $xml['longitude'];
    $info['country'] = $xml['countryName'];
	$info['localTimeZone'] = $xml['timezone'];

    return $info;
}

function anti_hacksession($User,$SessionID,$IP) {
	global $db ;
	if(empty($_SESSION['ua']) || $_SESSION['ua'] != $User.":".$_SERVER['HTTP_USER_AGENT'].":".$IP.":".$SessionID.":".$_SERVER['HTTP_ACCEPT_LANGUAGE'])
	{
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$db->del(TB_useronline," useronline='".$User."' "); 
		$db->add_db(TB_IPBLOCK,array(
			"ip"=> $IP,
			"post_date"=> time()
			));
		session_unset();
		session_regenerate_id();
		die('Session Hijacking Attempt');
	}
}

function highlight($word, $subject) {
	$pattern = '/(>[^<]*)('.$word.')/i';
	$replacement = '\1<span class="search">\2</span>';
	return preg_replace($pattern, $replacement, $subject);
}


function thai_date(){
	$thaiday = array(_Sunday,_Monday,_Tuesday,_Wednesday,_Thursday,_Friday,_Saturday);
	$thaimonth = array(_Month_1,_Month_2,_Month_3,_Month_4,_Month_5,_Month_6,_Month_7,_Month_8,_Month_9,_Month_10,_Month_11,_Month_12);
	$Date =$thaiday[date("w")]." ".date("j")." ".$thaimonth[date("m")-1]." ";
	$Ythai= date("Y")+543;
	$Date .= $Ythai; 
	return $Date;
}


//	$strDate = "2008-08-14 13:42:44";
//	echo "ThaiCreate.Com Time now : ".DateThai($strDate);
function DateThaiNew($strDate,$full=""){
	$strYear = date("Y",strtotime($strDate))+543;
	$strMonth= date("n",strtotime($strDate));
	$strDay= date("j",strtotime($strDate));
	$strHour= date("H",strtotime($strDate));
	$strMinute= date("i",strtotime($strDate));
	$strSeconds= date("s",strtotime($strDate));
	$strMonthCut = Array("",""._Month_1."",""._Month_2."",""._Month_3."",""._Month_4."",""._Month_5."",""._Month_6."",""._Month_7."",""._Month_8."",""._Month_9."",""._Month_10."",""._Month_11."",""._Month_12."");
	$strMonthThai=$strMonthCut[$strMonth];
	if($full){
		return "$strDay $strMonthThai $strYear, $strHour:$strMinute";
	} else {
		return "$strDay $strMonthThai $strYear";
	}
}

function anti_injection( $user, $pass ,$ip) {
	global $db;
           // We'll first get rid of any special characters using a simple regex statement.
           // After that, we'll get rid of any SQL command words using a string replacment.
            $banlist = ARRAY ("'", "--", "select", "union", "insert", "update", "like", "delete", "distinct", "having", "truncate", "replace", "handler", " as ", "or ", "procedure", "limit", "order by", "group by", "asc", "desc" , "1=1", "or", "#", "//","' or '1'='1'","'1'='1'" );
            // ---------------------------------------------
            IF ( preg_match ( "/[a-zA-Z0-9]+/i", $user ) ) {
                    $user = TRIM ( STR_REPLACE ( $banlist, '', STRTOLOWER ( $user ) ) );
            } ELSE {
                    $user = NULL;
            }
            // ---------------------------------------------
            // Now to make sure the given password is an alphanumerical string
            // devoid of any special characters. strtolower() is being used
            // because unfortunately, str_ireplace() only works with PHP5.
            IF ( preg_match ( "/[a-zA-Z0-9]+/i", $pass ) ) {
                    $pass = TRIM ( STR_REPLACE ( $banlist, '', STRTOLOWER ( $pass ) ) );
            } ELSE {
                    $pass = NULL;
            }
            // ---------------------------------------------
            // Now to make an array so we can dump these variables into the SQL query.
            // If either user or pass is NULL (because of inclusion of illegal characters),
            // the whole script will stop dead in its tracks.
            $array = ARRAY ( 'user' => $user, 'pass' => $pass );
            // ---------------------------------------------
            if ( in_array ( NULL, $array ) ) {
				$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
				$db->add_db(TB_IPBLOCK,array(
					"ip"=>"".$ip."",
					"post_date"=>"".time().""
				));
				$db->closedb ();
				?>
				<BR><BR>
				<CENTER><A HREF="?name=index"><IMG SRC="images/dangerous.png" BORDER="0"></A><BR><BR>
				<FONT COLOR="#336600"><B><?php echo _ADMIN_IPBLOCK_MESSAGE_HACK;?> <?php echo WEB_EMAIL;?></B></FONT><BR><BR>
				<A HREF="?name=index"><B><?php echo _ADMIN_IPBLOCK_MESSAGE_HACK1;?></B></A>
				</CENTER>
				<?php echo "<meta http-equiv='refresh' content='10; url=?name=index'>" ; ?>
				<BR><BR>
				<?php
            } else {
                    RETURN $array;
            }
    }

function youtubeID($url){
 	 $res = explode("v=",$url);
	 if(isset($res[1])) {
	 	$res1 = explode('&',$res[1]);
		if(isset($res1[1])){
			$res[1] = $res1[0];
		}
		$res1 = explode('#',$res[1]);
		if(isset($res1[1])){
			$res[1] = $res1[0];
		}
	 }
	 return substr($res[1],0,12);
  	 return false;
 }

function check_captcha($cap) {
	if($_SESSION['security_code'] != $cap OR empty($cap)) {
		echo "<script language='javascript'>" ;
		echo "alert('"._JAVA_CAPTCHA_NOACC."')" ;
		echo "</script>" ;
		echo "<script language='javascript'>javascript:history.go(-1)</script>";
		exit();
	} else {
	return true;
	}
}

function is_valid($input)
{
$input = strtolower($input);

if (str_word_count($input) > 1)
{
$loop = true;
$input = explode(" ",$input);
}

$bad_strings = array("'", "--", "select", "union", "insert", "update", "like", "delete", "distinct", "having", "truncate", "replace", "handler", " as ", "or ", "procedure", "limit", "order by", "group by", "asc", "desc" , "1=1", "or", "#", "//","' or '1'='1'","'1'='1'" );

if ($loop == true)
{
foreach($input as $value)
{
if (in_array($value, $bad_strings))
{
return false;
}
else
{
return true;
}
}
}
else
{
if (in_array($input, $bad_strings))
{
return false;
}
else
{
return true;
}
}
}


function get_content($URL) {
         $ch = curl_init();
         $timeout = 0; // set to zero for no timeout
         $useragent="Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)";
         curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
         curl_setopt ($ch, CURLOPT_URL, $URL);
         curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
         curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
          $String = curl_exec($ch);
          curl_close($ch);
           return $String;
 }

function timeyoutube($duration){
//Initially we set hours,minutes and second all to zero
$hours = 0;
$minutes = 0;
$seconds = 0;
//If duration > 3600 sec then we increase hour count
// We increase count untill duration is less than 3600
while($duration >= 3600) {
$hours = $hours + 1;
$duration = $duration - 3600;
}
//suppose we have duration more than 60 sec then we increment minute count
//We increase count untill duration is less than 60 sec
while($duration >= 60) {
$minutes = $minutes + 1;
$duration = $duration - 60;
}
$seconds = $duration;
//if duration of video is less than 10 sec then we directly write it in M:S
if($seconds < 10) {
$seconds = '0'.$seconds.'';
}
//We store the duration in Variable Time
$time = ''.$minutes.':'.$seconds.'';
if($hours > 0) {
$time = ''.$hours.':'.$time.'';
}
return $time;
}

//function แปลง tis620 เป็น utf8
function tis620_to_utf8($tis) {
	$utf8="";
  for( $i=0 ; $i< strlen($tis) ; $i++ ){
    $s = substr($tis, $i, 1);
    $val = ord($s);
    if( $val < 0x80 ){
	 $utf8 .= $s;
    } elseif ((0xA1 <= $val and $val <= 0xDA) 
              or (0xDF <= $val and $val <= 0xFB))  {
	 $unicode = 0x0E00 + $val - 0xA0;
	 $utf8 .= chr( 0xE0 | ($unicode >> 12) );
	 $utf8 .= chr( 0x80 | (($unicode >> 6) & 0x3F) );
	 $utf8 .= chr( 0x80 | ($unicode & 0x3F) );
    }
  }
return $utf8;
} 

//function แปลง utf8 เป็น tis620
function utf8_to_tis620($string) {
  $str = $string;
  $res = "";
  for ($i = 0; $i < strlen($str); $i++) {
	if (ord($str[$i]) == 224) {
	  $unicode = ord($str[$i+2]) & 0x3F;
	  $unicode |= (ord($str[$i+1]) & 0x3F) << 6;
	  $unicode |= (ord($str[$i]) & 0x0F) << 12;
	  $res .= chr($unicode-0x0E00+0xA0);
	  $i += 2;
	} else {
	  $res .= $str[$i];
	}
  }
  return $res;
}


function get_real_ip()
{
$ip = false;
if(!empty($_SERVER['HTTP_CLIENT_IP']))
{
$ip = $_SERVER['HTTP_CLIENT_IP'];
}
if(!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
{
$ips = explode(", ", $_SERVER['HTTP_X_FORWARDED_FOR']);
if($ip)
{
array_unshift($ips, $ip);
$ip = false;
}
for($i = 0; $i < count($ips); $i++)
{
if(!preg_match("/^(10|172\.16|192\.168)\./i", $ips[$i]))
{
if(version_compare(phpversion(), "5.0.0", ">="))
{
if(ip2long($ips[$i]) != false)
{
$ip = $ips[$i];
break;
}
}
else
{
if(ip2long($ips[$i]) != - 1)
{
$ip = $ips[$i];
break;
}
}
}
}
}
return ($ip ? $ip : $_SERVER['REMOTE_ADDR']);
}

//News Icon
function NewsIcon($Ntime="", $Otime="", $Icon=""){
	if(TIMESTAMP <= ($Otime + 86400)){
		echo "<IMG SRC=\"".$Icon."\" BORDER=\"0\" ALIGN=\"absmiddle\"> ";
	}
}
//update icon
function UpdateIcon($Ntime="", $Otime="", $Icon=""){
	if(TIMESTAMP <= ($Otime + 86400)){
		echo "<IMG SRC=\"".$Icon."\" BORDER=\"0\" ALIGN=\"absmiddle\"> ";
	}
}

function FixQuotes($what = "") {
        $what = preg_replace("/'/i","''",$what);
        while (preg_match("/\\\\'/i", $what)) {
                $what = preg_replace("/\\\\'/i","'",$what);
        }
        return $what;
}


function SplitPage($page="",$totalpage="",$option=""){
	global $ShowSumPages , $ShowPages ;
	
	$ShowSumPages .= "<B>"._FUNC_Page1."  </B>";
	if($page>1 && $page<=$totalpage) {
		$prevpage = $page-1;
		$ShowSumPages .= "<a href='".$option."&page=$prevpage' title='Back'><B><-</B></a>\n";
	}
	$ShowSumPages .= " <b>$page/$totalpage</b> ";
	if($page!=$totalpage) {
		$nextpage = $page+1;
		if($nextpage >= $totalpage){
			$nextpage = $totalpage ;
		}
		$ShowSumPages .= "<a href='".$option."&page=$nextpage' title='Next'><B>-></B></a>\n";
	}

	$b=floor($page/10); 
	$c=(($b*10));

	if($c>1) {
		$prevpage = $c-1;
		$ShowPages .= "<a href='".$option."&page=$prevpage' title='10 "._FUNC_Page2."'><<</a> \n";
	}
	else{
		$ShowPages .= "<B><<</B>\n";
	}
	$ShowPages .= " <b>";
	for($i=$c; $i<$page ; $i++) {
		if($i>0)
		$ShowPages .= "<a href='".$option."&page=$i'>$i</a> \n";
	}
	$ShowPages .= "<font color=red>$page</font> \n";
	for($i=($page+1); $i<($c+10) ; $i++) {
		if($i<=$totalpage)
		$ShowPages .= "<a href='".$option."&page=$i'>$i</a> \n";
	}
	$ShowPages .= "</b> ";
	if($c>=0) {
		if(($c+2)<$totalpage){
	$nextpage = $c+10;
	$ShowPages .= "<a href='".$option."&page=$nextpage' title='10 "._FUNC_Page3."'>>></a> \n";
		}
		else
	$ShowPages .= "<B>>></B>\n";
	}
	else{
		$ShowPages .= "<B>>></B>\n";
	}
}


function page_navigator($modules="",$file="",$id="",$before_p="",$plus_p="",$total="",$total_p="",$chk_page=""){   
	global $db;
	$pPrev=$chk_page-1;
	$pPrev=($pPrev>=0)?$pPrev:0;
	$pNext=$chk_page+1;
	$pNext=($pNext>=$total_p)?$total_p-1:$pNext;		
	$lt_page=$total_p-9;
	if($chk_page>0){  
		echo "<a  href='?name=".$modules."&file=".$file."&id=".$id."&s_page=$pPrev' class='naviPN'>Prev</a>";
	}
	if($total_p>=17){
		if($chk_page>=9){
			echo "<a $nClass href='?name=".$modules."&file=".$file."&id=".$id."&s_page=0'>1</a><a class='SpaceC'>. . .</a>";   
		}
		if($chk_page<9){
			for($i=0;$i<$total_p;$i++){  
				$nClass=($chk_page==$i)?"class='selectPage'":"";
				if($i<=9){
				echo "<a $nClass href='?name=".$modules."&file=".$file."&id=".$id."&s_page=$i'>".intval($i+1)."</a> ";   
				}
				if($i==$total_p-1 ){ 
				echo "<a class='SpaceC'>. . .</a><a $nClass href='?name=".$modules."&file=".$file."&id=".$id."&s_page=$i'>".intval($i+1)."</a> ";   
				}		
			}
		}
		if($chk_page>=9 && $chk_page<$lt_page){
			$st_page=$chk_page-3;
			for($i=1;$i<=10;$i++){
				$nClass=($chk_page==($st_page+$i))?"class='selectPage'":"";
				echo "<a $nClass href='?name=".$modules."&file=".$file."&id=".$id."&s_page=".intval($st_page+$i)."'>".intval($st_page+$i+1)."</a> ";   	
			}
			for($i=0;$i<$total_p;$i++){  
				if($i==$total_p-1 ){ 
				$nClass=($chk_page==$i)?"class='selectPage'":"";
				echo "<a class='SpaceC'>. . .</a><a $nClass href='?name=".$modules."&file=".$file."&id=".$id."&s_page=$i'>".intval($i+1)."</a> ";   
				}		
			}									
		}	
		if($chk_page>=$lt_page){
			for($i=0;$i<=9;$i++){
				$nClass=($chk_page==($lt_page+$i-1))?"class='selectPage'":"";
				echo "<a $nClass href='?name=".$modules."&file=".$file."&id=".$id."&s_page=".intval($lt_page+$i-1)."'>".intval($lt_page+$i)."</a> ";   
			}
		}		 
	}else{
		for($i=0;$i<$total_p;$i++){  
			$nClass=($chk_page==$i)?"class='selectPage'":"";
			echo "<a href='?name=".$modules."&file=".$file."&id=".$id."&s_page=$i' $nClass  >".intval($i+1)."</a> ";   
		}		
	} 	
	if($total_p !='' && $chk_page<$total_p-1){
		echo "<a href='?name=".$modules."&file=".$file."&id=".$id."&s_page=$pNext'  class='naviPN'>Next</a>";
	}
}


function breakpage($mod="",$page="",$id="",$thepage=""){
	global $mod , $page ,$id ,$thepage;

$contentpages = explode( "<!--pagebreak-->", $thepage );

$pageno = count($contentpages);
if ( $page=="" || $page < 1 ) $page = 1;
if ( $page > $pageno ) $page = $pageno;
$arrayelement = (int)$page;
$arrayelement --;
if ($pageno > 1) $thepageNew .= "<b>"._PAGES." $page/$pageno</b><br />";
$thepageNew = "<p align=\"justify\">".$contentpages["".$arrayelement.""]."</p>";
if($page >= $pageno) $next_page = "";
else {
   $next_pagenumber = $page + 1;
   if ($page != 1) {
      $next_page .= "- ";
   }
   $next_page .= "<a href=\"?name=".$mod."&amp;file=read".$mod."&amp;id=".$id."&amp;page=$next_pagenumber\"><b>"._NEXT." ($next_pagenumber/$pageno)</b></a><a href=\"?name=".$mod."&amp;file=read".$mod."&amp;id=".$id."&amp;page=$next_pagenumber\">  <img src=\"images/go.gif\"border=\"0\" alt=\""._NEXT."\" /></a>";
}
if($page <= 1) $previous_page = "";
else {
   $previous_pagenumber = $page - 1;
   $previous_page = "<a href=\"?name=".$mod."&amp;file=read".$mod."&amp;id=".$id."&amp;page=$previous_pagenumber\"><img src=\"images/backs.gif\" border=\"0\" alt=\""._PREVIOUS."\" /></a>  <a href=\"?name=".$mod."&amp;file=read".$mod."&amp;id=".$id."&amp;page=$previous_pagenumber\"><b>"._PREVIOUS." ($previous_pagenumber/$pageno)</b></a>";
}
$thepageNew .= "<br /><center><b> $previous_page $next_page </b></center><br />";
$thepages = $thepageNew;
echo "$thepages";
}

//Function Sendmail
function SendMail($charset="",$to="",$tocc="",$from="",$subject="",$topic=""){
	/* message */
	$message = "<html> <head> <title>".$subject."</title> </head> <body> ".$topic."</body> </html> ";

	/* To send HTML mail, you can set the Content-type header. */
	$headers  = "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/html; charset=".$charset."\r\n";

	/* additional headers */
	$headers .= "To: ".$to."\r\n";
	$headers .= "From: ".$from."\r\n";
	$headers .= "Cc: ".$tocc."\r\n";

	/* and now mail it */
	if(mail($to, $subject, $message, $headers)){
		return true ;
	}else{
		return false ;
	}
}

function ThaiTimeMini($timestamp="",$mini=""){
	global $SHORT_MONTH, $FULL_MONTH, $DAY_SHORT_TEXT, $DAY_FULL_TEXT;
	$day = date("l",$timestamp);
	$month = date("n",$timestamp);
	$year = date("Y",$timestamp);
	$time = date("H:i:s",$timestamp);
	$times = date("H:i",$timestamp);

	    $ThaiText = date("j",$timestamp);

return $ThaiText;
}

function ThaiTimeConvert($timestamp="",$full="",$showtime=""){
	global $SHORT_MONTH, $FULL_MONTH, $DAY_SHORT_TEXT, $DAY_FULL_TEXT;
	$day = date("l",$timestamp);
	$month = date("n",$timestamp);
	$year = date("Y",$timestamp);
	$time = date("H:i:s",$timestamp);
	$times = date("H:i",$timestamp);
	if($full){
		$ThaiText = $DAY_FULL_TEXT[$day]." "._TIME_AT." ".date("j",$timestamp)." "._MONTH_AT." ".$FULL_MONTH[$month]." "._YEAR_AT."".($year+543) ;
	}else{
		$ThaiText = date("j",$timestamp)."/".$SHORT_MONTH[$month]."/".($year+543);
	}

	if($showtime == "1"){
		return $ThaiText." "._TIMES_AT." ".$time;
	}else if($showtime == "2"){
		$ThaiText = date("j",$timestamp)." ".$SHORT_MONTH[$month]." ".($year+543);
		return $ThaiText." : ".$times;
	}else{
		return $ThaiText;
	}
}

function formatDateThai($date){
	$list= array("",""._Month_1."",""._Month_2."",""._Month_3."",""._Month_4."",""._Month_5."",""._Month_6."",""._Month_7."",""._Month_8."",""._Month_9."",""._Month_10."",""._Month_11."",""._Month_12."");
	list($d,$m,$y) =preg_split("/\//",$date);
	return "$d {$list[$m]} $y";
}

function CheckWebboard($user = "", $pwd ="" ,$cat="" ){
	global $db ;
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	$res['web'] = $db->select_query("SELECT * FROM ".TB_WEBBOARD_CAT." where id='$cat' ");
	$arr['web'] = $db->fetch($res['web']);
     if($arr['web']['status'] =='1'){
				if ($_SESSION['login_true']){
				$res['mem'] = $db->select_query("SELECT * FROM ".TB_MEMBER." where user='$user' AND password='$pwd'  ");
			    $arr['mem'] = $db->fetch($res['mem']);
				if (!$arr['mem']['id']){
				echo "<script language='javascript'>" ;
				echo "alert('"._BOARD_SIT."')" ;
				echo "</script>" ;
				echo "<meta http-equiv='refresh' content='0; url=?name=member'>";
				exit();
				} 
				} else if ($_SESSION['admin_user']){
				$res['mem'] = $db->select_query("SELECT * FROM ".TB_ADMIN." where username='$user' AND password='$pwd'  ");
			    $arr['mem'] = $db->fetch($res['mem']);
				if (!$arr['mem']['id']){
				echo "<script language='javascript'>" ;
				echo "alert('"._BOARD_SIT."')" ;
				echo "</script>" ;
				echo "<meta http-equiv='refresh' content='0; url=?name=admin'>";
				exit();
				} 
				} else {
				echo "<script language='javascript'>" ;
				echo "alert('"._BOARD_SIT."')" ;
				echo "</script>" ;
				echo "<meta http-equiv='refresh' content='0; url=?name=member'>";
				exit();
				}
	    }
}

function CheckAdmin($user = "", $pwd =""){
	global $db ;
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	$res['user'] = $db->select_query("SELECT id FROM ".TB_ADMIN." WHERE username='$user' AND password='$pwd' ");
	$arr['user'] = $db->fetch($res['user']);
	if(!$arr['user']['id']){
		echo "<script language='javascript'>" ;
		echo "alert('"._ADMIN_SIT."')" ;
		echo "</script>" ;
		echo "<meta http-equiv='refresh' content='1; url=?name=admin'>";
		exit();
	}
}

function CheckUser($user = "", $pwd =""){
	global $db ;
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	$res['user'] = $db->select_query("SELECT id FROM ".TB_MEMBER." WHERE user='$user' AND password='$pwd' ");
	$arr['user'] = $db->fetch($res['user']);
	if(!$arr['user']['id']){
		echo "<script language='javascript'>" ;
		echo "alert('"._MEMBER_SIT."')" ;
		echo "</script>" ;
		echo "<script language='javascript'>javascript:history.go(-1)</script>";
		exit();
	}
}
function OpenTable(){
echo "<TABLE cellSpacing=0 cellPadding=0 width=660  border=0>
      <TBODY>
        <TR>
          <TD><IMG SRC=images/main/1.gif BORDER=0 width=7 height=7></td><TD background=images/main/2.gif BORDER=0 height=7 width=650><IMG SRC=images/main/2.gif BORDER=0  height=7></td><TD><IMG SRC=images/main/3.gif BORDER=0 width=7 height=7></td>
		</tr>
        <TR>
          <TD background=images/main/4.gif BORDER=0 height=100% width=7></td>
		  <TD width=100%>";

}

function CloseTable(){
echo "</td>
  <TD background=images/main/5.gif BORDER=0 height=100% width=7></td>
		</tr>
        <TR>
          <TD><IMG SRC=images/main/6.gif BORDER=0 width=7 height=7></td><TD background=images/main/7.gif BORDER=0 height=7 width=650><IMG SRC=images/main/7.gif BORDER=0  height=7></td><TD><IMG SRC=images/main/8.gif BORDER=0 width=7 height=7></td>
		</tr>
		</table>";

}


function OpenTablemod(){
echo "<table  width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
				<tr>
				<td width=\"10\" height=\"10\"><img src=\"images/pic/news-tl.gif\"></td>
				<td height=\"10\" background=\"images/pic/news-tbg.png\"></td>
				<td width=\"10\" height=\"10\"><img src=\"images/pic/news-tr.gif\"></td>
				</tr>
                  <tr>
                    <td width=\"10\" valign=\"top\" height=\"100%\" background=\"images/pic/news-left.png\"></td>
                    <td width=\"100%\" valign=\"top\"  >";
}

function CloseTablemod(){
echo "</td>
                    <td width=\"10\" align=\"center\"  height=\"100%\"  background=\"images/pic/news-right.png\"></td>
				</tr>
				<tr>
				<td width=\"10\" height=\"10\"><img src=\"images/pic/news-bl.gif\"></td>
				<td height=\"10\" background=\"images/pic/news-bbg.png\"></td>
				<td width=\"10\" height=\"10\"><img src=\"images/pic/news-br.gif\"></td>
				</tr>
            </table>";
}

function OpenTableAd(){
echo "<table width=\"80%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
				<tr>
				<td width=\"11\" height=\"11\"><img src=\"../images/pic/block01.jpg\"></td>
				<td height=\"11\"  background=\"../images/pic/block02.jpg\"></td>
				<td width=\"12\" height=\"11\"><img src=\"../images/pic/block03.jpg\"></td>
				</tr>
              <tr>
			  <td width=\"12\" align=\"center\"  height=\"100%\"  background=\"../images/pic/block04.jpg\"></td>
                <td width=\"100%\" valign=\"top\">";
}

function CloseTableAd(){
echo "</td>
				<td width=\"12\" align=\"center\"  height=\"100%\"  background=\"../images/pic/block05.jpg\"></td>
				</tr>
				<tr>
				<td width=\"11\" height=\"12\"><img src=\"../images/pic/block06.jpg\"></td>
				<td height=\"11\" background=\"../images/pic/block07.jpg\"></td>
				<td width=\"12\" height=\"12\"><img src=\"../images/pic/block08.jpg\"></td>
            </table>";
}

function OpenTablecom(){
echo "<table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
				<tr>
				<td width=\"11\" height=\"11\"><img src=\"images/pic/block01.jpg\"></td>
				<td height=\"11\"  background=\"images/pic/block02.jpg\"></td>
				<td width=\"12\" height=\"11\"><img src=\"images/pic/block03.jpg\"></td>
				</tr>
              <tr>
			  <td width=\"12\" align=\"center\"  height=\"100%\"  background=\"images/pic/block04.jpg\"></td>
                <td width=\"100%\" valign=\"top\" align=\"center\">";
}

function CloseTablecom(){
echo "</td>
				<td width=\"12\" align=\"center\"  height=\"100%\"  background=\"images/pic/block05.jpg\"></td>
				</tr>
				<tr>
				<td width=\"11\" height=\"12\"><img src=\"images/pic/block06.jpg\"></td>
				<td height=\"11\" background=\"images/pic/block07.jpg\"></td>
				<td width=\"12\" height=\"12\"><img src=\"images/pic/block08.jpg\"></td>
            </table>";
}

function CheckUserblog($user = "", $pwd =""){
	global $db ;
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	$res['user'] = $db->select_query("SELECT id FROM ".TB_MEMBER." WHERE user='$user' AND password='$pwd' and blog='1' ");
	$arr['user'] = $db->fetch($res['user']);
	if(!$arr['user']['id']){
		echo "<script language='javascript'>" ;
		echo "alert('"._MEMBER_BLOG_ALL."')" ;
		echo "</script>" ;
		echo "<script language='javascript'>javascript:history.go(-1)</script>";
		exit();
	}
}

function CheckLevel($Username = "", $Action = ""){
	global $db ;
	//Check Level
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	$res['user'] = $db->select_query("SELECT * FROM ".TB_ADMIN." WHERE username='$Username' ");
	$arr['user'] = $db->fetch($res['user']);
	//Check Action
	$res['action'] = $db->select_query("SELECT * FROM ".TB_ADMIN_GROUP." WHERE id='".$arr['user']['level']."' ");
	$arr['action'] = $db->fetch($res['action']);
	if($arr['action'][$Action]){
		return True;
	}else{
		return False;
	}
}


//countblock
function CountBlock($pblock=""){
	global $db ;
	//Check Level
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	$res['Countsx'] = $db->select_query("SELECT *,count(pblock) as num FROM ".TB_BLOCK." WHERE status='1' and pblock='$pblock' group by pblock");
	$arr['Countsx'] = $db->fetch($res['Countsx']);
	if($arr['Countsx']['num']){
		return True;
	} else {
		echo "";
	}
}

//blog level
function BlogLevel($count=""){
	global $db ;
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	$res['countsy'] = $db->select_query("SELECT * FROM ".TB_BLOG_LEVEL." ");

	while ($arr['countsy'] = $db->fetch($res['countsy'])) {
		$levelid=$arr['countsy']['level_id'];
		if ($levelid=='1'){
			$level1=$arr['countsy']['level_count'];
		}
		if ($levelid=='2'){
			$level2=$arr['countsy']['level_count'];
		} 
		if ($levelid=='3'){
			$level3=$arr['countsy']['level_count'];
		} 
		if ($levelid=='4'){
			$level4=$arr['countsy']['level_count'];
		} 
		 if ($levelid=='5'){
			$level5=$arr['countsy']['level_count'];
		} 
		 if ($levelid=='6'){
			$level6=$arr['countsy']['level_count'];
		}
	}
	if ($count >=0 && $count <= $level1 ){ echo '<img src=images/rate/rank1.gif BORDER=\"0\" ALIGN=\"absmiddle\">  <font color=#CC3399>[ '._COUNT_STAR1.' ]</font>';}
	if ($count >$level1 && $count <= $level2) { echo '<img src=images/rate/rank2.gif BORDER=\"0\" ALIGN=\"absmiddle\">   <font color=#CC3399>[ '._COUNT_STAR2.' ]</font>';}
	if ($count >$level2 && $count <= $level3) { echo '<img src=images/rate/rank3.gif BORDER=\"0\" ALIGN=\"absmiddle\">   <font color=#CC3399>[ '._COUNT_STAR3.' ]</font>';}
	if ($count >$level3 && $count <= $level4) { echo '<img src=images/rate/rank4.gif BORDER=\"0\" ALIGN=\"absmiddle\">   <font color=#CC3399>[ '._COUNT_STAR4.' ]</font>';}
	if ($count >$level4 && $count <= $level5 ) { echo '<img src=images/rate/rank5.gif BORDER=\"0\" ALIGN=\"absmiddle\">   <font color=#CC3399>[ '._COUNT_STAR5.' ]</font>';}
	if ($count >=$level6) { echo '<img src=images/rate/rank6.gif BORDER=\"0\" ALIGN=\"absmiddle\">   <font color=#CC3399>[ '._COUNT_STAR6.' ]</font>';}

}

function NotTrueAlert($permission="", $option="", $text=""){
	if($option == 1){
		$option = "<script language='javascript'>javascript:history.go(-1)</script>";
	}elseif($option == 2){
		$option = "<script language='javascript'>refresh_close();</script>";
	}elseif($option == 3){
		$option = "<script language='javascript'>self.close();</script>";
	}

	if(!$permission){
		echo "<script language='javascript'>" ;
		echo "alert('".$text."')" ;
		echo "</script>" ;
		echo $option ;
		exit();
	}
}

function dirsize($dirName = '.') {
   $dir  = dir($dirName);
   $size = 0;

   while($file = $dir->read()) {
       if ($file != '.' && $file != '..') {
           if (is_dir($file)) {
               $size += dirsize($dirName . '/' . $file);
           } else {
               $size += filesize($dirName . '/' . $file);
           }
       }
   }
   $dir->close();
   return $size;
}

function getfilesize($bytes) {
   if ($bytes >= 1099511627776) {
       $return = round($bytes / 1024 / 1024 / 1024 / 1024, 2);
       $suffix = "TB";
   } elseif ($bytes >= 1073741824) {
       $return = round($bytes / 1024 / 1024 / 1024, 2);
       $suffix = "GB";
   } elseif ($bytes >= 1048576) {
       $return = round($bytes / 1024 / 1024, 2);
       $suffix = "MB";
   } elseif ($bytes >= 1024) {
       $return = round($bytes / 1024, 2);
       $suffix = "KB";
   } else {
       $return = $bytes;
       $suffix = "Byte";
   }
   if ($return == 1) {
       $return .= " " . $suffix;
   } else {
       $return .= " " . $suffix . "s";
   }
   return $return;
}

function showerror($showmsg) { 
	echo" <table width=\"400\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
  <tr>
    <td><div align=\"left\">
      <table cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" border=\"0\">
        <tbody>
          <tr>
            <td width=\"20\"></td>
            <td></td>
            <td width=\"19\"></td>
          </tr>
        </tbody>
      </table>
      <table cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" border=\"0\">
        <tbody>
          <tr>
            <td width=\"10\"></td>
            <td valign=\"top\" width=\"100%\"><div align=\"center\">
              <table cellspacing=\"0\" cellpadding=\"0\" width=\"98%\" border=\"0\">
                <tbody>
                  <tr>
                    <td><table width=\"100%\" cellspacing=\"5\">
                      <tr>
                        <td><div align=\"center\"><strong><br />
                          <br />
                          $showmsg</strong><br />
                        </div></td>
                      </tr>
                    </table></td>
                  </tr>
                </tbody>
              </table>
            </div></td>
            <td width=\"10\"></td>
          </tr>
        </tbody>
      </table>
      <table cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" border=\"0\">
        <tbody>
          <tr>
            <td width=\"20\"></td>
            <td></td>
            <td width=\"19\"></td>
          </tr>
        </tbody>
      </table>
    </div></td>
  </tr>
</table>";
} // end fuction checktel

function sendmailnewx($member_id ,$name, $user_name , $pwd_name1, $email ,$home) {
	$admin_mail="".WEB_EMAIL."";
	$Headers = "MIME-Version: 1.0\r\n" ;
	$Headers .= "Content-type: text/html; charset=".ISO."\r\n" ;

	$Headers .= "From: ".WEB_EMAIL." <".WEB_EMAIL.">\r\n" ;
	$Headers .= "Reply-to: ".WEB_EMAIL." <".WEB_EMAIL.">\r\n" ;
	$Headers .= "X-Priority: 3\r\n" ;
	$Headers .= "X-Mailer: PHP mailer\r\n" ;

	$subject_mail = _MAILNEW_TOPIC ;

	$message_mail = "
	<html>
	<title>Email for new User</title>
	<body>
	<table>
	<tr><td><br>"._MAILNEW_DETAIL1." $name</td></tr>
	<tr><td><br>"._MAILNEW_DETAIL2."</td></tr>
	<tr><td><br>"._MAILNEW_DETAIL3." $member_id</td></tr>
	<tr><td><br>"._MAILNEW_DETAIL4."</td></tr>
	<tr><td><br>"._MAILNEW_DETAIL5." $user_name</td></tr>
	<tr><td><br>"._MAILNEW_DETAIL6." $pwd_name1</td></tr>
	<tr><td><br>"._MAILNEW_DETAIL7."</td></tr>
	<tr><td><br>"._MAILNEW_DETAIL8." $home</td></tr>
	</table>
	</body>
	</html>
	" ;

	$from = "From:\"".WEB_EMAIL."\"<".WEB_EMAIL.">" ;
	if(@mail($email,$subject_mail,$message_mail,$Headers,$from))
	{
		echo "<br><br><center><font size='3' face='MS Sans Serif'><b>" ;
		echo ""._MAIL_WELCOME2."" ;
	}else{
		echo _MAIL_WELCOME;
	}

}

function writableCell( $folder ) {
	echo '<tr>';
	echo '<td class="item">' . $folder . '/</td>';
	echo '<td align="left">';
	echo is_writable( "../$folder" ) ? '<strong><font color="green">' . _INSTALL_WRITABLE . '</font></strong>' : '<strong><font color="red">' . _INSTALL_UNWRITABLE . '</font></strong>' . '</td>';
	echo '</tr>';
}

function checkPostTimePast($timeStamp){
    $dayArray    =    array(0 => _BOT_TODAY, 1 => _TIME_POST_YES );
    $datePost     =     time() - $timeStamp;
    $datePast    =    $datePost / 86400;
    list ( $number1, $number2)    =    explode(".", $datePast);
    if ( $number1 < 30)
    {
        foreach ( $dayArray as $f => $d)
        {
            if ( $f == $number1 )
            return $d;
        }
        return ""._TIME_POST." " . $number1 . " "._TIME_POST_YES1."";    
    }
    return ""._TIME_POST." " . round($number1 / 30) . " "._TIME_POST_MONTH."";
}

function remove_directory($dir) {
	if ($handle = opendir("$dir")) {
		while (false !== ($item = readdir($handle))) {
			if ($item != "." && $item != "..") {
				if (is_dir("$dir/$item")) {
					remove_directory("$dir/$item");
				} else {
					unlink("$dir/$item");
				}
			}
		}
		closedir($handle);
		rmdir($dir);
	}
}
<TABLE WIDTH="750"  border="0" ALIGN="center" CELLPADDING="0" CELLSPACING="0">
  <TR>
            <TD width="10" vAlign=top</TD>
          <TD width="740" vAlign=top colspan="2">

      &nbsp;&nbsp;<IMG SRC="images/menu/textmenu_member.gif" BORDER="0">
				<TABLE width="740" align=center cellSpacing=0 cellPadding=0 border=0>
				<TR>
					<TD height="1" class="dotline" ></TD>
				</TR>
      <TR><td>
<?php 
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$user_login = stripslashes( $_POST['user_login'] );
$user_login = mysql_real_escape_string($_POST['user_login']);
$pwd_login = stripslashes( $_POST['pwd_login'] );
$pwd_login = mysql_real_escape_string( $_POST['pwd_login'] );

if (is_valid($user_login) == true && is_valid($pwd_login) == true)
{
$Username = preg_replace ( '/"/i', '\"' , $user_login); 
$Password= preg_replace ( "/'/i", "\'" , $pwd_login); 
anti_injection($Username,$Password,$IPADDRESS);
//ระบบสมาชิกเสริม maxsite 1.10 พัฒนาโดย www.narongrit.net
	if(USE_CAPCHA){
		if($_SESSION['security_code'] != $_POST['security_code'] OR empty($_POST['security_code'])) {
			echo "<script language='javascript'>" ;
			echo "alert('"._JAVA_CAPTCHA_NOACC."')" ;
			echo "</script>" ;
			echo "<script language='javascript'>javascript:history.go(-1)</script>";
//		echo "		if(".$_SESSION['security_code']." != ".$_POST['security_code']." OR empty(".$_POST['security_code'].")) {";
			exit();
		}
	}

if(isset($Username) and isset($Password)) {


$res['admin'] = $db->select_query("SELECT * FROM ".TB_ADMIN." WHERE username='".$Username."' AND password='".md5($Password)."'  "); 
$rows['admin'] = $db->rows($res['admin']); 
if($rows['admin']){
	$arr['admin'] = $db->fetch($res['admin']);
}
if ($arr['admin']['username']){
session_unset($login_true);
	//Login ผ่าน
	ob_start();
	$_SESSION['admin_user'] = $Username ;
	$_SESSION['admin_pwd'] = md5($Password) ;
	$_SESSION['CKFinder_UserRole'] =$Username;
	$_SESSION['ua'] = $_SESSION['admin_user'].":".$_SERVER['HTTP_USER_AGENT'].":".$IPADDRESS.":".session_id().":".$_SERVER['HTTP_ACCEPT_LANGUAGE'];
	session_write_close();
	ob_end_flush();
			$timeoutseconds=20*60;
			$_SESSION['timestamp2']=time();
			$timeout=$_SESSION['timestamp2'] + $timeoutseconds;
	//////////////////////		 เพิ่ม  สมาชิกออนไลน์   ////////////////////////////

			
			$res['user2'] = $db->select_query("SELECT * FROM ".TB_useronline." WHERE useronline='".$_SESSION['admin_user']."' ");
			$rows['user2'] = $db->rows($res['user2']); 
			
			
			if($rows['user2']){

				
				$db->update_db(TB_useronline,array(
					"post_date"=>"".$_SESSION['timestamp2']."",
					"timeout"=>"".$timeout."",
					"ip"=>"".$IPADDRESS.""
				)," useronline='".$_SESSION['admin_user']."' ");
				
			
			}else{
					
				$db->add_db(TB_useronline,array(
					"post_date"=>"".$_SESSION['timestamp2']."",
					"useronline"=>"".$_SESSION['admin_user']."",
					"timeout"=>"".$timeout."",
					"ip"=>"".$IPADDRESS.""
			));
			
			}


?>
				<TABLE width="700" align=center cellSpacing=0 cellPadding=0 border=0>
				<TR>
					<TD>
<BR><BR>
<CENTER><A HREF="?name=admin&file=main"><IMG SRC="images/icon/login-welcome.gif" BORDER="0"></A><BR><BR>
<FONT COLOR="#336600"><B><?php  echo _FORM_MAIN_WELCOME;?></B></FONT><BR><BR>
<A HREF="?name=admin&file=main"><B><?php  echo _MENU_MAIN_INDEX;?></B></A>
</CENTER>
</td>
</tr>
</table>
<?php  echo "<meta http-equiv='refresh' content='1; url=?name=admin&file=main'>" ; ?>
<BR><BR>
<?php 
} else {
//	echo md5($Password);
$result = mysql_query("select user,password from ".TB_MEMBER." where user='".$Username."' and password='".md5($Password)."'") ;
$num = mysql_num_rows($result) ;
if($num<=0) {
//	$showmsg=""._MEMBER_MOD_FORM_LOGIN_NOACC."";
		$db->add_db(TB_MEMBERNOAC,array(
			"user"=>"".$Username."",
			"password"=>"".$Password."",
			"ip"=>"".$IPADDRESS."",
			"timelog"=>"".TIMESTAMP.""
		));
	$resultx = mysql_query("select user,password from ".TB_MEMBERNOAC." where user='".$Username."' ") ;
	$numx = mysql_num_rows($resultx) ;
	if ($numx ==3){
	$showmsg =""._MEMBER_MOD_FORM_LOGIN_NOACC_LIMIT."";
	showerror($showmsg);
	echo"<meta http-equiv=\"refresh\" content=\"3;URL=?name=member&file=wait&user=$Username \" />";
	} else {
	$showmsg =""._MEMBER_MOD_FORM_LOGIN_NOACC."";
	showerror($showmsg);
	echo"<meta http-equiv=\"refresh\" content=\"3;URL=?name=member\" />";
	}
}
else {
//session_start() ;

	mysql_query("UPDATE ".TB_MEMBER." SET lastlog=dtnow WHERE user='".$Username."'");
	mysql_query("UPDATE ".TB_MEMBER." SET dtnow='$now' WHERE user='".md5($Password)."'");

	$showmsg=""._MEMBER_MOD_FORM_LOGIN_PASS."";
	showerror($showmsg);
//session_start();
ob_start();
//session_start();
$_SESSION['login_true']=$Username;
$_SESSION['pwd_login']=md5($Password);
$_SESSION['ua'] = $_SESSION['login_true'].":".$_SERVER['HTTP_USER_AGENT'].":".$IPADDRESS.":".session_id().":".$_SERVER['HTTP_ACCEPT_LANGUAGE'];
session_write_close();
ob_end_flush();

			$timeoutseconds=20*60;
			$_SESSION['timestamp2']=time();
			$timeout=$_SESSION['timestamp2'] + $timeoutseconds;
//////////////////////		 เพิ่ม  สมาชิกออนไลน์   ////////////////////////////
			
			$res['user2'] = $db->select_query("SELECT * FROM ".TB_useronline." WHERE useronline='".$_SESSION['login_true']."' ");
			$rows['user2'] = $db->rows($res['user2']); 
			
			
			if($rows['user2']){

				
				$db->update_db(TB_useronline,array(
					"post_date"=>"".$_SESSION['timestamp2']."",
					"timeout"=>"".$timeout."",
					"ip"=>"".$IPADDRESS.""
				)," useronline='".$_SESSION['login_true']."' ");
				
			
			}else{
					
				$db->add_db(TB_useronline,array(
					"post_date"=>"".$_SESSION['timestamp2']."",
					"useronline"=>"".$_SESSION['login_true']."",
					"timeout"=>"".$timeout."",
					"ip"=>"".$IPADDRESS.""
			));
			
			}
//echo "<meta http-equiv='refresh' content='0.5;url=\"".$HTTP_REFERER."\"'>" ;
if($IPADDRESS !='127.0.0.1'){
$info = getInfo($IPADDRESS);
$lastdate=date('Y-m-d', strtotime('-1 week'));
$visitor_ip = $IPADDRESS;
$visitor_browser = getBrowserType();
$visitor_hour = date("h");
$visitor_minute = date("i");
$visitor_date = date("Y-m-d H:i:s");
$visitor_day = date("d");
$visitor_month = date("m");
$visitor_year = date("Y");
$visitor_refferer = $_SERVER['HTTP_REFERER'];
$visited_page = str_replace(WEB_URL,"",selfURL());

$result = mysql_query("select user,email from ".TB_MEMBER." where user='".$_SESSION['login_true']."' ") ;
$dbarr = mysql_fetch_array($result) ;

$db->del(TB_MEMBERLOG," visitor_date <='".$lastdate."' "); 

$db->add_db(TB_MEMBERLOG,array(
"user"=> "".$dbarr['user']."",
"email"=> "".$dbarr['email']."",
"visitor_ip"=> $visitor_ip,
"visitor_browser"=> $visitor_browser,
"visitor_date"=> $visitor_date,
"city"=>  $info["city"],
"location"=>  $info['country'],
"longitude"=>  $info["long"],
"latitude"=> $info["lat"],
"visitor_refferer"=> $visitor_refferer,
"visitor_page"=> $visited_page,
"localTimeZone"=> $info["localTimeZone"]
//"localTime"=> $info["localTime"]
));
}
echo "<meta http-equiv=refresh content='3;URL=?name=member&file=member_detail'>" ;
//exit() ;
				}
				}
				}

?>
</td>
</tr>
</table>
<?php 
//login now
} else {
		
		$db->add_db(TB_IPBLOCK,array(
			"ip"=>"".$IPADDRESS."",
			"post_date"=>"".time().""
		));
		
?>
<BR><BR>
<CENTER><A HREF="?name=index"><IMG SRC="images/dangerous.png" BORDER="0"></A><BR><BR>
<FONT COLOR="#336600"><B><?php  echo _ADMIN_IPBLOCK_MESSAGE_HACK;?> <?php  echo WEB_EMAIL;?></B></FONT><BR><BR>
<A HREF="?name=index"><B><?php  echo _ADMIN_IPBLOCK_MESSAGE_HACK1;?></B></A>
</CENTER>
<?php  echo "<meta http-equiv='refresh' content='10; url=?name=index'>" ; ?>
<BR><BR>
<?php 
}
?>
</td>
</tr>
</table>

	<TABLE cellSpacing=0 cellPadding=0 width=720 border=0>
      <TBODY>

<?php 
require_once("mainfile.php");
		$classtext = array("", "");
		$classbox = array("noborder2", "noborder2");
		$username = "";
		$password = "";
//////////////////////		 เพิ่ม  สมาชิกออนไลน์   ////////////////////////////
//			
//			$db->add(TB_useronline," useronline='".$_SESSION['admin_user']."' "); 
//			
//echo "$_POST[username]<br>";
//echo "$_POST[password]<br>";
//echo "".md5($_POST[password])."<br>";
//Check Admin

$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);

$user_login = stripslashes( $_POST['username'] );
$user_login = mysql_real_escape_string($_POST['username']);
$pwd_login = stripslashes( $_POST['password'] );
$pwd_login = mysql_real_escape_string( $_POST['password'] );

if (is_valid($user_login) == true && is_valid($pwd_login) == true)
{
$Username = preg_replace ( '/"/i', '\"' , $user_login); 
$Password= preg_replace ( "/'/i", "\'" , $pwd_login); 
anti_injection($Username,$Password,$IPADDRESS);

$res['admin'] = $db->select_query("SELECT * FROM ".TB_ADMIN." WHERE username='".$Username."' AND password='".md5($Password)."'  "); 
$rows['admin'] = $db->rows($res['admin']); 
if($rows['admin']){
	$arr['admin'] = $db->fetch($res['admin']);
}

if(USE_CAPCHA){
	if($_SESSION['security_code'] != $_POST['security_code'] OR empty($_POST['security_code'])) {
		echo "<script language='javascript'>" ;
		echo "alert('"._JAVA_CAPTCHA_NOACC."')" ;
		echo "</script>" ;
		echo "<script language='javascript'>javascript:history.go(-1)</script>";
		exit();
	}
}

//Can Login
if(!empty($arr['admin']['id'])){
session_unset($login_true);
	//Login ผ่าน
	ob_start();
	$_SESSION['admin_user'] = $Username ;
	$_SESSION['admin_pwd'] = md5($Password) ;
	$admin_user=$_SESSION['admin_user'];
	$admin_pwd=$_SESSION['admin_pwd'];
	$_SESSION['CKFinder_UserRole'] ='admin';
	$_SESSION['ua'] = $_SESSION['admin_user'].":".$_SERVER['HTTP_USER_AGENT'].":".$IPADDRESS.":".session_id().":".$_SERVER['HTTP_ACCEPT_LANGUAGE'];
	session_write_close();
	ob_end_flush();
			$timeoutseconds=20*60*60;
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

if($IPADDRESS !='127.0.0.1'){
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
$info = getInfo($IPADDRESS);

$result = mysql_query("select username,email from ".TB_ADMIN." where username='".$_SESSION['admin_user']."' ") ;
$dbarr = mysql_fetch_array($result) ;

$db->del(TB_ADMINLOG," visitor_date <='".$lastdate."' "); 

$db->add_db(TB_ADMINLOG,array(
"user"=> "".$dbarr['username']."",
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
?>
        <TR>
          <TD width="720" vAlign=top align=left><br>
		  <!-- Admin -->
		  &nbsp;&nbsp;<IMG SRC="images/menu/textmenu_admin.gif" BORDER="0"><BR>
				<TABLE width="700" align=center cellSpacing=0 cellPadding=0 border=0>
				<TR>
					<TD height="1" class="dotline"></TD>
				</TR>
				<TR>
					<TD>
<BR><BR>
<CENTER><A HREF="?name=admin&file=main"><IMG SRC="images/icon/login-welcome.gif" BORDER="0"></A><BR><BR>
<FONT COLOR="#336600"><B><?php  echo _ADMIN_LOGIN_MESSAGE_ACC;?></B></FONT><BR><BR>
<A HREF="?name=admin&file=main"><B><?php  echo _ADMIN_GOBACK;?></B></A>
</CENTER>
<?php  echo "<meta http-equiv='refresh' content='1; url=?name=admin&file=main'>" ; ?>
<BR><BR>
<?php 
}else{
	//Login ไม่ผ่าน

?>
        <TR>
          <TD width="720" vAlign=top align=left><BR>
				<TABLE width="700" align=center cellSpacing=0 cellPadding=0 border=0>
        <TR>
          <TD vAlign=top align=center class="login" align="center"><FONT COLOR="#990000" size="3"><b><?php  echo _ADMIN_LOGIN_MESSAGE_NOACC;?></b></font>
		  </td>
		</tr>
				<TR>
					<TD align="center">
	<TABLE cellSpacing=0 cellPadding=0 width=520 border=0>
      <TBODY>
        <TR>
          <TD vAlign=top align=center><BR>

	<div id="loginform">
		<h2>Admin<span class="gray">istrator ! login</span></h2>
		<form name="login" id="login" method="post" action="?name=admin&file=login">
			<p>
				<?php  echo _ADMIN_MOD_INDEX_USER;?> :
				<input type="text" name="username" id="username" class="<?php  echo $classbox[0]; ?>"  value="<?php  echo $username; ?>"  onclick="this.value=''" /><br />
				<?php  echo _ADMIN_MOD_INDEX_PASS;?> : 
				<input type="password" name="password" id="password" class="<?php  echo $classbox[1]; ?>"  value="<?php  echo $password; ?>"  onclick="this.value=''" /><br />
		    	<div><?php 
if(USE_CAPCHA){
?>
						<?php if(CAPCHA_TYPE == 1){ 
							echo "<img src=\"capcha/CaptchaSecurityImages.php?width=".CAPCHA_WIDTH."&height=".CAPCHA_HEIGHT."&characters=".CAPCHA_NUM."\" width=\"".CAPCHA_WIDTH."\" height=\"".CAPCHA_HEIGHT."\" align=\"absmiddle\" />";
						}else if(CAPCHA_TYPE == 2){ 
							echo "<img src=\"capcha/val_img.php?width=".CAPCHA_WIDTH."&height=".CAPCHA_HEIGHT."&characters=".CAPCHA_NUM."\" width=\"".CAPCHA_WIDTH."\" height=\"".CAPCHA_HEIGHT."\" align=\"absmiddle\" />";
						};?>&nbsp;
						<input name="security_code" type="text" id="security_code" class="<?php  echo $classbox[1]; ?>" onclick="this.value=''" maxlength="10" size="10">

<?php 
}
?></div><br>
				<input type="hidden" name="action" id="action" value="login"> 
                <input name="button" type="submit" class="button"    id="button" value="<?php  echo _ADMIN_MOD_BUTTON_ADD;?>"   />
                <input name="button2" type="button"   id="button2" class="button" value="<?php  echo _ADMIN_MOD_BUTTON_CANCLE;?>" onClick="window.location='index.php'" /><br />
			</p>
		</form>
		<div style="line-height: 18px"><a href="<?php echo WEB_URL."?name=admin&file=forget_pwd";?>">[ <?php echo _MEMBER_PASSRESET;?> ] </a>
		</div>
</div>
</td>
</tr>
</TABLE>
<?php 
}
?>
					</TD>
				</TR>
			</TABLE>
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
				</TD>
				</TR>
			</TABLE>

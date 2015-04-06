<?php
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$isox='UTF8';
$resultsx='utf8';
$langset='utf8_general_ci';
$checktablex = $db->select_query("SHOW TABLES LIKE 'web_adminlog' ");
$checktable = $db->rows($checktablex);
if ($checktable > 0) {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?=ISO;?>">
<title>ATOMYMAXSITE 2.5 : : ติดตั้งโปรแกรมเพิ่มเติม</title>
</head>

<body>
<div align="center">
  <p>&nbsp;</p>
  <p><img src="images/dangerous.png" alt="" /><br />
    <br />
      <strong>ท่านได้ update ระบบ member ของ ATOMYMAXSITE 2.5 ไปแล้วครับ</strong><br /><br />
	  <a href="index.php">หน้าแรก Maxsite</a> | <a href="?name=admin">ผู้ดูแลระบบ</a>
</div>
</body>
</html>
<?php 
} else {
if(!empty($_POST)){
if (file_exists( 'includes/config.in.php' ) && @is_writable( 'includes/config.in.php' )) {
//	echo '<strong><font color="green">ไฟล์สามารถเขียนทับได้</font></strong>';
	$canWrite = '1';
} else if ( @is_writable( 'includes/..' ) ) {
//	echo '<strong><font color="green">ไฟล์สามารถเขียนทับได้</font></strong>';
	$canWrite = '1';
} else {
//	echo '<strong><font color="red">ไฟล์ไม่สามารถเขียนทับได้</font></strong>';
	$canWrite = '0';
}

if($canWrite !=0){

$sql = "CREATE TABLE web_admin_reset (
  id int(6) NOT NULL auto_increment,
  user varchar(30) NOT NULL default '',
  password varchar(30) NOT NULL default '',
  addtime varchar(50) NOT NULL,
  email varchar(40) NOT NULL default '',
  ses_timein timestamp NOT NULL default '0000-00-00 00:00:00',
  session varchar(255) NOT NULL,
  confirm int(2) NOT NULL default '0',
  PRIMARY KEY  (id)
) ENGINE=MyISAM  DEFAULT CHARSET=".$isox." AUTO_INCREMENT=1 ;";
$db->select_query($sql);

$sql = "CREATE TABLE `web_adminlog` (
`id` int( 11 ) NOT NULL AUTO_INCREMENT ,
`user` varchar( 50 ) default NULL ,
`email` varchar( 50 ) default NULL ,
`visitor_ip` varchar( 32 ) default NULL ,
`visitor_browser` varchar( 255 ) default NULL ,
`visitor_date` timestamp NOT NULL default CURRENT_TIMESTAMP ,
`city` varchar( 255 ) NOT NULL ,
`location` varchar( 32 ) NOT NULL ,
`longitude` varchar( 255 ) NOT NULL ,
`latitude` varchar( 255 ) NOT NULL ,
`visitor_refferer` varchar( 255 ) default NULL ,
`visitor_page` varchar( 255 ) default NULL ,
`localTimeZone` varchar( 255 ) NOT NULL ,
`localTime` varchar( 255 ) NOT NULL ,
`ad` double NOT NULL ,
PRIMARY KEY ( `id` )
) ENGINE = MYISAM DEFAULT CHARSET = ".$isox." AUTO_INCREMENT =1;";
$db->select_query($sql);

$sql = "CREATE TABLE web_member_reset (
  id int(6) NOT NULL auto_increment,
  user varchar(30) NOT NULL default '',
  password varchar(30) NOT NULL default '',
  addtime varchar(50) NOT NULL,
  email varchar(40) NOT NULL default '',
  ses_timein timestamp NOT NULL default '0000-00-00 00:00:00',
  session varchar(255) NOT NULL,
  confirm int(2) NOT NULL default '0',
  PRIMARY KEY  (id)
) ENGINE=MyISAM  DEFAULT CHARSET=".$isox." AUTO_INCREMENT=1 ;";
$db->select_query($sql);

$sql = "CREATE TABLE `web_memberlog` (
`id` int( 11 ) NOT NULL AUTO_INCREMENT ,
`user` varchar( 50 ) default NULL ,
`email` varchar( 50 ) default NULL ,
`visitor_ip` varchar( 32 ) default NULL ,
`visitor_browser` varchar( 255 ) default NULL ,
`visitor_date` timestamp NOT NULL default CURRENT_TIMESTAMP ,
`city` varchar( 255 ) NOT NULL ,
`location` varchar( 32 ) NOT NULL ,
`longitude` varchar( 255 ) NOT NULL ,
`latitude` varchar( 255 ) NOT NULL ,
`visitor_refferer` varchar( 255 ) default NULL ,
`visitor_page` varchar( 255 ) default NULL ,
`localTimeZone` varchar( 255 ) NOT NULL ,
`localTime` varchar( 255 ) NOT NULL ,
`ad` double NOT NULL ,
PRIMARY KEY ( `id` )
) ENGINE = MYISAM DEFAULT CHARSET = ".$isox." AUTO_INCREMENT =1;";
$db->select_query($sql);

$GoogleAC=mysql_escape_string($_POST['GoogleAC']);
$GooglePa=mysql_escape_string($_POST['GooglePa']);
$NameSendMail=mysql_escape_string($_POST['NameSendMail']);
$APIKEY=mysql_escape_string($_POST['APIKEY']);

$FileBNK = "includes/config.in.php";
$FileBNKOpen = @fopen($FileBNK, "r");
$FileBNKContent = @fread ($FileBNKOpen, @filesize($FileBNK));
@fclose ($FileBNKOpen);
$FileBNKContent = str_replace ("?>", "//member admin login\r\n", $FileBNKContent);
$config_open = @fopen("includes/config.in.php", "w");
@fwrite($config_open, "".$FileBNKContent."");
@fclose($config_open);

$FileBNKContent ="define('TB_MEMBERLOG','web_memberlog');\r\n";
$FileBNKContent .="define('TB_ADMINLOG','web_adminlog');\r\n";
$FileBNKContent .="define('TB_ADMIN_RESET','web_admin_reset');\r\n";
$FileBNKContent .="define('TB_MEMBER_RESET','web_member_reset');\r\n";
$FileBNKContent .="define('_GOOGLE_SEND_MAIL_USER','$GoogleAC');\r\n";
$FileBNKContent .="define('_GOOGLE_SEND_MAIL_PASS','$GooglePa');\r\n";
$FileBNKContent .="define('_GOOGLE_SEND_MAIL_FROM','$NameSendMail');\r\n";
$FileBNKContent .="define('_GOOGLE_SEND_API_KEY','$APIKEY');\r\n";
$FileBNKContent .="?>\r\n";
$config_open = @fopen("includes/config.in.php", "a+");
@fwrite($config_open, "".$FileBNKContent."");
@fclose($config_open);


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?=$iso;?>">
<title>ATOMYMAXSITE 2.5 : : ติดตั้งโปรแกรมเพิ่มเติม</title>
</head>

<body>
<div align="center">
  <p>&nbsp;</p>
  <p><img src="images/icon/login-welcome.gif" alt="" width="97" height="105" /><br />
    <br />
      <strong>การ update ระบบ member ของ ATOMYMAXSITE 2.5 เสร็จเรียบร้อย</strong><br />
	  <strong>กรุณาเปลี่ยน permission ของ includes/config.in.php เป็น 644 ด้วยนะครับผม</strong><br /><br />
	  <a href="index.php">หน้าแรก Maxsite</a> | <a href="?name=admin">ผู้ดูแลระบบ</a>
</div>
</body>
</html>
<?php 
} else {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?=$iso;?>">
<title>ATOMYMAXSITE 2.5 : : ติดตั้งโปรแกรมเพิ่มเติม</title>
</head>

<body>
<div align="center">
  <p>&nbsp;</p>
  <p><img src="images/icon/login-welcome.gif" alt="" width="97" height="105" /><br />
    <br />
      <strong><font color="red">ไฟล์ includes/config.in.php ไม่สามารถเขียนทับได้ ต้องเปลี่ยน permission เป็น 777 ก่อนครับ</font></strong><br /><br />
	  <a href="index.php">หน้าแรก Maxsite</a> | <a href="?name=admin">ผู้ดูแลระบบ</a>
</div>
</body>
</html>
<?php 
}

} else {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?=$iso;?>">
<title>ATOMYMAXSITE 2.5 : : ติดตั้งโปรแกรมเพิ่มเติม</title>
</head>

<body>
<div align="center">
  <p>&nbsp;</p>
  <p><img src="images/icon/login-welcome.gif" alt="" width="97" height="105" /><br />
    <br />
      <strong>กรอข้อมูลการ update ข้อมูล</strong><br /><br />
              <FORM name ="update" ACTION="#" METHOD="post" onSubmit="return check()" ENCTYPE="multipart/form-data" >
                <TABLE WIDTH="530" BORDER="0" ALIGN="center" CELLPADDING="2" CELLSPACING="3" >
				
                  <TR>
                    <TD >Account Email ของ Google.com :</TD><TD ><INPUT type="text" NAME="GoogleAC"  ID="GoogleAC" SIZE="20" MAXLENGTH="50" ></TD>
                  </TR>
				 <tr>
                <TD >Password Email ของ Google.com :</TD>
                <TD BGCOLOR="#FFFFFF">
                  <INPUT type="text" NAME="GooglePa"  ID="GooglePa" SIZE="10" MAXLENGTH="50" ></TD>
              </TR>
                  <TR>
                <TD >ชื่อผู้ส่งเมล์หาสมาชิก :</TD>
                <TD BGCOLOR="#FFFFFF">
                  <INPUT type="text" NAME="NameSendMail"  ID="NameSendMail" SIZE="10" MAXLENGTH="50" ></TD>
              </TR>
                  <TR>
                <TD >API Key :</TD>
                <TD BGCOLOR="#FFFFFF">
                  <INPUT type="text" NAME="APIKEY"  ID="APIKEY" SIZE="20" MAXLENGTH="50" ></TD>
              </TR>
			  </table>
			  <INPUT type="submit" class='button'  NAME="Submit" VALUE="Update">
			  <INPUT type="reset" class='button'  NAME="Submit2" VALUE="Reset">
			 </form>
</div>
</body>
</html>
<?php
}

}
?>
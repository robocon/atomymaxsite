<TABLE WIDTH="660" BORDER="0" ALIGN="center" CELLPADDING="0" CELLSPACING="0">
  <TR>
            <TD width="10" vAlign=top></TD>
          <TD width="640" vAlign=top colspan="2"><BR>

      &nbsp;&nbsp;<IMG SRC="images/menu/textmenu_member.gif" BORDER="0">
<?php 
$forget=$_POST['forget'];
function mosMakePassword($length) {
	$salt = "abcdefghijkmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ123456789";
	$len = strlen($salt);
	$makepass="";
	mt_srand(10000000*(double)microtime());
	for ($i = 0; $i < $length; $i++)
	$makepass .= $salt[mt_rand(0,$len - 1)];
	return $makepass;
}
$Pass=mosMakePassword(8);
$confirmed=$_GET['confirmed'];

if(!empty($confirmed)){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['reset'] = $db->select_query("SELECT * FROM ".TB_MEMBER_RESET." where user='".$_GET['user']."' and session='".$_GET['session']."' and confirm='0' and password='".$_GET['password']."' ");
$arr['reset'] = $db->fetch($res['reset']);
$emailx=$arr['reset']['email'];
$password=$arr['reset']['password'];
$sess=$arr['reset']['session'];
if ($arr['reset']['id']<>''){
			$db->update_db(TB_MEMBER_RESET,array(
				"confirm"=>"1",
			)," email='$emailx' ");

$sql = "select email from ".TB_MEMBER." where email='$emailx'" ;
$result = $db->select_query($sql) ;
$numrow = $db->rows($result) ;
if($numrow !=0) {
			$db->update_db(TB_MEMBER,array(
				"password"=>"".md5($password).""
			)," email='$emailx' ");
}
$sql1 = "select email from ".TB_ADMIN." where email='$emailx'" ;
$result1 = $db->select_query($sql1) ;
$numrow1 = $db->rows($result1) ;
if($numrow1 !=0) {
			$db->update_db(TB_ADMIN,array(
				"password"=>"".md5($password).""
			)," email='$emailx' ");
}
}
?>

                <TABLE WIDTH="640" BORDER="0" ALIGN="center" CELLPADDING="2" CELLSPACING="3" >
              <TR>
                <TD BGCOLOR="#FFFFFF" align="center"><FONT SIZE="4"><< <?=_RESET_MAIL_ADDCON_TITLE;?> >> <br><a href="?name=member&file=login">[ login ]</a> </FONT></STRONG></FONT> </FONT></TD>
              </TR>
				</table><br>
<?
} else if(!empty($forget)) {
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);

//ระบบสมาชิกเสริม maxsite 1.10 พัฒนาโดย www.narongrit.net
$emails=$_POST['emails'];
$result = $db->select_query("select email from ".TB_MEMBER." where email='$emails' ") or die("Err Database") ;
$numrow = $db->rows($result) ;

if($numrow==0) {
$status = "<center><font size='3' face='MS Sans Serif'><b>No $emails on Web</b></font></center>" ;
} else {
$emails=$_POST['emails'];
$resultm = $db->select_query("select * from ".TB_MEMBER." where email='$emails' ") ;
$dbarr = $db->fetch($resultm) ;
$email=$dbarr['email'];
$name=$dbarr['name'];
$user=$dbarr['user'];
$password=$Pass;
$session=session_id();
$ses_timein=date('Y-m-d h:i:s');
$sqlx = "select email from ".TB_MEMBER_RESET." where email='$email' and confirm='0' " ;
$resultx = $db->select_query($sqlx) ;
$numrowx = $db->rows($resultx) ;
if($numrowx ==0) {
		$db->add_db(TB_MEMBER_RESET,array(
			"user"=>"".$user."",
			"password"=>"".$password."",
			"addtime"=>"".TIMESTAMP."",
			"email"=>"".$email."",
			"ses_timein"=>"".$ses_timein."",
			"session"=>"".$session."",
			"confirm"=>"0"
		));
//		$db->closedb ();
} else {
			$db->update_db(TB_MEMBER_RESET,array(
			"password"=>"".$password."",
			"session"=>"".$session.""
			)," email='$email' ");
}


function resetpasswordx($email,$name,$user,$password,$session) {

$subject_mail = ""._RESET_MAIL_SUB."" ; // หัวข้ออีเมล์ 

//----------------------------------------------------------------------- เนื้อหาของอีเมล์ //
$message_mail = "<html><title>"._RESET_MAIL_BODY." </title><body><table>" ;
$message_mail .= "<tr><td>"._RESET_MAIL_BODY1." $name </td></tr>" ;
$message_mail .= "<tr><td>"._RESET_MAIL_BODY2." $user </td></tr>" ;
$message_mail .= "<tr><td>"._RESET_MAIL_BODY3." $password </td></tr>" ;
$message_mail .= "<tr><td><a href=".WEB_URL."/?name=member&file=forget_pwd&confirmed=1&user=".$user."&password=".$password."&session=".$session.">"._RESET_MAIL_BODY4."</a></td></tr>";
$message_mail .= "<tr><td>"._RESET_MAIL_BODY5." $home</td></tr></table></body></html>";
//------------------------------------------------------------------------ จบเนื้อหาของอีเมล์ //
require_once("includes/phpmailler/class.phpmailer.php");
 $mail = new PHPMailer();
 $mail->CharSet = "utf-8";
 $mail->IsSMTP();
 $mail->IsHTML(true);
 $mail->Host = 'ssl://smtp.gmail.com';
 $mail->Port = 465;
 $mail->SMTPAuth = true;
 $mail->Username = ""._GOOGLE_SEND_MAIL_USER.""; //อีเมล์ของคุณ (Google App)
 $mail->Password = ""._GOOGLE_SEND_MAIL_PASS.""; //รหัสผ่านอีเมล์ของคุณ (Google App)
 $mail->From = "".WEB_EMAIL.""; // ใครเป็นผู้ส่ง
 $mail->FromName = ""._GOOGLE_SEND_MAIL_FROM.""; // ชื่อผู้ส่งสักนิดครับ
 $mail->Subject  = $subject_mail;
 $mail->Body     =  $message_mail;
 $mail->AltBody =  $message_mail;
 $mail->AddAddress($email); // ส่งไปที่ใครดีครับ
if( $mail->send("".$email.""))
{
echo "<br><br><center><b>" ;
echo "<center><b>"._RESET_MAIL_SEND1." $email "._RESET_MAIL_SEND2."</b></font></center>" ;
echo ""._RESET_MAIL_SEND_WAIT."</b></font></center>" ;
}else{
echo ""._RESET_MAIL_SEND_NO."";
}
}

resetpasswordx($email,$name,$user,$password,$session ) ;  // ส่งเมล์หาลูกค้า เรียกฟังค์ชั่นให้ทำงาน
echo "<meta http-equiv=refresh content='3;URL=index.php'>" ;

}

} else {
?>
	<FORM ACTION="?name=member&file=forget_pwd" METHOD="post">
              
        <TABLE WIDTH="640" BORDER="0" ALIGN="center" CELLPADDING="3" CELLSPACING="1">
		            <TR VALIGN="top"> 
                  <TD COLSPAN="2" align="center"> 
                    
                     
                      
                       <DIV ALIGN="center"><P><FONT COLOR="#000000" SIZE="2"><STRONG></STRONG></FONT></P>
                      <P><FONT COLOR="#000000" SIZE="2"><STRONG><?php echo _MEMBER_MOD_RESET_PASS_ADD;?></STRONG></FONT></P>
                    </DIV></TD>
      </TR>
	
      <TR> 
                  
            <TD align="right" BGCOLOR="#FFFFFF" ><FONT SIZE="2"><STRONG>email</STRONG></FONT></TD>
        <TD BGCOLOR="#FFFFFF"><INPUT NAME="emails" TYPE="text" ID="emails" size="20"></TD>
      </TR>
	  <TR> 
                  
            <TD align="center" BGCOLOR="#FFFFFF" >&nbsp;</TD>
				            <TD BGCOLOR="#FFFFFF"> 
            <INPUT type="submit" class='button'  NAME="Submit" VALUE="Send">
            <INPUT NAME="forget" TYPE="hidden" ID="forget" VALUE="forget">
            &nbsp; </TD>
      </TR>
	        <TR> 
                  <TD COLSPAN="2" BGCOLOR="#FFFFFF"><DIV ALIGN="center">
                    <P><STRONG><FONT COLOR="#FF0000" SIZE="1" FACE="MS Sans Serif, Tahoma, sans-serif"><?php echo _MEMBER_MOD_RESET_PASS_SEND;?> </FONT></STRONG></P>
                  </DIV></TD>
      </TR>
	  
    </TABLE>
	
</FORM>

<?php 
	}
?>
	</TD>
  </TR>
</TABLE>
<TABLE width="740" BORDER="0" ALIGN="center" CELLPADDING="0" CELLSPACING="0">
  <TR>
            <TD width="10" vAlign=top></TD>
          <TD width="730" vAlign=top colspan="2">

      &nbsp;&nbsp;<IMG SRC="images/menu/textmenu_member.gif" BORDER="0">
				<TABLE width="730" align=center cellSpacing=0 cellPadding=0 border=0>
				<TR>
					<TD height="1" class="dotline" colspan="2"></TD>

      </TR>
      <TR>
        <TD>
          <?php 
require("includes/class.resizepic.php");
	if(USE_CAPCHA){
		if($_SESSION['security_code'] != $_POST['security_code'] OR empty($_POST['security_code'])) {
			echo "<script language='javascript'>" ;
			echo "alert('"._JAVA_CAPTCHA_NOACC."')" ;
			echo "</script>" ;
			echo "<script language='javascript'>javascript:history.go(-1)</script>";
			exit();
		}
	}


$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['admin'] = $db->select_query("SELECT * FROM ".TB_ADMIN." WHERE username='".$_POST['username']."' "); 
$arr['admin'] = $db->fetch($res['admin']);

if($arr['admin']['username']){
			echo "<script language='javascript'>" ;
			echo "alert('"._MEMBER_MOD_FORM_JAVA_USERACC."')" ;
			echo "</script>" ;
			echo "<script language='javascript'>javascript:history.go(-1)</script>";
			exit();
}

$FILE = $_FILES['FILE'];

//ระบบสมาชิกเสริม maxsite 1.10 พัฒนาโดย www.narongrit.net

$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);

$first_name=$_POST['first_name'];
$last_name=$_POST['last_name'];
$nic_name=$_POST['nic_name'];
$age=$_POST['age'];
$user_name = stripslashes( $_POST['username'] );
$user_name = mysql_real_escape_string($_POST['username']);
$pwd_name1 = stripslashes( $_POST['pwd_name1'] );
$pwd_name1 = mysql_real_escape_string( $_POST['pwd_name1'] );
//$user_name=$_POST['username'];
//$pwd_name1=$_POST['pwd_name1'];
$email=$_POST['email'];
$day=$_POST['day'];
$office=$_POST['office'];
$month=$_POST['month'];
$year=$_POST['year'];
$signature=$_POST['signature'];
$address=$_POST['address'];
$amper=$_POST['amper'];
$zipcode=$_POST['zipcode'];
$phone=$_POST['phone'];
$education=$_POST['education'];
$work=$_POST['work'];
$province = $_POST['province'];
	// ป้องกันการแทรก html กับ ละเครื่องหมาย ' "
	$first_name = trim(htmlspecialchars($first_name));
	$last_name = trim(htmlspecialchars($last_name));
	$nic_name = trim(htmlspecialchars($nic_name));
	$age = trim(htmlspecialchars($age));
	$email = trim(htmlspecialchars($email));
	$work = trim(htmlspecialchars($work));
	$signature=trim(htmlspecialchars($signature));
$sex=$_POST['sex'];
if ($sex==1) {
	$sexx=''._ALUM_SEX1.'';
} else if ($sex==2)  {
	$sexx=''._ALUM_SEX2.'';
} else {
$sexx=''._ALUM_SEX3.'';
}
	// แปลง วัน/เดือน/ปีเกิด
	$birthday = "$day $month $year";


//(member_id,name,date,month,year,age,sex,address,amper,province,zipcode,phone,education,work,user,password,email,signup)

// ตรวจสอบ กรณีที่เรียกหน้านี้ขึ้นมาเลยโดยที่กรอกข้อมูลไม่ครบ
if($first_name=="" || $last_name=="" ||$nic_name=="" || $sex=="" ||$age=="" || $province=="" || $user_name=="" || $pwd_name1=="" || $email=="") {
$showmsg="<br><br><center><font size='3' face='MS Sans Serif'><b>"._MEMBER_MOD_FORM_JAVA_DATA_NOT."</b></font><br><br>
<input type='button' value='"._MEMBER_MOD_FORM_JAVA_RETERN."' onclick='history.back();'></center>" ;
	showerror($showmsg);
			exit();
}  

$signup = date("j/n/").(date("Y")+543) ;

//$name = htmlspecialchars($name) ;
$first_name=htmlspecialchars($first_name) ;
$last_name=htmlspecialchars($last_name) ;
$nic_name=htmlspecialchars($nic_name) ;

$address = htmlspecialchars($_POST['address']) ;
$zipcode = htmlspecialchars($_POST['zipcode']) ;
$phone = htmlspecialchars($_POST['phone']) ;

// ตรวจสอบว่ามีชื่อ email นี้ใช้ไปหรือยัง
$sqlm = "select email from ".TB_MEMBER." where email='$email'" ;
$resultm = mysql_query($sqlm) ;
$numrowm = mysql_num_rows($resultm) ;
if($numrowm !=0) {
$showmsgm="<br><br><center><font size='3' face='MS Sans Serif'>"._MEMBER_MOD_FORM_EMAIL_MISS."<br><br><input type='button' value='"._MEMBER_MOD_FORM_JAVA_RETERN."' onclick='history.back();'></center>" ;
	showerror($showmsgm);
	echo"<meta http-equiv=\"refresh\" content=\"3;URL=?name=member\" />";
} else {

// ตรวจสอบว่ามีชื่อ user นี้ใช้ไปหรือยัง
$sql = "select user from ".TB_MEMBER." where user='$user_name'" ;
$result = mysql_query($sql) ;
$numrow = mysql_num_rows($result) ;
if($numrow!=0) {
$showmsg="<br><br><center><font size='3' face='MS Sans Serif'>"._MEMBER_MOD_FORM_USER_MISS."<br><br><input type='button' value='"._MEMBER_MOD_FORM_JAVA_RETERN."' onclick='history.back();'></center>" ;
	showerror($showmsg);
//	echo"<meta http-equiv=\"refresh\" content=\"3;URL=?name=member\" />";
} else {

	//Check Pic Size
if(!empty($FILE['tmp_name'])){

if (($FILE['type']=='image/jpg') || ($FILE['type']=='image/jpeg') || ($FILE['type']=='image/pjpeg') || ($FILE['type']=='image/JPG') || ($FILE['type']=='image/gif') || ($FILE['type']=='image/x-png') ){

	$size = getimagesize($FILE['tmp_name']);
	$sizezz=$size[0]*$size[1];
	$widths = $size[0];
	$heights = $size[1];
  if ( $FILE['size'] > _MEMBER_LIMIT_UPLOAD ) {
	$showmsg="<br><br><center><font size='3' face='MS Sans Serif'><b>"._MEMBER_MOD_FORM_PIC_NOWIDTH." ".(_MEMBER_LIMIT_UPLOAD/1024)." kB "._MEMBER_MOD_FORM_PIC_NOWIDTH1."</b></font><br><br>
	<input type='button' value='"._MEMBER_MOD_FORM_JAVA_RETERN."' onclick='history.back();'></center>" ;
	showerror($showmsg);
	exit();
	}
	
if (($FILE['type']=='image/jpg') || ($FILE['type']=='image/jpeg') || ($FILE['type']=='image/pjpeg') || ($FILE['type']=='image/JPG') || ($FILE['type']=='image/gif') || ($FILE['type']=='image/x-png')|| ($FILE['type']=='image/png') ){
	if ($widths > _MEMBER_LIMIT_PICWIDTH) {
		$images = $FILE["tmp_name"];
		$new_images = "members_".TIMESTAMP."_".$FILE["name"];
		@copy($FILE["tmp_name"],"icon/members_".TIMESTAMP."_".$FILE["name"]);
		$original_image = "icon/members_".TIMESTAMP."_".$FILE["name"]."";
		$width=_MEMBER_LIMIT_PICWIDTH; 
//		$size=GetimageSize($images);
		$im=$widths/$width;
		$imheight=$heights/$im;
		$image = new hft_image($original_image);
		$image->resize($width,$imheight,  '0');
		if (($FILE['type']=='image/jpg') || ($FILE['type']=='image/jpeg') || ($FILE['type']=='image/pjpeg') || ($FILE['type']=='image/JPG')){
		$image->output_resized("icon/members_".TIMESTAMP."_".$FILE["name"]."", "JPG");
		}
		if (($FILE['type']=='image/gif')){
		$image->output_resized("icon/members_".TIMESTAMP."_".$FILE["name"]."", "GIF");
		}
		if (($FILE['type']=='image/x-png')|| ($FILE['type']=='image/png')){
		$image->output_resized("icon/members_".TIMESTAMP."_".$FILE["name"]."", "PNG");
		}
		$Filenames="members_".TIMESTAMP."_".$FILE["name"]."";
} else {
@copy ($FILE['tmp_name'] , "icon/members_".TIMESTAMP."_".$FILE["name"] );
$Filenames="members_".TIMESTAMP."_".$FILE["name"]."";
}
	} else {
	$showmsg="<br><br><center><font size='3' face='MS Sans Serif'><b>"._MEMBER_MOD_FORM_JAVA_TYPE_PIC."</b></font><br><br>
	<input type='button' value='"._MEMBER_MOD_FORM_JAVA_RETERN."' onclick='history.back();'></center>" ;
	showerror($showmsg);
	exit();
	}

} else {
$Filenames="";
}
}

$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$sql = "select MAX(id) as IDS from ".TB_MEMBER." " ;
$result = mysql_query($sql) ;
$dbarr = mysql_fetch_array($result);;
$member_db = $dbarr[IDS]+1 ; // นำค่า id มาเพิ่มให้กับค่ารหัสสมาชิกครั้งละ1
$name="".$first_name." ".$last_name."";
$member_id = "$yourcode$member_db" ; // รหัสสมาชิกเช่น ip0001
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$results =$db->add_db(TB_MEMBER,array(
		"member_id"=>"".$member_id."",
		"name"=>"".$first_name." ".$last_name."",
		"nic_name"=>"".$nic_name."",
		"date"=>"".$day."",
		"month"=>"".$month."",
		"year"=>"".$year."",
		"age"=>"".$age."",
		"sex"=>"".$sexx."",
		"address"=>"".$address."",
		"amper"=>"".$amper."",
		"province"=>"".$province."",
		"zipcode"=>"".$zipcode."",
		"phone"=>"".$phone."",
		"education"=>"".$education."",
		"work"=>"".$work."",
		"office"=>"".$office."",
		"user"=>"".$user_name."",
		"password"=>"".md5($pwd_name1)."",
		"email"=>"".$email."",
		"signup"=>"".$signup."",
		"member_pic"=>"".$Filenames."",
		"dtnow"=>"",
		"blog"=>"1",
		"lastlog"=>"",
		"signature"=>"".$signature.""
	));


//$results = mysql_query("insert into ".TB_MEMBER." (member_id,name,nic_name,date,month,year,age,sex,address,amper,province,zipcode,phone,education,work,office,user,password,email,signup,member_pic,dtnow,blog,lastlog,signature) values('$member_id','$first_name $last_name','$nic_name','$day','$month','$year','$age','$sexx','$address','$amper','$province','$zipcode','$phone','$education','$work','$office','$user_name','$pwd_name1','$email','$signup','$Filenames','','1','','$signature')")  or die("ไม่สามารถบันทึกข้อมูลได้ โปรดตรวจสอบความผิดพลาด หรือติดต่อ webmaster: ".WEB_EMAIL."");


if($results) {

$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	mysql_query("UPDATE ".TB_MEMBER." SET lastlog=dtnow WHERE user='$user_name'");
	mysql_query("UPDATE ".TB_MEMBER." SET dtnow='$now' WHERE user='$user_name'");


ob_start();
//session_start();
$_SESSION['login_true']=$user_name;
$_SESSION['pwd_login']=md5($pwd_name1);
$_SESSION['ua'] = $_SESSION['login_true'].":".$_SERVER['HTTP_USER_AGENT'].":".$IPADDRESS.":".session_id().":".$_SERVER['HTTP_ACCEPT_LANGUAGE'];
session_write_close();
ob_end_flush();

			$timeoutseconds=10*60;
			$_SESSION['timestamp2']=time();
			$timeout=$_SESSION['timestamp2'] + $timeoutseconds;

///////////////////////		 เพิ่ม  สมาชิกออนไลน์   ////////////////////////////
			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$res['user2'] = $db->select_query("SELECT * FROM ".TB_useronline." WHERE useronline='".$_SESSION['login_true']."' ");
			$rows['user2'] = $db->rows($res['user2']); 
			$db->closedb ();
			
			if($rows['user2']){

				$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
				$db->update_db(TB_useronline,array(
					"post_date"=>"".$_SESSION['timestamp2']."",
					"timeout"=>"".$timeout."",
					"ip"=>"".$IPADDRESS.""
				)," useronline='".$_SESSION['login_true']."' ");
				$db->closedb ();
			
			}else{
				$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);	
				$db->add_db(TB_useronline,array(
					"post_date"=>"".$_SESSION['timestamp2']."",
					"useronline"=>"".$_SESSION['login_true']."",
					"timeout"=>"".$timeout."",
					"ip"=>"".$IPADDRESS.""
			));
			
			}

function SendNewsUser($email,$name,$member_id,$user_name,$pwd_name1) {

$home="".WEB_URL."" ;
$subject_mail = _MAILNEW_TOPIC ; // หัวข้ออีเมล์ 
//----------------------------------------------------------------------- เนื้อหาของอีเมล์ //
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
// $mail->Send(); 

if( $mail->send("".$email."")){
	    echo ""._MEMBER_MOD_ADDMEMBER_SUCCESS."";
} else {
		echo "Mailer Error: " . $mail->ErrorInfo;
}
}

SendNewsUser($email,$name,$member_id,$user_name,$pwd_name1) ;  


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
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
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

//echo "<center><font size=\"3\" face='MS Sans Serif'><b>"._MEMBER_MOD_ADDMEMBER_SUCCESS."</b></font></center>" ;
//sendmailnewx($member_id ,$name, $user_name , $pwd_name1 , $email ,$home) ;  // ส่งเมล์หาลูกค้า เรียกฟังค์ชั่นให้ทำงาน

echo "<meta http-equiv='refresh' content='5; url=?name=member&file=member_detail'>" ;

}
}
 }

?>
        </TD>
      </TR>
      <TR>
        <TD>&nbsp;</TD>
      </TR>
    </TABLE></TD>
  </TR>
</TABLE>

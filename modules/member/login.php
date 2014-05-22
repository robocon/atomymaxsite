				<script language='JavaScript'>
					function check_Form_login() {
						if(document.checkForm2.user_login.value=='') {
						alert('<? echo _SHOP_MOD_JAVA_CHECK_NAME;?>') ;
						document.checkForm2.user_login.focus() ;
						return false ;
						} else if(document.checkForm2.pwd_login.value=='') {
							alert('<? echo _JAVA_FORM_CONF_NEWPASS;?>') ;
							document.checkForm2.pwd_login.focus() ;
							return false ;
						} else {
						return true ;
						}
						}
                      </script>
<?
empty($_SESSION['login_true'])?$login_true="":$login_true=$_SESSION['login_true'];
empty($_SESSION['pwd_login'])?$pwd_login="":$pwd_login=$_SESSION['pwd_login'];
if ($login_true==''){?>
			<table width="740" border="0" cellpadding="0" cellspacing="0">
			<tr><td>
			<img src="images/menu/graduatelogin.gif" width="150" height="30" />
			<FORM ACTION='?name=member&file=login_check'  name='checkForm2' id='checkForm2' method='post' onsubmit='return check_Form_login()' ENCTYPE="multipart/form-data">
				<TABLE width="245">
				<TR>
				<TD width='100' align='right' valign='top'>Username : </TD>
				<TD width='145'><INPUT name='user_login' type='text' id='user_login' size='15' value="<?=$login_true;?>"></TD>
				</TR>
				<TR>
				<TD width='100' align='right'  valign='top'>Password : </TD>
				<TD><input name='pwd_login' type='password' id='pwd_login' size='15' value="<?=$pwd_login;?>"></TD>
				</TR>
				<?
				if(USE_CAPCHA){
				?>
                 <tr>
                 <td width='100' align='right' ><?if(CAPCHA_TYPE == 1){
							echo "<img src=\"capcha/CaptchaSecurityImages.php?path=".WEB_PATH."&width=".CAPCHA_WIDTH."&height=".CAPCHA_HEIGHT."&characters=".CAPCHA_NUM."\" width=\"".CAPCHA_WIDTH."\" height=\"".CAPCHA_HEIGHT."\" align=\"absmiddle\" />";
						}else if(CAPCHA_TYPE == 2){ 
							echo "<img src=\"capcha/val_img.php?width=".CAPCHA_WIDTH."&height=".CAPCHA_HEIGHT."&characters=".CAPCHA_NUM."\" width=\"".CAPCHA_WIDTH."\" height=\"".CAPCHA_HEIGHT."\" align=\"absmiddle\" />";
						};?>
                    </td>
                    <td><input name="security_code" type="text" id="security_code" maxlength="6" size='15'/></td>
                    </tr>
                    <? } ?>
					<TR align='right' valign='top'>
					<TD colspan='2' align='center' valign='middle'><input name='submit' type='submit' value='<?=_WEBBOARD_READ_MEMBER_LASTLOG;?>'></TD>
					</TR>
					</TABLE>
				</FORM>
				</td>
				</tr>
				</table><br>

<?} else {
			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$res['user'] = $db->select_query("SELECT * FROM ".TB_MEMBER." WHERE user='".$login_true."' ");
			$rows['user'] = $db->rows($res['user']);
			$db->closedb ();
			if($rows['user']){
echo "<meta http-equiv=refresh content='3;URL=?name=member&file=login_check'>" ;
			} else {
?>
<TABLE WIDTH="660"  border="0" ALIGN="center" CELLPADDING="0" CELLSPACING="0" bgcolor="#FFFFFF">
  <TR>
            <TD width="10" vAlign=top</TD>
          <TD width="660" vAlign=top colspan="2">

      &nbsp;&nbsp;<IMG SRC="images/menu/textmenu_member.gif" BORDER="0">
				<TABLE width="740" align=center cellSpacing=0 cellPadding=0 border=0>
				<TR>
					<TD height="1" class="dotline" ></TD>
				</TR>
      <TR><td>
                <TABLE width="740" BORDER="0" ALIGN="center" CELLPADDING="2" CELLSPACING="3" >
              <TR>
                <TD BGCOLOR="#FFFFFF" align="center"><FONT SIZE="4" color="#0066FF"><< <?=_SHOP_MOD_LOGIN_TEENEE;?><a href="?name=member&file=index"> register </a> >></FONT></STRONG></FONT> </FONT></TD>
              </TR>
				</table><br>
</td>
</tr>
</table>
</td>
</tr>
</table>
<?
		  }
}
?>
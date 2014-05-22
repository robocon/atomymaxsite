	<table width="820"  border="0" cellspacing="0" cellpadding="0">
      <tr>
          <TD width="10" vAlign=top><IMG src="images/fader.gif" border=0></TD>
          <TD width="810" vAlign=top ><IMG src="images/topfader.gif" border=0><BR>
		  <!-- Admin -->
		  &nbsp;&nbsp;<img src="images/menu/textmenu_admin.gif" BORDER="0"><BR>
				<TABLE width="820" align=center cellSpacing=0 cellPadding=0 border=0>
				<TR>
					<TD height="1" class="dotline"></TD>
				</TR>
          <TR>
            <TD> <B>&nbsp;&nbsp;<IMG SRC="images/icon/plus.gif" BORDER="0" ALIGN="absmiddle"> <A HREF="?name=admin&file=main"><?=_ADMIN_GOBACK;?></A> &nbsp;&nbsp;<IMG SRC="images/icon/arrow_wap.gif" BORDER="0" ALIGN="absmiddle">&nbsp;&nbsp; <a href="?name=admin&file=member"><?=_ADMIN_MEMBER_MENU_TITLE;?></a> &nbsp;&nbsp;<IMG SRC="images/icon/arrow_wap.gif" BORDER="0" ALIGN="absmiddle">&nbsp;&nbsp; <a href="?name=admin&file=member_mail"><?=_ADMIN_MEMBER_MENU_MAILTO_MEM;?></a>&nbsp;&nbsp; <IMG SRC="images/icon/arrow_wap.gif" BORDER="0" ALIGN="absmiddle">&nbsp;&nbsp;<a href="?name=admin&file=member_log"><?=_ADMIN_LOG_MENU_LINK;?></a></B> <BR>
                <BR>
				<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0" >
                  <tr ><td>
<?
if($op == ""){

	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	$limit = 20 ;
	$SUMPAGE= $db->num_rows(TB_MEMBERLOG,"id","");

	if (empty($page)){
		$page=1;
	}
	$rt = $SUMPAGE%$limit ;
	$totalpage = ($rt!=0) ? floor($SUMPAGE/$limit)+1 : floor($SUMPAGE/$limit); 
	$goto = ($page-1)*$limit ;
?>
 <form action="?name=admin&file=member_log&op=log_del&action=multidel" name="myform" method="post">
 <table width="100%" cellspacing="0" cellpadding="0" class="grids">
  <tr  class="odd">
   <td width="44"><CENTER><B>Option</B></CENTER></td>
   <td ><CENTER><B>ip</B></CENTER></td>
   <td width="50"><CENTER><B>UserName</B></CENTER></td>
   <td width="50"><CENTER><B>Email</B></CENTER></td>
   <td ><CENTER><B>Country</B></CENTER></td>
   <td ><CENTER><B>City</B></CENTER></td>
   <td width="50"><CENTER><B>date</B></td>
   <td width="40"><CENTER><B>Check</B></CENTER></td>
  </tr>  
<?
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);

$res['log'] = $db->select_query("SELECT * FROM ".TB_MEMBERLOG." ORDER BY id  DESC LIMIT $goto, $limit ");
$rows['log'] = $db->rows($res['log']);

$count=0;
while ($arr['log'] = mysql_fetch_array($res['log'])){
if($count%2==0) { //ส่วนของการ สลับสี 
$ColorFill = ' onmouseover="this.style.backgroundColor=\'#FFF0DF\'" onmouseout="this.style.backgroundColor=\'#ffffff\'"  ';
} else {
$ColorFill = 'class="odd"';
}

?>
    <tr <?php echo $ColorFill; ?> >
     <td width="44">
      <a href="?name=admin&file=ipblock&op=ipblock_add&action=add&IP=<? echo $arr['log']['visitor_ip'];?>"><img src="images/noip015mini.png" border="0" alt="<?=_ADMIN_BUTTON_EDIT;?>" ></a> 
      <a href="javascript:Confirm('?name=admin&file=member_log&op=log_del&page=<? echo $page;?>&id=<? echo $arr['log']['id'];?>&prefix=<? echo $arr['log']['post_date'];?>','<?=_ADMIN_BUTTON_DEL_MESSAGE;?>');"><img src="images/admin/trash.gif"  border="0" alt="<?=_ADMIN_BUTTON_DEL;?>" ></a>
     </td> 
     <td align="center" width="50"><a href="?name=admin&file=member_log&op=log_map&id=<? echo $arr['log']['id'];?>"><? echo $arr['log']['visitor_ip'];?></a></td>
	 <td align="center" width="50"><? echo $arr['log']['user'];?></td>
	 <td align="center" width="50"><? echo $arr['log']['email'];?></td>
	 <td align="center" width="50"><? echo $arr['log']['location'];?></td>
	 <td align="center" width="80"><? echo $arr['log']['city'];?></td>
	<td align="center"  width="120"><? echo DateThaiNew($arr['log']['visitor_date']);?></td>
     <td valign="top" align="center" width="40"><input type="checkbox" name="list[]" value="<? echo $arr['log']['id'];?>"></td>
    </tr>

<?
		 $count++;
 } 
?>
 </table>
 <div align="right">
 <input type="button" name="CheckAll" value="Check All" onclick="checkAll(document.myform)" >
 <input type="button" name="UnCheckAll" value="Uncheck All" onclick="uncheckAll(document.myform)" >
 <input type="hidden" name="ACTION" value="log_del">
 <input type="submit" value="Delete" onclick="return delConfirm(document.myform)">
 </div>
 </form><BR><BR>
<?
		SplitPage($page,$totalpage,"?name=admin&file=member_log");
	echo $ShowSumPages ;
	echo "<BR>";
	echo $ShowPages ;
}

else if($op == "log_del" AND $action == "multidel"){
	//////////////////////////////////////////// กรณีลบ Multi

		while(list($key, $value) = each ($_POST['list'])){
			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$res['visitor'] = $db->select_query("SELECT * FROM ".TB_MEMBERLOG." WHERE id='".$value."' ");
			$arr['visitor'] = $db->fetch($res['visitor']);
			$db->del(TB_MEMBERLOG," id='".$value."' "); 
			$db->closedb ();

		}
		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_LOG_MESSAGE_DEL."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=member_log\"><B>"._ADMIN_LOG_MESSAGE_GOBACK."</B></A>";
		$ProcessOutput .= "<meta http-equiv='refresh' content='1; url=?name=admin&file=member_log&page=".$_GET['page']."'>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";

	echo $ProcessOutput ;
}
else if($op == "log_del"){
	//////////////////////////////////////////// กรณีลบ Form

			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$res['visitor'] = $db->select_query("SELECT * FROM ".TB_MEMBERLOG." WHERE id='".$_GET['id']."' ");
			$arr['visitor'] = $db->fetch($res['visitor']);

		$db->del(TB_MEMBERLOG," id='".$_GET['id']."' "); 
		$db->closedb ();

//	@unlink("visitoricon/".$_GET['prefix'].".jpg");
		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_LOG_MESSAGE_DEL."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=member_log\"><B>"._ADMIN_LOG_MESSAGE_GOBACK."</B></A>";
		$ProcessOutput .= "<meta http-equiv='refresh' content='1; url=?name=admin&file=member_log&page=".$_GET['page']."'>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";

	echo $ProcessOutput ;
}
else if($op == "log_map" ){

$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$query = $db->select_query("SELECT * FROM ".TB_MEMBERLOG." where id='".$_GET['id']."' ");
$row = $db->fetch($query);
$lat = $row['latitude'];
$long = $row['longitude'];
$city = $row['city'];
//echo $lat;
?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"   
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">  
    <html xmlns="http://www.w3.org/1999/xhtml">  
    <head>  
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />  
    <title></title>  
    <style type="text/css">  
    html{  
        padding:0px;  
        margin:0px;  
    }  
    div#map_canvas{  
        margin:auto;  
        width:650px;  
        height:450px;  
        overflow:hidden;  
    }  
    </style>  
      
    </head>  
      
    <body>  
      
    <div id="map_canvas">  
    </div>   
      
    <script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=AIzaSyDzvsvll8cAoAtjVAVcrfczCLyW3r7BRlo" type="text/javascript"></script>  
    <script type="text/javascript">   
    function initialize() {   
      if (GBrowserIsCompatible()) {   
        var map = new GMap2(document.getElementById("map_canvas"));   
        var center = new GLatLng('<?php echo $lat;?>','<?php echo $long;?>'); // การกำหนดจุดเริ่มต้น  
        map.setCenter(center, 10);  // เลข 13 คือค่า zoom  สามารถปรับตามต้องการ   
        map.setUIToDefault();   
          
        var marker = new GMarker(center, {draggable: true});    
        map.addOverlay(marker);  
           
        GEvent.addListener(marker, "dragend", function() {  
            var point = marker.getPoint();  
            map.panTo(point);  
      
            $("#lat").val(point.lat());  
            $("#long").val(point.lng());  
            $("#zoom_value").val(map.getZoom());  
      
        });    
           
      }   
    }   
    </script>   
    <script type="text/javascript" src="js/jquery-1.3.1.min.js"></script>  
    <script type="text/javascript">  
    $(function(){  
        initialize();  
        $(document.body).unload(function(){  
                GUnload();  
        });  
    });  
    </script>  
    </body>  
    </html>  
<?
}
	?>


</td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</table>

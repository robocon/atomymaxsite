<?php

###### Function Check ���ɳ� #######
// function check ��ͤ�������ɳ������ͻ����
function checkban($message) {
$ban = array(
	""._BAN_ARR_1."",
	"�-�-���-�-��-�",
	"���������蹴մ����Ըէ����",
	"�-�-���-�-��-�-�-��-�",
	"��ҡ����¹���Ե���բ��",
	"�ҹ����� ��������ŷ���ҹ��ҹ ��",
	"��蹴� ����� ��� � 4 �ѻ����",
	"PART TIME WORK�URGENT !!",
	"�ӧҹ�ҡ����ҹ",
	"�ҹ Part time",
	"Part Time / Full Time",
	"�ç��÷�դٳ�����",
	"���������� ��áԨ Part Time 5,000 �ҷ ��� �ѻ����",
	"�ҹ Part-Time �������� Internet",
	"��ǹ! ʹ㨵�ͧ�������������� Full Time - Part Time",
	"�������ҡ�����ҹ�ɳ��������� ��Ѥÿ�� �����������٧�����������",
	"�������� ��蹡�ЪѺ",
	"�������ҡ�����ҹ e-mail �ҹ�����Ѥÿ��",
	"www.propaidemail.com �����䫵��Ѻ��ҧ�ɳҧҹ�ҧ",
	"���ԭ��ҹ�١�͹��Ѻ�֧�ѧ�����ء��ҹ�礧������ء�ѹ��������",
	"�ٻ��ҧ������",
	"���������",
	"��Ҥ��ͺ��ҧ�س�ѡ��� ���ǹ� �س������֡���ҧ",
	"Herbalife ��Ե�ѳ�������آ�Ҿ��С��Ŵ���˹ѡ",
	"�����ҡ�����ҹ email",
	"��áԨ�ҡ����ҹ",
	"�����ҡ�����ҹ������",
	"�����������͡����",
	"������ԧ���Ҥ��� http://",
	"��������",
	"��áԨ�͡����",
	"�֧�������ѧ���س���ѹ�������آ�Ҿ����ٻ��ҧ�ͧ��Ǥس�ͧ",
	"��ǹ !!! ��������� Part-time �ӷ���ҹ����Internet �ӧҹ",
	"�ҹ par time �ӧҹ�ҡ����ҹ",
	"�ҡ��ѹ...��...�����",
	"����Ѻ������ͧ���Ըա��Ŵ���˹ѡ���ҧ��ʹ���",
	"�����������Ѻ����ǹ�ա",
	"�Ѻ��Сѹ�׹�Թ� 30 �ѹ",
	"1 ���� ��ҡѺ 7 ����..�ѹ���·��س�Ҩ�ѧ����Һ",
	"������������Ǫҭ��ҹ����ҡ�������йӵ�ʹ����",
	"��áԨ��ǹ��ǤǺ���Ѻ�ҹ��Ш�",
	"www.siamwellnessplus.com/rich",
	"1-2 �����������ѹ �������� Internet",
	"�Ѻ��Ѥü�����ͧ������������",
	"�Ѻ��������������ɿ�� click",
	"��������� �Ѻ����������ѹ�йԴ",
	"��������ҧ ������ҡ��",
	"�����������͡�����",
	"http://www.fast2slim.com/nice",
	"Ŵ���˹ѡ3-10 ���š���",
	"�Ѻ�ͧ������ 1 ��͹",
	"��Ե�ѳ��ҡ�����ҵ�",
	"Ŵ������ǹ",	
	"����ͧʹ�����",
	"��Ǿ�ó�ٴբ��",
	"www.fast2slim.com/fast",
	"http://www.ProPaideMail.com/pages/index.php?refid=jack99",
	"�����ͧ�͡�è��¤�ҵͺ᷹",
	"��áԨ������������ѧ��ԡ�ҹ",
	"0 ����ѻ����",
	"www.propaidemail.com",
	"���������",
	"��ҹ����������Թ",
	"�����������ҧ������",
	"���������",
	"��Ҥس��ͧ��Ш���������֡���",
	"�����������Ѻ������¹���",
	"http://www.how2rich.com",
	"�ա�Ѻ�ʹ�����������������",
	"�-�-��-�-�-�-��-�-�","�-�-�-�-��-�-�-�-�-�-��-�-�",
	"http://website.ntserver.at",
	"�ʹ���ͧ�Ѻ���ᾷ���й�",
	"������Ҿ�ҧ����",
	"����з��ҹ��Ш�",
	"www.how2rich.com/pim",
	"���Թ�ҡ��������",
	"http://www.cashfiesta.com",
	"�Ѻ�͡Ẻ������觾�����ɳ�",
	"herbalife",
	"��觫����Թ�����",
	"������ҧ���ҧ����������",
	"thaiwellness.cjb.net",
	"�����ա�͹����",
	"�س���������",
	"http://www.hotmail4u.anglican.at",
	"http://www.thaiadpoint.com/tap6/html/register.php?ref_id= 107751",
	"�������ѧ��",
	"��� net ��ѧ��",
	"cd2004.kickme.to",
	"http://www.clicknmoney.com",
	"��áԨ�������ѧ��ԡ�ҹ",
	"http://www.earnmoney2day.com/th/luck",
	"http://www.pantipmarket.com/fashion/topic/F1725640.html",
	"cd2004.kickme.to",
	"Work@Home",
	"www.slim2you.com",
	"www.newdiet4u.com",
	"www.newbiz4you.com",
	"���Թ�����Ѻ��ä���ẹ���� �����ҹ������",
	"www.allyousubmitters.com",
	"www.fantasticashmails.com",
	"www.amazingcashmails.com",
	"��������������",
	"www.siamwellnessplus.com",
	"�����������������ҧ ���ú�ǹ���ҧҹ",
	"��������ҧ��Ҵ",
	"����¹��������֡���ͧҹ",
	"�����Ŵ���˹ѡ�����˵�",
	"�ӧҹ��ҹ internet",
	"�������������",
	"�Դ�������� ��ѧ��",
	"�����آ�Ҿ����ٻ��ҧ",
	"�ӧҹ��͹���ǡ������Ǥ�Ѻ",
	"����������մ���",
	"���ҷ���ᵡ��ҧ..���ҷ���������",
	"PART-TIME ��ѧ��ԡ�ҹ",
	"email.deep.at",
	"��ҡ�ö١������Դ�Ѻ��зӧҹ",
	"panel.amiga500.at",
	"www.cashfiesta.com",
	"��·ҧ�Ѵ",
	"good.battle.at",
	"earnmoney2day",
	"good.battle.at",
	"myicon.ismyidol.com",
	"bizness.american.at",
	"dreamcome2.com02.com",
	"hbb4u.com",
	"viagra",
	"businessinter.com",
	"chasecreditcarda.info",
	"chasecreditcardb.info",
	"chasecredit"
) ;

	/// �ҡ��Ҿ���ͤ����ɳ�
	for($i=0;$i<count($ban);$i++) {
		if(preg_match('/'.$ban[$i].'/i', $message)) {
		// �ҡ����繡�����ɳ����ǡ�˹�����������ö������ ban
		$how = "ban" ;
		}
	}
	if($how == "ban") { // ����ɳ������Դ����
		echo "<script language='javascript'>" ;
		echo "alert('!!!! �����Դ��繢ͧ��ҹ��Ң��¡���ɳҪǹ���� ��س������ɳҤ�Ѻ �ͺ�س��Ѻ !!!!')" ;
		echo "</script>" ;
		echo "<script language='javascript'>javascript:history.go(-1)</script>";
		exit() ;
	}
}


###### Function Ban ����Һ #######

   function banword($passage)
{
     $word = array("�֧",
		"�� �",
		"���",
		"� � �",
		"�.�.�",
		"�����",
		"�ҵ����",
		"�Ҵ���",
		"� � � � � �",
		"�.�.�.�.�.�",
		"� � �� � � �",
		"�.�.��.�.�.�",
		"�Ѵ���",
		"���",
		"��",
		"���",
		"����",
		"���");
     $ban = '***';
     $c = sizeof($word);
     for ($i=0 ; $i<$c; $i++) {
     $passage = str_replace($word[$i],$ban,$passage);
} 
     return($passage);
}


// ( 9  )�ѧ���蹵Ѵ����Һ�������ö�����ӷ���ͧ��õѴ��
	function CheckRude($temp){
		$wordrude = array("ashole","a s h o l e","a.s.h.o.l.e","bitch","b i t c h","b.i.t.c.h","shit","s h i t","s.h.i.t","fuck","dick","f u c k","d i c k","f.u.c.k","d.i.c.k","�֧","�� �","� � �","� ֧","���","��.�","��_�","��-�","��+�","��","���","� � �","�.�.�","�� �� ��","��-��-��","���","�����","��������","�����","�ҵ����","�Ҵ���","� � � � � �","�.�.�.�.�.�","� � �� � � �","�.�.��.�.�.�","�Ѵ���","�Ѵ","���","��","�ѹ�ҹ","���","����","�鹵չ","ᵴ") ;
		$wordchange = ("<font color=red>xxx</font>") ;

		for ( $i=0 ; $i<sizeof($wordrude) ; $i++ ){
			$temp = preg_replace ('/'.$wordrude[$i].'/i' ,$wordchange ,$temp);
		}
		return ( $temp ) ;
	}
?>
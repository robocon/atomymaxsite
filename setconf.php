<?php

$db = New DB();

$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['configs'] = $db->select_query("SELECT * FROM ".TB_CONFIG."  ORDER BY id ");
$sd=1;

while($arr['configs'] = $db->fetch($res['configs'])){

	if ($arr['configs']['posit']=='title'){
		$title=$arr['configs']['name'];
	}
	if ($arr['configs']['posit']=='url'){
		$url=$arr['configs']['name'];
	}
	if ($arr['configs']['posit']=='path'){
		$path=$arr['configs']['name'];
	}
	if ($arr['configs']['posit']=='footer1'){
		$footer1=$arr['configs']['name'];
	}
	if ($arr['configs']['posit']=='footer2'){
		$footer2=$arr['configs']['name'];
	}
	if ($arr['configs']['posit']=='email'){
		$email=$arr['configs']['name'];
	}
	if ($arr['configs']['posit']=='templates'){
		$templates=$arr['configs']['name'];
	}
	if ($arr['configs']['posit']=='iso'){
		$iso=$arr['configs']['name'];
	}
	$sd++;

}

define("WEB_TITILE", $title);
define("WEB_URL", $url);
define("WEB_PATH", $path);
define("WEB_FOOTER1", $footer1);
define("WEB_FOOTER2", $footer2);
define("WEB_EMAIL", $email);
define("WEB_TEMPLATES", $templates);

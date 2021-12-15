
<?php
	include("API-GetAPIkey.php");

	//APIキー認証
	if (array_key_exists('key',$_POST)==TRUE) {
		if ($_POST['key']==PortalAPI_Getkey("API-SendNewRecord")) {
			$authflag=TRUE;
		} else {
			$authflag=FALSE;
			echo"ERROR_AUTH_APIKEY";
			echo $_POST['key'];
			exit;
		}
	} else {
		$authflag=FALSE;
		echo"ERROR_AUTH_APIKEY";
		exit;
	}

	//パラメータ確認
	if (array_key_exists('id',$_POST)==FALSE) {
		echo"ERROR_UNKNOWN_PRM_ID";
		exit;
	}
	if (array_key_exists('name',$_POST)==FALSE) {
		echo"ERROR_UNKNOWN_PRM_NAME";
		exit;
	}
	if (array_key_exists('score',$_POST)==FALSE) {
		echo"ERROR_UNKNOWN_PRM_SCORE";
		exit;
	}
	if (array_key_exists('j_ex',$_POST)==FALSE) {
		echo"ERROR_UNKNOWN_PRM_JEX";
		exit;
	}
	if (array_key_exists('j_gr',$_POST)==FALSE) {
		echo"ERROR_UNKNOWN_PRM_JGR";
		exit;
	}
	if (array_key_exists('j_go',$_POST)==FALSE) {
		echo"ERROR_UNKNOWN_PRM_JGO";
		exit;
	}
	if (array_key_exists('j_ba',$_POST)==FALSE) {
		echo"ERROR_UNKNOWN_PRM_JBA";
		exit;
	}
	if (array_key_exists('j_mi',$_POST)==FALSE) {
		echo"ERROR_UNKNOWN_PRM_JMI";
		exit;
	}
	if (array_key_exists('j_ea',$_POST)==FALSE) {
		echo"ERROR_UNKNOWN_PRM_JEA";
		exit;
	}
	if (array_key_exists('j_la',$_POST)==FALSE) {
		echo"ERROR_UNKNOWN_PRM_JLA";
		exit;
	}
	if (array_key_exists('maxcombo',$_POST)==FALSE) {
		echo"ERROR_UNKNOWN_PRM_MAXCOMBO";
		exit;
	}
	if (array_key_exists('type',$_POST)==FALSE) {
		echo"ERROR_UNKNOWN_PRM_TYPE";
		exit;
	}
	if (array_key_exists('g64',$_POST)==FALSE) {
		echo"ERROR_UNKNOWN_PRM_G64";
		exit;
	}
	if (array_key_exists('s64',$_POST)==FALSE) {
		echo"ERROR_UNKNOWN_PRM_S64";
		exit;
	}
	if (array_key_exists('ability',$_POST)==FALSE) {
		echo"ERROR_UNKNOWN_PRM_ABILITY";
		exit;
	}

	date_default_timezone_set('Asia/Tokyo');
	$tmpstr[0]="[".$_POST['id']."]";
	$tmpstr[1]="ID=".$_POST['id'];
	$tmpstr[2]="Name=".$_POST['name'];
	$tmpstr[3]="Score=".$_POST['score'];
	$tmpstr[4]="NumExcellent=".$_POST['j_ex'];
	$tmpstr[5]="NumGreat=".$_POST['j_gr'];
	$tmpstr[6]="NumGood=".$_POST['j_go'];
	$tmpstr[7]="NumBad=".$_POST['j_ba'];
	$tmpstr[8]="NumMiss=".$_POST['j_mi'];
	$tmpstr[9]="NumEarly=".$_POST['j_ea'];
	$tmpstr[10]="NumLate=".$_POST['j_la'];
	$tmpstr[11]="MaxCombo=".$_POST['maxcombo'];
	$tmpstr[12]="Gauge_64=".$_POST['g64'];
	$tmpstr[13]="Score_64=".$_POST['s64'];
	$tmpstr[14]="Type=".$_POST['type'];
	$tmpstr[15]="Ability=".$_POST['ability'];
	$tmpstr[16]="Date=".date('Y.m.d.H.i.s');

	$i=0;
	$buf="";
	while ($i<count($tmpstr)) {
		$buf=$buf.$tmpstr[$i]."</br>";
		$i++;
	}
	echo $buf;
	$buf=str_replace("</br>","\n",$buf);
	file_put_contents("record/ca_".$_POST['id']."_".$_POST['name'].".dat",$buf);
?>
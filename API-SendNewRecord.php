
<?php
	include("API-GetAPIkey.php");

	//APIキー認証
	if (array_key_exists('key',$_GET)==TRUE) {
		if ($_GET['key']==PortalAPI_Getkey("API-SendNewRecord")) {
			$authflag=TRUE;
		} else {
			$authflag=FALSE;
			echo"ERROR_AUTH_APIKEY";
			exit;
		}
	} else {
		$authflag=FALSE;
		echo"ERROR_AUTH_APIKEY";
		exit;
	}

	//パラメータ確認
	if (array_key_exists('id',$_GET)==FALSE) {
		echo"ERROR_UNKNOWN_PRM";
		exit;
	}
	if (array_key_exists('name',$_GET)==FALSE) {
		echo"ERROR_UNKNOWN_PRM";
		exit;
	}
	if (array_key_exists('score',$_GET)==FALSE) {
		echo"ERROR_UNKNOWN_PRM";
		exit;
	}
	if (array_key_exists('j_ex',$_GET)==FALSE) {
		echo"ERROR_UNKNOWN_PRM";
		exit;
	}
	if (array_key_exists('j_gr',$_GET)==FALSE) {
		echo"ERROR_UNKNOWN_PRM";
		exit;
	}
	if (array_key_exists('j_ni',$_GET)==FALSE) {
		echo"ERROR_UNKNOWN_PRM";
		exit;
	}
	if (array_key_exists('j_ba',$_GET)==FALSE) {
		echo"ERROR_UNKNOWN_PRM";
		exit;
	}
	if (array_key_exists('j_mi',$_GET)==FALSE) {
		echo"ERROR_UNKNOWN_PRM";
		exit;
	}
	if (array_key_exists('j_ea',$_GET)==FALSE) {
		echo"ERROR_UNKNOWN_PRM";
		exit;
	}
	if (array_key_exists('j_la',$_GET)==FALSE) {
		echo"ERROR_UNKNOWN_PRM";
		exit;
	}
	if (array_key_exists('maxcombo',$_GET)==FALSE) {
		echo"ERROR_UNKNOWN_PRM";
		exit;
	}
	if (array_key_exists('type',$_GET)==FALSE) {
		echo"ERROR_UNKNOWN_PRM";
		exit;
	}
	if (array_key_exists('graph',$_GET)==FALSE) {
		echo"ERROR_UNKNOWN_PRM";
		exit;
	}

	date_default_timezone_set('Asia/Tokyo');
	$tmpstr[0]="[".$_GET['id']."]";
	$tmpstr[1]="ID=".$_GET['id'];
	$tmpstr[2]="Name=".$_GET['name'];
	$tmpstr[3]="Score=".$_GET['score'];
	$tmpstr[4]="NumExcellent=".$_GET['j_ex'];
	$tmpstr[5]="NumGreat=".$_GET['j_gr'];
	$tmpstr[6]="NumNice=".$_GET['j_ni'];
	$tmpstr[7]="NumBad=".$_GET['j_ba'];
	$tmpstr[8]="NumMiss=".$_GET['j_mi'];
	$tmpstr[9]="NumEarly=".$_GET['j_ea'];
	$tmpstr[10]="NumLate=".$_GET['j_la'];
	$tmpstr[11]="MaxCombo=".$_GET['maxcombo'];
	$tmpstr[12]="Graph=".$_GET['graph'];
	$tmpstr[13]="Type=".$_GET['type'];
	$tmpstr[14]="Date=".date('Y.m.d.H.i.s');

	$i=0;
	$buf="";
	while ($i<count($tmpstr)) {
		$buf=$buf.$tmpstr[$i]."</br>";
		$i++;
	}
	echo $buf;
	$buf=str_replace("</br>","\n",$buf);
	file_put_contents("record/ca_".$_GET['id']."_".$_GET['name'].".dat",$buf);
?>
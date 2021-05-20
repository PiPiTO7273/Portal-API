
<?php
	include("API-GetAPIkey.php");

	//APIキー認証
	if (array_key_exists('key',$_GET)==TRUE) {
		if ($_GET['key']==PortalAPI_Getkey("API-GetRecord")) {
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
	if (array_key_exists('name',$_GET)==FALSE) {
		echo"ERROR_UNKNOWN_PRM";
		exit;
	}

	$expbuf="";
	$dirlist=glob("./record/*");
	$i=0;
	while ($i<count($dirlist)) {
		$dirlist[$i]=str_replace("./record/","",$dirlist[$i]);		//接頭語削除
		$dirlist[$i]=str_replace(".dat","",$dirlist[$i]);			//拡張子削除
		$tmparr=explode("_",$dirlist[$i]);
		if ($tmparr[0]=="ca") {
			if ($tmparr[2]==$_GET['name']) {
				$expbuf=file_get_contents("record/".$dirlist[$i].".dat");
				$expbuf=str_replace("\n","</br>",$expbuf);
				echo $expbuf."</br>";
			}
		}
		$i++;
	}
?>
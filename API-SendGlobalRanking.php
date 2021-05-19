
<?php
	include("API-GetAPIkey.php");

	//APIキー認証
	if (array_key_exists('key',$_GET)==TRUE) {
		if ($_GET['key']==PortalAPI_Getkey("API-SendGlobalRanking")) {
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

	$sharedfilename="profile/Shared.dat";
	if (file_exists($sharedfilename)==FALSE) {
		echo"ERROR_ACCESS_SHARED";
		exit;
	} else {
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
		$sharedfilebuf=file($sharedfilename);
		$writemode=0;	//新規書き込みモード
		$overcolumnid=0;	//上書き書き込みの行番号
		$i=0;
		while ($i<count($sharedfilebuf)) {
			$tmparr=explode(",",$sharedfilebuf[$i]);
			if ($tmparr[0]==$_GET['id']) {
				//ID一致
				if ($tmparr[1]==$_GET['name']) {
					//name一致
					$writemode=1;	//上書きモード
					$overcolumnid=$i;
					if ($_GET['score']<=$tmparr[2]) {
						$writemode=2;	//スコアが低いため書き込みをスキップする
					}
				}
			}
			$i++;
		}
		if ($writemode==0) {
			//新規書き込みモード
			$sharedfilebuf[count($sharedfilebuf)]=$_GET['id'].",".$_GET['name'].",".$_GET['score'];
		}
		if ($writemode==1) {
			//上書きモード
			$sharedfilebuf[$overcolumnid]=$_GET['id'].",".$_GET['name'].",".$_GET['score'];
		}
		if ($writemode==2) {
			//変更なし
		}

		$tmpbuf="";
		$i=0;
		while ($i<count($sharedfilebuf)) {
			$tmpbuf=$tmpbuf.$sharedfilebuf[$i]."</br>";
			$i++;
		}
		$tmpbuf=str_replace("\n","",$tmpbuf);
		echo $tmpbuf;
		if ($writemode!=2) {
			$tmpbuf=str_replace("</br>","\n",$tmpbuf);
			file_put_contents("profile/Shared.dat",$tmpbuf);
		}
	}
?>
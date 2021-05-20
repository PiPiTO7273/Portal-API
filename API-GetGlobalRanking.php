
<?php
	include("API-GetAPIkey.php");

	error_reporting(E_ALL & ~E_NOTICE);

	//APIキー認証
	if (array_key_exists('key',$_GET)==TRUE) {
		if ($_GET['key']==PortalAPI_Getkey("API-GetGlobalRanking")) {
			$authflag=TRUE;
		} else {
			$authflag=FALSE;
		}
	} else {
		$authflag=FALSE;
	}


	if ($authflag==TRUE) {

		//共有セーブデータを読み込み
		if (file_exists("profile/Shared.dat")==TRUE) {
			$sharedfilename="profile/Shared.dat";
			$sharedbuf=file($sharedfilename);

			//各要素に分割
			$exi=0;
			while ($exi<count($sharedbuf)) {
				$tmparr=explode(",",$sharedbuf[$exi]);
				$rankarr[$exi]['id']=$tmparr[0];
				$rankarr[$exi]['name']=$tmparr[1];
				$rankarr[$exi]['score']=$tmparr[2];
				$sort[$exi]=$tmparr[2];
				$secsort[$exi]=$tmparr[0];
				$exi++;
			}

			//ソート
			array_multisort($secsort,SORT_ASC,SORT_REGULAR,$sort,SORT_DESC,SORT_REGULAR,$rankarr);

			//出力
			$exi=0;
			$rankcnt['']=0;
			echo"[SAVEDATA]</br>";
			while ($exi<count($sharedbuf)) {
				$rankcnt[$rankarr[$exi]['id']]++;
				echo $rankarr[$exi]['id'].".RANK#".($rankcnt[$rankarr[$exi]['id']])."=".$rankarr[$exi]['name'].",".$rankarr[$exi]['score']."</br>";
				$exi++;
			}
		} else {
			echo"ERROR_ACCESS_SHARED";
			exit;
		}
	} else {
		echo"ERROR_AUTH_APIKEY";
	}
	exit;
?>
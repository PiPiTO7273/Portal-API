
<?php
	//APIキー認証
	if (array_key_exists('key',$_GET)==TRUE) {
		if ($_GET['key']=="VnNNVTSXPjngTYVFMWuXiX5n8FDEy534") {
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
				$exi++;
			}

			//ソート
			array_multisort($sort,SORT_DESC,$rankarr);

			//出力
			$exi=0;
			echo"[SAVEDATA]</br>";
			while ($exi<count($sharedbuf)) {
				echo $rankarr[$exi]['id'].".RANK#".$exi."=".$rankarr[$exi]['name'].",".$rankarr[$exi]['score']."</br>";
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
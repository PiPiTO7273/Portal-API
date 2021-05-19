
<?php
	include("API-GetAPIkey.php");

	//APIキー認証
	if (array_key_exists('key',$_GET)==TRUE) {
		if ($_GET['key']==PortalAPI_Getkey("API-SendProfile")) {
			$authflag=TRUE;
		} else {
			$authflag=FALSE;
		}
	} else {
		$authflag=FALSE;
	}

	if ($authflag==TRUE) {
		//パラメータ確認
		if (array_key_exists('id',$_GET)==FALSE) {
			echo"ERROR_UNKNOWN_PRM";
			exit;
		}
		if (array_key_exists('password',$_GET)==FALSE) {
			echo"ERROR_UNKNOWN_PRM";
			exit;
		}
		if (array_key_exists('decode',$_GET)==FALSE) {
			echo"ERROR_UNKNOWN_PRM";
			exit;
		}
		if (array_key_exists('object',$_GET)==FALSE) {
			echo"ERROR_UNKNOWN_PRM";
			exit;
		}
		if (array_key_exists('value',$_GET)==FALSE) {
			echo"ERROR_UNKNOWN_PRM";
			exit;
		}

		//ID確認
		if (file_exists("profile/".$_GET['id'].".dat")==FALSE) {
			echo"ERROR_UNKNOWN_ID";
			exit;
		}

		$datafilename="profile/".$_GET['id'].".dat";
		$datafilebuf=file($datafilename);

		$passauthflag=FALSE;
		$i=0;
		while ($i<count($datafilebuf)) {
			$tmparr=explode("=",$datafilebuf[$i]);
			if ($tmparr[0]=="PASSWORD") {
				$tmpenckey=$tmparr[1];
				$tmpenckey=base64_decode($tmpenckey);
				$tmpenckey=openssl_decrypt($tmpenckey,'AES-128-ECB',$_GET['decode']);
				if ($tmpenckey==$_GET['password']) {
					$passauthflag=TRUE;
				}
			}
			$i++;
		}
		if ($passauthflag==FALSE) {
			echo"ERROR_AUTH_PASSWORD";
			exit;
		} else {
			//セーブデータ変更処理
		}

	} else {
		echo"ERROR_AUTH_APIKEY";
	}
?>
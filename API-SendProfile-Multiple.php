
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

		//ID確認
		if (file_exists("profile/".$_GET['id'].".dat")==FALSE) {
			echo"ERROR_UNKNOWN_ID";
			exit;
		}

		$datafilename="profile/".$_GET['id'].".dat";
		$datafilebuf=parse_ini_file($datafilename,false);
		$writebuf=file_get_contents($datafilename);

		$passauthflag=FALSE;
		$tmpenckey=$datafilebuf['PASSWORD'];
		$tmpenckey=base64_decode($tmpenckey);
		$tmpenckey=openssl_decrypt($tmpenckey,'AES-128-ECB',$_GET['decode']);
		if ($tmpenckey==$_GET['password']) {
			$passauthflag=TRUE;
		}
		if ($passauthflag==FALSE) {
			echo"ERROR_AUTH_PASSWORD";
			exit;
		} else {
			//セーブデータ変更処理
			$i=0;
			if (array_key_exists('object_'.(string)0,$_POST)==TRUE) {
				echo"0.OK";
			}
			while (TRUE) {
				if (array_key_exists('object_'.(string)$i,$_POST)==TRUE) {
					if (array_key_exists($_POST['object_'.(string)$i],$datafilebuf)==TRUE) {
						//上書き
						$writebuf=str_replace($_POST['object_'.(string)$i]."=".$datafilebuf[$_POST['object_'.(string)$i]],$_POST['object_'.(string)$i]."=".$_POST['value_'.(string)$i],$writebuf);
					} else {
						//新規
						$writebuf=$writebuf.$_POST['object_'.(string)$i]."=".$_POST['value_'.(string)$i]."\n";
					}
				} else {
					break;
				}
				$i++;
			}
			file_put_contents($datafilename,$writebuf);
		}

	} else {
		echo"ERROR_AUTH_APIKEY";
	}
?>
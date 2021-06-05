
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
			$i=0;
			$overflag=FALSE;
			while ($i<count($datafilebuf)) {
				$tmparr=explode("=",$datafilebuf[$i]);
				if ($_GET['object']==$tmparr[0]) {
					$datafilebuf[$i]=$tmparr[0]."=".$_GET['value']."</br>";
					$overflag=TRUE;
					break;
				}
				$i++;
			}
			if ($overflag==FALSE) {
				$datafilebuf[count($datafilebuf)]=$_GET['object']."=".$_GET['value']."</br>";
			}
			//保存
			$i=0;
			$tmpbuf="";
			while ($i<count($datafilebuf)) {
				$tmpbuf=$tmpbuf.$datafilebuf[$i];
				$i++;
			}
			$tmpbuf=str_replace("</br>","\n",$tmpbuf);
			file_put_contents($datafilename,$tmpbuf);
			$tmpbuf=str_replace("\n","</br>",$tmpbuf);
			echo $tmpbuf;
		}

	} else {
		echo"ERROR_AUTH_APIKEY";
	}
?>
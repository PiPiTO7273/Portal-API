
<?php
	include("API-GetAPIkey.php");

	//APIキー認証
	if (array_key_exists('key',$_GET)==TRUE) {
		if ($_GET['key']==PortalAPI_Getkey("API-GetEncryptString")) {
			$authflag=TRUE;
		} else {
			$authflag=FALSE;
		}
	} else {
		$authflag=FALSE;
	}

	if ($authflag==TRUE) {
		if (array_key_exists('plain',$_GET)==FALSE) {
			echo"ERROR_UNKNOWN_PRM";
			exit;
		}
		if (array_key_exists('encode',$_GET)==FALSE) {
			echo"ERROR_UNKNOWN_PRM";
			exit;
		}
		$data=openssl_encrypt($_GET['plain'],'AES-128-ECB',$_GET['encode']);
		$res=base64_encode($data);
		echo $res;
	} else {
		echo"ERROR_AUTH_APIKEY";
	}
?>
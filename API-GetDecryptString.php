
<?php
	//APIキー認証
	if (array_key_exists('key',$_GET)==TRUE) {
		if ($_GET['key']=="SNn8dQS886ma2szdMwXrmuLRfMkHZU7p") {
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
		if (array_key_exists('decode',$_GET)==FALSE) {
			echo"ERROR_UNKNOWN_PRM";
			exit;
		}
          $res=base64_decode($_GET['plain']);
		$data=openssl_decrypt($res,'AES-128-ECB',$_GET['decode']);
		echo $data;
	} else {
		echo"ERROR_AUTH_APIKEY";
	}
?>
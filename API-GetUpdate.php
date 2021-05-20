
<?php
	include("API-GetAPIkey.php");

	//APIキー認証
	if (array_key_exists('key',$_GET)==TRUE) {
		if ($_GET['key']==PortalAPI_Getkey("API-GetUpdate")) {
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

	$updatefilename="core_Update.dat";
	$updatearr=file($updatefilename);
	$i=0;
	while ($i<count($updatearr)) {
		echo $updatearr[$i]."<br>";
		$i=$i+1;
	}

?>
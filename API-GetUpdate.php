
<?php
	//APIキー認証
	if (array_key_exists('key',$_GET)==TRUE) {
		if ($_GET['key']=="2Un8YB9FfFj3fUZiuFeFmcu86DPC3CmM") {
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
		echo $updatearr[$i];
		$i=$i+1;
	}

?>

<?php
	include("API-GetAPIkey.php");

	//APIキー認証
	if (array_key_exists('key',$_GET)==TRUE) {
		if ($_GET['key']==PortalAPI_Getkey("API-RegisterUser")) {
			$authflag=TRUE;
		} else {
			$authflag=FALSE;
		}
	} else {
		$authflag=FALSE;
	}

	if ($authflag==TRUE) {
		$progflag=0;
		if (array_key_exists('id',$_GET)==TRUE) {
			$progflag=1;
		}
		if (array_key_exists('pass',$_GET)==TRUE) {
			$progflag=1;
		}
		if (array_key_exists('passconf',$_GET)==TRUE) {
			$progflag=1;
		}
		if ($progflag==1) {
			if ($_GET['pass']==$_GET['passconf']) {
				if (file_exists("profile/".$_GET['id'].".dat")==FALSE) {
					$pass=openssl_encrypt($_GET['pass'],'AES-128-ECB',"bqjEPAQh1ZmiQpFbXLbtVBdR8p1z0yF6IkZHJO74UfvfCX2hhoDr8zaAEmvAKb0fls4kcIoqKMwWnUhAqI5EzDpDyvy2PyXCPeaF1N5JlH3AxUXPeHRxeE8j1BNE9mo0");
					$pass=base64_encode($pass);
					$buf="[SAVEDATA]\nUSERNAME=".$_GET['id']."\nPASSWORD=".$pass."\nREG.DATE=".date("Y/m/d")."\n";
					file_put_contents("profile/".$_GET['id'].".dat",$buf);
					exit;
				} else {
					echo"ERROR_ALREADYEXIST";
				}
			} else {
				echo"ERROR_NOTMATCH_PASSWORD";
			}
		}

	} else {
		echo"ERROR_AUTH_APIKEY";
	}
?>
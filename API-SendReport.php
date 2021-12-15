
<?php

	if (array_key_exists('id',$_POST)==FALSE) {
		echo"ERROR_UNKNOWN_PRM";
		exit;
	}
	if (array_key_exists('msg',$_POST)==FALSE) {
		echo"ERROR_UNKNOWN_PRM";
		exit;
	}

	date_default_timezone_set('Asia/Tokyo');
	$tmpstr[0]="[report]";
	$tmpstr[1]="ID=".$_POST['id'];
	$tmpstr[2]="Body=".$_POST['msg'];

	$i=0;
	$buf="";
	while ($i<count($tmpstr)) {
		$buf=$buf.$tmpstr[$i]."</br>";
		$i++;
	}
	echo $buf;
	$buf=str_replace("</br>","\n",$buf);
	file_put_contents("msg/ur_".$_POST['id']."_".date('Y.m.d.H.i.s').".dat",$buf);
?>
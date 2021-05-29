<?php
function PortalAPI_Signin($id,$pass) {
	if (file_exists("profile/".$id.".dat")==FALSE) {
		return 0;
	}
		$datafilename="profile/".$id.".dat";
		$datafilebuf=file($datafilename);

		$passauthflag=FALSE;
		$i=0;
		while ($i<count($datafilebuf)) {
			$tmparr=explode("=",$datafilebuf[$i]);
			if ($tmparr[0]=="PASSWORD") {
				$tmpenckey=$tmparr[1];
				$tmpenckey=base64_decode($tmpenckey);
				$tmpenckey=openssl_decrypt($tmpenckey,'AES-128-ECB',"bqjEPAQh1ZmiQpFbXLbtVBdR8p1z0yF6IkZHJO74UfvfCX2hhoDr8zaAEmvAKb0fls4kcIoqKMwWnUhAqI5EzDpDyvy2PyXCPeaF1N5JlH3AxUXPeHRxeE8j1BNE9mo0");
				if ($tmpenckey==$pass) {
					$passauthflag=TRUE;
				}
			}
			$i++;
		}
		if ($passauthflag==TRUE) {
			return 1;
		}
		return 0;
}
$urlstring="API-GetProfile.php";
$errormsgflag=0;
if (array_key_exists('id',$_GET)==TRUE) {
	if (PortalAPI_Signin($_GET['id'],$_GET['pass'])==0) {
		$errormsgflag=1;
	} else {
		header("Location:transfer.php?id=".$_GET['id']."&pass=".$_GET['pass']);
		exit;
	}
}


?>

<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8">
		<title>ログイン</title>

		<head>
			<style type="text/css">

@import url(https://fonts.googleapis.com/css?family=Roboto:300);

.login-page {
	width: 550px;
	padding: 5% 0 0;
	margin: auto;
}
.form {
	position: relative;
	z-index: 1;
	background: #FFFFFF;
	max-width: 360px;
	margin: 0 auto 0;
	padding: 45px;
	text-align: center;
	box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
}
.form input {
	font-family: "Roboto", sans-serif;
	outline: 0;
	background: #f2f2f2;
	width: 100%;
	border: 0;
	margin: 0 0 15px;
	padding: 15px;
	box-sizing: border-box;
	font-size: 14px;
}
.form button {
	font-family: "Roboto", sans-serif;
	text-transform: uppercase;
	outline: 0;
	background: #4CAF50;
	width: 100%;
	border: 0;
	padding: 15px;
	color: #FFFFFF;
	font-size: 14px;
	-webkit-transition: all 0.3 ease;
	transition: all 0.3 ease;
	cursor: pointer;
}
.form button:hover,.form button:active,.form button:focus {
	background: #43A047;
}
.form .message {
	margin: 15px 0 0;
	color: #b3b3b3;
	font-size: 14px;
}
.form .message a {
	color: #4CAF50;
	text-decoration: none;
}
.form .register-form {
	display: none;
}
.container {
	position: relative;
	z-index: 1;
	max-width: 300px;
	margin: 0 auto;
}
.container:before, .container:after {
	content: "";
	display: block;
	clear: both;
	}
.container .info {
	margin: 50px auto;
	text-align: center;
}
.container .info h1 {
	margin: 0 0 15px;
	padding: 0;
	font-size: 36px;
	font-weight: 300;
	color: #1a1a1a;
}
.container .info span {
	color: #4d4d4d;
	font-size: 12px;
}
.container .info span a {
	color: #000000;
	text-decoration: none;
}
.container .info span .fa {
	color: #EF3B3A;
}
body {
	background: #EEEEEE; /* fallback for old browsers */
	font-family: "Roboto", sans-serif;
	-webkit-font-smoothing: antialiased;
	-moz-osx-font-smoothing: grayscale;
}

			</style>
		</head>
	</head>

	<body>

		<div class="login-page">
			<div class="form">
				<img src="img/Logo_Online.png">
				<p class="message" style="margin-bottom: 10%;">Portalにサインインし、ゲームを開始しましょう。</p>
<?php

if ($errormsgflag==1) {
	echo"<p style=\"margin-bottom: 10%;color: #FF0000;\">";
	echo"ユーザーIDかパスワードが違います。";
	echo"</p>";
}

?>
				<form class="login-form" action="signin.php" method="get">
					<input type="text" name="id" placeholder="ユーザーID"/>
					<input type="password" name="pass" placeholder="パスワード"/>
					<button>サインイン</button>
					<p class="message">アカウントを持っていませんか？　　<a href="register.php">新規登録</a></p>
				</form>
			</div>
		</div>

	</body>
</html>
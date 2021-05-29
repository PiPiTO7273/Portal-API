<?php
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
			$buf="[SAVEDATA]\nUSERNAME=".$_GET['id']."\nPASSWORD=".$pass."\nREG.DATE=".date("Y/m/d");
			file_put_contents("profile/".$_GET['id'].".dat",$buf);
			header("Location:transfer.php?id=".$_GET['id']."&pass=".$_GET['pass']);
			exit;
		} else {
			$progflag=3;
		}
	} else {
		$progflag=2;
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
				<p class="message" style="margin-bottom: 10%;">Portal アカウントを作成します。<br>
				推測されにくいパスワードを設定してください。</p>

<?php

if ($progflag==2) {
	echo"<p style=\"margin-bottom: 10%;color: #FF0000;\">";
	echo"パスワードが一致しません。";
	echo"</p>";
}
if ($progflag==3) {
	echo"<p style=\"margin-bottom: 10%;color: #FF0000;\">";
	echo"指定されたユーザーIDは既に存在します。";
	echo"</p>";
}

?>

				<form class="login-form" action="register.php" method="get">
					<input type="text" name="id" placeholder="ユーザーID"/>
					<input type="password" name="pass" placeholder="パスワード"/>
					<input type="password" name="passconf" placeholder="パスワードの再入力"/>
					<button>アカウントを作成</button>
					<p class="message">アカウントを既に持っていますか？　　<a href="signin.php">サインイン</a></p>
				</form>
			</div>
		</div>

	</body>
</html>
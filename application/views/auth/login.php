<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black" />
<meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0, maximum-scale=1.0"/>
<link rel="apple-touch-icon" sizes="114x114" href="images/nav/index@2x.png">
<link rel="apple-touch-startup-image" href="images/splash/splash-screen.png" media="screen and (max-device-width: 320px)" />
<link rel="apple-touch-startup-image" media="(max-device-width: 480px) and (-webkit-min-device-pixel-ratio: 2)" href="images/splash/splash-screen@2x.png" />
<title>BADAX - Login</title>
<link href="styles/style.css" rel="stylesheet" type="text/css">
<link href="styles/type.css" rel="stylesheet" type="text/css">
<link href="styles/buttons.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" media="only screen and (-webkit-min-device-pixel-ratio: 2)"	type="text/css" href="styles/highdpi.css" />

<script type="text/javascript" src="scripts/jquery.js"></script>
<script type="text/javascript" src="scripts/highdpi.js"></script>
<script type="text/javascript" src="scripts/custom.js"></script>

</head>

<body>

<div class="landing-page">
	<p class="center-text landing-logo shadow">
    	BADAX Security System
    </p>

    <form action="login" method="post" accept-charset="utf-8" id="myform">
		<div class="login-box">
			<div id="infoMessage"><?php echo $message;?></div>
			<input type="text" name="identity" id="identity" class="text-input" placeholder="Email Address">
			<input type="password" name="password" id="password" class="text-input" placeholder="Password">
	        <input type="checkbox" name="remember" value="1" id="remember"> remember me
	        <span class="buttonBig"><a href="javascript:myform.submit()" class="buttonBigYellow">Login</a></span>        
	        <div class="clear"></div>
	    </div>
	   </form>
    <div class="login-box-deco1"></div>
    <div class="login-box-deco2"></div>

    <p class="login-note shadow"><a href="forgot_password">Forgot your password?</a></p>

</div>

<div style="height:30px"></div>

</body>
</html>
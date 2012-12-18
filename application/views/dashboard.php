<!DOCTYPE html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="apple-mobile-web-app-status-bar-style" content="black" />
	<meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0, maximum-scale=1.0"/>

	<title>BADAX</title>

	<link rel="apple-touch-icon" sizes="114x114" href="images/nav/settings@2x.png">
	<link rel="apple-touch-startup-image" href="images/splash/settings.png" media="screen and (max-device-width: 320px)" />
	<link rel="apple-touch-startup-image" media="(max-device-width: 480px) and (-webkit-min-device-pixel-ratio: 2)" href="images/splash/settings@2x.png" />	
	<link href="styles/style.css" rel="stylesheet" type="text/css">
	<link href="styles/type.css" rel="stylesheet" type="text/css">
	<link href="styles/buttons.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" media="only screen and (-webkit-min-device-pixel-ratio: 2)"	type="text/css" href="styles/highdpi.css" />

	<script type="text/javascript" src="scripts/jquery.js"></script>
	<script type="text/javascript" src="scripts/highdpi.js"></script>
	<script type="text/javascript" src="scripts/jquery.address-1.5.min.js"></script>
	<script type="text/javascript" src="scripts/jquery.fetcher.js"></script>
	<script type="text/javascript" src="scripts/jsrender.js"></script>
	<script type="text/javascript" src="scripts/jquery.observable.js"></script>
	<script type="text/javascript" src="scripts/jquery.views.js"></script>
	<script type="text/javascript" src="scripts/badax.js"></script>
</head>

<body>

<div class="dash-page">
	<a class="small-logo" href="nav.html"><img width="82" height="19" class="replace-2x small-logo" src="images/logo-small.png" alt="img"></a>
    <div class="dropdown-nav">
    	<p class="nav-deploy shadow">
        	<em class="nav-arrow">Navigation</em>
            <span class="nav-items">
            	<a class="shadow first-nav-item"	href="dash.html">Dash</a>
                <a class="shadow nav-item"			href="posts.html">Posts</a>
                <a class="shadow nav-item" 			href="media.html">Media</a>
                <a class="shadow nav-item" 			href="about.html">About</a>
                <a class="shadow nav-item" 			href="charts.html">Charts</a>
                <a class="shadow nav-item" 			href="settings.html">Settings</a>
                <a class="shadow nav-item" 			href="profile.html">Profile</a>
                <a class="shadow nav-item" 			href="comments.html">Comments</a>
                <a class="shadow last-nav-item"		href="index.html">Logout</a>
            </span>
        </p>
    </div>
    <div class="clear"></div>
	<div class="decoration"></div>
    <p class="breadcrumb"><a href="/">Home</a><em class="bdiv"></em> <a href="/">Home</a> <em class="bdiv"></em>Settings Page</p>
    <div class="decoration"></div>
    
    <div id="main_container"></div>

</div>

</body>
</html>
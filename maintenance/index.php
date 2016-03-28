<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title>Maintenance - Female Daily Network</title>
	<meta name="description" content="Female Daily Netwok Maintenance Mode">
	<!-- Load Google Fonts -->
	<link href='http://fonts.googleapis.com/css?family=Marck+Script' rel='stylesheet' type='text/css'><!-- font-family: 'Marck Script', cursive;-->
	<link href='http://fonts.googleapis.com/css?family=Lustria' rel='stylesheet' type='text/css'><!-- font-family: 'Lustria', serif; -->
	
	
	<style rel="stylesheet" type="text/css">
		/** CSS Reset **/
		html, body, div, span, applet, object, iframe,
		h1, h2, h3, h4, h5, h6, p, blockquote, pre,
		a, abbr, acronym, address, big, cite, code,
		del, dfn, em, img, ins, kbd, q, s, samp,
		small, strike, strong, sub, sup, tt, var,
		b, u, i, center,
		dl, dt, dd, ol, ul, li,
		fieldset, form, label, legend,
		table, caption, tbody, tfoot, thead, tr, th, td,
		article, aside, canvas, details, embed, 
		figure, figcaption, footer, header, hgroup, 
		menu, nav, output, ruby, section, summary,
		time, mark, audio, video {
			margin: 0;
			padding: 0;
			border: 0;
			font-size: 100%;
			font: inherit;
			vertical-align: baseline;
		}
		/* HTML5 display-role reset for older browsers */
		article, aside, details, figcaption, figure, 
		footer, header, hgroup, menu, nav, section {
			display: block;
		}
		body {
			line-height: 1;
		}
		ol, ul {
			list-style: none;
		}
		blockquote, q {
			quotes: none;
		}
		blockquote:before, blockquote:after,
		q:before, q:after {
			content: '';
			content: none;
		}
		table {
			border-collapse: collapse;
			border-spacing: 0;
		}
		
		/** Own Style **/
		
		html{
			height: 100%;
		}
		body{
			background: rgba(120,12,228,0.28);
			background: -moz-radial-gradient(center, ellipse cover, rgba(120,12,228,0.28) 0%, rgba(173,99,248,1) 100%);
			background: -webkit-gradient(radial, center center, 0px, center center, 100%, , color-stop(0%, rgba(120,12,228,0.28)), color-stop(100%, rgba(173,99,248,1)));
			background: -webkit-radial-gradient(center, ellipse cover, rgba(120,12,228,0.28) 0%, rgba(173,99,248,1) 100%);
			background: -o-radial-gradient(center, ellipse cover, rgba(120,12,228,0.28) 0%, rgba(173,99,248,1) 100%);
			background: -ms-radial-gradient(center, ellipse cover, rgba(120,12,228,0.28) 0%, rgba(173,99,248,1) 100%);
			background: radial-gradient(ellipse at center, rgba(120,12,228,0.28) 0%, rgba(173,99,248,1) 100%);
			filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#780ce4', endColorstr='#ad63f8', GradientType=1 );
			min-width: 100%;
			padding-bottom: 30px;
		}
		
		.content{
			 width: 800px;
			 margin: 20px auto 50px auto;
		}
		
		.content h1{
			background: url(img/logoFDN.png) no-repeat;
			width: 400px;
			height: 165px;
			text-indent: -9999px;
			margin: 0 auto;
		}
		
		.announcement{
			padding: 12px;
			font-size: 15px;
			line-height: 24px;
			font-family: 'Lustria', serif;
			
			background: rgba(237,237,237,0.04);
			background: -moz-linear-gradient(top, rgba(237,237,237,0.04) 0%, rgba(246,246,246,0.55) 53%, rgba(255,255,255,0.68) 67%, rgba(255,255,255,1) 100%);
			background: -webkit-gradient(left top, left bottom, color-stop(0%, rgba(237,237,237,0.04)), color-stop(53%, rgba(246,246,246,0.55)), color-stop(67%, rgba(255,255,255,0.68)), color-stop(100%, rgba(255,255,255,1)));
			background: -webkit-linear-gradient(top, rgba(237,237,237,0.04) 0%, rgba(246,246,246,0.55) 53%, rgba(255,255,255,0.68) 67%, rgba(255,255,255,1) 100%);
			background: -o-linear-gradient(top, rgba(237,237,237,0.04) 0%, rgba(246,246,246,0.55) 53%, rgba(255,255,255,0.68) 67%, rgba(255,255,255,1) 100%);
			background: -ms-linear-gradient(top, rgba(237,237,237,0.04) 0%, rgba(246,246,246,0.55) 53%, rgba(255,255,255,0.68) 67%, rgba(255,255,255,1) 100%);
			background: linear-gradient(to bottom, rgba(237,237,237,0.04) 0%, rgba(246,246,246,0.55) 53%, rgba(255,255,255,0.68) 67%, rgba(255,255,255,1) 100%);
			filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ededed', endColorstr='#ffffff', GradientType=0 );
			
			-webkit-box-shadow: 2px 2px 7px rgba(50, 50, 50, 0.81);
			   -moz-box-shadow:    2px 2px 7px rgba(50, 50, 50, 0.81);
                    box-shadow:         2px 2px 7px rgba(50, 50, 50, 0.81);
			
			border-left: 2px dashed #eeeeee;
			border-right: 2px dashed #eeeeee;
			border-bottom: 2px dashed #eeeeee;
			border-top: 2px dashed #B87BF4;
		}
		
		.announcement p{
			margin-bottom: 20px;
		}
		
		.announcement h2{
			font-family: 'Marck Script', cursive;
			color: #333;
			font-size: 50px;
			text-shadow: 1px 1px 2px rgba(150, 150, 150, 3);
			padding: 27px 0 0 0px;
			height: 65px;
			margin-bottom: 10px;
			text-align: center;
		}
		
		.sitelist{
			padding: 12px;
		}
		
		.sitelist ul li{
			display: inline-block;
			height: 80px;
			margin-right: 20px;
		}
		
		.sitelist ul li.fd{
			background: url(img/logoFD.png) no-repeat;
			width: 200px;
			height: 60px;
			text-indent: -9999px;
			margin-right: 30px;
		}
		
		.sitelist ul li.fasd{
			background: url(img/logoFasD.png) no-repeat;
			width: 200px;
			height: 60px;
			text-indent: -9999px;
			margin: 0 auto;
			margin-right: 30px;
		}
		
		.sitelist ul li.mom{
			background: url(img/logoMom.png) no-repeat;
			width: 200px;
			height: 60px;
			text-indent: -9999px;
			margin: 0 auto;
			margin-right: 30px;
		}
		
		.sitelist ul li.cloz{
			background: url(img/logoCloz.png) no-repeat;
			width: 200px;
			height: 60px;
			text-indent: -9999px;
			margin: 0 auto;
			margin-right: 30px;
		}
		
		.sitelist ul li.trav{
			background: url(img/logoTrav.png) no-repeat;
			width: 200px;
			height: 60px;
			text-indent: -9999px;
			margin: 0 auto;
			margin-right: 30px;
		}
		
		.social{
			text-align: center;
		}
		
		.social li{
			display: inline-block;
			margin-right: 15px;
		}

		h2.bb-bar{
			background: url(img/beauty_bar.png) no-repeat;
			width: 200px;
			height: 88px;
			margin: 50px auto;
		}
		
		pre, code{
			font-weight: bold;
			font-size: 18px;
			padding-left: 30px;
		}	
	</style>
</head>
<body>
	<div class="content">
		<h1>Female Daily Network</h1>
		<div class="announcement">
			<h2 class="bb-bar"></h2>
			<h2>Maintenance Mode</h2>
			
		
			<div class="sitelist">
				<ul>
					<li class="fd"></li>
					<li class="fasd"></li>
					<li class="mom"></li>
					<li class="cloz"></li>
					<li class="trav"></li>
					<li class="social"></li>
				</ul>
			</div>
			
			<!--<ul class="social">
				<li><a href="http://twitter.com/femaledaily"><img src="img/Twitter.png" /></a></li>
				<li><a href="http://facebook.com/femaledailynetwork"><img src="img/Facebook.png" /></a></li>
				<li><a href="http://instagram.com/fashionesedaily"><img src="img/Instagram.png" /></a></li>
				<li><a href="http://pinterest.com/fashionesedaily"><img src="img/Pinterest.png" /></a></li>
				<li><a href="http://www.youtube.com/femaledailynetwork"><img src="img/Youtube.png" /></a></li>
			</ul>-->
		</div>
	</div>
</body>
</html>
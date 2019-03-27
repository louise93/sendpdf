<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
	<meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="back">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="theme-color">
	<title>XINROX</title>

	<link rel="manifest" href="{{ asset('manifest.json')}}">
	<link rel="apple-touch-icon" href="{{ asset('Nandova/img/iphonetouch.png') }}" >
	<link rel="apple-touch-icon" sizes="152x152" href="{{ asset('Nandova/img/152x152.png') }}" >
	<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('Nandova/img/180x180.png') }}" >
	<link rel="apple-touch-icon" sizes="167x167" href="{{ asset('Nandova/img/167x167.png') }}" >
	<link rel="apple-touch-startup-image"  href="{{ asset('Nandova/img/180x180.png') }}" >

	<link href="splashscreens/iphone5_splash.png" media="(device-width: 320px) and (device-height: 568px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
	<link href="splashscreens/iphone6_splash.png" media="(device-width: 375px) and (device-height: 667px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
	<link href="splashscreens/iphoneplus_splash.png" media="(device-width: 621px) and (device-height: 1104px) and (-webkit-device-pixel-ratio: 3)" rel="apple-touch-startup-image" />
	<link href="splashscreens/iphonex_splash.png" media="(device-width: 375px) and (device-height: 812px) and (-webkit-device-pixel-ratio: 3)" rel="apple-touch-startup-image" />
	<link href="splashscreens/iphonexr_splash.png" media="(device-width: 414px) and (device-height: 896px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
	<link href="splashscreens/iphonexsmax_splash.png" media="(device-width: 414px) and (device-height: 896px) and (-webkit-device-pixel-ratio: 3)" rel="apple-touch-startup-image" />
	<link href="splashscreens/ipad_splash.png" media="(device-width: 768px) and (device-height: 1024px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
	<link href="splashscreens/ipadpro1_splash.png" media="(device-width: 834px) and (device-height: 1112px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
	<link href="splashscreens/ipadpro3_splash.png" media="(device-width: 834px) and (device-height: 1194px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
	<link href="splashscreens/ipadpro2_splash.png" media="(device-width: 1024px) and (device-height: 1366px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />

	<!-- Google font file. If you want you can change. -->
	<link href="https://fonts.googleapis.com/css?family=Nunito:300,400,600,700,900" rel="stylesheet">

	<!-- Fontawesome font file css -->
	<link rel="stylesheet" type="text/css" href="{{ asset('Nandova/css/font-awesome.min.css')}}">


	<!-- Animate css file for css3 animations. for more : https://daneden.github.io/animate.css -->
	<!-- Only use animate action. If you dont use animation, you don't have to add.-->
	<link rel="stylesheet" type="text/css" href="{{ asset('Nandova/css/animate.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('Nandova/css/cryptocoins.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('Nandova/plugins/c3-chart/c3.css')}}">

	<!-- Template global css file. Requared all pages -->


	<link rel="stylesheet" type="text/css" href="{{ asset('Nandova/css/global.style.css')}}">


	<!-- Swiper slider css file -->
	<link rel="stylesheet" href="{{ asset('Nandova/css/swiper.min.css')}}">

	<!--turbo slider plugin css file -->
	<link rel="stylesheet" type="text/css" href="{{ asset('Nandova/css/bootstrap.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('Nandova/plugins/turbo-slider/turbo.css')}}">
	<script type="text/javascript">
	'use strict';
if ('serviceWorker' in navigator) {
// Your service-worker.js *must* be located at the top-level directory relative to your site.
// It won't be able to control pages unless it's located at the same level or higher than them.
// *Don't* register service worker file in, e.g., a scripts/ sub-directory!
// See https://github.com/slightlyoff/ServiceWorker/issues/468
navigator.serviceWorker.register('/service-worker.js').then(function(reg) {
// updatefound is fired if service-worker.js changes.
  console.log('ServiceWorker registration successful with scope: ', reg.scope);
reg.onupdatefound = function() {
// The updatefound event implies that reg.installing is set; see
// https://slightlyoff.github.io/ServiceWorker/spec/service_worker/index.html#service-worker-container-updatefound-event
var installingWorker = reg.installing;
installingWorker.onstatechange = function() {
switch (installingWorker.state) {
case 'installed':
	if (navigator.serviceWorker.controller) {
		// At this point, the old content will have been purged and the fresh content will
		// have been added to the cache.
		// It's the perfect time to display a "New content is available; please refresh."
		// message in the page's interface.
		console.log('New or updated content is available.');
	} else {
		// At this point, everything has been precached.
		// It's the perfect time to display a "Content is cached for offline use." message.
		console.log('Content is now available offline!');
	}
	break;
case 'redundant':
	console.error('The installing service worker became redundant.');
	break;
}
};
};
}).catch(function(e) {
console.error('Error during service worker registration:', e);
});
}
</script>
</head>

<body>
	<!--Page loader DOM Elements. Requared all pages-->
	<div class="sweet-loader show">
		<div class="box">
				<div class="circle1"></div>
				<div class="circle2"></div>
				<div class="circle3"></div>
		</div>
	</div>
	<div class="wrapper ">
		@include('layouts.menu')
		<div class="wrapper-inline">
			<!-- Header area start -->
		    @yield('header')
			<!-- Header area end -->

			<!--NOTIFICATION BOX CONTENT START-->
	       @yield('notification')
			<!--NOTIFICATION BOX CONTENT END-->

			<!-- Page content start -->
			<main class="margin mt-0" id="app">
          @yield('content')
					<div class="form-mini-divider"></div>
			</main>
			<!-- Page content end -->
		</div>
	</div>


		<script src="{{ asset('js/app.js')}}"></script>
	<!-- JQuery library file. requared all pages -->
	<script src="{{ asset('Nandova/js/jquery-3.2.1.min.js')}}"></script>

	<!-- Swiper JS -->
    <script src="{{ asset('Nandova/js/swiper.min.js')}}"></script>

	 <!-- Initialize Swiper -->

  	<!-- Flot Charts -->
	<script src="{{ asset('Nandova/plugins/c3-chart/c3.min.js')}}"></script>
	<script src="{{ asset('Nandova/plugins/c3-chart/d3.min.js')}}"></script>
	<script src="{{ asset('Nandova/plugins/c3-chart/c3.custom.js')}}"></script>
  	<!-- Flot Charts -->
	<script src="{{ asset('Nandova/plugins/flot/jquery.flot.min.js')}}"></script>
	<script src="{{ asset('Nandova/plugins/flot/jquery.flot.time.min.js')}}"></script>
	<script src="{{ asset('Nandova/plugins/flot/jquery.flot.pie.min.js')}}"></script>
	<script src="{{ asset('Nandova/plugins/flot/jquery.flot.tooltip.min.js')}}"></script>
	<script src="{{ asset('Nandova/plugins/flot/jquery.flot.resize.min.js')}}"></script>
    <!-- Sparkline-->

	<!-- Template global script file. requared all pages -->

	<script src="{{ asset('Nandova/js/global.script.js')}}"></script>
<script>
	$(function() {
			$('#form').submit(function(){
					$('#btn').html('<span class="fa fa-spin fa-spinner"></span>');

			});
			$('.sweet-loader').hide();


	});
</script>


</body>

</html>

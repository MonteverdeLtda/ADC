<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="<?= $this->getCharset(); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!-- // <meta name="viewport" content="width=device-width, initial-scale=1"> -->
<meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no" />
<title><?= $title; ?></title>
<link rel="icon" sizes="224x224" href="/favicon.ico">
<meta name="theme-color" content="#6ba74c">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<script src='/public/assets/build/js/apiFG.js?updd=<?= date("Ymd") ?>'></script>
<link rel="manifest" href="/public/assets/manifest.json">
<!-- <script src='/public/assets/build/js/apiFG.js'></script> -->
<script>
/*
if ('serviceWorker' in navigator) {
	window.addEventListener('load', function() {
		navigator.serviceWorker.register('/?controller=sw&action=service_worker').then(function(registration) {
			// Registration was successful
			console.log('ServiceWorker registration successful with scope: ', registration.scope);
		}, function(err) {
			// registration failed :(
			console.log('ServiceWorker registration failed: ', err);
		});
	});
}*/
/*
if ('serviceWorker' in navigator) {
  window.addEventListener('load', function() {
	//navigator.serviceWorker.register('/?controller=sw&action=service_worker&updd=' + Math.random())
	navigator.serviceWorker.register('/?controller=sw&action=service_worker')
  });
}*/
	/*
	let deferredPrompt;

	window.addEventListener('beforeinstallprompt', (e) => {
	  // Prevent Chrome 67 and earlier from automatically showing the prompt
	  e.preventDefault();
	  // Stash the event so it can be triggered later.
	  deferredPrompt = e;
	});

	if ('serviceWorker' in navigator) {
	  window.addEventListener('load', function() {
		navigator.serviceWorker.register('/sw.js').then(function(registration) {
		  // Registration was successful
		  console.log('ServiceWorker registration successful with scope: ', registration.scope);
		}, function(err) {
		  // registration failed :(
		  console.log('ServiceWorker registration failed: ', err);
		});

		  // Independent of the registration, let's also display
		  // information about whether the current page is controlled
		  // by an existing service worker, and when that
		  // controller changes.

		  // First, do a one-off check if there's currently a
		  // service worker in control.
		  if (navigator.serviceWorker.controller) {
			console.log('This page is currently controlled by:', navigator.serviceWorker.controller);
		  }

		  // Then, register a handler to detect when a new or
		  // updated service worker takes control.
		  navigator.serviceWorker.oncontrollerchange = function() {
			console.log('This page is now controlled by:', navigator.serviceWorker.controller);
		  };
	  });
	}

	*/
</script>
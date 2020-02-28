<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="<?= $this->getCharset(); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!-- // <meta name="viewport" content="width=device-width, initial-scale=1"> -->
<meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no" />
<title><?= $title; ?></title>
<link rel="icon" sizes="224x224" href="/favicon.ico">
<meta name="theme-color" content="#6ba74c">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<link rel="manifest" href="/public/assets/manifest.json">
<script src='/public/assets/build/js/apiFG.js?updd=<?= date("Ymd") ?>'></script>
<!-- <script src='/public/assets/build/js/apiFG.js'></script> -->
<script>
function initialiseState(reg){
	if(reg.active) {
		console.log('Trabajadora de servicio activo');
		console.log('Reg: ', reg);
	}
};

if ('serviceWorker' in navigator) {
	window.addEventListener('load', function() {
		navigator.serviceWorker.register('/?controller=sw&action=service_worker').then(function(registration) {
			// Registration was successful
			if(registration.installing) {
				console.log('Service worker installing');
			} else if(registration.waiting) {
				console.log('Service worker installed');
			} else if(registration.active) {
				console.log('Service worker active');
			}
			
			initialiseState(registration);
		}, function(err) {
			// registration failed :(
			console.log('ServiceWorker registration failed: ', err);
		});
	});

	window.addEventListener('notificationclick', function(e) {
	  var notification = e.notification;
	  var primaryKey = notification.data.primaryKey;
	  var action = e.action;

	  if (action === 'close') {
		notification.close();
	  } else {
		clients.openWindow('http://www.example.com');
		notification.close();
	  }
	});
}
</script>
<?php 
/* *******************************
 *
 * Developer by FelipheGomez
 *
 * ******************************/
?>
<!DOCTYPE html>
<html lang="<?= $this->getLang(); ?>">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta charset="<?= $this->getCharset(); ?>">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?= $title; ?></title>
		<?= $this->head(); ?>
		<script>
		/*
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
		*/
		</script>
	</head>
	<body class="login">
		<?php $this->getView($description); ?>
		<?= $this->footerScripts(); ?>
	</body>
</html>
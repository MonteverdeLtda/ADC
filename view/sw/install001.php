<?php header('Content-Type: text/javascript'); 
self.addEventListener('install', function(event) {
	// Instalar de inmediato
	if (self.skipWaiting) { self.skipWaiting(); }
	event.waitUntil(
		caches.open(
			'cacheMVLTDA_00000000001'
		).then(function(cache) {
			return cache.addAll([
				'/favicon.ico',
			]);
		})
	);
});

// Cache, falling back to network
self.addEventListener('fetch', function(event) {
	event.respondWith(
		caches.match(event.request).then(function(response) {
			return response || fetch(event.request);
		})
	);
});
caches.keys().then(function(cacheKeys) {
	// Muestra en la consola la cache instalada 
	console.log('Versión SW: ' + cacheKeys);
});

// Elimina archivos de cache viejos
// var cacheWhitelist = ['cacheMVLTDA-' + new Date().getFullYear()+new Date().getMonth()+new Date().getDate()]; // 
var cacheWhitelist = []; // 
caches.keys().then(function(cacheNames) {
	return Promise.all(
		cacheNames.map(function(cacheName) {
			if (cacheWhitelist.indexOf(cacheName) === -1) {
				return caches.delete(cacheName);
			}
		})
	);
});

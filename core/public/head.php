<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="<?= $this->getCharset(); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!-- // <meta name="viewport" content="width=device-width, initial-scale=1"> -->
<meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no" />
<title><?= count($title) > 0 ? $title : $this->title; ?></title>
<link rel="icon" sizes="224x224" href="/favicon.ico">
<meta name="theme-color" content="#6ba74c">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<link rel="manifest" href="/public/assets/manifest.json">
<script src='/public/assets/build/js/apiFG.js?updd=<?= date("Ymd") ?>'></script>
<!-- <script src='/public/assets/build/js/apiFG.js'></script> -->
<script>
const apiTickets = MV.apiFG.create({
	baseURL: '/core/integrations/hesk/api/index.php/v1',
	// baseURL: '/ayudaysoporte/api/index.php/v1',
	withCredentials: true
});

apiTickets.defaults.headers['X-Auth-Token'] = '<?= X_AUTH_TOKEN_API_HESK; ?>';

// Retirado de Head.
function initialiseState(reg){
	if(reg.active) {
		console.log('Trabajadora de servicio activo');
		console.log('Reg: ', reg);
	}
};
</script>
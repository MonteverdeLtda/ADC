<?php 
/*
	
*/
if (!isset($_GET['boxId']) || (int) $_GET['boxId'] <= 0) {
	echo "<meta http-equiv=\"refresh\" content=\"0; url=" . linkRoute('site', 'index') . "\">";
	exit();
}
$mailBoxes = $this->user->getEmailBoxes();
$found_key = array_search($_GET['boxId'], array_column($mailBoxes, 'id'));
if($found_key !== false && $found_key > -1){
	$mailBox = new EmailBox($this->adapter);
	$mailBox->getById($_GET['boxId']);
	$user = $mailBox->user;
	$pass = $mailBox->pass;
	$urlOut = "/webmail/?_task=logout_mvt";
	$url = "/webmail/?postlogin&_user={$user}&_pass={$pass}&_action=login";
	$url_close = '/webmail/?_task=login&_action=login';
} else {
	echo "<meta http-equiv=\"refresh\" content=\"0; url=" . linkRoute('site', 'index') . "\">";
	exit();
}
?>
<div class="row">
	<div class="col-xs-12">
		<iframe id="frame2" class="hidden" frameborder="0" src="<?= $url_close; ?>" style="width:100%;height:calc(90vh);"></iframe>
	</div>
</div>
<script>
setTimeout(() => {
	$("#frame2").attr('src', '<?= $url; ?>');
	setTimeout(() => {
		$("#frame2").attr('class', 'show');
	}, 500);
}, 500);
</script>
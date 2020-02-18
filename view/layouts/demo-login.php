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
	</head>
	<body class="login">
		<?php $this->getView($description); ?>
		<?= $this->footerScripts(); ?>
	</body>
</html>
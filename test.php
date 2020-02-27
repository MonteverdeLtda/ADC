<?php

function strip_html_tags( $text ) {
	$text = preg_replace(
		array(
		  // Remove invisible content
			'@<head[^>]*?>.*?</head>@siu',
			'@<style[^>]*?>.*?</style>@siu',
			'@<script[^>]*?.*?</script>@siu',
			'@<object[^>]*?.*?</object>@siu',
			'@<embed[^>]*?.*?</embed>@siu',
			'@<noscript[^>]*?.*?</noscript>@siu',
			'@<noembed[^>]*?.*?</noembed>@siu',
			'@\t+@siu',
			'@\n+@siu'
		),
		'',
		(($text)) );

	// replace certain elements with a line-break
	$text = preg_replace(
		array(
			'@</?((div)|(h[1-9])|(/tr)|(p)|(pre))@iu'
		),
		"\n\$0",
		$text );

	// replace other elements with a space
	$text = preg_replace(
		array(
			'@</((td)|(th))@iu'
		),
		" \$0",
		$text );

	// strip all remaining HTML tags
	$text = strip_tags( $text );

	// trim text
	$text = trim( $text );

	return $text;
}

$file = "templates/mails/register.php";
$fileExist = @file_exists($file);
$template = "NONE {$file}";
if($fileExist == true){
	
	$template = @htmlspecialchars(@file_get_contents($file, true));
	$template = (preg_replace([
		'/%username%/i',
		'/%email%/i',
		'/%password%/i',
	], [
		"username",
		"email",
		"orig_pass",
	], $template));
	#
	$template = htmlspecialchars_decode($template, ENT_NOQUOTES);
}
echo strip_html_tags($template);
exit();

<?php
	use Spherus\HttpContext\HttpContext;
	use Spherus\Helpers\HtmlHelper;
	HtmlHelper::Css(CSS.'cssser.css');
?>

<html>
	<head>
		{css}
	</head>
	<body>
		<?php echo HttpContext::getPageContent();?>
	</body>
</html>
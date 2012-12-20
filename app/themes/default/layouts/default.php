<?php
	use Spherus\HttpContext\HttpContext;
	use Spherus\Helpers\HtmlHelper;
?>
<!DOCTYPE html>
<html>
	<head>
		<?php echo HtmlHelper::Css(CSS.'cssser.css')?>
	</head>
	<body>
		<?php echo HttpContext::getPageContent()?>
	</body>
</html>
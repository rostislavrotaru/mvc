<?php
use Spherus\HttpContext\HttpContext;
use Spherus\Helpers\HtmlHelper;
?>
<!DOCTYPE html>
<html>
<head>
		<?php
echo HtmlHelper::Css(THEME_CSS . 'cssser');
echo HtmlHelper::Css(THEME_CSS . 'style');
?>
	</head>
<body>
	<?php echo HttpContext::getPageContent();?>
</body>
</html>
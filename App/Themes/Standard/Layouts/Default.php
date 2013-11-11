<?php
use Spherus\HttpContext\HttpContext;
use Spherus\Helpers\HtmlHelper;
use Spherus\Core\Workbench;
?>
<!DOCTYPE html>
<html>
<head>
<?php
echo HtmlHelper::Css(Workbench::getCurrentTheme()->getCssPath().'/style');
?>
</head>
<body>
this is layout from global theme
<?php echo HttpContext::getPageContent();?>
</body>
</html>
<?php
use Spherus\HttpContext\HttpContext;
use Spherus\Helpers\HtmlHelper;
use Spherus\Core\Workbench;
?>
<!DOCTYPE html>
<html>
<head>
<?php
echo HtmlHelper::Css(Workbench::getCurrentTheme()->getCssPath().SEPARATOR.'style');
echo HtmlHelper::Css(Workbench::getCurrentTheme()->getCssPath().SEPARATOR.'style');
echo HtmlHelper::Css(Workbench::getCurrentTheme()->getCssPath().SEPARATOR.'style');
echo HtmlHelper::Css(Workbench::getCurrentTheme()->getCssPath().SEPARATOR.'style');
echo HtmlHelper::Css(Workbench::getCurrentTheme()->getCssPath().SEPARATOR.'style');
echo HtmlHelper::Css(Workbench::getCurrentTheme()->getCssPath().SEPARATOR.'style');
echo HtmlHelper::Css(Workbench::getCurrentTheme()->getCssPath().SEPARATOR.'style');
echo HtmlHelper::Css(Workbench::getCurrentTheme()->getCssPath().SEPARATOR.'style');
echo HtmlHelper::Css(Workbench::getCurrentTheme()->getCssPath().SEPARATOR.'cssser');
?>
</head>
<body>
<?php echo HttpContext::getPageContent();?>
</body>
</html>
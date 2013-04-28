this is layout from main module theme
<br />
<?php
use Spherus\Helpers\HtmlHelper;
use Spherus\Core\Workbench;

echo HtmlHelper::Css(Workbench::getCurrentTheme()->getCssPath().SEPARATOR.'cssser');
echo HtmlHelper::Css(Workbench::getCurrentTheme()->getCssPath().SEPARATOR.'style');
use Spherus\HttpContext\HttpContext;
echo HttpContext::getPageContent();
?>
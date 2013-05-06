this is layout "site" from main module theme
<br />
<?php
use Spherus\Helpers\HtmlHelper;
use Spherus\Core\Workbench;

echo HtmlHelper::Css(Workbench::getCurrentTheme()->getCssPath().'/cssser');
echo HtmlHelper::Css(Workbench::getCurrentTheme()->getCssPath().'/style');
use Spherus\HttpContext\HttpContext;
echo HttpContext::getPageContent();
?>
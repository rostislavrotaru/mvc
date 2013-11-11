this is layout "default" from main module theme
<br />
<?php
use Spherus\Helpers\HtmlHelper;
use Spherus\Core\Workbench;

echo HtmlHelper::Css(Workbench::getCurrentTheme()->getCssPath().'/style');
use Spherus\HttpContext\HttpContext;
echo HttpContext::getPageContent();
?>
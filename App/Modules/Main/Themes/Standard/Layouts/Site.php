this is layout "site" from main module theme
<br />
<?php
use Spherus\Helpers\HtmlHelper;
use Spherus\Core\Workbench;

echo HtmlHelper::Css(Workbench::getCurrentTheme()->getCssPath().SEPARATOR.'cssser');
use Spherus\HttpContext\HttpContext;
echo HttpContext::getPageContent();
?>
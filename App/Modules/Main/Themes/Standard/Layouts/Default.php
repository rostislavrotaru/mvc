this is layout from main module theme
<br />
<?php
use Spherus\Helpers\HtmlHelper;
use Spherus\Core\Workbench;

echo HtmlHelper::Css(Workbench::getCurrentTheme()->getCssPath().'/cssser');
use Spherus\HttpContext\HttpContext;
echo HttpContext::getPageContent();
?>
<?php
namespace Spherus\Modules\Main\Themes
{
    use Spherus\Interfaces\ITheme;

    class DefaultTheme implements ITheme
    {

        public function getLayoutsPath ()
        {
            return __DIR__ . SEPARATOR . 'layouts';
        }

        public function getName ()
        {}

        public function getCssPath ()
        {}

        public function getImagesPath ()
        {}

        public function getScriptsPath ()
        {}
    }
}

?>
<?php
namespace Spherus\Modules\Install
{
    use Spherus\Core\Base\ControllerBase;

    class HomeController extends ControllerBase
    {

        public function BeforeLoad ()
        {
            $this->helpers = array(
                    'html'
            );
        }

        public function index ()
        {}
    }
}

?>
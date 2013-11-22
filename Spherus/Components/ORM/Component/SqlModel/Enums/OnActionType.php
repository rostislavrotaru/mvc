<?php

	/**
	 * Redistributions of files must retain the above copyright notice.
	 *
	 * @copyright SPHERUS (http://spherus.net)
	 * @license http://license.spherus.net
	 * @link http://spherus.net
	 * @since 3.0
	 */
	namespace Spherus\Components\ORM\Component\SqlModel\Enums;

	use Spherus\Core\Enums\Enum;
	
	/**
     * Class that represents an ORM Column type
     *
     * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
     * @package spherus.components.orm
     */
    class OnActionType extends Enum
	{
		const Restrict = 'Restrict';
		const Cascade = 'Cascade';
	}
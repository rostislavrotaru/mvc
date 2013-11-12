<?php

	/**
	 * Redistributions of files must retain the above copyright notice.
	 *
	 * @copyright SPHERUS (http://spherus.net)
	 * @license http://license.spherus.net
	 * @link http://spherus.net
	 * @since 3.0
	 */
	namespace Spherus\Components\ORM\Component\Enums;

	use Spherus\Core\Enums\Enum;
					
	/**
     * Class that represents an ORM Entity multiplicity type
     *
     * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
     * @package spherus.components.orm
     */
    class MultiplicityType extends Enum
	{
		const Many = 'Many';
		const ZeroOrOne = 'ZeroOrOne';
		const One = 'One';
	}
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
     * Class that represents an ORM Column type
     *
     * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
     * @package spherus.components.orm
     */
    class PropertyType extends Enum
	{
		const Integer = 'Integer';
		const Char = 'Char';
		const Varchar = 'Varchar';
		const UniqueIdentifier = 'UniqueIdentifier';
		const Text = 'Text';
		const DateTime = 'DateTime';
		const Binary = 'Binary';
		const Boolean = 'Boolean';
		const Decimal = 'Decimal';
	}
<?php

	/**
	 * Redistributions of files must retain the above copyright notice.
	 *
	 * @copyright SPHERUS (http://spherus.net)
	 * @license http://license.spherus.net
	 * @link http://spherus.net
	 * @since 3.0
	 */
	namespace Spherus\Components\Data;

	use Spherus\Core\Enums\Enum;
		
	/**
	 * Class that represents a database parameter type
	 *
	 * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
	 * @package spherus.components.data
	 */
	class DatabaseParameterType extends Enum
	{
		const Text = 'Text';
		const Varchar = 'Varchar';
		const Date = 'Date';
		const DateTime = 'DateTime';
		const Integer = 'Integer';
	}
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
     * Class that represents an ORM Entity enum type
     *
     * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
     * @package spherus.components.orm
     */
    class EntityType extends Enum
	{
		const Database = 'Database';
		const Table = 'Table';
		const Column = 'Column';
	}
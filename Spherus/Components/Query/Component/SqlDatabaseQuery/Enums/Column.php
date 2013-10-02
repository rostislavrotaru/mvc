<?php

	/**
	 * Redistributions of files must retain the above copyright notice.
	 *
	 * @copyright SPHERUS (http://spherus.net)
	 * @license http://license.spherus.net
	 * @link http://spherus.net
	 * @since 3.0
	 */
	namespace pherus\Components\Query\Component\SqlDatabaseQuery\Enums;

	use Spherus\Core\Enums\Enum;
	
    /**
	 * Class that contains column types.
	 * 
	 * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
     * @package spherus.components.query
	 *
	 */
	class Column extends Enum
	{
		const Entry = 'Entry';
		const Exit_ = 'Exit';
		const Alias = 'Alias';
	}
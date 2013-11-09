<?php

	/**
	 * Redistributions of files must retain the above copyright notice.
	 *
	 * @copyright SPHERUS (http://spherus.net)
	 * @license http://license.spherus.net
	 * @link http://spherus.net
	 * @since 3.0
	 */
	namespace Spherus\Components\Query\Component\SqlDatabaseQuery\Enums;

	use Spherus\Core\Enums\Enum;
	
	/**
     * Class that represents the Insert section enum type
     *
     * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
     * @package spherus.components.query
     */
    class InsertType extends Enum
	{
		const Entry = 'Entry';
		const Exit_ = 'Exit';
		const ColumnsEntry = 'ColumnsEntry';
		const ColumnsExit = 'ColumnsExit';
		const ValuesEntry = 'ValuesEntry';
		const ValuesExit = 'ValuesExit';
		const DefaultValues = 'DefaultValues';
	}
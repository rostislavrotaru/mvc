<?php

	/**
	 * Redistributions of files must retain the above copyright notice.
	 *
	 * @copyright SPHERUS (http://spherus.net)
	 * @license http://license.spherus.net
	 * @link http://spherus.net
	 * @since 3.0
	 */
	namespace Spherus\Data\Engine\SqlDatabaseEngine\Enums;
					
	/**
     * Class that represents the Select section enum type
     *
     * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
     * @package spherus.data
     */
    class SelectSection
    {
    	const Entry = 'Entry';
    	const Exit_ = 'Exit';
    	const From = 'From';
    	const Where = 'Where';
    	const GroupBy = 'GroupBy';
    	const Having = 'Having';
    	const OrderBy = 'OrderBy';
    	const Limit = 'Limit';
    	const Offset = 'Offset';
    }
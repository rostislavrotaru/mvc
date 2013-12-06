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
	 * Class that contains order types.
	 * 
	 * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
     * @package spherus.components.orm
	 *
	 */
    class OrderType extends Enum
	{	
    	const Ascending = 'Ascending';
		const Descending = 'Descending';
	}
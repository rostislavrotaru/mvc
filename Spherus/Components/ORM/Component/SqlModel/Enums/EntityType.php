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
     * Class that represents an ORM Entity type
     *
     * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
     * @package spherus.components.orm
     */
    class EntityType extends Enum
	{
		const Literal = 'Literal';
		const Select = 'Select';
		const And_ = 'And';
		const Or_ = 'Or';
		const In = 'In';
		const NotIn = 'NotIn';
		const Equal = 'Equal';
		const NotEqual = 'NotEqual';
		const GreaterThan = 'GreaterThan';
		const GreaterThanOrEqual = 'GreaterThanOrEqual';
		const LessThan = 'LessThan';
		const LessThanOrEqual = 'LessThanOrEqual';
		const Order = 'Order';
		
		const Model = 'Model';
		const ModelEntities = 'ModelEntities';
		const Property = 'Property';
		const NavigationProperty = 'NavigationProperty';
		const Index = 'Index';
		const Relationship = 'Relationship';
		const ActiveRecordEntity = 'ActiveRecordEntity';
	}
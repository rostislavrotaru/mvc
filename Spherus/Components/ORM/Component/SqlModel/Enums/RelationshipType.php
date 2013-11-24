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
     * Class that represents an ORM Entity Relationsip type
     *
     * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
     * @package spherus.components.orm
     */
    class RelationshipType extends Enum
	{
		const OneToOne = 'OneToOne';
		const OneToMany = 'OneToMany';	
		const ManyToOne = 'ManyToOne';
		const ManyToMany = 'ManyToMany';
	}
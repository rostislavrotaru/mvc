<?php

	/**
	 * Redistributions of files must retain the above copyright notice.
	 *
	 * @copyright SPHERUS (http://spherus.net)
	 * @license http://license.spherus.net
	 * @link http://spherus.net
	 * @since 3.0
	 */
	namespace Spherus\Components\Data\Base;
	
	/**
	 * Class that represents data engine database
	 *
	 * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
	 * @package spherus.components.data
	 */
	abstract class Database
	{
		
		/* FIELDS */
		
		/**
		 * Defines the database connection string
		 * @var string
		 */
		private $connectionString = null;
		
		
		/* PROPERTIES */
	
		/**
		 * Gets the database connection string.
		 * @var string
		 */
		public function getConnectionString()
		{
			return $this->connectionString;
		}
	
		/**
		 * Sets the database connection string.
		 * @param string $connectionString The connection string to set.
		 */
		public function setConnectionString($connectionString)
		{
			$this->connectionString = $connectionString;
		}

	}
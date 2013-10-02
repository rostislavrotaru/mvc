<?php

	/**
	 * Redistributions of files must retain the above copyright notice.
	 *
	 * @copyright SPHERUS (http://spherus.net)
	 * @license http://license.spherus.net
	 * @link http://spherus.net
	 * @since 3.0
	 */
	namespace Spherus\Components\Data\Component;
		
	use Spherus\Core\Check;
	use Spherus\Core\SpherusException;
	
		/**
	 * Class that represents a database configuration object
	 *
	 * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
	 * @package spherus.components.data
	 */
	class DatabaseConfig
	{
		
		/* CONSTRUCTOR */
		
		/**
		 * Initializes a new instance of DatabaseConfig class.
		 * 
		 * @param string $host The database host name.
		 * @param string $port The database port name.
		 * @param string $databaseName The database name.
		 * @param string $userName The database user name.
		 * @param string $userPassword The database user password.
		 * @param mixed $options The database additional options if any.
		 * 
		 * @throws SpherusException When $host parameter is null or empty.
		 * @throws SpherusException When $databaseName parameter is null or empty.
		 * @throws SpherusException When $userName parameter is null or empty.
		 */
		public function __construct($host, $port, $databaseName, $userName, $userPassword, $options = null)
		{
			Check::IsNullOrEmpty($host);
			Check::IsNullOrEmpty($databaseName);
			Check::IsNullOrEmpty($userName);
			
			$this->host = $host;
			$this->port = $port;
			$this->databaseName = $databaseName;
			$this->userName = $userName;
			$this->userPassword = $userPassword;
			$this->options = $options;
		}
		
		
		/* FIELDS */
		
		/**
		 * Defines the database host
		 * @var string
		 */
		private $host = null;
		
		/**
		 * Defines the database port
		 * @var string
		 */
		private $port = null;
		
		/**
		 * Defines the database name
		 * @var string
		 */
		private $databaseName = null;
		
		/**
		 * Defines the database user name
		 * @var string
		 */
		private $userName = null;
		
		/**
		 * Defines the database user password
		 * @var string
		 */
		private $userPassword = null;
		
		/**
		 * Defines the database additional options
		 * @var mixed
		 */
		private $options = null;
	
		
		/* PROPERTIES */
	
		/**
		 * Gets the database host.
		 * @var string
		 */
		public function getHost()
		{
			return $this->host;
		}
	
		/**
		 * Sets the database host.
		 * @param string $host The database host name to set.
		 */
		public function setHost($host)
		{
			$this->host = $host;
		}
	
		/**
		 * Gets the database port.
		 * @var string
		 */
		public function getPort()
		{
			return $this->port;
		}
	
		/**
		 * Sets the database port.
		 * @param string $port The database port name to set.
		 */
		public function setPort($port)
		{
			$this->port = $port;
		}
	
		/**
		 * Gets the database name.
		 * @var string
		 */
		public function getDatabaseName()
		{
			return $this->databaseName;
		}
	
		/**
		 * Sets the database name.
		 * @param string $databaseName The database name to set.
		 */
		public function setDatabaseName($databaseName)
		{
			$this->databaseName = $databaseName;
		}
	
		/**
		 * Gets the database user name.
		 * @var string
		 */
		public function getUserName()
		{
			return $this->userName;
		}
	
		/**
		 * Sets the database user name.
		 * @param string $userName The database user name to set.
		 */
		public function setUserName($userName)
		{
			$this->userName = $userName;
		}
	
		/**
		 * Gets the database user password.
		 * @var string
		 */
		public function getUserPassword()
		{
			return $this->userPassword;
		}
	
		/**
		 * Sets the database user password.
		 * @param string $userPassword The database user password to set.
		 */
		public function setUserPassword($userPassword)
		{
			$this->userPassword = $userPassword;
		}
	
		/**
		 * Gets the database additional options.
		 * @var mixed
		 */
		public function getOptions()
		{
			return $this->options;
		}
	
		/**
		 * Sets the database additional option.
		 * @param string $options The database additional options to set.
		 */
		public function setOptions($options)
		{
			$this->options = $options;
		}

		
	}
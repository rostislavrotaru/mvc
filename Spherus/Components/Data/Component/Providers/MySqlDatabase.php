<?php

	/**
	 * Redistributions of files must retain the above copyright notice.
	 *
	 * @copyright SPHERUS (http://spherus.net)
	 * @license http://license.spherus.net
	 * @link http://spherus.net
	 * @since 3.0
	 */
	namespace Spherus\Components\Data\Component\Providers;
	
	use Spherus\Components\Data\Component\Base\SqlDatabase;
	use Spherus\Core\SpherusException;
		
	/**
	 * Class that represents a MySql database
	 *
	 * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
	 * @package spherus.components.data
	 */
	class MySqlDatabase extends SqlDatabase
	{
		/**
		 * Creates PDO connection
		 *
		 * @return \PDO
		 */
		public function CreatePdoConnection()
		{
			try
			{
				$connectionString = 'mysql:host='.$this->config->getHost().'; port='.$this->config->getPort().'; dbname='.$this->config->getDatabaseName();
				return new \PDO($connectionString, $this->config->getUserName(), $this->config->getUserPassword(), $this->config->getOptions());
			}
			catch (\Exception $e)
			{
				throw new SpherusException($e->getMessage(), $e->getCode(), $e);
			}
		}
	}

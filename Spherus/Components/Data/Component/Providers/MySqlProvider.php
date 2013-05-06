<?php

	/**
	 * Redistributions of files must retain the above copyright notice.
	 *
	 * @copyright SPHERUS (http://spherus.net)
	 * @license http://license.spherus.net
	 * @link http://spherus.net
	 * @since 3.0
	 */
	namespace Spherus\Components\Data\Providers;
	
	use Spherus\Components\Data\Component\Base\SqlDatabase;
	
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
				$connectionString = $this->databaseConfig['provider'].':host='.$this->databaseConfig['host'].'; port='.$this->databaseConfig['port'].'; dbname='.$this->databaseConfig['name'];
				return new \PDO($connectionString, $this->databaseConfig['user'], $this->databaseConfig['password']);
			}
			catch (\Exception $e)
			{
				throw new DataEngineException($e->getMessage());
			}
		}
	}

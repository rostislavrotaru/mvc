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
	
	use Spherus\Core\Check;
	use Spherus\Core\SpherusException;
	use Spherus\Components\Data\DatabaseParameter;
	use Spherus\Components\Data\DatabaseParameterType;
		
				/**
	 * Class that represents a sql database
	 *
	 * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
	 * @package spherus.components.data
	 */
	abstract class SqlDatabase extends Database
	{
		
		/* FIELDS */
		
		/**
		 * Defines sql database connection object.
		 *
		 * @var \PDO
		 */
		protected $connection = null;
			
		/**
		 * Defines whether the current connection is opened or not.
		 *
		 * @var boolean
		 */
		protected $connected = false;
		
		
		/* PUBLIC METHODS */
		
		/**
		 * Opens connection to the database and creates a PDO connection.
		 *
		 * @return boolean true if connected, otherwise false.
		 */
		public function ConnectionOpen()
		{
			if (!$this->connected)
			{
				$this->connection = $this->CreatePdoConnection();
				if ($this->connection)
				{
					$this->connected = true;
				}
			}
			return $this->connected;
		}
		
		/**
		 * Closes connection to the database
		 */
		public function ConnectionClose()
		{
			$this->connection = null;
		}
		
		
		/* SQL */
		
		/**
		 * Executes sql statement on server and returns an array.
		 *
		 * @param string $sql The sql to execute.
		 * @param array $databaseParameters Array of DatabaseParameter objects.
		 * @throws SpherusException When sql cannot be executed.
		 *
		 * @return Array of fetched objects.
		 * @var array
		 */
		public function ExecuteSql($sql, $databaseParameters = null)
		{
			$this->ConnectionOpen();
			$preparedStatement = $this->PrepareSqlAndParametersAndExecute($sql, $databaseParameters);
		
			$result = $preparedStatement->fetchAll(\PDO::FETCH_OBJ);
			$preparedStatement->closeCursor();
			$this->SetOutParameters($databaseParameters);
		
			return $result;
		}
		
		/**
		 * Execute sql as non-query.
		 *
		 * @param string $sql The sql to execute.
		 * @param array $databaseParameters Array of DatabaseParameter objects.
		 *
		 * @return Number of affected rows.
		 * @var integer
		 */
		public function ExecuteSqlNonQuery($sql, $databaseParameters = null)
		{
			$this->ConnectionOpen();
			$preparedStatement = $this->PrepareSqlAndParametersAndExecute($sql, $databaseParameters);
			
			$preparedStatement->closeCursor();
			$this->SetOutParameters($databaseParameters);
			
			return $preparedStatement->rowCount();
		}
		
		/**
		 * Execute sql as non-query.
		 *
		 * @param string $sql The sql to execute.
		 * @param array $databaseParameters Array of DatabaseParameter objects.
		 *
		 * @return First row of first column.
		 * @var string
		 */
		public function ExecuteSqlScalar($sql, $databaseParameters = null)
		{
			$this->ConnectionOpen();
			$preparedStatement = $this->PrepareSqlAndParametersAndExecute($sql, $databaseParameters);
			
			$result = $preparedStatement->fetchColumn();
			$preparedStatement->closeCursor();
			$this->SetOutParameters($databaseParameters);
		
			return $result;
		}
		
		
		/* STORED PROCEDURE */
		
		/**
		 * Execute stored procedure on server and return an array.
		 *
		 * @param string $storedProcedureName The stored procedure name to execute.
		 * @param array $databaseParameters Array of DatabaseParameter objects.
		 *
		 * @return Array of fetched objects.
		 * @var array
		 */
		public function ExecuteStoredProcedure($storedProcedureName, $databaseParameters = null)
		{
			return $this->ExecuteSql('CALL '.$storedProcedureName, $databaseParameters);	
		}
		
		/**
		 * Execute stored procedure as non-query.
		 *
		 * @param string $storedProcedureName The stored procedure name to execute.
		 * @param array $databaseParameters Array of DatabaseParameter objects.
		 *
		 * @return Number of affected rows.
		 * @var integer
		 */
		public function ExecuteStoredProcedureNonQuery($storedProcedureName, $databaseParameters = null)
		{
			return $this->ExecuteSqlNonQuery('CALL '.$storedProcedureName, $databaseParameters);
		}
		
		/**
		 * Execute stored procedure scalar.
		 *
		 * @param string $storedProcedureName he stored procedure name to execute.
		 * @param array $databaseParameters Array of DatabaseParameter objects.
		 *
		 * @return First row of first column.
		 * @var string
		 */
		public function ExecuteStoredProcedureScalar($storedProcedureName, $databaseParameters = null)
		{
			return $this->ExecuteSqlScalar('CALL '.$storedProcedureName, $databaseParameters);
		}
		
		
		/* TRANSACTIONS */
			
		/**
		 * Begins transaction.
		 */
		public function BeginTransaction()
		{
			$this->ConnectionOpen();
			if($this->connection->inTransaction() === false)
			{
				$this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
				$this->connection->beginTransaction();
			}
		}
			
		/**
		 * Commits transaction.
		 */
		public function CommitTransaction()
		{
			if($this->connection->inTransaction() === true)
			{
				$this->connection->commit();
			}
		}
			
		/**
		 * Rollbacks transaction
		 */
		public function RollbackTransaction()
		{
			if($this->connection->inTransaction() === true)
			{
				$this->connection->rollBack();
			}
		}
			
		
		/* PROTECTED FUCNTIONS */
		
		/**
		 * Creates PDO connection
		 *
		 * @return \PDO
		 */
		protected abstract function CreatePdoConnection();
		
		/**
		 * If in database parameters array found out one - set the out values.
		 *
		 * @param array $databaseParameters Array of DatabaseParameter objects.
		 */
		protected function SetOutParameters($databaseParameters = null)
		{
			if(isset($databaseParameters))
			{
				foreach ($databaseParameters as $key=>$parameter)
				{
					if ($parameter->getIsOut() === true)
					{
						$outSql = $this->connection->query('SELECT '.$parameter->getName());
						if ($outSql === false)
						{
							throw new SpherusException($this->connection->errorInfo()[2], $this->connection->errorInfo()[0], $this->connection->errorInfo());
						}
						$databaseParameters[$key]->setValue($outSql->fetch(\PDO::FETCH_OBJ)->$parameter->getName());
					}
				}
			}
		}

		/**
		 * Prepares sql statement and binds database parameters.
		 *
		 * @param string $sql The sql statement to prepare.
		 * @param array $databaseParameters The parameters from statement to bind.
		 *
		 * @throws SpherusException When $sql parameter is null or empty.
		 * @throws SpherusException When one of parameters cannot be binded.
		 * 
		 * @return prepared sql statement.
		 * @var \PDOStatement
		 */
		protected function PrepareSqlAndParametersAndExecute($sql, $databaseParameters)
		{
			Check::IsNullOrEmpty($sql);
		
			$preparedStatement = $this->connection->prepare($sql);
			
			if(isset($databaseParameters))
			{
				foreach ($databaseParameters as $parameter)
				{
					if ($preparedStatement->bindValue($parameter->getName(), $parameter->getValue(), $this->ConvertDatabaseParameter($parameter)) === false)
					{
						throw new SpherusException($preparedStatement->errorInfo()[2], $preparedStatement->errorInfo()[0], $preparedStatement->errorInfo());
					}
				}
			}
			
			if ($preparedStatement->execute() === false)
			{
				throw new SpherusException($preparedStatement->errorInfo()[2], $preparedStatement->errorInfo()[0], $preparedStatement->errorInfo());
			}
				
			return $preparedStatement;
		}
			
		/**
		 * Converts parameter from common type to database type.
		 *
		 * @param DatabaseParameter $databaseParameter The database parameter object.
		 *
		 * @return integer Converted result.
		 */
		protected function ConvertDatabaseParameter(DatabaseParameter $databaseParameter)
		{
			$result = \PDO::PARAM_NULL;
			switch ($databaseParameter->getType())
			{
				case DatabaseParameterType::Varchar:
				case DatabaseParameterType::Text:
				{
					$result = \PDO::PARAM_STR;
					break;
				}
				case DatabaseParameterType::Integer:
				{
					$result = \PDO::PARAM_INT;
					break;
				}
				default:
				{
					$result = \PDO::PARAM_NULL;
					break;
				}
			}
			
			if ($databaseParameter->getIsOut() === true)
			{
				$result = $result|\PDO::PARAM_INPUT_OUTPUT;
			}
			
			return $result;
		}
	}
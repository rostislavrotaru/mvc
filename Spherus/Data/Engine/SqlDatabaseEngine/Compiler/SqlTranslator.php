<?php

	/**
	 * Redistributions of files must retain the above copyright notice.
	 *
	 * @copyright SPHERUS (http://spherus.net)
	 * @license http://license.spherus.net
	 * @link http://spherus.net
	 * @since 3.0
	 */
	namespace Spherus\Data\Engine\SqlDatabaseEngine\Compiler;

    /**
     * Class that represents the sql database engine compiler
     *
     * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
     * @package spherus.data
     */
	abstract class SqlTranslator
	{
		
		/* PROPERTIES */
		
		/**
		 * Defines the open bracket symbol.
		 * 
		 * @var string
		 */
		public $openBracket = '[';
		
		/**
		 * Defines the close bracket symbol.
		 * 
		 * @var string
		 */
		public $closeBracket = ']';
		
		/**
		 * Defines the quote symbol.
		 * @var string
		 */
		public $quote = '\'';
		
		/**
		 * Defines the opening parenthesis symbol.
		 * @var string
		 */
		public $openingParenthesis = '(';
		
		/**
		 * Defines the closing parenthesis symbol.
		 * @var string
		 */
		public $closingParenthesis = ')';
		
		/**
		 * Defines the Column delimiter symbol.
		 * @var string
		 */
		public $columnDelimiter = ',';
		
		/**
		 * Defines the argument delimiter symbol.
		 * @var string
		 */
		public $argumentDelimiter = ',';
		
		/**
		 * Defines the asterisc symbol
		 * @var string
		 */
		public $asterisc = '*';
		
		/**
		 * Defines the begin batch symbol
		 * @var string
		 */
		public $batchBegin = null;
		
		/**
		 * Defines the end batch symbol
		 * @var string
		 */
		public $batchEnd = null;
		
		/**
		 * Defines the delimiter batch symbol
		 * @var string
		 */
		public $batchDelimiter = ';';
		
		
		/* PUBLIC METHODS */
		
		/**
		 * Encapsulates given string in brackets.
		 * 
		 * @param string $string The string to encapsulate.
		 * 
		 * @return string Encapsulated string.
		 */
		public function EncapsulateInBrackets($string)
		{
			return $this->openBracket.$string.$this->closeBracket;
		}
		
		/**
		 * Encapsulates given string in quotes.
		 * 
		 * @param string $string The string to encapsulate.
		 * 
		 * @return string Encapsulated string.
		 */
		public function EncapsulateInQuotes($string)
		{
			return $this->quote.str_replace("'", "''", $string).$this->quote;
		}
	}

?>
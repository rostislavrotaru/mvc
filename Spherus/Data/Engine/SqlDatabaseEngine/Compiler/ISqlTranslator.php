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
     * Interface that represents the sql database engine translator
     *
     * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
     * @package spherus.data
     */
	interface ISqlTranslator
	{
		
		/* PROPERTIES */
		
		/**
		 * Gets the open bracket symbol.
		 * 
		 * @var string
		 */
		public function getOpenBracket();
		
		/**
		 * Gets the close bracket symbol.
		 *
		 * @var string
		 */
		public function getCloseBracket();
				
		/**
		 * Gets the quote symbol
		 *
		 * @var string
		 */
		public function getQuote();
		
		/**
		 * Gets the opening parenthesis symbol
		 *
		 * @var string
		 */
		public function getOpeningParenthesis();
				
		/**
		 * Gets the closing parenthesis symbol
		 *
		 * @var string
		 */
		public function getClosingParenthesis();
				
		/**
		 * Gets the column delimiter symbol
		 *
		 * @var string
		 */
		public function getColumnDelimiter();
		
		/**
		 * Gets the argument delimiter symbol
		 *
		 * @var string
		 */
		public function getArgumentDelimiter();
				
		/**
		 * Gets the asterisk symbol
		 *
		 * @var string
		 */
		public function getAsterisk();
		
		/**
		 * Gets the batch begin symbol
		 *
		 * @var string
		 */
		public function getBatchBegin();
		
		/**
		 * Gets the batch end symbol
		 *
		 * @var string
		 */
		public function getBatchEnd();
		
		/**
		 * Gets the batch delimiter symbol
		 *
		 * @var string
		 */
		public function getBatchDelimiter();
	
		
		/* PUBLIC METHODS */
		
		/**
		 * Encapsulates given string in brackets.
		 * 
		 * @param string $string The string to encapsulate.
		 * 
		 * @return string Encapsulated string.
		 */
		public function EncapsulateInBrackets($string);
		
		/**
		 * Encapsulates given string in quotes.
		 * 
		 * @param string $string The string to encapsulate.
		 * 
		 * @return string Encapsulated string.
		 */
		public function EncapsulateInQuotes($string);
	
	}

?>
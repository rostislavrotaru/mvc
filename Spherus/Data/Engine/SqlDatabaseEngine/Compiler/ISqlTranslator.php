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
		 * Sets the open bracket symbol.
		 * @param string $openBracket The open bracket symbol to set.
		 *
		 * @var string
		 */
		public function setOpenBracket($openBracket);
		
		/**
		 * Gets the close bracket symbol.
		 *
		 * @var string
		 */
		public function getCloseBracket();
		
		/**
		 * Sets the close bracket symbol.
		 * @param string $closeBracket The close bracket symbol to set.
		 *
		 * @var string
		*/
		public function setCloseBracket($closeBracket);
				
		/**
		 * Gets the quote symbol
		 *
		 * @var string
		 */
		public function getQuote();
		
		/**
		 * Sets the quote symbol.
		 * @param string $quoteSymbol The quote symbol to set.
		 *
		 * @var string
		*/
		public function setQuote($quote);
		
		/**
		 * Gets the opening parenthesis symbol
		 *
		 * @var string
		 */
		public function getOpeningParenthesis();
		
		/**
		 * Sets the opening parenthesis symbol.
		 * @param string $openingParenthesis The opening parenthesis symbol to set.
		 *
		 * @var string
		*/
		public function setOpeningParenthesis($openingParenthesis);
		
		/**
		 * Gets the closing parenthesis symbol
		 *
		 * @var string
		 */
		public function getClosingParenthesis();
		
		/**
		 * Sets the closing parenthesis symbol.
		 * @param string $closingParenthesis The closing parenthesis symbol to set.
		 *
		 * @var string
		*/
		public function setClosingParenthesis($closingParenthesis);
		
		/**
		 * Gets the column delimiter symbol
		 *
		 * @var string
		 */
		public function getColumnDelimiter();
		
		/**
		 * Sets the column delimiter symbol
		 * @param string $columnDelimiter The column delimiter symbol to set.
		 *
		 * @var string
		*/
		public function setColumnDelimiter($columnDelimiter);
		
		/**
		 * Gets the argument delimiter symbol
		 *
		 * @var string
		 */
		public function getArgumentDelimiter();
		
		/**
		 * Sets the argument delimiter symbol
		 * @param string $argumentDelimiter The argument delimiter symbol to set.
		 *
		 * @var string
		*/
		public function setArgumentDelimiter($argumentDelimiter);
		
		/**
		 * Gets the asterisk symbol
		 *
		 * @var string
		 */
		public function getAsterisk();
		
		/**
		 * Sets the asterisk symbol
		 * @param string $asterisk The asterisk symbol to set.
		 *
		 * @var string
		*/
		public function setAsterisc($asterisk);

		/**
		 * Gets the batch begin symbol
		 *
		 * @var string
		 */
		public function getBatchBegin();
		
		/**
		 * Sets the batch begin symbol
		 * @param string $batchBegin The batch begin symbol to set.
		 *
		 * @var string
		*/
		public function setBatchBegin($batchBegin);
		
		/**
		 * Gets the batch end symbol
		 *
		 * @var string
		 */
		public function getBatchEnd();
		
		/**
		 * Sets the batch end symbol
		 * @param string $batchEnd The batch end symbol to set.
		 *
		 * @var string
		*/
		public function setBatchEnd($batchEnd);
		
		/**
		 * Gets the batch delimiter symbol
		 *
		 * @var string
		 */
		public function getBatchDelimiter();
		
		/**
		 * Sets the batch delimiter symbol
		 * @param string $batchDelimiter The batch delimiter symbol to set.
		 *
		 * @var string
		*/
		public function setBatchDelimiter($batchDelimiter);

		
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
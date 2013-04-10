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
	class SqlTranslator implements ISqlTranslator
	{
		
		/* FIELDS */
		
		/**
		 * Defines the open bracket symbol.
		 * 
		 * @var string
		 */
		private $openBracket = '[';
		
		/**
		 * Defines the close bracket symbol.
		 * 
		 * @var string
		 */
		private $closeBracket = ']';
		
		/**
		 * Defines the quote symbol.
		 * @var string
		 */
		private $quote = '\'';
		
		/**
		 * Defines the opening parenthesis symbol.
		 * @var string
		 */
		private $openingParenthesis = '(';
		
		/**
		 * Defines the closing parenthesis symbol.
		 * @var string
		 */
		private $closingParenthesis = ')';
		
		/**
		 * Defines the Column delimiter symbol.
		 * @var string
		 */
		private $columnDelimiter = ',';
		
		/**
		 * Defines the argument delimiter symbol.
		 * @var string
		 */
		private $argumentDelimiter = ',';
		
		/**
		 * Defines the asterisc symbol
		 * @var string
		 */
		private $asterisk = '*';
		
		/**
		 * Defines the begin batch symbol
		 * @var string
		 */
		private $batchBegin = null;
		
		/**
		 * Defines the end batch symbol
		 * @var string
		 */
		private $batchEnd = null;
		
		/**
		 * Defines the delimiter batch symbol
		 * @var string
		 */
		private $batchDelimiter = ';';
		
		
		/* PROPERTIES */
		
		/* (non-PHPdoc)
		 * @see ISqlTranslator::getOpenBracket()
		*/
		public function getOpenBracket() 
		{
			return $this->openBracket;		
		}
		
		/* (non-PHPdoc)
		 * @see \Spherus\Data\Engine\SqlDatabaseEngine\Compiler\ISqlTranslator::setOpenBracket()
		*/
		public function setOpenBracket($openBracket) 
		{
			$this->openBracket = $openBracket;
		}
		
		/* (non-PHPdoc)
		 * @see \Spherus\Data\Engine\SqlDatabaseEngine\Compiler\ISqlTranslator::getCloseBracket()
		*/
		public function getCloseBracket() 
		{
			return $this->closeBracket;
		}
		
		/* (non-PHPdoc)
		 * @see \Spherus\Data\Engine\SqlDatabaseEngine\Compiler\ISqlTranslator::setCloseBracket()
		*/
		public function setCloseBracket($closeBracket) 
		{
			$this->closeBracket = $closeBracket;
		}
		
		/* (non-PHPdoc)
		 * @see \Spherus\Data\Engine\SqlDatabaseEngine\Compiler\ISqlTranslator::getQuote()
		*/
		public function getQuote() 
		{
			return $this->quote;
		}
		
		/* (non-PHPdoc)
		 * @see \Spherus\Data\Engine\SqlDatabaseEngine\Compiler\ISqlTranslator::setQuote()
		*/
		public function setQuote($quote) 
		{
			$this->quote = $quote;
		}
		
		/* (non-PHPdoc)
		 * @see \Spherus\Data\Engine\SqlDatabaseEngine\Compiler\ISqlTranslator::getOpeningParenthesis()
		*/
		public function getOpeningParenthesis() 
		{
			return $this->openingParenthesis;
		}
		
		/* (non-PHPdoc)
		 * @see \Spherus\Data\Engine\SqlDatabaseEngine\Compiler\ISqlTranslator::setOpeningParenthesis()
		*/
		public function setOpeningParenthesis($openingParenthesis) 
		{
			$this->openingParenthesis = $openingParenthesis;
		}
		
		/* (non-PHPdoc)
		 * @see \Spherus\Data\Engine\SqlDatabaseEngine\Compiler\ISqlTranslator::getClosingParenthesis()
		*/
		public function getClosingParenthesis() 
		{
			return $this->closingParenthesis;
		}
		
		/* (non-PHPdoc)
		 * @see \Spherus\Data\Engine\SqlDatabaseEngine\Compiler\ISqlTranslator::setClosingParenthesis()
		*/
		public function setClosingParenthesis($closingParenthesis) 
		{
			return $this->closingParenthesis;
		}
		
		/* (non-PHPdoc)
		 * @see \Spherus\Data\Engine\SqlDatabaseEngine\Compiler\ISqlTranslator::getColumnDelimiter()
		*/
		public function getColumnDelimiter() 
		{
			return $this->columnDelimiter;
		}
		
		/* (non-PHPdoc)
		 * @see \Spherus\Data\Engine\SqlDatabaseEngine\Compiler\ISqlTranslator::setColumnDelimiter()
		*/
		public function setColumnDelimiter($columnDelimiter) 
		{
			$this->columnDelimiter = $columnDelimiter;
		}
		
		/* (non-PHPdoc)
		 * @see \Spherus\Data\Engine\SqlDatabaseEngine\Compiler\ISqlTranslator::getArgumentDelimiter()
		*/
		public function getArgumentDelimiter() 
		{
			return $this->argumentDelimiter;
		}
		
		/* (non-PHPdoc)
		 * @see \Spherus\Data\Engine\SqlDatabaseEngine\Compiler\ISqlTranslator::setArgumentDelimiter()
		*/
		public function setArgumentDelimiter($argumentDelimiter) 
		{
			$this->argumentDelimiter = $argumentDelimiter;
		}
		
		/* (non-PHPdoc)
		 * @see \Spherus\Data\Engine\SqlDatabaseEngine\Compiler\ISqlTranslator::getAsterisk()
		*/
		public function getAsterisk() 
		{
			return $this->asterisk;
		}
		
		/* (non-PHPdoc)
		 * @see \Spherus\Data\Engine\SqlDatabaseEngine\Compiler\ISqlTranslator::setAsterisc()
		*/
		public function setAsterisc($asterisk) 
		{
			$this->asterisk = $asterisk;
		}
		
		/* (non-PHPdoc)
		 * @see \Spherus\Data\Engine\SqlDatabaseEngine\Compiler\ISqlTranslator::getBatchBegin()
		*/
		public function getBatchBegin() 
		{
			return $this->batchBegin;
		}
		
		/* (non-PHPdoc)
		 * @see \Spherus\Data\Engine\SqlDatabaseEngine\Compiler\ISqlTranslator::setBatchBegin()
		*/
		public function setBatchBegin($batchBegin) 
		{
			$this->batchBegin = $batchBegin;
		}
		
		/* (non-PHPdoc)
		 * @see \Spherus\Data\Engine\SqlDatabaseEngine\Compiler\ISqlTranslator::getBatchEnd()
		*/
		public function getBatchEnd() 
		{
			return $this->batchEnd;
		}
		
		/* (non-PHPdoc)
		 * @see \Spherus\Data\Engine\SqlDatabaseEngine\Compiler\ISqlTranslator::setBatchEnd()
		*/
		public function setBatchEnd($batchEnd) 
		{
			$this->batchEnd = $batchEnd;
		}
		
		/* (non-PHPdoc)
		 * @see \Spherus\Data\Engine\SqlDatabaseEngine\Compiler\ISqlTranslator::getBatchDelimiter()
		*/
		public function getBatchDelimiter() 
		{
			return $this->batchDelimiter;
		}
		
		/* (non-PHPdoc)
		 * @see \Spherus\Data\Engine\SqlDatabaseEngine\Compiler\ISqlTranslator::setBatchDelimiter()
		*/
		public function setBatchDelimiter($batchDelimiter) 
		{
			$this->batchDelimiter = $batchDelimiter;
		}
		
		
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
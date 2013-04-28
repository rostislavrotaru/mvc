<?php

	/**
	 * Redistributions of files must retain the above copyright notice.
	 *
	 * @copyright SPHERUS (http://spherus.net)
	 * @license http://license.spherus.net
	 * @link http://spherus.net
	 * @since 3.0
	 */
	namespace Spherus\Core\Base;
	
	use Spherus\Core\Check;
	use Spherus\Core\SpherusException;
	
	/**
	 * Class that represents the base for all application components
	 *
	 * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
	 * @package spherus.core.base
	 */
	abstract class ComponentBase
	{
		
		/**
		 * Initializes a new instance of ComponentBase class
		 * 
		 * @param string $name The name of component
		 */
		public function __construct($name)
		{
			$this->setName($name);
		}
		
		/* FIELDS */
		
		/**
		 * Defines the component name.
		 * 
		 * @var string
		 */
		private $name = null;
		
		/**
		 * Defines an array of depending ComponentBase objects.
		 *
		 * @var array
		 */
		private $dependingComponents = []; 
		
		/**
		 * Determine the ComponentBase version.
		 * @var string
		 */
		private $version = null; 
		
		/**
		 * Determine the ComponentBase author.
		 * @var string
		 */
		private $author = null;
		
		/**
		 * Determine the ComponentBase description.
		 * @var string
		 */
		private $description = null;
		

		/* PROPERTIES */
	
		/**
		 * Gets the component name.
		 * 
		 * @var string
		 */
		public function getName()
		{
			return $this->name;
		}
	
		/**
		 * Sets the component name.
		 * 
		 * @param string $name The component name
		 * @throws SpherusException When $name parameter is null or empty.
		 */
		public function setName($name)
		{
			Check::IsNullOrEmpty($name);
			$this->name = $name;
		}
	
		/**
		 * Gets an array of depending ComponentBase objects.
		 * 
		 * @return array
		 */
		public function getDependingComponents()
		{
			return $this->dependingComponents;
		}
	
		/**
		 * Gets an array of depending ComponentBase objects.
		 * 
		 * @param $dependingComponents an array of ComponentBase objects.
		 */
		public function setDependingComponents($dependingComponents)
		{
			$this->dependingComponents = $dependingComponents;
		}

		/**
		 * Gets the ComponentBase version.
		 * @return string
		 */
		public function getVersion()
		{
			return $this->version;
		}
		
		/**
		 * Sets the ComponentBase version.
		 * 
		 * @param string $version The version of ComponentBase to set.
		 */
		public function setVersion($version)
		{
			$this->version = $version;
		}
		
		/**
		 * Gets the ComponentBase author.
		 * @return string
		 */
		public function getAuthor()
		{
			return $this->author;
		}
		
		/**
		 * Sets the ComponentBase author.
		 *
		 * @param string $author The author of ComponentBase to set.
		 */
		public function setAuthor($author)
		{
			$this->author = $author;
		}
		
		/**
		 * Gets the ComponentBase description.
		 * @return string
		 */
		public function getDescription()
		{
			return $this->description;
		}
		
		/**
		 * Sets the ComponentBase description.
		 *
		 * @param string $description The description of ComponentBase to set.
		 */
		public function setDescription($description)
		{
			$this->description = $description;
		}
		

		/* PUBLIC FUNCTIONS */
		
		/**
		 * Adds depending component
		 * 
		 * @param ComponentBase $dependingComponent The depending component to add.
		 * @throws SpherusException When component with the same name already loaded.s
		 */
		public function AddDependingComponent(ComponentBase $dependingComponent)
		{
			Check::IsNullOrEmpty($dependingComponent);
			
			if($this->GetDependingComponentByName($dependingComponent->getName()) == null)
			{
				$this->dependingComponents[] = $dependingComponent;
			}
			else 
			{
				throw new SpherusException(printf(EXCEPTION_COMPONENT_ALREADY_LOADED, $dependingComponent->getName()));
			}
		}
		
		
		/* PRIVATE FUNCTIONS*/
		
		/**
		 * Gets depending component by name.
		 * 
		 * @param string $name The component name to search.
		 * @return ComponentBase|NULL Found ComponentBase object or null
		 */
		private function GetDependingComponentByName($name)
		{
			foreach($this->dependingComponents as $component)
			{
				if(strtolower($component->getName()) === strtolower($name))
				{
					return $component;
				}
			}
			
			return null;
		}
	
	}
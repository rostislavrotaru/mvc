<?php

	/**
	 * Redistributions of files must retain the above copyright notice.
	 *
	 * @copyright SPHERUS (http://spherus.net)
	 * @license http://license.spherus.net
	 * @link http://spherus.net
	 * @since 3.0
	 */
	namespace Spherus\Parsers;

	use Spherus\HttpContext\Request;
	use Spherus\Core\SpherusException;
	use App\Common\IpFilter;

	/**
	 * Represents the framework IP filtratioin functionality
	 *
	 * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
	 * @package spherus.parsers
	 */
	class IpFilterParser
	{

		/* PUBLIC FUNCTIONS */

		/**
		 * Parses ip according to ip filter
		 */
		public static function Parse()
		{
			if(!(self::CheckAllowed()))
			{
				throw new SpherusException(EXCEPTION_ACCESS_DENIED);
			}
		}

		/* PRIVATE FUNCTIONS */

		/**
		 * Checks if remote address allowed or denied
		 *
		 * @return boolean true if ip allowed, otherwise false
		 */
		private static function CheckAllowed()
		{
			// Check if remote address is allowed
			$allow = IpFilter::getAllow();
			if(isset($allow))
			{
				foreach($allow as $element)
				{
					if(($element==Request::getRemoteAddress())||($element=='all'))
					{
						return true;
					}
				}
			}

			// if remote address not found - check deny permissions
			$deny = IpFilter::getDeny();
			if(isset($deny))
			{
				foreach($deny as $element)
				{
					if(($element==Request::getRemoteAddress())||($element=='all'))
					{
						return false;
					}
				}
			}

			return true;
		}
	}
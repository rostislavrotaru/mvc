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
	/* FIELDS */

	/**
	 * Regular expression for IpV4, wildcard allowed
	 *
	 * @var string
	 */
	private static $ipFilterV4 = '#((\d{1,3}|\*)(\.(\d{1,3}|\*)){1,3}|\*)#';

	/**
	 * Regular expression for IpV6
	 *
	 * @var string
	 */
	private static $ipFilterV6 = '#\s*((([0-9A-Fa-f]{1,4}:){7}([0-9A-Fa-f]{1,4}|:))|(([0-9A-Fa-f]{1,4}:){6}(:[0-9A-Fa-f]{1,4}|((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3})|:))|(([0-9A-Fa-f]{1,4}:){5}(((:[0-9A-Fa-f]{1,4}){1,2})|:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3})|:))|(([0-9A-Fa-f]{1,4}:){4}(((:[0-9A-Fa-f]{1,4}){1,3})|((:[0-9A-Fa-f]{1,4})?:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:))|(([0-9A-Fa-f]{1,4}:){3}(((:[0-9A-Fa-f]{1,4}){1,4})|((:[0-9A-Fa-f]{1,4}){0,2}:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:))|(([0-9A-Fa-f]{1,4}:){2}(((:[0-9A-Fa-f]{1,4}){1,5})|((:[0-9A-Fa-f]{1,4}){0,3}:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:))|(([0-9A-Fa-f]{1,4}:){1}(((:[0-9A-Fa-f]{1,4}){1,6})|((:[0-9A-Fa-f]{1,4}){0,4}:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:))|(:(((:[0-9A-Fa-f]{1,4}){1,7})|((:[0-9A-Fa-f]{1,4}){0,5}:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:)))(%.+)?\s*#';


	/* PUBLIC FUNCTIONS */

	/**
	 * Parse ip's according to ip filters
	 */
	public static function Parse()
	{
		$allowedIpAddresses = IpFilter::getAllow();
		$result  = false;
		if(isset($allowedIpAddresses))
		{
			$result = self::CheckIpExistence($allowedIpAddresses);
		}

		$deniedIpAddresses = IpFilter::getDeny();
		if(isset($deniedIpAddresses))
		{
			$result = !self::CheckIpExistence($deniedIpAddresses);
		}

		if($result === false)
		{
			throw new SpherusException(EXCEPTION_ACCESS_DENIED);
		}
	}

	/* PRIVATE FUNCTIONS */

	/**
	 * Checks if IP is a valid V4 or V6 IP and Match it from the list
	 *
	 * @param array $ipAddressesList Array of IP addresses to check.
	 *
	 * @return boolean TRUE if exists, otherwise FALSE.
	 */
	private static function CheckIpExistence($ipAddressesList)
	{
		foreach($ipAddressesList as $ipAddress)
		{
			$regex = preg_match_all(self::$ipFilterV4, $ipAddress, $ip);
			if($regex !== false && $regex > 0)
			{
				$ip = $ip[0][0];
				if (self::MatchIp($ip, Request::getRemoteAddress()))
				{
					return true;
				}
			}

			$regex = preg_match_all(self::$ipFilterV6, $ipAddress, $ip);
			if($regex !== false && $regex > 0)
			{
				$ip = $ip[0][0];
				if (self::MatchIp($ip, Request::getRemoteAddress()))
				{
					return true;
				}
			}
		}

		return false;
	}

	/**
	 * Match IP address according to the given parrtern
	 *
	 * @param string $pattern the patern to match
	 * @param string $string The IP Address (can contain wilcards).
	 *
	 * @return boolean TRUE if match, otherwise FALSE.
	 */
	private static function MatchIp($pattern, $string)
	{
		$regex = '/^'.strtr(addcslashes($pattern, '.+^$(){}=!<>|'), array('*' => '.*','?' => '.?')).'$/i';
		return (boolean)@preg_match($regex, $string);
	}
}
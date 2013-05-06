<?php

/**
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright SPHERUS (http://spherus.net)
 * @license http://license.spherus.net
 * @link http://spherus.net
 * @since 3.0
 */
namespace Spherus\Common;

use Spherus\Core\Check;
use Spherus\Core\SpherusException;

/**
 * Class that represents the zip files functionality
 *
 * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
 * @package spherus.common
 */
class Zip
{

	/* PUBLIC FUNCTIONS */
	

	/**
	 * Extracts the archive file
	 * 
	 * @param string $fileName The filename to extract.
	 * @param string $destination The destination. Optional.
	 * 
	 * @throws SpherusException When extraction error occured.
	 */
	public static function Unzip($fileName, $destination = null)
	{
		Check::PhpExtensionIsLoaded('zlib');
		Check::FileIsReadable($fileName);
		
		$archivedFile = new \ZipArchive();
		if($archivedFile->open($fileName, \ZIPARCHIVE::CREATE) === true)
		{
			if(!isset($destination))
			{
				$destination = pathinfo($fileName, PATHINFO_DIRNAME).'/'.pathinfo($fileName, PATHINFO_FILENAME);
			}
			$archivedFile->extractTo($destination);
			$archivedFile->close();
		}
		else 
		{
			throw new SpherusException(printf(EXCEPTION_FAILED_ARCHIVE_EXTRACTION, $fileName));
		}
	}
}
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

/**
 * Class that represents the files and folders functionality
 *
 * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
 * @author Sergey Calugher (SlKelevro@gmail.com)
 * @package spherus.common
 */
class FileSystem
{

	/* PUBLIC FUNCTIONS */
	
	/**
	 * Check if file exists
	 *
	 * @param string $fileName The path and name of file
	 * @return boolean True if file exists, otherwise False
	 */
	public static function FileExists($fileName)
	{
		$fileName = str_ireplace('\\', '/', $fileName);
		return file_exists($fileName);
	}

	/**
	 * Lists directory content, including folder and files
	 *
	 * @param string $path. The path to the directory
	 * @param boolean $includeHiddenFiles Defines whether hidden files should be included. Default is false. Optional.
	 * @return array Array of directory and folder names
	 */
	public static function ReadDirectoryContent($path, $includeHiddenFiles = false)
	{
		return self::ReadDirectory($path, $includeHiddenFiles, true, true);
	}

	/**
	 * Lists directory folders
	 *
	 * @param string $path. The path to the directory
	 * @param boolean $includeHiddenFiles Defines whether hidden files should be included. Default is false. Optional.
	 * @return array Array of directory names
	 */
	public static function ListDirectoryFolders($path, $includeHiddenFiles = false)
	{
		return self::ReadDirectory($path, $includeHiddenFiles, true, false);
	}

	/**
	 * Lists directory files
	 *
	 * @param string $path. The path to the directory
	 * @param boolean $includeHiddenFiles Defines whether hidden files should be included. Default is false. Optional.
	 * @return array Array of directory names
	 */
	public static function ListDirectoryFiles($path, $includeHiddenFiles = false)
	{
		return self::ReadDirectory($path, $includeHiddenFiles, false, true);
	}

	/* PRIVATE FUNCTIONS */

	/**
	 * Reads directory for folders and files
	 *
	 * @param string $path. The path to the directory
	 * @param boolean $includeHiddenFiles Defines whether hidden files should be included. Default is false. Optional.
	 * @param boolean $readDirectories Defines whether directories should be included. Default is true. Optional.
	 * @param boolean $readFiles Defines whether files should be included. Default is true. Optional.
	 * @return array NULL of directory and folder names
	 */
	private static function ReadDirectory($path, $includeHiddenFiles = false, $readDirectories = true, $readFiles = true)
	{
		$result = [];

		if (!$readFiles && !$readDirectories)
		{
			return $result;
		}

		$flags = $includeHiddenFiles
				? \FilesystemIterator::SKIP_DOTS | \FilesystemIterator::KEY_AS_FILENAME
				: \FilesystemIterator::KEY_AS_FILENAME;

		$iterator = new \FilesystemIterator($path, $flags);

		while($iterator->valid())
		{
			if($readFiles)
			{
				$iterator->isFile() ? $result['files'][] = $iterator->getFilename() : null;
			}
			if($readDirectories)
			{
				$iterator->isDir() ? $result['folders'][] = $iterator->getFilename() : null;
			}
			$iterator->next();
		}
		unset($iterator);

		return $result;
	}
}
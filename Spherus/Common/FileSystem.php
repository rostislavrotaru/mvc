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
 * @package spherus.core
 */
class FileSystem
{

	/* PUBLIC FUNCTIONS */

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
		$iterator = new \DirectoryIterator($path);

		if (!$readFiles && !$readDirectories)
		{
			return $result;
		}

		if ($includeHiddenFiles)
		{
			foreach ($iterator as $fileinfo)
			{
				if ($fileinfo->isFile() && $readFiles)
				{
					$result['files'][] = $fileinfo->getFilename();
				}
				elseif ($fileinfo->isDir() && $readDirectories)
				{
					$result['folders'][] = $fileinfo->getFilename();
				}
			}
		}
		else
		{
			foreach ($iterator as $fileinfo)
			{
				if ($fileinfo->isDot())
				{
					continue;
				}
				if ($fileinfo->isFile() && $readFiles)
				{
					$result['files'][] = $fileinfo->getFilename();
				}
				elseif ($fileinfo->isDir() && $readDirectories)
				{
					$result['folders'][] = $fileinfo->getFilename();
				}
			}
		}

		return $result;
	}
}
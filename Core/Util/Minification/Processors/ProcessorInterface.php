<?php
/**
 * Minification Processor interface Class
 * 
 * @dependencies 	\Core\Util\Minification\Processors\*
 * @author 			Avi Aialon <aviaialon@gmail.com>
 * @package			Core
 * @subpackage		Util
 * @category		Core Utilities
 * @version 		2.0.0
 * @copyright 		(c) 2010 Deviant Logic. All Rights Reserved
 * @license 		CC Attribution-ShareAlike 3.0 Unported (CC BY-SA 3.0) - http://creativecommons.org/licenses/by-sa/3.0/
 * @link			SVN: $HeadURL$
 * @since			12:35:53 PM
 * @example			See below
 * @throws			\Exception
 */

namespace Core\Util\Minification\Processors;

/**
 * Minification Processor interface Class
 *
 * This class controls the Minification scope
 *
 * @namespace    Core
 * @package      Net
 * @subpackage   none
 * @author       Avi Aialon <aviaialon@gmail.com>
 * @copyright    2012 Canspan. All Rights Reserved
 * @license      http://www.canspan.com/license
 * @version      SVN: $Id$
 * @link         SVN: $HeadURL$
 * @since        12:35:53 AM
 *
 */
interface ProcessorInterface
{
	/**
	 * This method RETURN AN OBJCT INSTANCE
	 *
	 * @access	public static
	 * @param 	NONE
	 * @return 	OBJECT
	 */
	public static function getInstance();

	/**
	 * This method minifies content
	 *
	 * @access	public static
	 * @param 	string $strContent	- The File Content.
	 * @return 	string
	 */
	public function minify		($strContent = NULL);

	/**
	 * This method minifies a single file
	 *
	 * @access	public static
	 * @param 	string $strContent	- The File Path.
	 * @return 	string
	 */
	public function minifyFile	($strFilepath = NULL);

	/**
	 * This method minifies Multiple files
	 *
	 * @access	public static
	 * @param 	array $arrFiles	- The File Array.
	 * @return 	string
	 */
	public function minifyFiles	(array  $arrFiles = NULL);
}
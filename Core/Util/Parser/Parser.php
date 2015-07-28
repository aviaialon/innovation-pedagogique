<?php 
/**
 * String parser Util Class
 * 
 * @dependencies 	None
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

namespace Core\Util\Parser;

/**
 * String parser Util Class
 * 
 * @dependencies 	None
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
class Parser 
    extends \Core\Interfaces\Base\ObjectBaseInterface
{
	/**
	 * Data to parse
	 *
	 * @var array
	 */
	protected $arrData = array();
	
	
	/**
	 * Parser constructor. Create parser object and initialise object with array('name' => 'Yanik', 'domain' => 'www.privatefeeds.com')
	 *
	 * @param  array $attarrData (Optional) the data to parse
	 * @return \Core\Util\Parser\Parser
	 */
	public static final function getInstance(array $attarrData = array()) 
	{
		$_parser = new \Core\Util\Parser\Parser();
		$_parser->setData($attarrData);
		
		return $_parser;
	}
	
	/**
	 * This method will return all available variable for the string it receive in an array
	 *
	 * @param  string $strToParse
	 * @return array
	 */
	public final function getAvailableVariable($strToParse) 
	{
		$arrMatch  = array();
		$arrReturn = array();

		preg_match_all("/%%(\w+)%%/i", $strToParse, $arrMatch);
		
		if(is_array($arrMatch[1])) {
			$arrReturn = $arrMatch[1];
		}
		
		return $arrReturn;
	}
	
	/**
	 * Set object data with specified array use array like array('name' => 'Yanik', 'domain' => 'www.privatefeeds.com')
	 *
	 * @param  array $attarrData (Optional) Sets the data to parse
	 * @return \Core\Util\Parser\Parser
	 */
	public function setData(array $attarrData = array())
	{
		if (empty($attarrData) === false) {
			$this->arrData = array_change_key_case($attarrData, CASE_UPPER);
		}
		
		return $this;
	}

	/**
	 * Parser call back method. For internal use. 
	 *
	 * @param  array  $attarrData The data to parse
	 * @return string
	 */
	protected final function _parseCallBack($attarrData) 
	{
		return (isset($this->arrData[strtoupper($attarrData[1])]) === true ? $this->arrData[strtoupper($attarrData[1])] : false);
	}

	/**
	 * Parse method. 
	 *
	 * @param mixed  $attMixedTemplate "Hi %%NAME%%, your domain is : %%DOMAIN%%"
	 * @return mixed "Hi Yanik, your domain is : www.privatefeeds.com"
	 */
	public final function parse($attMixedTemplate) 
	{
		return preg_replace_callback('(%%(\w+)%%)', array($this, '_parseCallBack'), $attMixedTemplate);
	}

	/**
	 * Array form string. 
	 *
	 * @param string $attstrTemplate "name=%%NAME%%&domain=%%DOMAIN%%"
	 * @return array ('name' => 'Yanik', 'domain' => 'www.privatefeeds.com')
	 */
	public final function getArrayFromString($attstrTemplate) 
	{
		$attstrTemplate = preg_replace('(%%(\w+)%%)', '##$1##', $attstrTemplate);
		parse_str($attstrTemplate, $arrReturn);
		$arrReturn = preg_replace('(##(\w+)##)', '%%$1%%', $arrReturn);
		
		return $this->parse($arrReturn);
	}
}
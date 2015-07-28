<?php 
namespace Core\Hybernate\Page;
/**
 * Page Content management used with Hybernate loader
 *
 * @package    Core
 * @subpackage Interfaces
 * @file       Core/Interfaces/Base/HybernateBaseInterface.php
 * @desc       Used interface for ORM implementations
 * @author     Avi Aialon
 * @license    BSD/GPLv2
 *
 * copyright (c) Avi Aialon (DeviantLogic)
 * This source file is subject to the BSD/GPLv2 License that is bundled
 * with this source code in the file license.txt.
 */
class Page_Content extends \Core\Interfaces\HybernateInterface 
{
	/**
     * Returns the parsed content
     *
     * @access public
     * @throws \Exception
     * @return mixed
     */
    public final function getParsedContent()
    {
		$content = '';
		
		if ($this->getId() > 0) {
			$content = $this->getContent();
			
			if (empty($content) === false) {
				$content = str_replace('<php>', '<?php ', $content);
				$content = str_replace('</php>', ' ?>', $content);
				$content = str_replace('<javascript>', '<script type="text/javascript">', $content);
				$content = str_replace('</javascript>', '</script>', $content);
				ob_start(); eval('?>' . utf8_encode($content));
				$content = ob_get_clean();	
			}
		}
		
		return $content;
	}
}
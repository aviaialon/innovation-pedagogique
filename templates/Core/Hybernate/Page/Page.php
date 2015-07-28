<?php 
namespace Core\Hybernate\Page;
/**
 * Page management used with Hybernate loader
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
class Page extends \Core\Interfaces\HybernateInterface 
{
	/**
	 * Variables to exclude from save
	 * 
	 * @var array
	 */
	protected $_excludeFields = array('pagecontent');
	
	/**
	 * Called after the getInstance
	 *
	 * @access protected
	 * @param  mixed $identifier identifier passed to get instance
	 * @return \Core\Interfaces\Base\HybernateBaseInterface
	 */
	protected function onGetInstance($identifier = null)
	{
		$this->setPageContent(array());
		
		$Application = \Core\Application::getInstance();
			
		foreach ($Application->getConfigs()->get('Application.core.available.langs') as $lang) {
			$this->addPageContent($lang, \Core\Hybernate\Page\Page_Content::getInstance(array(
					'lang' 		=> $lang, 
					'page_id' 	=> (int) $this->getId()
			)));				
		}	
	}
	
	/**
	 * Returns the current page according to the MVC path
	 * 
	 * @return \Core\Hybernate\Page\Page
	 */
	public static final function getCurrentPage()
	{
		return \Core\Hybernate\Page\Page::getInstance(array(
			'url' => \Core\Net\Url::getCanonicalPath()	
		));
	}
}
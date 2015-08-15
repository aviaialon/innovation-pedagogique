<?php
/**
 * Projects Controller
 *
 * @package    Controller
 * @subpackage None
 * @file       Admin/ApiControler.php
 * @desc       Used interface for base objects implementations
 * @author     Avi Aialon
 * @license    BSD/GPLv2
 *
 * copyright (c) Avi Aialon (DeviantLogic)
 * This source file is subject to the BSD/GPLv2 License that is bundled
 * with this source code in the file license.txt.
 */

namespace Ipm\Mvc\Controller;

/**
 * Base controller for Projects section
 *
 * @package    Controller
 * @subpackage None
 * @file       Admin/IndexControler.php
 * @desc       Used interface for base objects implementations
 * @author     Avi Aialon
 * @license    BSD/GPLv2
 *
 * copyright (c) Avi Aialon (DeviantLogic)
 * This source file is subject to the BSD/GPLv2 License that is bundled
 * with this source code in the file license.txt.
 */

class ProjectsController
    extends \Core\Net\HttpRequest
{
   /**
    * Projects index action
    *
    * @return void
    */
   public final function indexAction(array $requestDispatchData)
   {
		$Application = \Core\Application::getInstance();
		$category    = \Core\Hybernate\Products\Product_Category::getInstance((int) $this->getRequestParam('category', 0));
		$amtperPage  = 9;
		
		if ((int) $category->getId() > 0) {
			$pagination  = \Core\Hybernate\Products\Product::searchByCategoryId((int) $category->getId(), $amtperPage);
		} else {
			$pagination   = \Core\Hybernate\Products\Product::search($this->getRequestParam('q', null), array(
				'amtPerPage'	=> $amtperPage
			));
		}
		
		$this->setViewData('categoryTree', \Core\Hybernate\Products\Product_Category::getSortedCategoryTree('a.id ASC'));
		$this->setViewData('category', \Core\Hybernate\Products\Product_Category::getInstance((int) $category->getId()));
		$this->setViewData('pagination', $pagination);
   }
}
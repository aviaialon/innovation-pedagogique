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
		$pagination  = \Core\Hybernate\Products\Product::search($this->getRequestParam('q', null), array(
			'amtPerPage'  => $amtperPage,
			'categoryIds' => (int) $category->getId(),
			'minAge'	  => (int) $this->getRequestParam('min-age', 0),
			'maxAge'	  => (int) $this->getRequestParam('max-age', 0),
			'year'	      => (int) $this->getRequestParam('year', 0)
		));
		
		$this->setViewData('categoryTree', \Core\Hybernate\Products\Product_Category::getSortedCategoryTree('a.id ASC'));
		$this->setViewData('category', \Core\Hybernate\Products\Product_Category::getInstance((int) $category->getId()));
		$this->setViewData('pagination', $pagination);
   }
   
   /**
    * Projects wishlist action
    *
    * @return void
    */
   public final function wishlistAction(array $requestDispatchData)
   {
	   \Core\Inp\Products\Product_Wishlist::sendEmail();
	   $this->setViewData('wishlist', \Core\Inp\Products\Product_Wishlist::getInstance()->getAll());
   }
   
   /**
    * Projects detail action
    *
    * @return void
    */
   public final function detailAction(array $requestDispatchData)
   {
	   \Core\Inp\Products\Product_Wishlist::sendProductInquiryEmail();
	   
	   $path      = $this->getMvcRequest('mvcPath');
	   $pathData  = explode('/', $path);
	   $productId = (int) end($pathData);
	   $product   = \Core\Hybernate\Products\Product::getInstance(array('id' => $productId, 'activeStatus' 	=> 1));
	   
	   if ($product->getId() <= 0) {
			$this->pageNotFound();   
	   }
	   
	   $product->addView();
	   $this->indexAction($requestDispatchData);
	   $this->setViewData('product', $product);
   }
}
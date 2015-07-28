<?php 
namespace Core\King\Products;
/**
 * Products management used with Hybernate loader
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
class Ajax_Search
    extends \Core\Interfaces\Base\ObjectBaseInterface
{
  /**
	* Finds products
	*
	* @access static
	* @param  array $filter What to find and filter
	* @return boolean
	*/
	public static final function findBy(array $filter = array())
	{
		\Core\Application::bootstrapResource('\Core\Hybernate\Products\Product');
		\Core\Application::bootstrapResource('\Core\Hybernate\Products\Product_Description');
		\Core\Application::bootstrapResource('\Core\Hybernate\Products\Product_Image');
		\Core\Application::bootstrapResource('\Core\Hybernate\Products\Product_Image_Position');
		\Core\Application::bootstrapResource('\Core\Hybernate\Products\Product_Attribute');
		\Core\Application::bootstrapResource('\Core\Hybernate\Products\Product_Category');
		\Core\Application::bootstrapResource('\Core\Hybernate\Products\Product_Category_Parent');
		\Core\Application::bootstrapResource('\Core\Hybernate\Products\Product_Manual');
		\Core\Application::bootstrapResource('\Core\Hybernate\Products\Product_Manual_Type');
		\Core\Application::bootstrapResource('\Core\King\Products\Product_Wishlist');
		\Core\Application::bootstrapResource('\Core\Util\Pagination\Pagination');
		\Core\Application::bootstrapResource('\Core\Debug\Dump');
		\Core\Application::bootstrapResource('\Core\Net\Url');
		
		$result = array();
		
		// Search by category id (Used in the ajax see more (http://www.canspanclients.com/dev/king/?page_id=172&cid=88)
		if (false === empty($filter['categoryId'])) {
			$productTemplate = '<div class="relatedBox d-1of4 newResult">' .
							   '<a href="%s"><img src="%s">' .
							   '<p class="keyDisplay">Model: %s</p>' .
							   '<p>%s</p></a></div>';
			
			
			$_GET['page'] = (int) (true === isset($_GET['page']) ? $_GET['page'] : 1);	
			$_GET['ipp']  = (int) (true === isset($filter['ipp']) ? $filter['ipp'] : 10);
			
			$pagination 		   = \Core\Hybernate\Products\Product::searchByCategoryId((int) $filter['categoryId']);
			$result['hasNextPage'] = ($pagination->getCurrentPage() < $pagination->getTotalPages());
			$result['dataHtml']    = ''; 
			
			foreach ($pagination->getPageData() as $product) {
				$productUrl = \Core\Hybernate\Products\Product::getStaticProductUrl($product['id'], $product['title']); 
				$imageUrl   = \Core\Hybernate\Products\Product_Image_Position::getImagePositionWebDirecotryPath(17) . '/' . $product[ 'mainImage'];
				
				$result['dataHtml'] .= sprintf($productTemplate, $productUrl, $imageUrl, $product['productKey'], $product['title']);
			}
		}
		
		// Search by keyword
		if (true === isset($filter['keyword'])) {
			$filter = array(
				'amtPerPage' => 5, 
				'hasParts' 	 => true, 
				'imagePathId' => 1
			);
			
			if (empty($_GET['categoryId']) === false) {
				$filter['parentCategoryIds'] = (int) $_GET['categoryId'];
			}
			
			$result = \Core\Hybernate\Products\Product::search($_GET['keyword'], $filter, false)->getPageData();
		}
		
		
		return $result;
	}
}
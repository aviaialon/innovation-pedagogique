<?php 
namespace Core\Hybernate\Products;
/**
 * Products part management used with Hybernate loader
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
class Product_Part extends \Core\Interfaces\HybernateInterface 
{
	/**
     * This method returns the parts associated to a product
     *
     * @param  \Core\Hybernate\Products\Product $product The product
     * @return array
     */
     public static final function getByProduct(\Core\Hybernate\Products\Product $product)
     {
		 return \Core\Hybernate\Products\Product_Part::getMultiInstance(array('searchProductKey' => $product->getUrlProductKey()), true);
     }
}
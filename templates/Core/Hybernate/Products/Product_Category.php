<?php
namespace Core\Hybernate\Products;

/**
 * Products category used with Hybernate loader
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
class Product_Category extends \Core\Interfaces\HybernateInterface
{
	/**
     * This method is called before delete of a category
     *
     * @return void
     */
    public final function onBeforeDelete()
    {
		if ($this->getId() > 0) {
			$linkedCategories = \Core\Hybernate\Products\Product_Category_Parent::getMultiInstance(array(
				'categoryId' => (int) $this->getId()
			));	
			
			foreach ($linkedCategories as $linkedCategory) {
				$linkedCategory->delete();	
			}
			
			$linkedCategoriesParent = \Core\Hybernate\Products\Product_Category_Parent::getMultiInstance(array(
				'parentCategoryId' => (int) $this->getId()
			));	
			
			foreach ($linkedCategoriesParent as $linkedCategory) {
				$linkedCategory->delete();	
			}
			
			$linkedProductCategories = \Core\Hybernate\Products\Product_Category_Link::getMultiInstance(array(
				'categoryId' => (int) $this->getId()
			));	
			
			foreach ($linkedProductCategories as $linkedProductCategory) {
				$linkedProductCategory->delete();	
			}
		}
	}
	
    /**
     * This method returns the complete category tree
     *
     * @param  boolean $returnArray (optional) Return data as \Core\Hybernate\Products\Product_Category or array
     * @param  string  $orderBy     (optional) The order by field
     * @return array | \Core\Hybernate\Products\Product_Category
     */
    public static final function getCategoryTree($returnArray = true, $orderBy = 'a.orderIndex ASC, a.name_en ASC')
    {
        $categoriesIds    = array();
        $sortedCategories = array();
        $categories       = \Core\Hybernate\Products\Product_Category::getMultiInstance(array(), (bool) $returnArray, array('order_by' => $orderBy));
        $categorieParents = \Core\Hybernate\Products\Product_Category_Parent::getMultiInstance(array(), (bool) $returnArray);

        foreach ($categories as $category) {
            $categoryId = (int)  (true === $returnArray ? $category['id'] : $category->getId());
            $categoriesIds[$categoryId] = $category;
        }

        // Extract the parents
        foreach ($categoriesIds as $categoryId => $category) {
            $isParent  = (bool) (true === $returnArray ? $category['isParent'] : $category->getIsParent());
            if (true === $isParent) {
                $sortedCategories[$categoryId] = $category;
                $sortedCategories[$categoryId]['children'] = array();
            }
        }

        // Extract sub categories
        foreach ($categorieParents as $parentData) {
            $parentId   = (int) (true === $returnArray ? $parentData['parentCategoryId'] : $parentData->getParentCategoryId());
            $categoryId = (int) (true === $returnArray ? $parentData['categoryId'] : $parentData->getCategoryId());
            $sortedCategories[$parentId]['children'][$categoryId] = $categoriesIds[$categoryId];
        }

        unset($categoriesIds);
        unset($categories);
        unset($categorieParents);

        return $sortedCategories;
    }
	
	/**
     * This method returns the complete category tree sorted alphabetically
     *
     * @param  string $orderBy (optional) The order by field
     * @return array
     */
    public static final function getSortedCategoryTree($orderBy = 'a.name_en ASC')
    {
		$dboAccess  = \Core\Hybernate\Products\Product_Category::getInstance();
        $categories = \Core\Hybernate\Products\Product_Category::getMultiInstance(array('isParent' => 1), true, array(
			'order_by' => $orderBy
		));
		
		array_walk($categories, function(&$item) use($orderBy, $returnArray, $dboAccess) {
			$item['children'] = $dboAccess->getDataAccessInterface()->getAll('
					SELECT       a.*
					FROM         product_category_parent AS pcp
					INNER JOIN   product_category AS a
					ON           a.id = pcp.categoryId
					WHERE        pcp.parentCategoryId = :parentId 
					GROUP BY     a.id
					ORDER BY     ' . $orderBy . ';
				 ', array('parentId' => (int) $item['id']));
		});
		
		return $categories;
    }

    /**
     * This method returns the categories associated to a product
     *
     * @param  \Core\Hybernate\Products\Product $product      The product
     * @param  boolean                          $returnArray (optional) Return data as \Core\Hybernate\Products\Product_Category or array
     * @return array | \Core\Hybernate\Products\Product_Category
     */
     public static final function getCategoriesByProduct(\Core\Hybernate\Products\Product $product, $returnArray = true)
     {
         if (false === $returnArray) {
            $product->_dataAccessInterface->setFetchType(\PDO::FETCH_CLASS, __CLASS__);
         }

         return ($product->_dataAccessInterface->getAll('
            SELECT       p2.id as mainCatId,
                         p.id as subCatId,
                         p2.name_en as mainCat_en,
                         p2.name_fr as mainCat_fr,
                         p.name_en as subCat_en,
                         p.name_fr as subCat_fr
            FROM         product_category_link AS pcl
            INNER JOIN   product_category AS p
            ON           p.id = pcl.categoryId
            LEFT JOIN    product_category_parent AS pca
            ON           pca.categoryId = p.id
            LEFT JOIN    product_category AS p2
            ON           p2.id = pca.parentCategoryId
            WHERE        pcl.productId = :productId
            GROUP BY     p2.id, p.id
            ORDER BY     p2.name_en ASC, p.name_en ASC;
         ', array('productId' => (int) $product->getId())));
     }

    /**
     * This method returns the categories associated by a parent categoryId
     *
     * @param  integer $parentCategoryId The parent category id
     * @param  boolean $returnArray      (optional) Return data as \Core\Hybernate\Products\Product_Category or array
     * @return array | \Core\Hybernate\Products\Product_Category
     */
     public static final function getCategoriesByParent($parentCategoryId, $returnArray = true)
     {
         if (false === $returnArray) {
            $product->_dataAccessInterface->setFetchType(\PDO::FETCH_CLASS, __CLASS__);
         }

         return ($product->_dataAccessInterface->getAll('
            SELECT           a.*
            FROM             `product_category` a
            INNER JOIN       `product_category_parent` b
            ON               b.categoryId = a.id
            WHERE            b.parentCategoryId = :categoryId
            GROUP BY         b.categoryId
            ORDER BY         a.name_en ASC, a.name_fr ASC;
         ', array('productId' => (int) $parentCategoryId)));
     }

    /**
     * This method will group a product's categories gathered by self::getCategoriesByProduct
     *
     * @param  \Core\Hybernate\Products\Product $product The product
     * @return array
     */
     public static final function groupCategories(\Core\Hybernate\Products\Product $product)
     {
         $groupCategories = array();

         if (false === $product->getGroupedCategories()) {
             foreach ($product->getCategories() as $categoryArray) {
                 if (empty($groupCategories[$categoryArray['mainCatId']]) === true) {
                    $groupCategories[$categoryArray['mainCatId']] = array(
                        'id'         => $categoryArray['mainCatId'],
                        'name_en'    => $categoryArray['mainCat_en'],
                        'name_fr'    => $categoryArray['mainCat_fr'],
                        'children'    => array()
                     );
                 }

                 $groupCategories[$categoryArray['mainCatId']]['children'][$categoryArray['subCatId']] = array(
                    'id'         => $categoryArray['subCatId'],
                    'name_en'    => $categoryArray['subCat_en'],
                    'name_fr'    => $categoryArray['subCat_fr']
                 );
             }
         }

         return $groupCategories;
     }
}
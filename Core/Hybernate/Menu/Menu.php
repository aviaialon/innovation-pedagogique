<?php
/**
 * Menu management used with Hybernate loader
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
namespace Core\Hybernate\Menu;
/**
 * Menu management used with Hybernate loader
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
class Menu extends \Core\Interfaces\HybernateInterface
{
	/**
     * This Itterates through the menu data recursively
     * @param  array  $menuData          The Menu Data
     * @param  String $fnCallbackFuntion The callback function
	 * @return void
     */
    public static final function Itterator(array $menuData = array(), $fnCallbackFuntion = false)
    {
		if (true === is_callable ($fnCallbackFuntion)) {
			foreach ($menuData as $_key => $_data) {
				call_user_func_array($fnCallbackFuntion, array($_key, $_data));
				
				if (false === empty($_data['children'])) {
					self::ItteratorChildren($_data['children'], $fnCallbackFuntion);
				}
			}
		}
	}
	
    /**
     * This method loads the menu
     * @param Integer $intMenuGroupId  The Menu Group Id
     * @param String  $strCanonicalUrl The current canonical URL
     * @return Array  $arrPageMenuTree The menu Tree
     */
    public static final function getRawMenuData($intMenuGroupId, $strCanonicalUrl = NULL)
    {
        $Application            = \Core\Application::getInstance();
        $objMenuTree            = Menu_Tree::getInstance();
        $arrPageMenu            = array();
        $arrPageMenuTree        = array();
        $objSortedMenu          = new \stdClass();
		$strCurrentCanonicalUrl = ((false === is_null($strCanonicalUrl)) ? $strCanonicalUrl : self::getCurrentCanonicalUrl());

        $arrPageMenu = \Core\Hybernate\Menu\Menu::getObjectClassView(array(
            'cacheQuery'=>     false,
            'filter'     =>    array(
                'group_id'     => (int) $intMenuGroupId
            ),
            'orderBy'    => 'parent_id ASC, position',
            'direction'    => 'ASC'
        ));

        if (false === empty($arrPageMenu))
        {
            foreach ($arrPageMenu as $arrRow)
            {
                $li_attr = array();
                if (false === empty($arrRow['class'])) {
                    $li_attr['class'] = $arrRow['class'];
                }
				
				$blnIsCurrentPage   = false;
                $blnUsedCurrent     = false;
                if (false === empty($strCurrentCanonicalUrl))
                {
                    $strMenuUrl = $arrRow['url'];
                    $strMenuUrl = str_replace($Application->getConfigs()->get('Application.core.base_url'), '/', $strMenuUrl);
                    $strMenuUrl = str_replace('//', '/', $strMenuUrl);
                    $blnIsCurrentPage = $blnUsedCurrent = (bool) ($strCurrentCanonicalUrl === (rtrim($strMenuUrl, '/')));
                }
				
                $objMenuTree->add_row($arrRow['id'], $arrRow['parent_id'], $li_attr, $arrRow['title'], $arrRow['url'], $blnIsCurrentPage);
            }

            $arrPageMenuTree = $objMenuTree->generate_raw_list(0, 'class="menu"');
        }

        return ($arrPageMenuTree);
    }
	
    /**
     * Returns the current canonical URL
     * 
     * @return String
     */
    public static final function getCurrentCanonicalUrl()
    {
    	$strCurrentCanonicalUrl = \Core\Net\Url::getCanonicalUrl(NULL, false, true, true, array(session_name()), false);
    	$strCurrentCanonicalUrl = ((true === empty($strCurrentCanonicalUrl)) ? '/' : $strCurrentCanonicalUrl);
    	
    	if (
    			(false === empty($strCurrentCanonicalUrl)) &&
    			(true === (in_array(substr($strCurrentCanonicalUrl, 0, 3), array('/en', '/fr', '/ch'))))
    	) {
    		$strCurrentCanonicalUrl = '/' . (substr($strCurrentCanonicalUrl, 3));
    		$strCurrentCanonicalUrl = str_replace('//', '/', $strCurrentCanonicalUrl);
    	}
    	
    	return $strCurrentCanonicalUrl;
    }
    
    /**
     * Returns the menu block according to a canonical path
     * 
     * @access public, static
     * @param  integer $intMenuGroupId The Menu Group Id
     * @param  boolean $flatten        Return a flat array rather than children hierarchy
     * @param  string  $currentPath    (Optional) The current path
     * @return Array
     */
    public static final function getCurrentMenuByPath($intMenuGroupId, $flatten = false, $currentPath = null)
    {
    	$hasParent              = false;
    	$activeMenu             = array();
    	$currentMenu            = array();
    	$strCurrentCanonicalUrl = ((true === empty($currentPath)) ? self::getCurrentCanonicalUrl() : $currentPath);
    	$objCurrentMenu         = \Core\Hybernate\Menu\Menu::getInstance(array(
    		'url'      => $strCurrentCanonicalUrl,
    		'group_id' => (int) $intMenuGroupId	
    	));
    	
		if ($objCurrentMenu->getId() > 0) {
			$hasParent     = (bool) $objCurrentMenu->getParent_Id();
			$currentMenu[] = $objCurrentMenu;
			
			while (true === $hasParent) {
				$childMenu = \Core\Hybernate\Menu\Menu::getInstance((int) $objCurrentMenu->getParent_Id());
				$hasParent = (bool) $childMenu->getParent_Id();
				
				if ($childMenu->getId() > 0) {
					$currentMenu[] = $childMenu;
				}
			}
		}
    	
		if (empty($currentMenu) === false) {
			$objMenuTree = Menu_Tree::getInstance();
			foreach ($currentMenu as $menuObject) {
				$objMenuTree->add_row(
					(int) $menuObject->getId(), 
					(int) $menuObject->getParent_Id(), null, 
					$menuObject->getTitle(), 
					$menuObject->getUrl(), false
				);
			}
			
			$activeMenu = $objMenuTree->generate_raw_list(0, null);
			
			if (true === $flatten) {
				$flatMenu    = array();
				$flatMenu[0] = array_shift($activeMenu);
				$_current    = (isset($flatMenu[0]['children']) === true ? array_shift($flatMenu[0]['children']) : false);
				
				while (empty($_current) === false) {
					$flatMenu[] = $_current;
					$_current = (empty($_current['children']) === false ? array_shift($_current['children']) : false);
				}

				$activeMenu = $flatMenu;
			}
		}
		
    	return $activeMenu;
    }
    
    /**
     * This method loads the menu
     * @param Integer $intMenuGroupId The Menu Group Id
     * @param String  $strAttribute An extra attribute to add the main <UL> menu.
     *                                 Ex: attr = 'id="test"' will generate <ul id="test">...</ul>
     * @param String  $strCurrentCononicalUrl The current canonical URL (used to find the active menu item)
     * @return String $strMenuHtml The menu HTML
     */
    public static final function getSiteMenuHtml($intMenuGroupId, $strAttribute = '', $strCanonicalUrl = NULL, $blnAddMenuArrow = true)
    {
        $Application            = \Core\Application::getInstance();
        $objMenuTree            = Menu_Tree::getInstance();
        $strCurrentCanonicalUrl = ((false === is_null($strCanonicalUrl)) ? $strCanonicalUrl : self::getCurrentCanonicalUrl());
        $strMenuHtml            = null;
        $arrPageMenu            = array();

        $arrPageMenu = \Core\Hybernate\Menu\Menu::getObjectClassView(array(
            'cacheQuery'=>     false,
            'filter'     =>    array(
                'group_id'     => (int) $intMenuGroupId
            ),
            'orderBy'    => 'parent_id ASC, position',
            'direction'    => 'ASC'
        ));

        // Add the categories to the menu tree
        //$arrPageMenu = \Core\Hybernate\Menu\Menu::_addCategoriesMenu($arrPageMenu);

        if (false === empty($arrPageMenu))
        {
            $arrParents = array();
            foreach ($arrPageMenu as $arrRow)
            {
                if (false === empty($arrRow['parent_id']) && (int) $arrRow['parent_id'] > 0) {
                    $arrParents[(int) $arrRow['parent_id']] = true;
                }
            }

            reset ($arrRow);
            foreach ($arrPageMenu as $arrRow)
            {
                $blnIsCurrentPage   = false;
                $blnUsedCurrent     = false;
                if (false === empty($strCurrentCanonicalUrl))
                {
                    $strMenuUrl = $arrRow['url'];
                    $strMenuUrl = str_replace($Application->getConfigs()->get('Application.core.base_url'), '/', $strMenuUrl);
                    $strMenuUrl = str_replace('//', '/', $strMenuUrl);
                    $blnIsCurrentPage = $blnUsedCurrent = (bool) (rtrim($strCurrentCanonicalUrl, '/') == (rtrim($strMenuUrl, '/')));
                }

                $label  = '<a href="'. $arrRow['url'] .'" target="'. $arrRow['target'] .'" class="'. $arrRow['class'] .'">';
                $label .= $arrRow['title'];
                /*
                if (
                    (true === $blnAddMenuArrow) &&
                    (true  === array_key_exists((int) $arrRow['id'], $arrParents)) &&
                    (false === empty($arrRow['parent_id'])) // Make sure its not the first row!
                ) {
                    $label .= '<img src="/static/images/right.png" class="menuArrow" />';
                }
                */

                $label .= '</a>';
                $li_attr = ' class="';
                if ($arrRow['class'])
                {
                    $li_attr .= $arrRow['class'] . " ";
                }
                $li_attr .= ($blnIsCurrentPage ? 'current_page_item' : '') . '"';
                $objMenuTree->add_row($arrRow['id'], $arrRow['parent_id'], $li_attr, $label, null, $blnIsCurrentPage);
            }

            $strMenuHtml = $objMenuTree->generate_list($strAttribute);
        }

        return ($strMenuHtml);
    }

    /**
     * This method injects the categories in the menu tree
     *
     * @access protected statis
     * @return void
     */
    protected static function _addCategoriesMenu(array $currentMenu)
    {
        if (empty($currentMenu) === false) {
            $Application  = \Core\Application::getInstance();
            $firstElement = array_shift($currentMenu);

            foreach (\Core\Hybernate\Listings\Listing_Category::getObjectClassView(array('columns' => array(
                'a.id as intId',
                'a.urlKey as urlKey',
                'CONCAT("99999", a.id) as id',
                'IF(a.parentId = 0, "cat_menu", CONCAT("99999", a.parentId)) as parent_id',
                sprintf('a.name_%s as title', $Application->translate('en', 'fr', 'ch')),
                sprintf('a.description_%s as description', $Application->translate('en', 'fr', 'ch'))
            ), 'orderBy' => sprintf('a.orderIndex', $Application->translate('en', 'fr', 'ch')))) as $category) {

                array_unshift($currentMenu, array_merge(
                    $category,
                    array(
                        'url'     => $Application->getRequestDispatcher()->route('category', strtolower($category['urlKey']), array()),
                        'class'    => '',
                        'isCat' => true
                    )
                ));
            }

            array_unshift($currentMenu, array(
                'id'         => 'cat_menu',
                'class'     => '',
                'parent_id'    => 0,
                'title'     => 'Categories',
                'url'         => null,
                'isCat' => true
            ));


            // Re-instate the first array element
            array_unshift($currentMenu, $firstElement);
        }

        //\Core\Debug\Dump::getInstance($currentMenu); die;
        return $currentMenu;
    }

    /**
     * This method updates the position of a certain menu. its a recursive function.
     *
     * @access    public, static
     * @param     integer     $intParentId         - The menu parent ID
     * @param     array         $arrMenuChildren     - The menu children
     * @param     integer        $intMenuGroupId     - The menu groupId (used to clear the cache)
     * @return     void
     */
    public static function updateMenuPosition($intParentId = 0, $arrMenuChildren = array(), $intMenuGroupId = false)
    {
        $i = 1;
        foreach ($arrMenuChildren as $k => $v)
        {
            /**
             * Using iQuery here greatly improves the performance!
             */
            $intId = (int) $arrMenuChildren[$k]['id'];
            \Core\Application::getInstance()->getDatabase()->execute(
                "UPDATE " . strtolower(__CLASS__) . " " .
                "SET    parent_id = " . (int) $intParentId . ", " .
                "        position = " . (int) $i . " " .
                "WHERE    id = " . $intId
            );

            if (isset($arrMenuChildren[$k]['children'][0]))
            {
                self::updateMenuPosition($intId, $arrMenuChildren[$k]['children']);
            }
            $i++;
        }
    }
	
	/**
     * This method returns the parent menus
     *
     * @access public, static
     * @param  integer $groupId The menu group id
     * @return array
     */
    public static function getParentMenus($groupId = 0)
    {
		return \Core\Hybernate\Menu\Menu::getObjectClassView(array(
            'cacheQuery'=>     false,
            'filter'     =>    array(
                'group_id'   => (int) $groupId,
				'parent_id'  => 0
            ),
            'orderBy'    => 'position',
            'direction'  => 'ASC'
        ));	
	}
}


/**
 * Class for generating nested lists
 *
 * example:
 *
 * $tree = new Tree;
 * $tree->add_row(1, 0, '', 'Menu 1');
 * $tree->add_row(2, 0, '', 'Menu 2');
 * $tree->add_row(3, 1, '', 'Menu 1.1');
 * $tree->add_row(4, 1, '', 'Menu 1.2');
 * echo $tree->generate_list();
 *
 * output:4
 * <ul>
 *     <li>Menu 1
 *         <ul>
 *             <li>Menu 1.1</li>
 *             <li>Menu 1.2</li>
 *         </ul>
 *     </li>
 *     <li>Menu 2</li>
 * </ul>l..[''[0o;.0
 *
 * @author gawibowo
 */
class Menu_Tree
{

    /**
     * variable to store temporary data to be processed later
     *
     * @var array
     */
    var $data;

    public static final function getInstance()
    {
        return (new self());
    }

    /**
     * Add an item
     *
     * @param int $id             ID of the item
     * @param int $parent         parent ID of the item
     * @param string $li_attr     attributes for <li>
     * @param string $label        text inside <li></li>
     */
    function add_row($id=NULL, $parent=NULL, $li_attr=NULL, $label=NULL, $url=NULL, $current = false)
    {
        $this->data [$parent] [] = array ('id' => $id, 'li_attr' => $li_attr, 'label' => $label, 'url' => $url, 'is_current' => $current );
    }

    /**
     * Generates nested lists
     *
     * @param string $ul_attr
     * @return string
     */
    function generate_list($ul_attr = '')
    {
        return $this->ul ( 0, $ul_attr );
    }

    /**
     * Generates nested lists and returns the raw array
     *
     * @param integer $parentId - For recursive purposes
     * @return array
     */
    function generate_raw_list($parent=0)
    {
        static $i = 1;
        static $level = 0;
        if (isset ( $this->data [$parent] )) {
            /*if ($strAttribute) {
                $strAttribute = ' ' . $strAttribute;
            }*/
            $menuArray = array();
            $i ++;
            $level++;
            foreach ( $this->data [$parent] as $row ) {
                $child = $this->generate_raw_list ( $row ['id'] );
                $menuArray[] = array(
                    'attributes' => $row ['li_attr'],
                    'label'      => $row ['label'],
                    'url'        => $row ['url'],
                    'is_current' => $row ['is_current'],
                    'children'   => $child,
                    'menu_level' => $level
                );

                if ($child) { $i --; }
            }
            $level--;

            return $menuArray;
        }
        else
        {
            return array();
        }
    }

    /**
     * Recursive method for generating nested lists
     *
     * @param int $parent
     * @param string $strAttribute
     * @return string
     */
    function ul($parent = 0, $strAttribute = '')
    {
        static $i = 1;
        $indent = str_repeat ( "\t\t", $i );
        if (isset ( $this->data [$parent] )) {
			$strAttribute .= 'class="menu_group_' . $parent . ' ';
            if ($i > 1) $strAttribute .= 'sub-menu';
			$strAttribute .= '"';
					
            if ($strAttribute) {
                $strAttribute = ' ' . $strAttribute;
            }

            /*
            var_dump($this->data[$parent]); die;
            if (true === isset($this->data[$parent]['isCat'])) {
                $strAttribute = ' class="mega-grid"';
                die('ok');
            }*/
			
            $html = "\n$indent";
            $html .= "<ul$strAttribute>";
            $i ++;
			
			
            foreach ( $this->data [$parent] as $row ) {
				$row ['li_attr'] = ' class="menu_item_' . $row['id'] . ' ';
				if ($parent === 0) 
					$row ['li_attr'] .= 'menu-item-simple-parent ';
					
				if ($row ['is_current'] === true)
						$row ['li_attr'] .= 'current_page_item ';
						
				$row ['li_attr'] .= '"';
				
                $child = $this->ul ( $row ['id'] );
                $html .= "\n\t$indent";
                $html .= '<li' . $row ['li_attr'] . '>';
                $html .= $row ['label'];

                if ($child) {
                    $i --;
                    $html .= $child;
                    $html .= "\n\t$indent <a class=\"dt-menu-expand\">+</a>";
                }
                $html .= '</li>';
            }
            $html .= "\n$indent</ul>";
            return $html;
        } else {
            return false;
        }
    }

    /**
     * Clear the temporary data
     *
     */
    function clear()
    {
        $this->data = array ();
    }
}

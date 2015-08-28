<?php
/**
 * Index Controller
 *
 * @package    Admin
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

namespace Ipm\Mvc\Controller;

/**
 * Base controller for admin section
 *
 * @package    Admin
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

class AboutController
    extends \Core\Net\HttpRequest
{
   /**
    * index action
    *
    * @return void
    */
   public final function preDispatch(array $requestDispatchData)
   {
	   $this->setViewData('PageResource', \Core\Hybernate\Page\Page::getCurrentPage());
   }
	   
   /**
    * index action
    *
    * @return void
    */
   public final function indexAction(array $requestDispatchData)
   {
        //$this->setView(false);
        //$this->setLayout(false);
   }
   
   /**
    * Enseignants action
    *
    * @return void
    */
   protected final function enseignantsAction(array $requestDispatchData)
   {
   }
   
   /**
    * Students action
    *
    * @return void
    */
   protected final function studentsAction(array $requestDispatchData)
   {
   }
   
   /**
    * Collaborators action
    *
    * @return void
    */
   protected final function collaboratorsAction(array $requestDispatchData)
   {
   }
}

<?php
/**
 * Contact Controller
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
 * @file       Views/ContactControler.php
 * @desc       Used interface for base objects implementations
 * @author     Avi Aialon
 * @license    BSD/GPLv2
 *
 * copyright (c) Avi Aialon (DeviantLogic)
 * This source file is subject to the BSD/GPLv2 License that is bundled
 * with this source code in the file license.txt.
 */

class ContactController
    extends \Core\Net\HttpRequest
{
   /**
    * Predispatch hook
    *
    * @return void
    */
   public final function preDispatch(array $requestDispatchData)
   {
   }
	   
   /**
    * index action
    *
    * @return void
    */
   public final function indexAction(array $requestDispatchData)
   {
   }
}
<?php
/**
 * Sponsors Controller
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

class SponsorsController
    extends \Core\Net\HttpRequest
{ 
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
    * gold sponsor more page action
    *
    * @return void
    */
   public final function goldAction(array $requestDispatchData)
   {
	   $this->setViewData('title', 'La Caisse de l’Éducation, un atout dans ma carrière!');
   }
}

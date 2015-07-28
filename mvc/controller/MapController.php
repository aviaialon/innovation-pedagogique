<?php
/**
 * Map Controller
 *
 * @package    Admin
 * @subpackage None
 * @file       Admin/MapControler.php
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
 * Map controller
 *
 * @package    Admin
 * @subpackage None
 * @file       Admin/MapControler.php
 * @desc       Used interface for base objects implementations
 * @author     Avi Aialon
 * @license    BSD/GPLv2
 *
 * copyright (c) Avi Aialon (DeviantLogic)
 * This source file is subject to the BSD/GPLv2 License that is bundled
 * with this source code in the file license.txt.
 */

class MapController
    extends \Core\Net\HttpRequest
{
  /**
    * Large map action
    *
    * @return void
    */
	protected final function largeAction(array $requestDispatchData)
	{
		$this->setLayout('blank.php');
	}
}